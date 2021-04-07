<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerjalananModel extends CI_Model {

	public function getPerjalanan($jenis = null, $dari = null, $ke = null, $berangkat = null, $sampai = null, $kelas = null, $dewasa = null, $bayi = null)
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

		if($sampai != '')
		{
			$where 		= "( b.jadk_tipe = '{$jenis}' and f.rute_stat_asal_id = '{$dari}' and f.rute_stat_tujuan_id = '{$ke}' and a.tikk_kela_id = '{$kelas}' and ( b.jadk_tanggal_berangkat = '{$berangkat}' or b.jadk_tanggal_pulang = '{$sampai}' ) )";
		}
		else
		{
			$where 		= "( b.jadk_tipe = '{$jenis}' and f.rute_stat_asal_id = '{$dari}' and f.rute_stat_tujuan_id = '{$ke}' and a.tikk_kela_id = '{$kelas}' and ( b.jadk_tanggal_berangkat = '{$berangkat}' ) )";
		}

		$this->db->where($where);

		return $this->db->get();
	}
}