<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.* ");
		$this->db->from("voucher a");
		$this->db->where("(a.vouc_nama LIKE '%".$cari."%' or a.vouc_kode LIKE '%".$cari."%' or a.vouc_persen LIKE '%".$cari."%' or a.vouc_batas LIKE '%".$cari."%' or a.vouc_jumlah LIKE '%".$cari."%' or a.vouc_keterangan LIKE '%".$cari."%' or a.vouc_tanggal_akhir LIKE '%".$cari."%' ) ");
		
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

	public function insert($nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal) 
	{

		$sql = "INSERT INTO voucher (vouc_nama, vouc_kode, vouc_persen, vouc_batas, vouc_jumlah, vouc_keterangan, vouc_tanggal_akhir) VALUES (?, ?, ?, ?, ? ,? ,?);";
		$q = $this->db->query($sql, [$nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal]);

		$return['id'] = $this->db->insert_id();
		
		return $return;
	}

	public function update($id, $nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal)
	{
		$sql = "UPDATE voucher SET vouc_nama=?, vouc_kode=?, vouc_persen=?, vouc_batas=?, vouc_jumlah=?, vouc_keterangan=?, vouc_tanggal_akhir=? WHERE vouc_id=?;";
		$q = $this->db->query($sql, [$nama, $kode, $persen, $batas, $jumlah, $keterangan, $tanggal, $id]);
		return $q;
	}

	public function delete($id) 
	{
		$sql = "DELETE FROM voucher WHERE vouc_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}