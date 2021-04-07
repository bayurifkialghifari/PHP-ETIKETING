<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Bandara extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 			= 'Referensi Bandara';
		$this->content 			= 'referensi-bandara'; 
		$this->plugins 			= ['datatables','autocomplete'];
		$this->navigation 		= ['Referensi'];
		$this->data['kota'] 	= $this->getValueKota();
		$this->data['negara'] 	= $this->getValueNegara();
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->bandara->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->bandara->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$kode 			= $this->input->post('kode');
		$negara 		= $this->input->post('negara');
		$kota 			= $this->input->post('kota');
		$nama 			= $this->input->post('nama');
		$deskripsi 		= $this->input->post('deskripsi');

		$r = $this->bandara->insert($kode, $negara, $kota, $nama, $deskripsi);

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
		$kode 			= $this->input->post('kode');
		$negara 		= $this->input->post('negara');
		$kota 			= $this->input->post('kota');
		$nama 			= $this->input->post('nama');
		$deskripsi 		= $this->input->post('deskripsi');

		$r = $this->bandara->update($id, $kode, $negara, $kota, $nama, $deskripsi);

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

		$r 		= $this->bandara->delete($id);

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

	private function getValueKota()
	{
		return $this->db->get('kota')->result_array();
	}

	private function getValueNegara()
	{
		return $this->db->get('negara')->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('referensi/bandaraModel', 'bandara');
		// cek session
		$this->sesion->cek_session();
	}
}