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
		$this->title 			= 'Generate Tiket Pesawat';
		$this->content 			= 'penerbangan-generate'; 
		$this->plugins 			= ['datatables', 'autocomplete', 'formatrupiah', 'datetimepicker'];
		$this->navigation 		= ['Generate Tiket'];

		$this->data['pesawat'] 	= $this->getPesawat();
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
		$pesawat 			= $this->input->post('pesawat');
		$tipePenerbangan 	= $this->input->post('tipePenerbangan');

		$sql 				= "(a.jadp_tanggal_berangkat = '{$berangkat}' OR a.jadp_pesa_id = '{$pesawat}') AND a.jadp_tipte_penerbangan = '{$tipePenerbangan}' ";

		$this->db->select(" a.*, b.*, c.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.band_nama as band_asal, g.band_id as band_asal_id, h.band_nama as band_tujuan, h.band_id as band_tujuan_id ");
		$this->db->from("jadwal_pesawat a");
		$this->db->join("pesawat b", 'b.pesa_id = a.jadp_pesa_id', 'left');
		$this->db->join("maskapai c", 'b.pesa_mask_id = c.mask_id', 'left');
		$this->db->join("rute d", 'd.rute_kode = a.jadp_rute_kode', 'left');
		$this->db->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left');
		$this->db->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left');
		$this->db->join("bandara g", 'd.rute_band_asal_id = g.band_id', 'left');
		$this->db->join("bandara h", 'd.rute_band_tujuan_id = h.band_id', 'left');
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
		$sql 			= "INSERT INTO tiket_pesawat (tikp_jadp_kode, tikp_kela_id, tikp_jumlah_kursi, tikp_keterangan, tikp_status, created_date) VALUES (?, ?, ?, ?, ?, ?);";

		$q 				= $this->db->query($sql, [$jadwal, $kelas, $jumlah_penumpang, $keterangan, 'Tersedia', psql_datetime_format()]);
		// End Generate Tiket


		$id 			= $this->db->insert_id();


		// Generate Tiket Detail
		$no_kursi 		=	1;

		for($i = 0; $i < (int)$jumlah_penumpang; $i++)
		{
			$data['tipd_tikp_id'] 		= $id;
			$data['tipd_no_kursi'] 		= $no_kursi++;
			$data['tikp_harga_usd'] 	= $total_harga_usd;
			$data['tikp_harga_idr'] 	= $total_harga_idr;
			$data['tipd_status'] 		= 'Tersedia';

			$exe 						= $this->db->insert('tiket_pesawat_detail', $data);
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

	private function getPesawat()
	{
		return $this->db->select(' a.* , b.* ')->join('maskapai b', 'a.pesa_mask_id = b.mask_id', 'left')->get('pesawat a')->result_array();
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
		$this->load->model('penerbangan/generateModel', 'generate');
		// cek session
		$this->sesion->cek_session();
	}
}