<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Penerbangan extends Render_Controller {

	public function cari()
	{

		$jenis 			= $this->input->get('jenis-penerbangan');
		$dari 			= $this->input->get('dari');
		$ke 			= $this->input->get('ke');
		$berangkat 		= $this->input->get('berangkat');
		$sampai 		= $this->input->get('sampai');
		$kelas 			= $this->input->get('kelas');
		$dewasa 		= $this->input->get('jumlah-dewasa');
		$anak 			= $this->input->get('jumlah-anak');
		$bayi 			= $this->input->get('jumlah-bayi');

		$hasil 			= $this->penerbangan->getPenerbangan($jenis, $dari, $ke, $berangkat, $sampai, $kelas, $dewasa, $anak, $bayi);


		// Page config:

		$this->title 					= 'Penerbangan '.$hasil->row_array()['kota_asal'].' Ke '.$hasil->row_array()['kota_tujuan'];
		$this->content 					= 'penerbangan-hasilCari'; 
		$this->plugins 					= ['autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->data['hasil']			= $hasil->result_array();
		$this->data['hasil_numRows']	= $hasil->num_rows();
		$this->data['dewasa'] 			= $dewasa;
		$this->data['anak'] 			= $anak;
		$this->data['bayi'] 			= $bayi;
		$this->data['rute'] 			= $this->getKota();
		$this->data['kelas']			= $this->getKelas();

		$this->data['jenis']			= $jenis;
		$this->data['darii']			= $dari;
		$this->data['kee']				= $ke;
		$this->data['berangkat']		= $berangkat;
		$this->data['sampai']			= $sampai;
		$this->data['kelasi']			= $kelas;
		$this->data['dewasa']			= $dewasa;
		$this->data['anak']				= $anak;
		$this->data['bayi']				= $bayi;

		
		// Commit render:
		$this->render();
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
		$this->load->model('users/penerbanganModel', 'penerbangan');
	}
}