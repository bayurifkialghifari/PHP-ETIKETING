<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenerbanganModel extends CI_Model {

	public function getPenerbangan($jenis=null, $dari=null, $ke=null, $berangkat=null, $sampai=null, $kelas=null, $dewasa=null, $anak=null, $bayi=null)
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

		if($sampai != '')
		{
			$where 		= "( a.jadp_tipte_penerbangan = '{$jenis}' and d.rute_band_asal_id = '{$dari}' and d.rute_band_tujuan_id = '{$ke}' and i.tikp_kela_id = '{$kelas}' and ( a.jadp_tanggal_berangkat = '{$berangkat}' or a.jadp_tanggal_pulang = '{$sampai}' ) )";
		}
		else
		{
			$where 		= "( a.jadp_tipte_penerbangan = '{$jenis}' and d.rute_band_asal_id = '{$dari}' and d.rute_band_tujuan_id = '{$ke}' and i.tikp_kela_id = '{$kelas}' and a.jadp_tanggal_berangkat = '{$berangkat}' )";
		}

		$this->db->where($where);

		return $this->db->get();
	}
}