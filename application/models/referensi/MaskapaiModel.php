<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaskapaiModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("maskapai a");
		$this->db->where("( a.mask_kode LIKE '%".$cari."%' or a.mask_nama LIKE '%".$cari."%' or a.mask_deskripsi LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $nama, $keterangan, $logo)
	{

		$sql = "INSERT INTO maskapai (mask_kode, mask_nama, mask_deskripsi, mask_logo) VALUES (?, ?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan, $logo]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $nama, $keterangan, $logo)
	{
		$sql = "UPDATE maskapai SET mask_kode=?, mask_nama=?, mask_deskripsi=?, mask_logo=? WHERE mask_id=?;";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan, $logo, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM maskapai WHERE mask_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}