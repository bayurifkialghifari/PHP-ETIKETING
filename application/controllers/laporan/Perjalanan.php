<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';
require_once APPPATH. 'libraries/dompdf/dompdf_config.inc.php';

class Perjalanan extends Render_Controller {

	public function index() 
	{

		// Page config:
		$this->title = 'Laporan Perjalanan';
		$this->content = 'laporan-perjalanan'; 
		$this->plugins = ['datatables', 'formatrupiah', 'datetimepicker'];
		$this->navigation = ['Laporan'];

		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$dari 	= $this->input->post('dari');
		$ke 	= $this->input->post('ke');

		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->perjalanan->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->perjalanan->getAllIsi(null,null, $cari['value'])->num_rows();
		
		array($cari);

		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function exportExcel()
	{
		$data['data'] 	= $this->perjalanan->getAllIsi()->result_array();

		$this->load->view('report/excel/perjalanan', $data);
	}

	public function exportPDF()
	{
		$data['data'] 	= $this->perjalanan->getAllIsi()->result_array();

		$html 			= $this->load->view('report/pdf/perjalanan', $data, true);

		$dompdf 		= new Dompdf();

	    $dompdf->load_html($html);
	    
	    $dompdf->set_paper('A4' , 'landscape');

		$dompdf->render();

		$filename 		= 'laporan_tiketperjalanan-'.date('Y-M-D');

		$pdf  			=  $dompdf->output();

		$dompdf->stream($filename, array('Attachment' => false));
	}

	private function output_json($data) {
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() {
		parent::__construct();

		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('laporan/perjalananModel', 'perjalanan');
		// cek session
		$this->sesion->cek_session();
	}
}