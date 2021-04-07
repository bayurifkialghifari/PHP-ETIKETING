<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Register extends Render_Controller {

	public function index()
	{
        if($this->session->userdata('status') == false)
        {
            $session            = array('data'   => array
                                        (
                                            'id' => 0
                                        )
                                    );

            $this->session->set_userdata($session);
        }
        
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title 		= 'Register';
		$this->navigation 	= [];
		$this->render();
	}

	public function daftar()
	{
		$username 	= $this->input->post('nama');
		$email 		= $this->input->post('email');
		$notelepon	= $this->input->post('notelp');
		$password 	= $this->b_password->create_hash($this->input->post('password'));
		$token 		= $password;
    
        $exe 		= $this->model->daftar($username, $email, $notelepon, $password, $token);

        if($exe == 0)
        {
            echo "<script>alert('Gagal mendaftar !! Email telah digunakan !')</script>";
        
            redirect('register','refresh');   
        }

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

        $this->email->to($email); // Ganti dengan email tujuan kamu

        $this->email->subject('Verivikasi Akun Anda');

        $data['url']    = base_url()."register/verivikasi?id=".$exe."&email=".$email."&token=".$token."&notelp=".$notelepon;
        $view           = $this->load->view('email/validasi', $data, TRUE);

        $this->email->message($view);

        if (!$this->email->send()) 
        {
            show_error($this->email->print_debugger());

            exit; 
        }
        else
        {
        	echo "<script>alert('Daftar Success !! Silakan Verivikasi Email Anda !')</script>";
    	
			redirect('login','refresh');
        }

        exit;
	}

	public function verivikasi()
	{
        $id             = $this->input->get('id');
        $email          = $this->input->get('email');
        $token          = $this->input->get('token');
        $notelp         = $this->input->get('notelp');
        $verivikasi     = $this->model->verivikasi($id, $email, $token, $notelp);

        echo "<script>alert('Akun dengan nama ".$verivikasi['user_name']." sudah aktif !!')</script>";

        redirect('login','refresh');
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/register';
		$this->load->model('registerModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');

	}

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */