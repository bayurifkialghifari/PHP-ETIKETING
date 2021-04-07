<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("kereta a");
		$this->db->where("(a.keret_kode LIKE '%".$cari."%' or a.keret_nama LIKE '%".$cari."%' or a.keret_keterangan LIKE '%".$cari."%' or a.keret_penumpang LIKE '%".$cari."%' or a.keret_status LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $nama, $keterangan, $kursi, $status) 
	{

		$sql = "INSERT INTO kereta (keret_kode, keret_nama, keret_keterangan, keret_penumpang, keret_status) VALUES (?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan, $kursi, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $nama, $keterangan, $kursi, $status)
	{
		$sql = "UPDATE kereta SET keret_kode=?, keret_nama=?, keret_keterangan=?, keret_penumpang=?, keret_status=? WHERE keret_id=?;";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan, $kursi, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM kereta WHERE keret_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}