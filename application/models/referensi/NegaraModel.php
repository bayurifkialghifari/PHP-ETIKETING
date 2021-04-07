<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NegaraModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("negara a");
		$this->db->where("( a.nega_nama LIKE '%".$cari."%' or a.nega_keterangan LIKE '%".$cari."%' ) ");
		
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

	public function insert($nama, $keterangan, $bendera)
	{

		$sql = "INSERT INTO negara (nega_nama, nega_keterangan, nega_bendera) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan, $bendera]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan, $bendera)
	{
		$sql = "UPDATE negara SET nega_nama=?, nega_keterangan=?, nega_bendera=? WHERE nega_id=?;";
		$q = $this->db->query($sql, [$nama, $keterangan, $bendera, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM negara WHERE nega_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}