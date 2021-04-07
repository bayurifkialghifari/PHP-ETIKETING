<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.* ");
		$this->db->from("pesawat a");
		$this->db->join("maskapai b", 'a.pesa_mask_id = b.mask_id', 'left');
		$this->db->where("(a.pesa_kode LIKE '%".$cari."%' or a.pesa_nama LIKE '%".$cari."%' or a.pesa_deskripsi LIKE '%".$cari."%' or a.pesa_jumlah_kursi LIKE '%".$cari."%' or a.pesa_status LIKE '%".$cari."%' or b.mask_nama LIKE '%".$cari."%' ) ");
		
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

	public function insert($maskapai, $kode, $nama, $deskripsi, $kursi, $status) 
	{

		$sql = "INSERT INTO pesawat (pesa_mask_id, pesa_kode, pesa_nama, pesa_deskripsi, pesa_jumlah_kursi, pesa_status) VALUES (?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$maskapai, $kode, $nama, $deskripsi, $kursi, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $maskapai, $kode, $nama, $deskripsi, $kursi, $status)
	{
		$sql = "UPDATE pesawat SET pesa_mask_id=?, pesa_kode=?, pesa_nama=?, pesa_deskripsi=?, pesa_jumlah_kursi=?, pesa_status=? WHERE pesa_id=?;";
		$q = $this->db->query($sql, [$maskapai, $kode, $nama, $deskripsi, $kursi, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM pesawat WHERE pesa_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}