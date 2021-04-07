<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function getTiketPenerbangan()
	{
		$exe 	= $this->db->select('count(*) as tiket')
							->from('tiket_pesawat_detail')
							->where('tipd_status', 'Tersedia')
							->get();

		return $exe->row_array()['tiket'];
	}

	public function getTiketKereta()
	{
		$exe 	= $this->db->select('count(*) as tiket')
							->from('tiket_kereta_detail')
							->where('tikd_status', 'Tersedia')
							->get();

		return $exe->row_array()['tiket'];	
	}

	public function getCustomer()
	{
		$exe 	= $this->db->select('count(*) as customer')
							->from('role_users')
							->where('rolu_lev_id', 3)
							->get();

		return $exe->row_array()['customer'];
	}

	public function getPemesan()
	{
		$exe 	= $this->db->select('count(*) as pemesan')
							->from('pemesan_tiket')
							->where('pemt_status', 'Terverivikasi')
							->get();

		return $exe->row_array()['pemesan'];
	}

	public function getPembayaranPayPal()
	{
		$exe 	= $this->db->select('*')
							->from('pembayaran')
							->where('PaymentMethod', 'paypal')
							->where('PayerStatus', 'VERIFIED')
							->get();

		$exe 	= $exe->result_array();
		$uang 	= 0;
		$total 	= 0;

		foreach($exe as $r)
		{
			$uang = $r['Total'];

			$uang = explode('.', $uang);
			$uang = $uang[0];

			$total = (int)$total + (int)$uang;
		}

		return $total;

	}

	public function getPembayaranManual()
	{
		$exe 	= $this->db->select('count(*) as manual')
							->from('pembayaran')
							->where('PaymentMethod', 'manual')
							->where('PayerStatus', 'VERIFIED')
							->get();

		return $exe->row_array()['manual'];
	}


	public function getPesanan($where = null)
	{
		$exe 	= $this->db->get_where('pemesan_tiket', ['pemt_status_pesanan' => $where, 'pemt_status' => 'Terverivikasi']);

		return $exe->result_array();
	}
}
