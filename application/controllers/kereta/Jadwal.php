<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Jadwal extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 			= 'Kereta Jadwal';
		$this->content 			= 'kereta-jadwal'; 
		$this->plugins 			= ['datatables', 'autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->navigation 		= ['Jadwal'];

		$this->data['kereta'] 	= $this->getKereta();
		$this->data['rute'] 	= $this->getRute();
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->jadwal->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->jadwal->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$kode 					= $this->input->post('kode');
		$kereta 				= $this->input->post('kereta');
		$rute 					= $this->input->post('rute');
		$tipePerjalanan 		= $this->input->post('tipePerjalanan');
		$berangkat				= $this->input->post('berangkat');
		$jamBerangkat 			= $this->input->post('jamBerangkat');
		$jamBerangkatSampai 	= $this->input->post('jamBerangkatSampai');
		$pulang 				= $this->input->post('pulang');
		$jamPulang 				= $this->input->post('jamPulang');
		$jamPulangSampai 		= $this->input->post('jamPulangSampai');
		$keterangan 			= $this->input->post('keterangan');
		$status 				= $this->input->post('status');

		$r = $this->jadwal->insert($kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function update() 
	{

		// Input values
		$id 					= $this->input->post('id');
		$kode 					= $this->input->post('kode');
		$kereta 				= $this->input->post('kereta');
		$rute 					= $this->input->post('rute');
		$tipePerjalanan 		= $this->input->post('tipePerjalanan');
		$berangkat				= $this->input->post('berangkat');
		$jamBerangkat 			= $this->input->post('jamBerangkat');
		$jamBerangkatSampai 	= $this->input->post('jamBerangkatSampai');
		$pulang 				= $this->input->post('pulang');
		$jamPulang 				= $this->input->post('jamPulang');
		$jamPulangSampai 		= $this->input->post('jamPulangSampai');
		$keterangan 			= $this->input->post('keterangan');
		$status 				= $this->input->post('status');

		$r = $this->jadwal->update($id, $kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $r,
				]
			);
		}
	}

	public function delete() 
	{

		// Input values
		$id 	= $this->input->post('id');

		$r 		= $this->jadwal->delete($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}


	private function output_json($data) 
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	private function getKereta()
	{
		return $this->db->get('kereta')->result_array();
	}

	private function getRute()
	{
		$this->db->select(" a.*, b.kota_nama as kota_asal, b.kota_id as kota_asal_id, c.kota_nama as kota_tujuan, c.kota_id as kota_tujuan_id, d.stat_nama as stat_asal, d.stat_id as stat_asal_id, e.stat_nama as stat_tujuan, e.stat_id as stat_tujuan_id ");
		$this->db->from("rute_kereta a");
		$this->db->join("kota b", 'a.rute_kota_asal_id = b.kota_id', 'left');
		$this->db->join("kota c", 'a.rute_kota_tujuan_id = c.kota_id', 'left');
		$this->db->join("stasiun d", 'a.rute_stat_asal_id = d.stat_id', 'left');
		$this->db->join("stasiun e", 'a.rute_stat_tujuan_id = e.stat_id', 'left');

		return $this->db->get()->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('kereta/jadwalModel', 'jadwal');
		// cek session
		$this->sesion->cek_session();
	}
}