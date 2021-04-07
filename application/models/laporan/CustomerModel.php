<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, c.lev_id, c.lev_nama ");
		$this->db->from("users a");
		$this->db->join("role_users b", "b.rolu_user_id = a.user_id","left");
		$this->db->join("level c", "c.lev_id = b.rolu_lev_id","left");
		$this->db->where('c.lev_nama', 'Customer');
		
		$this->db->where("(a.user_name LIKE '%".$cari."%' or a.user_phone LIKE '%".$cari."%' or a.user_status LIKE '%".$cari."%' or a.created_date LIKE '%".$cari."%' or a.user_email LIKE '%".$cari."%' ) ");

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