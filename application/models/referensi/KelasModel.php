<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("kelas a");
		$this->db->where("(a.kela_kode LIKE '%".$cari."%' or a.kela_nama LIKE '%".$cari."%' or a.kela_harga LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $nama, $harga) 
	{

		$sql = "INSERT INTO kelas (kela_kode, kela_nama, kela_harga) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $nama, $harga]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $nama, $harga)
	{
		$sql = "UPDATE kelas SET kela_kode=?, kela_nama=?, kela_harga=? WHERE kela_id=?;";
		$q = $this->db->query($sql, [$kode, $nama, $harga, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM kelas WHERE kela_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}