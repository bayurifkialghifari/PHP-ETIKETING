<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TiketModel extends CI_Model {

	public function getPenerbangan($tiketId)
	{
		$this->db->select(" a.*, b.*, c.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.band_nama as band_asal, g.band_id as band_asal_id, h.band_nama as band_tujuan, h.band_id as band_tujuan_id, 
			(SELECT 
					j.tikp_harga_usd as tikp_harga_usd
				
				FROM tiket_pesawat_detail j 
					
					WHERE j.tipd_tikp_id = i.tikp_id 
				
				LIMIT 1) as tikp_harga_usd,

				(SELECT 
					j.tikp_harga_idr as tikp_harga_idr
				
				FROM tiket_pesawat_detail j 
					
					WHERE j.tipd_tikp_id = i.tikp_id 
				
				LIMIT 1) as tikp_harga_idr,

				i.*
			");
		
		$this->db->from("jadwal_pesawat a");
		$this->db->join("pesawat b", 'b.pesa_id = a.jadp_pesa_id', 'left');
		$this->db->join("maskapai c", 'b.pesa_mask_id = c.mask_id', 'left');
		$this->db->join("rute d", 'd.rute_kode = a.jadp_rute_kode', 'left');
		$this->db->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left');
		$this->db->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left');
		$this->db->join("bandara g", 'd.rute_band_asal_id = g.band_id', 'left');
		$this->db->join("bandara h", 'd.rute_band_tujuan_id = h.band_id', 'left');
		$this->db->join('tiket_pesawat i', 'a.jadp_kode = i.tikp_jadp_kode', 'right');

		$where 			= 'i.tikp_id = '.$tiketId;

		$this->db->where($where);

		return $this->db->get();
	}	

	public function getPerjalanan($tiketId)
	{
		$this->db->select('a.*, b.*, c.*, d.*, f.*, g.kota_nama as kota_asal, g.kota_id as kota_asal_id, h.kota_nama as kota_tujuan, h.kota_id as kota_tujuan_id, i.stat_nama as stat_asal, i.stat_id as stat_asal_id, j.stat_nama as stat_tujuan, j.stat_id as stat_tujuan_id, 

				(SELECT 
					j.tikd_harga_idr as tikd_harga_idr
				
				FROM tiket_kereta_detail j 
					
					WHERE j.tikd_tikk_id = a.tikk_id 
				
				LIMIT 1) as tikd_harga_idr,

				(SELECT 
					j.tikd_harga_usd as tikd_harga_usd
				
				FROM tiket_kereta_detail j 
					
					WHERE j.tikd_tikk_id = a.tikk_id 
				
				LIMIT 1) as tikd_harga_usd

			');

		$this->db->from('tiket_kereta a');
		$this->db->join('jadwal_kereta b', 'a.tikk_jadk_kode = b.jadk_kode', 'left');
		$this->db->join('kelas c', 'a.tikk_kela_id = c.kela_id', 'left');
		$this->db->join("kereta d", 'd.keret_id = b.jadk_keret_id', 'left');
		$this->db->join("rute_kereta f", 'f.rute_kode = b.jadk_rute_kode');
		$this->db->join("kota g", 'f.rute_kota_asal_id = g.kota_id', 'left');
		$this->db->join("kota h", 'f.rute_kota_tujuan_id = h.kota_id', 'left');
		$this->db->join("stasiun i", 'f.rute_stat_asal_id = i.stat_id', 'left');
		$this->db->join("stasiun j", 'f.rute_stat_tujuan_id = j.stat_id', 'left');

		$where 		= 'a.tikk_id = '.$tiketId;

		$this->db->where($where);

		return $this->db->get();
	}

}