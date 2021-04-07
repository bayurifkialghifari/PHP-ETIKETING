<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model {

	public function daftar($username, $email, $notelepon, $password, $token)
	{
		$data['user_name'] 		= $username;
		$data['user_email'] 	= $email;
		$data['user_phone'] 	= $notelepon;
		$data['user_password'] 	= $password;
		$data['user_token'] 	= $token;
		$data['user_status'] 	= 'Belum Verivikasi';
		$data['created_date'] 	= psql_datetime_format();

		$emailCek 				= $this->db->get_where('users', ['user_email' => $email])->num_rows();

		if($emailCek < 1)
		{
			$exe 				 	= $this->db->insert('users', $data);
			$user_id 				= $this->db->insert_id();
			$lev_id 				= 3;


			$sql2 					= "INSERT INTO role_users (rolu_user_id, rolu_lev_id, created_date) VALUES (?, ?, ?);";
			$q2 					= $this->db->query($sql2, [$user_id, $lev_id, psql_datetime_format()]);

			return $user_id;
		}

		return 0;
	}

	public function verivikasi($id, $email, $token, $notelp)
	{
		$data['user_status'] 	= 'Terverivikasi';

		$where 					= array(
											'user_email' => $email,
											'user_token' => $token,
											'user_phone' => $notelp,
											'user_id' => $id
										);

		$exe 					= $this->db->where($where);
		$exe 					= $this->db->update('users', $data);

		return $this->db->get_where('users', ['user_id' => $id])->row_array();
	}

}

/* End of file RegisterModel.php */
/* Location: ./application/models/RegisterModel.php */