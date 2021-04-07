<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Maskapai extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 		= 'Referensi Maskapai';
		$this->content 		= 'referensi-maskapai'; 
		$this->plugins 		= ['datatables'];
		$this->navigation 	= ['Referensi'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->maskapai->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->maskapai->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$kode 			= $this->input->post('kode');
		$nama 			= $this->input->post('nama');
		$keterangan 	= $this->input->post('keterangan');
		
		$config['upload_path'] 		= './assets/upload/maskapai/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
		$config['max_size']  		= '2000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
		
		$this->load->library('upload', $config);

		
		$this->upload->do_upload('logo');
		$logo 			= $this->upload->data();
		$logo 			= $logo['file_name'];

		$r 				= $this->maskapai->insert($kode, $nama, $keterangan, $logo);

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
		$nama 			= $this->input->post('nama');
		$keterangan 	= $this->input->post('keterangan');
		
		$config['upload_path'] 		= './assets/upload/maskapai/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
		$config['max_size']  		= '2000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
		
		$this->load->library('upload', $config);

		
		$this->upload->do_upload('logo');
		$logo 			= $this->upload->data();
		$logo 			= $logo['file_name'];

		$r = $this->maskapai->update($id, $kode, $nama, $keterangan, $logo);

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

		$r 		= $this->maskapai->delete($id);

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
		$this->load->model('referensi/maskapaiModel', 'maskapai');
		// cek session
		$this->sesion->cek_session();
	}
}