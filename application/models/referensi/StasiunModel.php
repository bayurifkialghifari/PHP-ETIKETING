<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StasiunModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.* ");
		$this->db->from("stasiun a");
		$this->db->join("kota b", 'b.kota_id = a.stat_kota_id', 'left');
		$this->db->where("(a.stat_nama LIKE '%".$cari."%' or b.kota_nama LIKE '%".$cari."%' or a.stat_keterangan LIKE '%".$cari."%' ) ");
		
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

	public function insert($kota, $nama, $keterangan) 
	{

		$sql = "INSERT INTO stasiun (stat_kota_id, stat_nama, stat_keterangan) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$kota, $nama, $keterangan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kota, $nama, $keterangan)
	{
		$sql = "UPDATE stasiun SET stat_kota_id=?, stat_nama=?, stat_keterangan=? WHERE stat_id=?;";
		$q = $this->db->query($sql, [$kota, $nama, $keterangan, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM stasiun WHERE stat_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}