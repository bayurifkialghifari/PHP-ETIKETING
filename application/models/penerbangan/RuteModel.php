<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RuteModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.kota_nama as kota_asal, b.kota_id as kota_asal_id, c.kota_nama as kota_tujuan, c.kota_id as kota_tujuan_id, d.band_nama as band_asal, d.band_id as band_asal_id, e.band_nama as band_tujuan, e.band_id as band_tujuan_id ");
		$this->db->from("rute a");
		$this->db->join("kota b", 'a.rute_kota_asal_id = b.kota_id', 'left');
		$this->db->join("kota c", 'a.rute_kota_tujuan_id = c.kota_id', 'left');
		$this->db->join("bandara d", 'a.rute_band_asal_id = d.band_id', 'left');
		$this->db->join("bandara e", 'a.rute_band_tujuan_id = e.band_id', 'left');
		$this->db->where("(a.rute_kode LIKE '%".$cari."%' or b.kota_nama LIKE '%".$cari."%' or c.kota_nama LIKE '%".$cari."%' or d.band_nama LIKE '%".$cari."%' or e.band_nama LIKE '%".$cari."%' or a.rute_jarak LIKE '%".$cari."%' or a.rute_harga LIKE '%".$cari."%' or a.rute_status LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status) 
	{

		$sql = "INSERT INTO rute (rute_kode, rute_kota_asal_id, rute_kota_tujuan_id, rute_band_asal_id, rute_band_tujuan_id, rute_jarak, rute_harga, rute_status) VALUES (?, ?, ?, ?, ? ,? ,? ,?);";
		$q = $this->db->query($sql, [$kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status)
	{
		$sql = "UPDATE rute SET rute_kode=?, rute_kota_asal_id=?, rute_kota_tujuan_id=?, rute_band_asal_id=?, rute_band_tujuan_id=?, rute_jarak=?, rute_harga=?, rute_status=? WHERE rute_id=?;";
		$q = $this->db->query($sql, [$kode, $kota_asal, $kota_tujuan, $bandara_asal, $bandara_tujuan, $jarak, $harga, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM rute WHERE rute_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}