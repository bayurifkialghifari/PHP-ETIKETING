<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.* ");
		$this->db->from("pembayaran a");
		$this->db->join("pemesan b", 'a.peme_id = b.peme_id', 'left');
		$this->db->where("( b.peme_email LIKE '%".$cari."%' or a.PayerStatus LIKE '%".$cari."%' or a.PayerMail LIKE '%".$cari."%' or a.payerBuktiPembayaran LIKE '%".$cari."%' ) ");

		$this->db->where("PaymentMethod", "Manual");
		$this->db->where_not_in("PayerStatus", "VERIFIED");
		$this->db->where_not_in("PayerStatus", "NOT VERIFIED");
		
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

	public function valid($id) 
	{
		$sql = "UPDATE pembayaran SET PayerStatus=?, Payment_state=? WHERE txn_id=?;";
		
		$q = $this->db->query($sql, ['VERIFIED', 'completed', $id]);

		$get = $this->db->select('a.*, b.*')
						->from('pembayaran a')
						->join('pemesan_tiket b', 'b.pemt_peme_id = a.peme_id', 'right')
						->get()
						->row_array()['pemt_status_pesanan'];
		return $get;
	}

	public function tidakValid($id)
	{
		$sql = "UPDATE pembayaran SET PayerStatus=?, Payment_state=? WHERE txn_id=?;";
		
		$q = $this->db->query($sql, ['NOT VERIFIED', 'not completed', $id]);
		return $q;
	}
	
}