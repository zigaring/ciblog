<?php
	class Users extends CI_Controller
	{
		public function register()
		{
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('username','Username','required|callback_check_username_exists');//custom funkcija za preverit username če že obstaja(callback pred imenom funkcije)
			$this->form_validation->set_rules('email','Email','required|callback_check_email_exists');//isto za email
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('password2','Confirm','matches[password]');
		

			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				//Encrypt password
				$enc_password = md5($this->input->post('password'));   //md5-php funkcija za zakodirat geslo
				$this->user_model->register($enc_password);

				//Set message
				$this->session->set_flashdata('user_registered','You are now registered and can log in');

				redirect('posts');
			}
		}

		public function login()
		{
				$data['title'] = 'Sign In';

				$this->form_validation->set_rules('username','Username','required');
				$this->form_validation->set_rules('password','Password','required');

				if($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header');
					$this->load->view('users/login', $data);
					$this->load->view('templates/footer');
				}
				else
				{	
					//get username
					$username = $this->input->post('username');

					//get and encrypt password
					$password = md5($this->input->post('password'));

					//login user
					$user_id = $this->user_model->login($username, $password);

					if($user_id)
						{	
							//create session
							$user_data = array(
								'user_id' => $user_id,
								'username' => $username,
								'logged_in' => true 
							);

							$this->session->set_userdata($user_data);
							
							//Set message
							$this->session->set_flashdata('user_loggedin','You are now logged in');
							redirect('posts');
						}
					else
						{	
							//Set message
							$this->session->set_flashdata('login_failed','Login is invalid');
							redirect('users/login');
						}
				}
		}

		public function logout()
		{
			//Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');

			//Set message
			$this->session->set_flashdata('user_loggedout','You have beed logged out');
			redirect('users/login');
		}

		//check if username exists
		public function check_username_exists($usrn) //-pridobi podatek(username) iz forme
		{
			$this->form_validation->set_message('check_username_exists','This Username is taken. Please choose a different one' );
			if($this->user_model->check_username_exists($usrn)){
				return true; //Če najde enak username vrne sporočilo
			} 
			else{
				return false;
			}
		}

		public function check_email_exists($email)
		{
			$this->form_validation->set_message('check_email_exists','This Email is taken. Please choose different one');
			if($this->user_model->check_email_exists($email)){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>	