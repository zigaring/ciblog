<?php
	class User_model extends CI_Model
	{
		public function register($enc_password)
		{
			//User data array
			$data = array(
				'name' => $this->input->post('name'),
				'zipcode' => $this->input->post('zipcode'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password
			);

			//insert
			return $this->db->insert('users', $data);
		}

		public function login($username, $password)
		{
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1 )
				{
					return $result->row(0)->id;
				}
			else
				{
					return false;
				}
		}

		//check username exists
		public function check_username_exists($usrn)
		{
			$query = $this->db->get_where('users', array('username' => $usrn));
			if(empty($query->row_array())){     //Returns a single result row
				return true;  //vrne rezultat
			}
			else{
				return false;
			}
		}

		//check email exists
		public function check_email_exists($email)
		{
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>