<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code extends CI_Controller {

	public function getCodeJadwalPerjalanan()
	{
		$this->db->select('RIGHT(jadwal_kereta.jadk_kode,5) as id', FALSE);
		$this->db->order_by('jadk_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('jadwal_kereta');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "PERJ-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));	
	}

	public function getCodeJadwal()
	{
		$this->db->select('RIGHT(jadwal_pesawat.jadp_kode,5) as id', FALSE);
		$this->db->order_by('jadp_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('jadwal_pesawat');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "PENE-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodeKereta()
	{
	  	$kodetampil 	= "KAI-";  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));	
	}

	public function getCodeKeretaRute()
	{
		$this->db->select('RIGHT(rute_kereta.rute_kode,5) as id', FALSE);
		$this->db->order_by('rute_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('rute_kereta');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "RKAI-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));	
	}

	public function getCodePenerbanganRute()
	{
		$this->db->select('RIGHT(rute.rute_kode,5) as id', FALSE);
		$this->db->order_by('rute_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('rute');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "RUTE-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));	
	}

	public function getCodeMaskapai()
	{
		$this->db->select('RIGHT(maskapai.mask_kode,5) as id', FALSE);
		$this->db->order_by('mask_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('maskapai');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "MASK-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodeKelas()
	{
		$this->db->select('RIGHT(kelas.kela_kode,5) as id', FALSE);
		$this->db->order_by('kela_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('kelas');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "KELA-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodeBandara()
	{
		$this->db->select('RIGHT(bandara.band_kode,5) as id', FALSE);
		$this->db->order_by('band_kode','DESC');    
		$this->db->limit(1);    
		$query 	= $this->db->get('bandara');  //cek dulu apakah ada sudah ada kode di tabel.    
		
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
	  	$kodetampil 	= "BAND-".$tgl."-".$batas;  
		$output['id'] 	= $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));	
	}
}