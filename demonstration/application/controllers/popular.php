<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popular extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
	
		// Load the instagram api library
		$this->load->library('instagram_api');
		
		// Get the popular media
		$popular_media = $this->instagram_api->getPopularMedia();
		
		// Loop through the data returned by Instagram
		foreach($popular_media->data as $data) {
		
			// To see all the data that each media item contains uncomment the following		
			/*echo '<pre>';
			print_r($data);
			echo '</pre>';*/

			// Display the thumbnail image
			echo '<p><img src="' . $data->images->thumbnail->url . '" /></p>';
			
			// Display the user name
			echo '<p>Taken by ' . $data->user->username . '</p>'; 
			
			echo '<hr />';
		
		}
		
		
	}
	
}