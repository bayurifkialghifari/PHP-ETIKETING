<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class LupaPassword extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Lupa Password';
		$this->content = 'lupaPassword';
		$this->navigation = [];
		$this->data['status'] = '';
		$this->render();
	}

	// Cek akun
	public function cekAkun()
	{
		$email 	= $this->input->post('email');

		$cek 	= $this->model->cekAkunLupas($email);

		if($cek->num_rows() > 0)
		{
			echo json_encode(array('status' => 1, 'data' => $cek->row_array()));
		}
		else
		{
			echo json_encode(array('status' => 0, 'data' => 0));
		}
	}

	// Kirim link lupa password
	public function kirimLink()
	{
		$id 		= $this->input->post('id');
		$email 		= $this->input->post('email');
		$token 		= $this->input->post('token');

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

        $this->email->subject('Link Ganti Password');

        $data['url']    = base_url()."lupaPassword/halamanReset?id=".$id."&email=".$email."&token=".$token;
        $view           = $this->load->view('email/linkLupaPassword', $data, TRUE);

        $this->email->message($view);

        if (!$this->email->send()) 
        {
            show_error($this->email->print_debugger());

            exit; 
        }

        echo json_encode(array('status' => 1));
	}

	// Halaman Reset
	public function halamanReset()
	{
		$id 		= $this->input->get('id');
		$email 		= $this->input->get('email');
		$token 		= $this->input->get('token');

		$this->data['id'] 		= $id;
		$this->data['email'] 	= $email;
		$this->data['token'] 	= $token;
		$this->data['status'] 	= 'Reset Password';

		$this->render();
	}

	// Reset password
	public function reset()
	{
		$id 			= $this->input->post('id');
		$email 			= $this->input->post('email');
		$token 			= $this->input->post('token');
		$password 		= $this->input->post('password');

		$cek 			= $this->model->cekAkun($id, $email, $token, $password);

		if($cek['status'] == 0)
		{
			echo "<script>alert('Password anda berhasil di ubah !!')</script>";

			redirect('login','refresh');
		}else
		{
			echo "<script>alert('Email tidak ditemukan')</script>";
			
			redirect('lupaPassword','refresh');
		}
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/lupaPassword';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		
	}
}