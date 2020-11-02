<?php 
	class Post_model extends CI_Model
	{

		public function __construct()  //constructor se kliče pred vsemi ostalimi funkcijami
		//The construct function lets you use things over the entire class. This way you don't have to load the model/language/settings in every method. Class calls this method on each newly-created object
		{

			$this->load->database();
			//If only some of your pages require database connectivity you can manually connect to your database by adding this line of code in any function where it is needed, or in your class constructor to make the database available globally in that class.
		}

		public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE) //če $slug ni vnešen je FALSE. Prejmemo še limit in offset za Pagination
		{
			if($limit){
				$this->db->limit($limit, $offset);
			}

			if($slug === FALSE)
			{
				$this->db->order_by('posts.id','DESC');
				$this->db->join('categories','categories.id = posts.category_id'); //joinamo tabele

				$query = $this->db->get('posts'); //potegne iz baze 'posts'
				return $query->result_array(); //množica rezultatov
			}

			$query = $this->db->get_where('posts', array('slug'=>$slug)); //$slug služi kot ID
			return $query->row_array();  //1 rezultat
		}

		public function create_post($post_image)
		{
			$slug = url_title($this->input->post('title'));  //url title= string to 'human-friendy-url'

			$data = array(
						'title' => $this->input->post('title'),
						'slug' => $slug,
						'body' => $this->input->post('body'),
						'category_id' => $this->input->post('category_id'),
						'user_id' => $this->session->userdata('user_id'),
						'post_image' => $post_image
			);

			return $this->db->insert('posts', $data);
		}

		public function delete_post($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post()
		{
			$slug = url_title($this->input->post('title'));
			$data = array(
						'title' => $this->input->post('title'),
						'slug' => $slug,
						'body' => $this->input->post('body'),
						'category_id' => $this->input->post('category_id')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_categories()
		{
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();   //vračamo array - množica rezultatov
		}

		public function get_posts_by_category($category_id)
		{
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');	
			$query = $this->db->get_where('posts', array('category_id' => $category_id));

			return $query->result_array();
		}


	}