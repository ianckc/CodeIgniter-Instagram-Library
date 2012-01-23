<?php

class Instagram extends Controller {

	function Instagram() {
		parent::Controller();
	}
	
	function index() {
	
		echo '<h1>Instagram</h1>';
		
		// Load the Instagram api library
		$this->load->library('instagram_api');
		
		// Get popular media
		$popular_media = $this->instagram_api->getPopularMedia();
		
		// Loop through the popular media and display the images
		foreach($popular_media->data as $data) {
		
			// Display the thumbnail image		
			echo '<img src="' . $data->images->thumbnail->url . '" />';
		
		}
	
	}

}