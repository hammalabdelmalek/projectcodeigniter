<?php

	class user_model extends CI_Model{
		public function register($enc_password){
			// user data array
			$data = array(
				'nom'=>$this->input->post('name'),
				'prenom'=>$this->input->post('prenom'),
				'user_name'=>$this->input->post('username'),
				'mail'=>$this->input->post('email'),				
				'password'=>$enc_password,
				'role'=>$this->input->post('role')
			);

			//inser user
			return $this->db->insert('users', $data);

		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('user_name', $username);
			$this->db->where('password', $password);
			$result = $this->db->get('users');
			if($result->num_rows() == 1){
				$user_data = array(
					'role' =>$result->row(0)->role 
				);
				$this->session->set_userdata($user_data);
				return $result->row(0)->id;
			} else {
				return false;
			}
		}

		// check username exists
		public function check_username_exists($username){
			$query=$this->db->get_where('users',array('user_name'=>$username));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// check email exists
		public function check_email_exists($email){
			$query=$this->db->get_where('users',array('mail'=>$email));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function edit_password($enc_password){
			$data = array(
				'password'=>$enc_password
			);

			 return $this->db->where('id',$this->session->userdata('user_id'))->update('users',$data);     

		}

	}