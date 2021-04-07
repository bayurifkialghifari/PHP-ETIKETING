<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Generate extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page config:
		$this->title 			= 'Generate Tiket Kereta';
		$this->content 			= 'kereta-generate'; 
		$this->plugins 			= ['datatables', 'autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->navigation 		= ['Generate Tiket'];

		$this->data['kereta'] 	= $this->getKereta();
		$this->data['kelas'] 	= $this->getKelas();
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->generate->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->generate->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}




	// Cari Jadwal
	public function searchJadwal()
	{
		$berangkat 			= $this->input->post('berangkat');
		$kereta 			= $this->input->post('kereta');
		$tipePerjalanan 	= $this->input->post('tipePerjalanan');

		$sql 				= "(a.jadk_tanggal_berangkat = '{$berangkat}' OR a.jadk_keret_id = '{$kereta}') AND a.jadk_tipe = '{$tipePerjalanan}' ";

		$this->db->select(" a.*, b.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.stat_nama as stat_asal, g.stat_id as stat_asal_id, h.stat_nama as stat_tujuan, h.stat_id as stat_tujuan_id ");
		$this->db->from("jadwal_kereta a");
		$this->db->join("kereta b", 'b.keret_id = a.jadk_keret_id', 'left');
		$this->db->join("rute_kereta d", 'd.rute_kode = a.jadk_rute_kode', 'left');
		$this->db->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left');
		$this->db->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left');
		$this->db->join("stasiun g", 'd.rute_stat_asal_id = g.stat_id', 'left');
		$this->db->join("stasiun h", 'd.rute_stat_tujuan_id = h.stat_id', 'left');
		$this->db->where($sql);

		$query 				= $this->db->get()->result_array();

		echo json_encode($query);
	}




	// Get Kelas Harga
	public function getKelasHarga()
	{
		$kelas 	= $this->input->post('kelas');

		$query 	= $this->db->where('kela_id', $kelas)->get('kelas')->row_array();

		echo json_encode($query);
	}





	// Generate Tiket
	public function insert() 
	{

		// Input values
		$jadwal 			= $this->input->post('jadwal');
		$kelas 				= $this->input->post('kelas');
		$jumlah_penumpang 	= $this->input->post('jumlah_penumpang');
		$keterangan 		= $this->input->post('keterangan');
		$total_harga_usd 	= $this->input->post('total_harga_usd');
		$total_harga_idr 	= $this->input->post('total_harga_idr');

		// Generate Tiket
		$sql 			= "INSERT INTO tiket_kereta (tikk_jadk_kode, tikk_kela_id, tikk_jumlah_kursi, tikk_keterangan, tikk_status, created_date) VALUES (?, ?, ?, ?, ?, ?);";

		$q 				= $this->db->query($sql, [$jadwal, $kelas, $jumlah_penumpang, $keterangan, 'Tersedia', psql_datetime_format()]);
		// End Generate Tiket


		$id 			= $this->db->insert_id();


		// Generate Tiket Detail
		$no_kursi 		=	1;

		for($i = 0; $i < (int)$jumlah_penumpang; $i++)
		{
			$data['tikd_tikk_id'] 		= $id;
			$data['tikd_no_kursi'] 		= $no_kursi++;
			$data['tikd_harga_usd'] 	= $total_harga_usd;
			$data['tikd_harga_idr'] 	= $total_harga_idr;
			$data['tikd_status'] 		= 'Tersedia';

			$exe 						= $this->db->insert('tiket_kereta_detail', $data);
		}


		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $id,
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

	private function getKelas()
	{
		return $this->db->get('kelas')->result_array();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('kereta/generateModel', 'generate');
		// cek session
		$this->sesion->cek_session();
	}
}