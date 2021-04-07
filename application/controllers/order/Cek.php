<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Cek extends Render_Controller {

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
		
		// Page config:
		
		$this->title 		= 'Cek Pesanan';
		$this->content 		= 'order-cek'; 
		$this->plugins 		= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		// $this->navigation 	= ['Pengaturan'];
		
		// Commit render:
		$this->render();
	}

	public function orderan()
	{
		$kode 		= $this->input->post('kode');
		$email 		= $this->input->post('email');

		$cek 		= $this->model->cekOrderan($kode, $email);

		$this->output_json($cek);
	}

	// Tiket Kereta Detail
	public function orderanKereta()
	{
		$id 		= $this->input->post('id');

		$cek 		= $this->model->cekKereta($id);

		$this->output_json($cek);
	}

	// Tiket Pesawat Detail
	public function orderanPesawat()
	{
		$id 		= $this->input->post('id');

		$cek 		= $this->model->cekPesawat($id);

		$this->output_json($cek);
	}

	private function output_json($data) 
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/main-page';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('order/cekModel', 'model');
	}
}