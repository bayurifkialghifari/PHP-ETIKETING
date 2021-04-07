<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekModel extends CI_Model {

	public function cekOrderan($kode, $email)
	{
		$cek 		= $this->db->select('a.*, b.*')
								->join('pemesan_tiket b', 'b.pemt_peme_id = a.peme_id', 'right')
								->get_where('pemesan a', ['a.peme_kode' => $kode, 'a.peme_email' => $email])
								->result_array();

		return $cek;
	}

	// Tiket Kereta Detail
	public function cekKereta($id)
	{
		$cek 		= $this->db->select('a.*, b.*, c.*, d.*, f.*, g.kota_nama as kota_asal, g.kota_id as kota_asal_id, h.kota_nama as kota_tujuan, h.kota_id as kota_tujuan_id, i.stat_nama as stat_asal, i.stat_id as stat_asal_id, j.stat_nama as stat_tujuan, j.stat_id as stat_tujuan_id, k.*, l.*, n.*, m.*')
				->from('tiket_kereta a')
				->join('jadwal_kereta b', 'a.tikk_jadk_kode = b.jadk_kode', 'left')
				->join('kelas c', 'a.tikk_kela_id = c.kela_id', 'left')
				->join("kereta d", 'd.keret_id = b.jadk_keret_id', 'left')
				->join("rute_kereta f", 'f.rute_kode = b.jadk_rute_kode')
				->join("kota g", 'f.rute_kota_asal_id = g.kota_id', 'left')
				->join("kota h", 'f.rute_kota_tujuan_id = h.kota_id', 'left')
				->join("stasiun i", 'f.rute_stat_asal_id = i.stat_id', 'left')
				->join("stasiun j", 'f.rute_stat_tujuan_id = j.stat_id', 'left')
				->join('tiket_kereta_detail k ', 'k.tikd_tikk_id = a.tikk_id', 'right')
				->join('pemesan_tiket m', 'm.pemt_tikd_id = k.tikd_id', 'right')
				->join('penumpang l', 'l.penu_id = m.pemt_penu_id', 'right')
				->join('pemesan n', 'n.peme_id = m.pemt_peme_id', 'right')
				->where('m.pemt_status', 'Terverivikasi')
				->where('k.tikd_id', $id)
				->get();

		return $cek->row_array();
	}

	// Tiket Pesawat Detail
	public function cekPesawat($id)
	{
		$cek 	= $this->db->select(" a.*, b.*, c.*, d.*, e.kota_nama as kota_asal, e.kota_id as kota_asal_id, f.kota_nama as kota_tujuan, f.kota_id as kota_tujuan_id, g.band_nama as band_asal, g.band_id as band_asal_id, h.band_nama as band_tujuan, h.band_id as band_tujuan_id, i.*, l.*, k.*, m.*, o.*")
				->from("jadwal_pesawat a")
				->join("pesawat b", 'b.pesa_id = a.jadp_pesa_id', 'left')
				->join("maskapai c", 'b.pesa_mask_id = c.mask_id', 'left')
				->join("rute d", 'd.rute_kode = a.jadp_rute_kode', 'left')
				->join("kota e", 'd.rute_kota_asal_id = e.kota_id', 'left')
				->join("kota f", 'd.rute_kota_tujuan_id = f.kota_id', 'left')
				->join("bandara g", 'd.rute_band_asal_id = g.band_id', 'left')
				->join("bandara h", 'd.rute_band_tujuan_id = h.band_id', 'left')
				->join('tiket_pesawat i', 'a.jadp_kode = i.tikp_jadp_kode', 'left')
				->join('tiket_pesawat_detail l ', 'l.tipd_tikp_id = i.tikp_id', 'right')
				->join('pemesan_tiket k', 'k.pemt_tipd_id = l.tipd_id', 'right')
				->join('penumpang m', 'm.penu_id = k.pemt_penu_id', 'right')
				->join('pemesan o', 'o.peme_id = k.pemt_peme_id', 'right')
				->where('l.tipd_id', $id)
				->where('k.pemt_status', 'Terverivikasi')
				->get();

		return $cek->row_array();
	}

}

/* End of file CekModel.php */
/* Location: ./application/models/order/CekModel.php */