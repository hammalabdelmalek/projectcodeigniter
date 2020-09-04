<?php
 	class users extends CI_Controller{

 		public function register(){

 			//check login 
 			if($this->session->userdata('logged_in')){
                redirect('posts');
            } 

 			$data['title']='Inscription';

 			$this->form_validation->set_rules('name','Name','required');
 			$this->form_validation->set_rules('username','Userame','required|callback_check_username_exists');
 			$this->form_validation->set_rules('email','Email','required|callback_check_email_exists');
 			$this->form_validation->set_rules('password','Password','required|callback_check_password_length');
 			$this->form_validation->set_rules('password2','Password2','matches[password]');

 			if($this->form_validation->run() === FALSE){

 				$this->load->view('templates/header');
 				$this->load->view('users/register', $data);
 				$this->load->view('templates/footer');

 			}else{

 				// Encrypt the password
 				$enc_password = md5($this->input->post('password'));

 				$this->user_model->register($enc_password);

 				$this->session->set_flashdata('user_registered','Maintenant vous êtes inscrit et vous pouvez connecter');

 				redirect('posts');

 			

 		}


	}


	// Log in user
		public function login(){
			// Check login
       		if($this->session->userdata('logged_in')){
                redirect('posts');
            } 

			$data['title'] = 'Connexion';
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));
				// Login user
				$user_id = $this->user_model->login($username, $password);
				if($user_id){
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'Maintenant vous êtes connecté');
					redirect('posts');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Username ou mot de passe incorect');
					redirect('users/login');
				}		
			}
		}

		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('role');
			// Set message
			$this->session->set_flashdata('user_loggedout', 'maintenant vous êtes déconnecté');
			redirect('users/login');
		}		

		public function edit_password(){
			//check login 
			if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            } 

			$data['title']='Modifier mot de passe';

 			$this->form_validation->set_rules('password','Password','required');
 			$this->form_validation->set_rules('password2','Password2','matches[password]');

 			if($this->form_validation->run() === FALSE){
 				$this->load->view('templates/header');
 				$this->load->view('users/password', $data);
 				$this->load->view('templates/footer');
 			}else{

 				// Encrypt the password
 				$enc_password = md5($this->input->post('password'));
 				$this->user_model->edit_password($enc_password);
 				//set message
 				$this->session->set_flashdata('user_password','votre mot de passe a etait changer');

 				redirect('users/profile');
 			}

		}

		public function profile(){

			//check login 
			if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            } 

			$this->load->view('templates/header');
 			$this->load->view('users/profile');
 			$this->load->view('templates/footer');
 		}

		function check_username_exists($username){

 			$this->form_validation->set_message('check_username_exists','Ce username est déjà pris il faut choisir un autre');
 			if($this->user_model->check_username_exists($username)){
 				return true;
 			}else{
 				return false;
 			}

 		}

 		function check_password_length($password){
 			$this->form_validation->set_message('check_password_length','Donner un mot de passe de 6 caractere minimum');
 			if(strlen($password)<6){
 				return false;
 			}else{
 				return true;
 			}
 		}

 		//check if email exists
 		function check_email_exists($email){
 			$this->form_validation->set_message('check_email_exists','Cette adresse mail déjà prise il faut choisir une autre');
 			if($this->user_model->check_email_exists($email)){
 				return true;
 			}else{
 				return false;
 			}

 		}
}
?>	 				