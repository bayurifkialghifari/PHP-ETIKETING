<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Negara extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 		= 'Referensi Negara';
		$this->content 		= 'referensi-negara'; 
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
		$data 	= $this->negara->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->negara->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() 
	{

		// Input values
		$nama 			= $this->input->post('nama');
		$keterangan 	= $this->input->post('keterangan');
		
		$config['upload_path'] 		= './assets/upload/bendera/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
		$config['max_size']  		= '2000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
		
		$this->load->library('upload', $config);

		
		$this->upload->do_upload('bendera');
		$bendera 		= $this->upload->data();
		$bendera 		= $bendera['file_name'];

		$r 				= $this->negara->insert($nama, $keterangan, $bendera);

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
		$keterangan 	= $this->input->post('keterangan');

		$config['upload_path'] 		= './assets/upload/bendera/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
		$config['max_size']  		= '2000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
		
		$this->load->library('upload', $config);

		
		$this->upload->do_upload('bendera');
		$bendera 		= $this->upload->data();
		$bendera 		= $bendera['file_name'];

		$r = $this->negara->update($id, $nama, $keterangan, $bendera);

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

		$r 		= $this->negara->delete($id);

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
		$this->load->model('referensi/negaraModel', 'negara');
		// cek session
		$this->sesion->cek_session();
	}
}