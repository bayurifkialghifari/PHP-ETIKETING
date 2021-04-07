<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemesananModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("pemesan_tiket a");
		$this->db->join("pemesan b", 'a.pemt_peme_id = b.peme_id', 'letf');
		$this->db->join("penumpang c", 'a.pemt_penu_id = c.penu_id', 'letf');

		$this->db->where("(b.peme_kode LIKE '%".$cari."%' or b.peme_nama LIKE '%".$cari."%' or a.pemt_status LIKE '%".$cari."%' or a.pemt_status_pesanan LIKE '%".$cari."%' or c.penu_nama LIKE '%".$cari."%' or a.pemt_tanggal LIKE '%".$cari."%' ) ");

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