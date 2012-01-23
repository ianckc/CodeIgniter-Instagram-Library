<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends Controller {

	function __construct()
	{
		parent::__construct();
		
		// Set the instagram library access token variable
		$this->instagram_api->access_token = $this->session->userdata('instagram-token');
		
	}
	
	function index()
	{
		echo '<p>List tag functions</p>';
	}

	function details($tag = FALSE)
	{
		
		$tags_data = $this->instagram_api->getTags($tag);
		
		echo '<pre>';
		print_r($tags_data);
		echo '</pre>';
		
	}
	
	function recent($tag = FALSE)
	{
		
		$data['tags_recent_data'] = $this->instagram_api->tagsRecent($tag);
		
		$data['main_view'] = 'tags_recent';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function search()
	{
		
		$tags_search_data = $this->instagram_api->tagsSearch('skateboard', $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($tags_search_data);
		echo '</pre>';
		
	}
	
}