<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Perjalanan extends Render_Controller {

	public function cari()
	{

		$jenis 			= $this->input->get('jenis-perjalanan');
		$dari 			= $this->input->get('dari');
		$ke 			= $this->input->get('ke');
		$berangkat 		= $this->input->get('berangkat');
		$sampai 		= $this->input->get('sampai');
		$kelas 			= $this->input->get('kelas');
		$dewasa 		= $this->input->get('jumlah-dewasa');
		$bayi 			= $this->input->get('jumlah-bayi');

		$hasil 			= $this->perjalanan->getPerjalanan($jenis, $dari, $ke, $berangkat, $sampai, $kelas, $dewasa, $bayi);

		// Page config:

		$this->title 					= 'Perjalanan '.$hasil->row_array()['kota_asal'].' Ke '.$hasil->row_array()['kota_tujuan'];
		$this->content 					= 'perjalanan-hasilCari'; 
		$this->plugins 					= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['hasil']			= $hasil->result_array();
		$this->data['hasil_numRows']	= $hasil->num_rows();
		$this->data['dewasa'] 			= $dewasa;
		$this->data['bayi'] 			= $bayi;
		$this->data['rute'] 			= $this->getStasiun();
		$this->data['kelas']			= $this->getKelas();

		$this->data['jenis'] 			= $jenis;
		$this->data['darii'] 			= $dari;
		$this->data['kee'] 				= $ke;
		$this->data['berangkat'] 		= $berangkat;
		$this->data['sampai'] 			= $sampai;
		$this->data['kelasi'] 			= $kelas;
		$this->data['dewasa'] 			= $dewasa;
		$this->data['bayi'] 			= $bayi;
		
		// Commit render:
		$this->render();
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
		$this->load->model('users/perjalananModel', 'perjalanan');
	}
}