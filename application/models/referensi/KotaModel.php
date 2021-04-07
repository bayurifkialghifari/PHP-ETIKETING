<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KotaModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("kota a");
		$this->db->where("(a.kota_kode LIKE '%".$cari."%' or a.kota_nama LIKE '%".$cari."%' or a.kota_keterangan LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $nama, $keterangan) 
	{

		$sql = "INSERT INTO kota (kota_kode, kota_nama, kota_keterangan) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $nama, $keterangan)
	{
		$sql = "UPDATE kota SET kota_kode=?, kota_nama=?, kota_keterangan=? WHERE kota_id=?;";
		$q = $this->db->query($sql, [$kode, $nama, $keterangan, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM kota WHERE kota_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}