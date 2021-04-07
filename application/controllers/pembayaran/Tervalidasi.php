<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Tervalidasi extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 		= 'Pembayaran Data';
		$this->content 		= 'pembayaran-tervalidasi'; 
		$this->plugins 		= ['datatables', 'autocomplete'];
		$this->navigation 	= ['Validasi Pembayaran'];
		$this->data['tervalidasi'] = $this->pembayaran->getAllIsi()->result_array();

		// Commit render:
		$this->render();
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
		$this->load->model('pembayaran/tervalidasiModel', 'pembayaran');
		// cek session
		$this->sesion->cek_session();
	}
}