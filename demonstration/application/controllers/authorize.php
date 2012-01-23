<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorize extends Controller {

	function __construct()
	{		
		parent::__construct();
	}

	function index()
	{
		
		echo '<h1>Authorize</h1>';		
		
	}
	
	/*
	 * Function for the Instagram callback url
	 */
	function get_code() {
	
		// Make sure that there is a GET variable of code
		if(isset($_GET['code']) && $_GET['code'] != '') {
			
			$auth_response = $this->instagram_api->authorize($_GET['code']);
			
			// Set up session variables containing some useful Instagram data
			$this->session->set_userdata('instagram-token', $auth_response->access_token);
			$this->session->set_userdata('instagram-username', $auth_response->user->username);
			$this->session->set_userdata('instagram-profile-picture', $auth_response->user->profile_picture);
			$this->session->set_userdata('instagram-user-id', $auth_response->user->id);
			$this->session->set_userdata('instagram-full-name', $auth_response->user->full_name);
			
			redirect('/welcome');
			
		} else {
			
			// There was no GET variable so redirect back to the homepage
			redirect('/welcome');
			
		}
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */