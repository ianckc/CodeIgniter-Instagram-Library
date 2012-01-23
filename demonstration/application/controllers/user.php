<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Controller {

	function __construct()
	{
		parent::__construct();
		
		// Set the instagram library access token variable
		$this->instagram_api->access_token = $this->session->userdata('instagram-token');
		
	}
	
	function index()
	{
		echo '<p>List user functions</p>';
	}

	function profile($user_id = FALSE)
	{
	
		if($user_id === FALSE) {
			$user_id = $this->session->userdata('instagram-user-id');
		}
		
		// Get the user data
		$data['user_data'] = $this->instagram_api->getUser($user_id);

		$data['main_view'] = 'user_profile';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function feed()
	{
		
		// Get the user data
		$data['user_data'] = $this->instagram_api->getUser($this->session->userdata('instagram-user-id'));
		
		// Get the user feed
		$data['user_feed'] = $this->instagram_api->getUserFeed();

		$data['main_view'] = 'user_feed';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function recent($user_id = FALSE)
	{
	
		if($user_id === FALSE) {
			$user_id = $this->session->userdata('instagram-user-id');
		}
	
		// Get the user data
		$data['user_data'] = $this->instagram_api->getUser($user_id);
		
		$data['user_recent_data'] = $this->instagram_api->getUserRecent($user_id);
		
		$data['main_view'] = 'user_recent';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function search($username = FALSE)
	{
	
		if($this->input->post('username')) {
		
			redirect('/user/search/' . $this->input->post('username'));
		
		}
		
		if($username !== FALSE) {
		
			// Search for the user
			$data['user_search_data'] = $this->instagram_api->userSearch($username);
		
		}
		
		$data['username_input'] = array(
				'name'	=> 'username',
				'id'	=> 'username'
		);
		
		$data['submit_input'] = array(
				'name'	=> 'submit',
				'id'	=> 'submit',
				'value'	=> 'Search'
		);
		
		$data['main_view'] = 'user_search';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function follows($user_id = FALSE)
	{
		
		if($user_id === FALSE) {
			$user_id = $this->session->userdata('instagram-user-id');
		}
		
		// Get the user data
		$data['user_data'] = $this->instagram_api->getUser($this->session->userdata('instagram-user-id'));
		
		// Get the user feed
		$data['follows'] = $this->instagram_api->userFollows($user_id);

		$data['main_view'] = 'follows';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function followed_by($user_id = FALSE)
	{
		
		if($user_id === FALSE) {
			$user_id = $this->session->userdata('instagram-user-id');
		}
		
		// Get the user data
		$data['user_data'] = $this->instagram_api->getUser($this->session->userdata('instagram-user-id'));
		
		// Get the user feed
		$data['followed_by'] = $this->instagram_api->userFollowedBy($user_id);

		$data['main_view'] = 'followed_by';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function requested_by() {
		
		$user_requested_by_data = $this->instagram_api->userRequestedBy($this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($user_requested_by_data);
		echo '</pre>'; 
		
	}
	
	function relationship() {
		
		$user_relationship_data = $this->instagram_api->userRelationship($this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($user_relationship_data);
		echo '</pre>'; 
		
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */