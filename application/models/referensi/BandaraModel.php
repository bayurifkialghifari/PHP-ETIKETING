<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BandaraModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("bandara a");
		$this->db->join("kota b", 'b.kota_id = a.band_kota_id', 'left');
		$this->db->join("negara c", 'c.nega_id = a.band_nega_id', 'left');
		$this->db->where("(a.band_nama LIKE '%".$cari."%' or a.band_kode LIKE '%".$cari."%' or a.band_deskripsi LIKE '%".$cari."%' or b.kota_nama LIKE '%".$cari."%' or c.nega_nama LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $negara, $kota, $nama, $deskripsi) 
	{

		$sql = "INSERT INTO bandara (band_kode, band_nega_id, band_kota_id, band_nama, band_deskripsi) VALUES (?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $negara, $kota, $nama, $deskripsi]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $negara, $kota, $nama, $deskripsi)
	{
		$sql = "UPDATE bandara SET band_nega_id=?, band_kode=?, band_kota_id=?, band_nama=?, band_deskripsi=? WHERE band_id=?;";
		$q = $this->db->query($sql, [$negara, $kode, $kota, $nama, $deskripsi, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM bandara WHERE band_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}