<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Rute extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 			= 'Penerbangan Rute';
		$this->content 			= 'penerbangan-rute'; 
		$this->plugins 			= ['datatables', 'autocomplete', 'formatrupiah'];
		$this->navigation 		= ['Rute'];

		$this->data['kota'] 	= $this->getKota();
		$this->data['bandara'] 	= $this->getBandara();
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->rute->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->rute->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$kode 				= $this->input->post('kode');
		$kota_asal 			= $this->input->post('kota_asal');
		$kota_tujuan 		= $this->input->post('kota_tujuan');
		$bandara_asal 		= $this->input->post('bandara_asal');
		$bandara_tujuan		= $this->input->post('bandara_tujuan');
		$jarak 				= $this->input->post('jarak');
		$harga 				= $this->input->post('harga');
		$status 			= $this->input->post('status');

		$r = $this->rute->insert($kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status);

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
		$id 			= $this->input->post('id');
		$kode 				= $this->input->post('kode');
		$kota_asal 			= $this->input->post('kota_asal');
		$kota_tujuan 		= $this->input->post('kota_tujuan');
		$bandara_asal 		= $this->input->post('bandara_asal');
		$bandara_tujuan		= $this->input->post('bandara_tujuan');
		$jarak 				= $this->input->post('jarak');
		$harga 				= $this->input->post('harga');
		$status 			= $this->input->post('status');

		$r = $this->rute->update($id, $kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status);

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

		$r 		= $this->rute->delete($id);

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

	private function getKota()
	{
		return $this->db->get('kota')->result_array();
	}

	private function getBandara()
	{
		return $this->db->get('bandara')->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('penerbangan/ruteModel', 'rute');
		// cek session
		$this->sesion->cek_session();
	}
}