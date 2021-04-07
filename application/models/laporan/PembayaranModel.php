<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.* ");
		$this->db->from("pembayaran a");
		$this->db->join("pemesan b", 'a.peme_id = b.peme_id');
		$this->db->where('a.PaymentMethod', 'paypal');

		$this->db->where("(b.peme_nama LIKE '%".$cari."%' or a.PayerStatus LIKE '%".$cari."%' or a.PayerMail LIKE '%".$cari."%' or a.Total LIKE '%".$cari."%' or a.CreateTime LIKE '%".$cari."%' ) ");

		if ($show == null && $start == null)
		{
			$return = $this->db->get();
		}else
		{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}

		return $return;
	}

}