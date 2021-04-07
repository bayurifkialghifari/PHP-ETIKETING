<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/paypal-php-sdk/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files

use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class Pembayaran extends CI_Controller
{
    public $_api_context;

    function  __construct()
    {
        parent::__construct();
        $this->load->model('users/pembayaranModel', 'paypal');
        
        // paypal credentials
        $this->config->load('paypal');
        $this->load->library('plugin');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    }

    public function pesanPembayaran()
    {
    	$typePembayaran 	= $this->input->post('type');

        // setup PayPal api context
        $this->_api_context->setConfig($this->config->item('settings'));



        // Tiket
        $tiketId 			= $this->input->post('tiketId');
        $hargaUSD 			= $this->input->post('hargaUSD');
        $hargaIDR 			= $this->input->post('hargaIDR');

        // Pemesan Data
        $titlepemesan 		= $this->input->post('titlepemesan');
        $namapemesan 		= $this->input->post('namapemesan');
        $emailpemesan 		= $this->input->post('emailpemesan');

        $exePemesan 		= $this->paypal->insertPemesan($titlepemesan, $namapemesan, $emailpemesan);

        $exePenumpang 		= $this->paypal->insertPenumpang();

        $exePemesananTiket 	= $this->paypal->insertTiketDetail($exePenumpang, $exePemesan, $tiketId);

        $arraySessionPemesan = array('pemesan'=>$exePemesan);
        
        $this->session->set_userdata( $arraySessionPemesan );

        // Kota
        $kotaAsal 			= $this->input->post('kota_asal');
        $kotaTujuan 		= $this->input->post('kota_tujuan');


        // Untuk Pembayarab Manual
        if($typePembayaran == 'manual')
        {
            $config     = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'gwp01070@gmail.com',
                'smtp_pass' => '@Cimahi123',
                // 'mailtype'  => 'html', 
                // 'charset' => 'utf-8',
                'wordwrap' => TRUE

            );


            $this->load->library('email', $config);
            
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            
            $this->email->set_header('Content-type', 'text/html');

            $this->email->set_newline("\r\n");

            $this->email->from('etiketing.com', 'Etiketing - Cari & Pesan Tiket Online');

            $this->email->to($emailpemesan); // Ganti dengan email tujuan kamu

            $this->email->subject('Upload Bukti Pembayaran Anda');

            $data['url']    = base_url() . "users/pembayaran/uploadBuktiPembayaran/" . $exePemesan . '?token='. generate(20);
            $view           = $this->load->view('email/buktiPembayaran', $data, TRUE);

            $this->email->message($view);

            if (!$this->email->send()) 
            {
                show_error($this->email->print_debugger());

                exit; 
            }
	        else
	        {
	        	echo "<script>alert('Link untuk upload pembayaran dikirim ke email anda !')</script>";
	    	
				redirect('users/pembayaran/uploadBuktiPembayaran/' . $exePemesan . '?token=' . generate(20) ,'refresh');
	        }
        }

        // Untuk PayPal

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.

        $payer['payment_method'] = 'paypal';

// ### Itemized information
// (Optional) Lets you specify item wise
// information
        $item1["name"] 			= 'Tiket Pesawat';
        $item1["sku"] 			= 'TIKP-0000';  // Similar to `item_number` in Classic API
        $item1["description"] 	= 'Tiket Pesawat Dari '.$kotaAsal.' Ke '.$kotaTujuan;
        $item1["currency"] 		= 'USD';
        // $item1["quantity"]      = $exePenumpang;
        $item1["quantity"]      = 1;
        $item1["price"] 		= number_format($hargaUSD, 2, '.', '');

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
        $details['tax'] 		= 0;
        // $details['subtotal']    = number_format((int)$hargaUSD * (int)$exePenumpang, 2, '.', '');
        $details['subtotal'] 	= number_format((int)$hargaUSD, 2, '.', '');
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount['currency'] 	= 'USD';
        $amount['total'] 		= number_format((int)$details['tax'] + (int)$details['subtotal'], 2, '.', '');
        $amount['details'] 		= $details;
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
        $transaction['description'] 	='Payment Detail';
        $transaction['amount'] 			= $amount;
        $transaction['invoice_number'] 	= uniqid();
        $transaction['item_list'] 		= $itemList;

        // ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
        $baseUrl = base_url();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($baseUrl."users/pembayaran/getPaymentStatus")
            ->setCancelUrl($baseUrl."users/pembayaran/getPaymentStatus");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $ex);
            exit(1);
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            redirect($redirect_url);
        }

        redirect('users/home', 'refresh');

    }


    public function getPaymentStatus()
    {

        // paypal credentials

        /** Get the payment ID before session clear **/
        $payment_id 		= $this->input->get("paymentId") ;
        $PayerID 			= $this->input->get("PayerID") ;
        $token 				= $this->input->get("token") ;
        /** clear the session payment ID **/

        if (empty($PayerID) || empty($token)) {
            echo "<script>alert('Pembayaran Gagal !! Coba Lagi ')</script>";

	        redirect('users/home', 'refresh');
        }

        $payment = Payment::get($payment_id, $this->_api_context);


        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution,$this->_api_context);



        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            $trans = $result->getTransactions();

            // item info
            $Subtotal 		= $trans[0]->getAmount()->getDetails()->getSubtotal();
            $Tax 			= $trans[0]->getAmount()->getDetails()->getTax();

            $payer 			= $result->getPayer();
            // payer info //
            $PaymentMethod 	= $payer->getPaymentMethod();
            $PayerStatus 	= $payer->getStatus();
            $PayerMail 		= $payer->getPayerInfo()->getEmail();

            $relatedResources 	= $trans[0]->getRelatedResources();
            $sale 				= $relatedResources[0]->getSale();
            // sale info //
            $saleId 		= $sale->getId();
            $CreateTime 	= $sale->getCreateTime();
            $UpdateTime 	= $sale->getUpdateTime();
            $State 			= $sale->getState();
            $Total 			= $sale->getAmount()->getTotal();
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $this->paypal->createPembayaran($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State);

            $pemesanan = $this->paypal->updatePembayaran()->row_array();

            // Send Bukti Pembayaran
            $this->sendReceipt($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State);

            // Send Tiket
            $config     = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'gwp01070@gmail.com',
                'smtp_pass' => '@Cimahi123',
                // 'mailtype'  => 'html', 
                // 'charset' => 'utf-8',
                'wordwrap' => TRUE

            );

            $pemesan    = $this->session->userdata('pemesan');
            $email      = $this->db->get_where('pemesan', ['peme_id' => $pemesan])->row_array();

            $this->load->library('email', $config);
            
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            
            $this->email->set_header('Content-type', 'text/html');

            $this->email->set_newline("\r\n");

            $this->email->from('etiketing.com', 'Etiketing - Cari & Pesan Tiket Online');

            $this->email->to($email['peme_email']); // Ganti dengan email tujuan kamu

            $this->email->subject('Tiket Penerbangan Anda');

            $data['getDataPenerbangan']     = $this->paypal->getPenerbangan()->result_array();

            $view                           = $this->load->view('email/tiketPenerbangan', $data, TRUE);

            $this->email->message($view);

            if (!$this->email->send()) 
            {
                show_error($this->email->print_debugger());

                exit; 
            }
            else
            {
                echo "<script>alert('Pembayaran Success !! Cek email anda untuk melihat tiket !!')</script>";
            
                redirect('users/home', 'refresh');
            }
            
        }

        echo "<script>alert('Pembayaran Success !!')</script>";;
        
        redirect('users/home', 'refresh');
    }






    // Receipt / Tanda Pembayaran
    public function sendReceipt($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State)
    {
        // Send Tiket
        $config     = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'gwp01070@gmail.com',
            'smtp_pass' => '@Cimahi123',
            // 'mailtype'  => 'html', 
            // 'charset' => 'utf-8',
            'wordwrap' => TRUE

        );

        $pemesan    = $this->session->userdata('pemesan');
        $email      = $this->db->get_where('pemesan', ['peme_id' => $pemesan])->row_array();

        $this->load->library('email', $config);
        
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        
        $this->email->set_header('Content-type', 'text/html');

        $this->email->set_newline("\r\n");

        $this->email->from('etiketing.com', 'Etiketing - Cari & Pesan Tiket Online');

        $this->email->to($email['peme_email']); // Ganti dengan email tujuan kamu

        $this->email->subject('Payment Receipt');

        $data['getDataPenerbangan']     = $this->paypal->getPenerbangan()->result_array();
        $data['tipe']                   = 'Pesawat';
        $data['email']                  = $PayerMail;
        $data['total']                  = $Total;

        $view                           = $this->load->view('email/paymentRecipt', $data, TRUE);

        $this->email->message($view);

        if (!$this->email->send())
        {
            show_error($this->email->print_debugger());

            exit;
        }
    }


    // Upload Bukti
    public function uploadBuktiPembayaran($exePemesan)
    {
    	$data['idPemesan'] 	= $exePemesan;

    	$this->load->view('upload/butktiPembayaran', $data);
    }

    public function uploadBukti()
    {
    	$config['upload_path'] 		= './assets/upload/buktiPembayaran/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
		$config['max_size']  		= '2000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
		
		$this->load->library('upload', $config);

		
		$this->upload->do_upload('bukti');

		$bukti 		= $this->upload->data();
		$bukti 		= $bukti['file_name'];
		$idPemesan  = $this->input->post('idPemesan');

		$r 			= $this->paypal->createPembayaranManual($bukti, $idPemesan);

		echo json_encode(array('status' => 'Success'));
    }
}