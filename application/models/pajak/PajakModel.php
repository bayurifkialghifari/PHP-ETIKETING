<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PajakModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("pajak a");
		$this->db->where("(a.paja_nama LIKE '%".$cari."%' or a.paja_persen LIKE '%".$cari."%' or a.paja_keterangan LIKE '%".$cari."%' ) ");
		
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

	public function insert($nama, $persen, $keterangan) 
	{

		$sql = "INSERT INTO pajak (paja_nama, paja_persen, paja_keterangan) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $persen, $keterangan]);

		$return['id'] = $this->db->insert_id();
		
		return $return;
	}

	public function update($id, $nama, $persen, $keterangan)
	{
		$sql = "UPDATE pajak SET paja_nama=?, paja_persen=?, paja_keterangan=? WHERE paja_id=?;";
		$q = $this->db->query($sql, [$nama, $persen, $keterangan, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM pajak WHERE paja_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}