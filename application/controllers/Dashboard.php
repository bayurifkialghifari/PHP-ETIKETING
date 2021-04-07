	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Dashboard extends Render_Controller {
	
	public function index() 
	{
		if($this->session->userdata('data')['level'] == 'Customer')
		{
			redirect('users/home','refresh');
		}

		// Page Settings
		$this->title = 'Dashboard';
		$this->content = 'home';
		$this->navigation = ['Dashboard'];

		// Data
		$this->data['tiket_pesawat'] 		= $this->model->getTiketPenerbangan();
		$this->data['tiket_kereta'] 		= $this->model->getTiketKereta();
		$this->data['customer'] 			= $this->model->getCustomer();
		$this->data['pemesanan'] 			= $this->model->getPemesan();
		$this->data['pembayaran_paypal'] 	= $this->model->getPembayaranPayPal();
		$this->data['manual'] 				= $this->model->getPembayaranManual();

		$this->data['statistik_kereta'] 	= $this->model->getPesanan('Kereta');
		$this->data['statistik_pesawat'] 	= $this->model->getPesanan('Pesawat');

		$this->render();
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->model('dashboardModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}