<?php
	class pages extends CI_Controller{
		public function view($page = 'home'){  //po defaultu je $page home

			if(!file_exists(APPPATH. 'views/pages/'.$page.'.php')){    //APPPATH- CI constant- CI application folder
					show_404();   //CI function to load a 404 error
			}

			$data['title'] = ucfirst($page);

			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}