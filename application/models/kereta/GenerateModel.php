<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select('a.*, b.*, c.*, d.*, f.*, g.kota_nama as kota_asal, g.kota_id as kota_asal_id, h.kota_nama as kota_tujuan, h.kota_id as kota_tujuan_id, i.stat_nama as stat_asal, i.stat_id as stat_asal_id, j.stat_nama as stat_tujuan, j.stat_id as stat_tujuan_id, 

				(SELECT 
					j.tikd_harga_idr as tikd_harga_idr
				
				FROM tiket_kereta_detail j 
					
					WHERE j.tikd_tikk_id = a.tikk_id 
				
				LIMIT 1) as tikd_harga_idr,
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
		
		$this->db->where("(b.jadk_kode LIKE '%".$cari."%' or d.keret_nama LIKE '%".$cari."%' or d.keret_kode LIKE '%".$cari."%' or g.kota_nama LIKE '%".$cari."%' or h.kota_nama LIKE '%".$cari."%' or i.stat_nama LIKE '%".$cari."%' or j.stat_nama LIKE '%".$cari."%' or b.jadk_tanggal_berangkat LIKE '%".$cari."%' ) ");


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