<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 		= 'Pesawat Data';
		$this->content 		= 'pesawat-data'; 
		$this->plugins 		= ['datatables', 'autocomplete'];
		$this->navigation 	= ['Pesawat'];

		$this->data['maskapai'] = $this->getMaskapai();
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->pesawat->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->pesawat->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$maskapai 		= $this->input->post('maskapai');
		$kode 			= $this->input->post('kode');
		$nama 			= $this->input->post('nama');
		$deskripsi 		= $this->input->post('deskripsi');
		$kursi 			= $this->input->post('kursi');
		$status 		= $this->input->post('status');

		$r = $this->pesawat->insert($maskapai, $kode, $nama, $deskripsi, $kursi, $status);

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
		$maskapai 		= $this->input->post('maskapai');
		$kode 			= $this->input->post('kode');
		$nama 			= $this->input->post('nama');
		$deskripsi 		= $this->input->post('deskripsi');
		$kursi 			= $this->input->post('kursi');
		$status 		= $this->input->post('status');

		$r = $this->pesawat->update($id, $maskapai, $kode, $nama, $deskripsi, $kursi, $status);

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

		$r 		= $this->pesawat->delete($id);

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

	private function getMaskapai()
	{
		return $this->db->get('maskapai')->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('pesawat/dataModel', 'pesawat');
		// cek session
		$this->sesion->cek_session();
	}
}