<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		echo '<p>List location functions</p>';
	}

	function details()
	{
		
		$location_data = $this->instagram_api->getLocation('1', $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($location_data);
		echo '</pre>';
		
	}
	
	function recent()
	{
		
		$location_recent_data = $this->instagram_api->locationRecent('1', $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($location_recent_data);
		echo '</pre>';
		
	}
	
	function search()
	{
		
		$location_search_data = $this->instagram_api->locationSearch($this->session->userdata('instagram-token'), '37.782654745657', '-122.38786697388');
		
		echo '<pre>';
		print_r($location_search_data);
		echo '</pre>';
		
	}
	
}