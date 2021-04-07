<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranKeretaModel extends CI_Model {

	public function insertPemesan($titlepemesan, $namapemesan, $emailpemesan)
	{
		$data['peme_title'] 		= $titlepemesan;
		$data['peme_nama'] 			= $namapemesan;
		$data['peme_email'] 		= $emailpemesan;
		$data['peme_kode'] 			= $this->getCodePemesan();

		$exe 						= $this->db->insert('pemesan', $data);

		return $this->db->insert_id();
	}

	public function insertPenumpang()
	{
		$penumpangDewasa 			= $this->input->post('titlepenumpangd');
		$penumpangBayi 				= $this->input->post('titlepenumpangb');

		if(!empty($penumpangDewasa))
		{
			if(count($penumpangDewasa) > 0)
			{
				for ($i=0; $i < count($penumpangDewasa); $i++) 
				{
					$data['penu_kode'] 		= $this->getCodePenumpang();
					$data['penu_title'] 	= $this->input->post('titlepenumpangd')[$i];
					$data['penu_nama'] 		= $this->input->post('namapenumpangd')[$i];
					$data['penu_ktp'] 		= $this->input->post('ktpd')[$i];
					$data['penu_status'] 	= 'Dewasa';

					$this->db->insert('penumpang', $data);
				}
			}
		}

		if(!empty($penumpangBayi))
		{
			if(count($penumpangBayi) > 0)
			{
				for ($i = 0; $i < count($penumpangBayi); $i++) 
				{
					$data['penu_kode'] 		= $this->getCodePenumpang();
					$data['penu_title'] 	= $this->input->post('titlepenumpangb')[$i];
					$data['penu_nama'] 		= $this->input->post('namapenumpangb')[$i];
					$data['penu_ktp'] 		= $this->input->post('ktpb')[$i];
					$data['penu_status'] 	= 'Bayi';

					$this->db->insert('penumpang', $data);
				}
			}
		}

		if(!empty($penumpangDewasa)){$dewasa=count($penumpangDewasa);}else{$dewasa=0;}
		if(!empty($penumpangBayi)){$bayi=count($penumpangBayi);}else{$bayi=0;}

		$total 	= (int)$dewasa + (int)$bayi;
		
		return $total;
	}

	public function insertTiketDetail($exePenumpang, $exePemesan, $tiketId)
	{
		$getPenumpang 				= $this->db->order_by('penu_id','DESC')->limit($exePenumpang)->get('penumpang')->result_array();

		for($i = 0; $i < (int)$exePenumpang; $i++)
		{
			$data['pemt_penu_id'] 			= $getPenumpang[$i]['penu_id'];
			$data['pemt_peme_id'] 			= $exePemesan;
			$data['pemt_tikk_id']			= $tiketId;
			$data['pemt_status_pesanan'] 	= 'Kereta';
			$data['pemt_tikd_id'] 			= $this->getTiketPesawatDetail($tiketId);
			$data['pemt_kode'] 				= $this->getCodePemesanan();
			$data['pemt_status'] 			= 'Belum Verivikasi';

			$this->db->insert('pemesan_tiket', $data);
		}
	}












	// Create Pembayaran PayPal
	public function createPembayaran($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State)
	{
		$pemesan = $this->session->userdata('pemesan');

        $data['peme_id'] 			= $pemesan;
        $data['PaymentMethod']		= $PaymentMethod;
        $data['PayerStatus'] 		= $PayerStatus;
        $data['PayerMail'] 			= $PayerMail;
        $data['Total'] 				= $Total;
        $data['SubTotal'] 			= $Subtotal;
        $data['Tax'] 				= $Tax;
        $data['Payment_state']		= $State;
		$data['CreateTime'] 		= $CreateTime;
		$data['UpdateTime'] 		= $UpdateTime;

		$this->db->insert('pembayaran', $data);
		
		$id 	= $this->db->insert_id();
		
		return $id;
	}

	// Update Pembayaran
	public function updatePembayaran()
	{
		$pemesan 				= $this->session->userdata('pemesan');

		$getPemesan 			= $this->db->where('peme_id', $pemesan)->get('pemesan');
		$getPemesanan 			= $this->db->where('pemt_peme_id', $pemesan)->get('pemesan_tiket')->result_array();

		if(!empty($getPemesanan))
		{
			if(count($getPemesanan) > 0)
			{
				foreach($getPemesanan as $r)
				{
					$data1['tikd_status'] 	= 'Sudah Dipesan';

					$exe2 					= $this->db->where('tikd_id', $r['pemt_tikd_id']);
					$exe2 					= $this->db->update('tiket_kereta_detail', $data1);
				}
			}
		}

		$cekTiket 				= $this->db->where('pemt_peme_id', $pemesan)->limit(1)->get('pemesan_tiket');

		// Ganti Status Setelah Tiket Habis
		if($cekTiket->num_rows() > 0)
		{
			$tiketId 	= $cekTiket->row_array()['pemt_tikk_id'];

			$cekTiket2 	= $this->db->where('tikd_tikk_id', $tiketId)->where('tikd_status', 'Tersedia')->get('tiket_kereta_detail');

			if($cekTiket2->num_rows() < 1)
			{
				$data2['tikk_status'] 	= 'Habis';

				$exe3 					= $this->db->where('tikk_id', $tiketId);
				$exe3 					= $this->db->update('tiket_kereta', $data);
			}
		}

		$data['pemt_status'] 	= 'Terverivikasi';

		$exe1 					= $this->db->where('pemt_peme_id', $pemesan);
		$exe1 					= $this->db->update('pemesan_tiket', $data);

		return $getPemesan;		
	}







	// Create Pembayaran Manual
	public function createPembayaranManual($bukti, $idPemesan)
	{
		$data['payerBuktiPembayaran'] 	= $bukti;
		$data['PayerStatus'] 			= 'Belum Verivikasi';
		$data['PaymentMethod'] 			= 'Manual';
		$data['peme_id'] 				= $idPemesan;

		$this->db->insert('pembayaran', $data);

		return $this->db->insert_id();
	}

	private function getTiketPesawatDetail($tiketId)
	{
		$get 	= $this->db->where('pemt_status_pesanan', 'Kereta')->limit(1)->get('pemesan_tiket')->row_array();

		$exe 	= $this->db->select('a.*')
							->from('tiket_kereta_detail a')
							->where('a.tikd_tikk_id', $tiketId)
							->where('a.tikd_status', 'Tersedia')
							->where_not_in('a.tikd_id', $get['pemt_tikd_id'])
							->order_by('a.tikd_id', 'asc')
							->limit(1)
							->get();

		return $exe->row_array()['tikd_id'];
	}











	// Get Data Penerbangan
	public function getPerjalanan()
	{
		$pemesan    		= $this->session->userdata('pemesan');

		$this->db->select('a.*, b.*, c.*, d.*, f.*, k.*, g.kota_nama as kota_asal, g.kota_id as kota_asal_id, h.kota_nama as kota_tujuan, h.kota_id as kota_tujuan_id, i.stat_nama as stat_asal, i.stat_id as stat_asal_id, j.stat_nama as stat_tujuan, j.stat_id as stat_tujuan_id, 

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
		$this->db->join('pemesan_tiket k', 'k.pemt_tikk_id = a.tikk_id', 'left');
		$this->db->limit(1);

		$this->db->where('k.pemt_peme_id', $pemesan);

		return $this->db->get();
	}










	private function getCodePemesan()
	{
		$this->db->select('RIGHT(pemesan.peme_kode,5) as id', FALSE);
		$this->db->order_by('peme_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('pemesan');  //cek dulu apakah ada sudah ada kode di tabel.    
		
		if($query->num_rows() <> 0)
		{      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else
		{      
		   $kode = 1; 
		}

	  	$tgl 			= date('Y'); 
	  	$batas 			= str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil 	= "PEME-".$tgl."-".$batas; 
		
		return $kodetampil;
	}

	private function getCodePenumpang()
	{
		$this->db->select('RIGHT(penumpang.penu_kode,5) as id', FALSE);
		$this->db->order_by('penu_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('penumpang');  //cek dulu apakah ada sudah ada kode di tabel.    
		
		if($query->num_rows() <> 0)
		{      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else
		{      
		   $kode = 1; 
		}

	  	$tgl 			= date('Y'); 
	  	$batas 			= str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil 	= "PENU-".$tgl."-".$batas; 
		
		return $kodetampil;
	}

	private function getCodePemesanan()
	{
		$this->db->select('RIGHT(pemesan_tiket.pemt_kode,5) as id', FALSE);
		$this->db->order_by('pemt_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('pemesan_tiket');  //cek dulu apakah ada sudah ada kode di tabel.    
		
		if($query->num_rows() <> 0)
		{      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else
		{      
		   $kode = 1; 
		}

	  	$tgl 			= date('Y'); 
	  	$batas 			= str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil 	= "PESAN-".$tgl."-".$batas; 
		
		return $kodetampil;	
	}

}

/* End of file PembayaranModel.php */
/* Location: ./application/models/users/PembayaranModel.php */