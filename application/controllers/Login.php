<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Login extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('status') == false)
		{
			$session   			= array('data'	 => array
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
		$this->title 				= 'Login';
		$this->content 				= 'login';
		$this->navigation 			= [];

		// Facebook URL
		$this->data['urlFacebook'] 	= $this->facebook->login_url();

		$this->render();

	}






	// Native Login
	public function doLogin(){
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}


		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		$login 		= $this->model->cekLogin($email,$password);

		
		if($login['status'] == 0){
			$session = array(
				'status' => true,
				'data'	 => array
								(
									'id' => $login['data'][0]['user_id'],
									'nama' => $login['data'][0]['user_name'],
									'email' => $login['data'][0]['user_email'], 
									'level' => $login['data'][0]['lev_nama'],
								)
			);
			$this->session->set_userdata($session);

			$this->output->set_content_type('application/json');
			
			if($login['data'][0]['lev_nama'] == 'User')
			{
				$this->output->set_output(json_encode(array('status' => 2)));
			}
			else
			{
				$this->output->set_output(json_encode(array('status' => 1)));
			}
			
		}else {
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('status' => 0)));
		}
	}





	// Login With Facebook
	public function loginWithFB()
	{
		if($this->facebook->is_authenticated())
		{
			
			$userProfile = $this->facebook->request('get', '/me?fields=id,name,first_name,last_name,email,gender,locale,picture');

			// $data = array(		'name'=>$userProfile['name'],
			// 				  	'email'=>$userProfile['email'],
			// 				  	'gambar'=>$userProfile['picture']['data']['url']);
			
			$session = array(
				'status' => true,
				'data'	 => array
								(
									'id' => 1,
									'nama' => $userProfile['name'],
									'email' => $userProfile['email'], 
									'level' => 'Customer',
								)
			);

			$this->session->set_userdata($session);

			redirect('users/home','refresh');
		}

		exit;
	}



	// Login With Google 
	public function loginWithGoogle()
	{
		$id 	= $this->input->post('id');
		$nama 	= $this->input->post('name');
		$email 	= $this->input->post('email');
		$gambar = $this->input->post('gambar');

		$session = array(
				'status' => true,
				'data'	 => array
								(
									'id' => 1,
									'nama' => $nama,
									'email' => $email, 
									'level' => 'Customer',
								)
			);

		$this->session->set_userdata($session);

		echo json_encode(array('status' => 'Success'));
	}




	// Logout function
	public function logout() {
		$session = array('status','data');
		
		$this->session->unset_userdata($session);

		redirect('users/home', 'refresh');
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/login';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');

		// Facebook Liblary
		$this->load->library('facebook');

	}
}