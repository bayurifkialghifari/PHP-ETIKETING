<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.stat_nama as stat_asal, g.stat_id as stat_asal_id, h.stat_nama as stat_tujuan, h.stat_id as stat_tujuan_id ");
		$this->db->from("jadwal_kereta a");
		$this->db->join("kereta b", 'b.keret_id = a.jadk_keret_id', 'left');
		$this->db->join("rute_kereta d", 'd.rute_kode = a.jadk_rute_kode', 'left');
		$this->db->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left');
		$this->db->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left');
		$this->db->join("stasiun g", 'd.rute_stat_asal_id = g.stat_id', 'left');
		$this->db->join("stasiun h", 'd.rute_stat_tujuan_id = h.stat_id', 'left');

		$this->db->where("(a.jadk_kode LIKE '%".$cari."%' or b.keret_kode LIKE '%".$cari."%' or b.keret_nama LIKE '%".$cari."%' or e.kota_nama LIKE '%".$cari."%' or f.kota_nama LIKE '%".$cari."%' or g.stat_nama LIKE '%".$cari."%' or h.stat_nama LIKE '%".$cari."%' or a.jadk_tanggal_berangkat LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status) 
	{

		$sql = "INSERT INTO jadwal_kereta (jadk_kode, jadk_keret_id, jadk_rute_kode, jadk_tipe, jadk_tanggal_berangkat, jadk_jam_berangkat, jadk_jam_berangkat_sampai, jadk_tanggal_pulang, jadk_jam_pulang, jadk_jam_pulang_sampai, jadk_keterangan, jadk_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		$q = $this->db->query($sql, [$kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status)
	{
		$sql = "UPDATE jadwal_kereta SET jadk_kode=?, jadk_keret_id=?, jadk_rute_kode=?, jadk_tipe=?, jadk_tanggal_berangkat=?, jadk_jam_berangkat=?, jadk_jam_berangkat_sampai=?, jadk_tanggal_pulang=?, jadk_jam_pulang=?, jadk_jam_pulang_sampai=?, jadk_keterangan=?, jadk_status=? WHERE jadk_id=?;";
		
		$q = $this->db->query($sql, [$kode, $kereta, $rute, $tipePerjalanan, $berangkat, $jamBerangkat, $jamBerangkatSampai, $pulang, $jamPulang, $jamPulangSampai, $keterangan, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM jadwal_kereta WHERE jadk_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}