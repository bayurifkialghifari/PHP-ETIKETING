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
		$this->title 		= 'Voucher';
		$this->content 		= 'voucher-data'; 
		$this->plugins 		= ['datatables','formatrupiah'];
		$this->navigation 	= ['Voucher'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->voucher->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->voucher->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$nama 			= $this->input->post('nama');
		$kode 			= $this->input->post('kode');
		$persen 		= $this->input->post('persen');
		$batas 			= $this->input->post('batas');
		$jumlah 		= $this->input->post('jumlah');
		$keterangan 	= $this->input->post('keterangan');
		$tanggal 		= $this->input->post('tanggal_akhir');

		$r = $this->voucher->insert($nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal);

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
		$nama 			= $this->input->post('nama');
		$kode 			= $this->input->post('kode');
		$persen 		= $this->input->post('persen');
		$batas 			= $this->input->post('batas');
		$jumlah 		= $this->input->post('jumlah');
		$keterangan 	= $this->input->post('keterangan');
		$tanggal 		= $this->input->post('tanggal_akhir');

		$r = $this->voucher->update($id, $nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal);

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

		$r 		= $this->voucher->delete($id);

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

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('voucher/dataModel', 'voucher');
		// cek session
		$this->sesion->cek_session();
	}
}