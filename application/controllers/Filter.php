<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

	public function getValueKota()
	{
		$get = $this->db->get('kota')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValuePengaturanMenuParent()
	{
		$get = $this->db->select('menu_id,menu_name')->order_by('menu_index','asc')->where('menu_menu_id',0)->get('menu')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}	
		
	public function getValuePengaturanPenggunaLevel()
	{
		$get = $this->db->select('lev_id,lev_nama')->order_by('lev_id','asc')->get('level')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueMenu()
	{
		$get = $this->db->select('*')
										->where('menu_menu_id',0)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueLevel()
	{
		$get = $this->db->select('*')
										// ->where('menu_menu_id',0)
										->get('level a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueSubMenu()
	{
		$menu_id = $this->input->post('menu_id');
		$get = $this->db->select('*')
										->where('menu_menu_id',$menu_id)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}
}	
