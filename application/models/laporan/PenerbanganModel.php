<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenerbanganModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select('a.*, b.*, c.*, d.*, e.*, f.*, g.kota_nama as kota_asal, g.kota_id as kota_asal_id, h.kota_nama as kota_tujuan, h.kota_id as kota_tujuan_id, i.band_nama as band_asal, i.band_id as band_asal_id, j.band_nama as band_tujuan, j.band_id as band_tujuan_id, k.*
			');

		$this->db->from('tiket_pesawat_detail k');
		$this->db->join('tiket_pesawat a', 'a.tikp_id = k.tipd_tikp_id', 'left');
		$this->db->join('jadwal_pesawat b', 'a.tikp_jadp_kode = b.jadp_kode', 'left');
		$this->db->join('kelas c', 'a.tikp_kela_id = c.kela_id', 'left');
		$this->db->join("pesawat d", 'd.pesa_id = b.jadp_pesa_id', 'left');
		$this->db->join("maskapai e", 'd.pesa_mask_id = e.mask_id', 'left');
		$this->db->join("rute f", 'f.rute_kode = b.jadp_rute_kode', 'left');
		$this->db->join("kota g", 'f.rute_kota_asal_id = g.kota_id', 'left');
		$this->db->join("kota h", 'f.rute_kota_tujuan_id = h.kota_id', 'left');
		$this->db->join("bandara i", 'f.rute_band_asal_id = i.band_id', 'left');
		$this->db->join("bandara j", 'f.rute_band_tujuan_id = j.band_id', 'left');
		
		$this->db->where("(b.jadp_kode LIKE '%".$cari."%' or e.mask_nama LIKE '%".$cari."%' or d.pesa_nama LIKE '%".$cari."%' or g.kota_nama LIKE '%".$cari."%' or h.kota_nama LIKE '%".$cari."%' or i.band_nama LIKE '%".$cari."%' or j.band_nama LIKE '%".$cari."%' or b.jadp_tanggal_berangkat LIKE '%".$cari."%' or b.jadp_tanggal_berangkat_sampai LIKE '%".$cari."%' or k.tipd_status LIKE '%".$cari."%' ) ");

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

}