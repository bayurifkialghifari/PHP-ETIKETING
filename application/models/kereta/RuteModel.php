<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RuteModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.kota_nama as kota_asal, b.kota_id as kota_asal_id, c.kota_nama as kota_tujuan, c.kota_id as kota_tujuan_id, d.stat_nama as stat_asal, d.stat_id as stat_asal_id, e.stat_nama as stat_tujuan, e.stat_id as stat_tujuan_id ");
		$this->db->from("rute_kereta a");
		$this->db->join("kota b", 'a.rute_kota_asal_id = b.kota_id', 'left');
		$this->db->join("kota c", 'a.rute_kota_tujuan_id = c.kota_id', 'left');
		$this->db->join("stasiun d", 'a.rute_stat_asal_id = d.stat_id', 'left');
		$this->db->join("stasiun e", 'a.rute_stat_tujuan_id = e.stat_id', 'left');
		$this->db->where("(a.rute_kode LIKE '%".$cari."%' or b.kota_nama LIKE '%".$cari."%' or c.kota_nama LIKE '%".$cari."%' or d.stat_nama LIKE '%".$cari."%' or e.stat_nama LIKE '%".$cari."%' or a.rute_jarak LIKE '%".$cari."%' or a.rute_harga LIKE '%".$cari."%' or a.rute_status LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $kota_asal, $kota_tujuan, $stasiun_asal, $stasiun_tujuan, $harga, $harga_dolar, $status)
	{

		$sql = "INSERT INTO rute_kereta (rute_kode, rute_kota_asal_id, rute_kota_tujuan_id, rute_stat_asal_id, rute_stat_tujuan_id, rute_harga, rute_harga_dolar, rute_status) VALUES (?, ?, ?, ?, ? ,? ,? ,?);";
		$q = $this->db->query($sql, [$kode, $kota_asal, $kota_tujuan, $stasiun_asal, $stasiun_tujuan, $harga, $harga_dolar, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $kota_asal, $kota_tujuan, $stasiun_asal, $stasiun_tujuan, $harga, $harga_dolar, $status)
	{
		$sql = "UPDATE rute_kereta SET rute_kode=?, rute_kota_asal_id=?, rute_kota_tujuan_id=?, rute_stat_asal_id=?, rute_stat_tujuan_id=?, rute_harga=?, rute_harga_dolar=?, rute_status=? WHERE rute_id=?;";
		$q = $this->db->query($sql, [$kode, $kota_asal, $kota_tujuan, $stasiun_asal, $stasiun_tujuan, $harga, $harga_dolar, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM rute_kereta WHERE rute_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}