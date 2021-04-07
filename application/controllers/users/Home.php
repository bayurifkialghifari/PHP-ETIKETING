<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Home extends Render_Controller {

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
		
		$this->title 		= 'Cari penerbangan';
		$this->content 		= 'pesawat-data'; 
		$this->plugins 		= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['rute'] = $this->getKota();
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

	private function getKota()
	{
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("bandara a");
		$this->db->join("kota b", 'b.kota_id = a.band_kota_id', 'left');
		$this->db->join("negara c", 'c.nega_id = a.band_nega_id', 'left');

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