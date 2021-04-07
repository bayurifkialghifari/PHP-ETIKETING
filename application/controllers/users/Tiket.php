<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Tiket extends Render_Controller {

	public function pesanPesawat()
	{
		// Page config:
		$hasil 					= $this->input->get('hasil');
		
		$this->title 			= 'Pesan Tiket';
		$this->content 			= 'pesawat-pesan'; 
		$this->plugins 			= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['dewasa']	= $this->input->get('dewasa');
		$this->data['anak']		= $this->input->get('anak');
		$this->data['bayi']		= $this->input->get('bayi');
		$this->data['tiketId']	= $hasil;
		$this->data['negara'] 	= $this->getNegara();
		$this->data['pesawat'] 	= $this->tiket->getPenerbangan($hasil)->row_array();
		
		// Commit render:
		$this->render();
	}

	public function pesanKereta()
	{
		$hasil 					= $this->input->get('hasil');

		$this->title 			= 'Pesan Tiket';
		$this->content 			= 'kereta-pesan'; 
		$this->plugins 			= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['dewasa']	= $this->input->get('dewasa');
		$this->data['bayi']		= $this->input->get('bayi');
		$this->data['tiketId']	= $hasil;
		$this->data['kereta'] 	= $this->tiket->getPerjalanan($hasil)->row_array();
		
		// Commit render:
		$this->render();
	}

	private function output_json($data) 
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	private function getNegara()
	{
		return $this->db->get('negara')->result_array();
	}


	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/main-page';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('users/tiketModel', 'tiket');
	}
}