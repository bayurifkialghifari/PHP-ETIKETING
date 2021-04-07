<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.*, c.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.band_nama as band_asal, g.band_id as band_asal_id, h.band_nama as band_tujuan, h.band_id as band_tujuan_id ");
		$this->db->from("jadwal_pesawat a");
		$this->db->join("pesawat b", 'b.pesa_id = a.jadp_pesa_id', 'left');
		$this->db->join("maskapai c", 'b.pesa_mask_id = c.mask_id', 'left');
		$this->db->join("rute d", 'd.rute_kode = a.jadp_rute_kode', 'left');
		$this->db->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left');
		$this->db->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left');
		$this->db->join("bandara g", 'd.rute_band_asal_id = g.band_id', 'left');
		$this->db->join("bandara h", 'd.rute_band_tujuan_id = h.band_id', 'left');

		$this->db->where("(a.jadp_kode LIKE '%".$cari."%' or c.mask_nama LIKE '%".$cari."%' or b.pesa_nama LIKE '%".$cari."%' or e.kota_nama LIKE '%".$cari."%' or f.kota_nama LIKE '%".$cari."%' or g.band_nama LIKE '%".$cari."%' or h.band_nama LIKE '%".$cari."%' or a.jadp_tanggal_berangkat LIKE '%".$cari."%' or a.jadp_tanggal_berangkat_sampai LIKE '%".$cari."%' ) ");
		
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

	public function insert($kode, $pesawat, $rute, $tipePenerbangan, $berangkat, $berangkatSampai, $jamBerangkat, $jamBerangkatSampai, $pulang, $pulangSampai, $jamPulang, $jamPulangSampai, $keterangan, $status) 
	{

		$sql = "INSERT INTO jadwal_pesawat (jadp_kode, jadp_pesa_id, jadp_rute_kode, jadp_tipte_penerbangan, jadp_tanggal_berangkat, jadp_tanggal_berangkat_sampai, jadp_jam_berangkat, jadp_jam_berangkat_sampai, jadp_tanggal_pulang, jadp_tanggal_pulang_sampai, jadp_jam_pulang, jadp_jam_pulang_sampai, jadp_keterangan, jadp_status) VALUES (?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?, ?, ?);";

		$q = $this->db->query($sql, [$kode, $pesawat, $rute, $tipePenerbangan, $berangkat, $berangkatSampai, $jamBerangkat, $jamBerangkatSampai, $pulang, $pulangSampai, $jamPulang, $jamPulangSampai, $keterangan, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $pesawat, $rute, $tipePenerbangan, $berangkat, $berangkatSampai, $jamBerangkat, $jamBerangkatSampai, $pulang, $pulangSampai, $jamPulang, $jamPulangSampai, $keterangan, $status)
	{
		$sql = "UPDATE jadwal_pesawat SET jadp_kode=?, jadp_pesa_id=?, jadp_rute_kode=?, jadp_tipte_penerbangan=?, jadp_tanggal_berangkat=?, jadp_tanggal_berangkat_sampai=?, jadp_jam_berangkat=?, jadp_jam_berangkat_sampai=?, jadp_tanggal_pulang=?, jadp_tanggal_pulang_sampai=?, jadp_jam_pulang=?, jadp_jam_pulang_sampai=?, jadp_keterangan=?, jadp_status=? WHERE jadp_id=?;";
		
		$q = $this->db->query($sql, [$kode, $pesawat, $rute, $tipePenerbangan, $berangkat, $berangkatSampai, $jamBerangkat, $jamBerangkatSampai, $pulang, $pulangSampai, $jamPulang, $jamPulangSampai, $keterangan, $status, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM jadwal_pesawat WHERE jadp_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}