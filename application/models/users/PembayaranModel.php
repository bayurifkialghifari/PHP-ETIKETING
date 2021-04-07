<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranModel extends CI_Model {

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
		$penumpangAnak 				= $this->input->post('titlepenumpanga');
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
					$data['penu_nega_id'] 	= $this->input->post('warganegarad')[$i];
					$data['penu_status'] 	= 'Dewasa';

					$this->db->insert('penumpang', $data);
				}
			}
		}

		if(!empty($penumpangAnak))
		{
			if(count($penumpangAnak) > 0)
			{
				for ($i = 0; $i < count($penumpangAnak); $i++) 
				{
					$data['penu_kode'] 		= $this->getCodePenumpang();
					$data['penu_title'] 	= $this->input->post('titlepenumpanga')[$i];
					$data['penu_nama'] 		= $this->input->post('namapenumpanga')[$i];
					$data['penu_nega_id'] 	= $this->input->post('warganegaraa')[$i];
					$data['penu_status'] 	= 'Anak - Anak';

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
					$data['penu_nega_id'] 	= $this->input->post('warganegarab')[$i];
					$data['penu_status'] 	= 'Bayi';

					$this->db->insert('penumpang', $data);
				}
			}
		}

		if(!empty($penumpangDewasa)){$dewasa=count($penumpangDewasa);}else{$dewasa=0;}
		if(!empty($penumpangAnak)){$anak=count($penumpangAnak);}else{$anak=0;} 
		if(!empty($penumpangBayi)){$bayi=count($penumpangBayi);}else{$bayi=0;}

		$total 	= (int)$dewasa + (int)$anak + (int)$bayi;
		
		return $total;
	}

	public function insertTiketDetail($exePenumpang, $exePemesan, $tiketId)
	{
		$getPenumpang 				= $this->db->order_by('penu_id','DESC')->limit($exePenumpang)->get('penumpang')->result_array();

		for($i = 0; $i < (int)$exePenumpang; $i++)
		{
			$data['pemt_penu_id'] 			= $getPenumpang[$i]['penu_id'];
			$data['pemt_peme_id'] 			= $exePemesan;
			$data['pemt_tikp_id']			= $tiketId;
			$data['pemt_status_pesanan'] 	= 'Pesawat';
			$data['pemt_tipd_id'] 			= $this->getTiketPesawatDetail($tiketId);
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
					$getTiketDetailId 		= $this->db->limit(1)
														->get_where('tiket_pesawat_detail', ['tipd_tikp_id' => $r['pemt_tikp_id'],'tipd_status' => 'Tersedia'])
														->row_array();

					$data1['tipd_status'] 	= 'Sudah Dipesan';

					$exe2 					= $this->db->where('tipd_id', $getTiketDetailId['tipd_id']);
					$exe2 					= $this->db->update('tiket_pesawat_detail', $data1);
				}
			}
		}

		$cekTiket 				= $this->db->where('pemt_peme_id', $pemesan)->limit(1)->get('pemesan_tiket');

		// Ganti Status Setelah Tiket Habis
		if($cekTiket->num_rows() > 0)
		{
			$tiketId 	= $cekTiket->row_array()['pemt_tikp_id'];

			$cekTiket2 	= $this->db->where('tipd_tikp_id', $tiketId)->where('tipd_status', 'Tersedia')->get('tiket_pesawat_detail');

			if($cekTiket2->num_rows() < 1)
			{
				$data2['tikp_status'] 	= 'Habis';

				$exe3 					= $this->db->where('tikp_id', $tiketId);
				$exe3 					= $this->db->update('tiket_pesawat', $data);
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
		$get 	= $this->db->where('pemt_status_pesanan', 'Pesawat')->limit(1)->get('pemesan_tiket')->row_array();

		$exe 	= $this->db->select('a.*')
							->from('tiket_pesawat_detail a')
							->where('a.tipd_status', 'Tersedia')
							->where('a.tipd_tikp_id', $tiketId)
							->where('a.tipd_id != ', $get['pemt_tipd_id'])
							->order_by('a.tipd_id', 'asc')
							->limit(1)
							->get();

		return $exe->row_array()['tipd_id'];
	}











	// Get Data Penerbangan
	public function getPenerbangan()
	{
		$pemesan    		= $this->session->userdata('pemesan');

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

				i.*, k.*
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
		$this->db->join('pemesan_tiket k', 'k.pemt_tikp_id = i.tikp_id', 'left');
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