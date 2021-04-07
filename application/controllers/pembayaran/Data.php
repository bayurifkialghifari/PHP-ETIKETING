<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 		= 'Pembayaran Data';
		$this->content 		= 'pembayaran-data'; 
		$this->plugins 		= ['datatables', 'autocomplete'];
		$this->navigation 	= ['Validasi Pembayaran'];

		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->pembayaran->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->pembayaran->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}


	// Jika Valid
	public function valid() 
	{

		// Input values
		$id 	= $this->input->post('id');

		$r 		= $this->pembayaran->valid($id);

		// Kirim Tiket Pesawat
		if($r == 'Pesawat')
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

	        $pemesan    = $this->db->get_where('pembayaran', ['txn_id' => $id])->row_array()['peme_id'];
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
	            if($r !== FALSE) {
					$this->output_json(
						[
							'id' => $id
						]
					);
				}
	        }
		}
		// Kirim Tiket Kereta
		else
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

            $pemesan    = $this->db->get_where('pembayaran', ['txn_id' => $id])->row_array()['peme_id'];
	        $email      = $this->db->get_where('pemesan', ['peme_id' => $pemesan])->row_array();

            $this->load->library('email', $config);
            
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            
            $this->email->set_header('Content-type', 'text/html');

            $this->email->set_newline("\r\n");

            $this->email->from('etiketing.com', 'Etiketing - Cari & Pesan Tiket Online');

            $this->email->to($email['peme_email']); // Ganti dengan email tujuan kamu

            $this->email->subject('Tiket Kereta Anda');

            $data['getDataKererta']         = $this->paypalk->getPerjalanan()->result_array();

            $view                           = $this->load->view('email/tiketPerjalanan', $data, TRUE);

            $this->email->message($view);

            if (!$this->email->send()) 
            {
                show_error($this->email->print_debugger());

                exit;
            }
            else
        	{
        		if($r !== FALSE) {
					$this->output_json(
						[
							'id' => $id
						]
					);
				}
        	}
		}
	}

	public function tidakValid() 
	{

		// Input values
		$id 	= $this->input->post('id');

		$r 		= $this->pembayaran->tidakValid($id);

		// Kirim keterangan tidak valid
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

        $pemesan    = $this->db->get_where('pembayaran', ['txn_id' => $id])->row_array()['peme_id'];
        $email      = $this->db->get_where('pemesan', ['peme_id' => $pemesan])->row_array();

        $this->load->library('email', $config);
        
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        
        $this->email->set_header('Content-type', 'text/html');

        $this->email->set_newline("\r\n");

        $this->email->from('etiketing.com', 'Etiketing - Cari & Pesan Tiket Online');

        $this->email->to($email['peme_email']); // Ganti dengan email tujuan kamu

        $this->email->subject('Pembayaran tidak valid !!');

        $data['keterangan'] 			= 'Tidak Valid';

        $view                           = $this->load->view('email/keteranganTidakValid', $data, TRUE);

        $this->email->message($view);

        if (!$this->email->send()) 
        {
            show_error($this->email->print_debugger());

            exit;
        }
        else
        {
			if($r !== FALSE) {
				$this->output_json(
					[
						'id' => $id
					]
				);
			}
        }
	}


	private function output_json($data) 
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('pembayaran/dataModel', 'pembayaran');
		$this->load->model('users/pembayaranModel', 'paypal');
		$this->load->model('users/pembayaranKeretaModel', 'paypalk');
		// cek session
		$this->sesion->cek_session();
	}
}