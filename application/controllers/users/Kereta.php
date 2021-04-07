<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Kereta extends Render_Controller {

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
		
		$this->title 		= 'Cari perjalanan';
		$this->content 		= 'kereta-data'; 
		$this->plugins 		= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['rute'] = $this->getStasiun();
		$this->data['kelas']= $this->getKelas();
		// $this->navigation 	= ['Pengaturan'];
		
		// Commit render:
		$this->render();
	}

	private function output_json($data) 
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	private function getStasiun()
	{
		$this->db->select(" a.*, b.* ");
		$this->db->from("stasiun a");
		$this->db->join("kota b", 'b.kota_id = a.stat_kota_id', 'left');

		return $this->db->get()->result_array();
	}

	private function getKelas()
	{
		return $this->db->get('kelas')->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/main-page';
		$this->load->library('plugin');
		$this->load->helper('url');
		// $this->load->model('pengaturan/hakAkses_model', 'hakAkses');
	}
}