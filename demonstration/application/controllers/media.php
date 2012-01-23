<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends Controller {

	function __construct()
	{
		parent::__construct();
		
		// Set the instagram library access token variable
		$this->instagram_api->access_token = $this->session->userdata('instagram-token');
	}
	
	function index()
	{
		echo '<p>List media items</p>';
	}

	function item($media_id = FALSE)
	{
		
		$media_data = $this->instagram_api->getMedia($media_id, $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($media_data);
		echo '</pre>';
		
	}
	
	function search()
	{
	
		// Load the javascript
		$this->carabiner->js('jquery-ui-1.8.5.custom.min.js');
		$this->carabiner->js('pages/search_media.js');
	
		if($this->input->post('submit')) {
		
			if($this->input->post('latitude')) {
				$latitude = $this->input->post('latitude');
			} else {
				$latitude = null;
			}
			
			if($this->input->post('longitude')) {
				$longitude = $this->input->post('longitude');
			} else {
				$longitude = null;
			}
			
			if($this->input->post('max_timestamp')) {
				$max_timestamp = strtotime($this->input->post('max_timestamp'));
			} else {
				$max_timestamp = null;
			}
			
			if($this->input->post('min_timestamp')) {
				$min_timestamp = strtotime($this->input->post('min_timestamp'));
			} else {
				$min_timestamp = null;
			}
			
			if($this->input->post('distance')) {
				$distance = $this->input->post('distance');
			} else {
				$distance = null;
			}
		
			$data['media_search_data'] = $this->instagram_api->mediaSearch($latitude, $longitude, $max_timestamp, $min_timestamp, $distance);
			
		}
		
		$data['latitude_input'] = array(
				'name'	=> 'latitude',
				'id'	=> 'latitude'
		);
		
		$data['longitude_input'] = array(
				'name'	=> 'longitude',
				'id'	=> 'longitude'
		);
		
		$data['max_timestamp_input'] = array(
				'name'	=> 'max_timestamp',
				'id'	=> 'max_timestamp',
				'class'	=> 'date'
		);

		$data['min_timestamp_input'] = array(
				'name'	=> 'min_timestamp',
				'id'	=> 'min_timestamp',
				'class'	=> 'date'
		);
		
		$data['distance_select'] = array(
				'name'		=> 'distance',
				'id'		=> 'distance',
				'options'	=> array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')
		);
		
		$data['submit_input'] = array(
				'name'	=> 'submit',
				'id'	=> 'submit',
				'value'	=> 'Search'
		);

		$data['main_view'] = 'media_search';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function popular() {
		
		$data['popular_media_data'] = $this->instagram_api->popularMedia();
		
		$data['main_view'] = 'media_popular';
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
	}
	
	function comments() {
		
		$media_comments_data = $this->instagram_api->mediaComments('3', $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($media_comments_data);
		echo '</pre>';
		
	}
	
	function likes() {
		
		$media_likes_data = $this->instagram_api->mediaLikes('3', $this->session->userdata('instagram-token'));
		
		echo '<pre>';
		print_r($media_likes_data);
		echo '</pre>';
		
	}
	
}