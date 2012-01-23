<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popular_media extends Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		echo '<h1>Popular media</h1>';
		
		$popular_media_request_url = 'https://api.instagram.com/v1/media/popular?client_id=' . INSTAGRAM_CLIENT_ID;
		
		$popular_media = $this->instagram_api->getPopularMedia();
		
		foreach($popular_media->data as $media) {
			
			$thumbnail_url	= $media->images->thumbnail->url;
			
			if(isset($media->caption->text)) {
				$image_caption	= $media->caption->text;
			} else {
				$image_caption	= 'Instagram CodeIgniter library by Ian Luckraft';
			}
			$image_width	= $media->images->thumbnail->width;
			$image_height	= $media->images->thumbnail->height;
			
			echo '<img src="' . $thumbnail_url . '" alt="' . $image_caption . '" width="' . $image_width . '" height="' . $image_height . '" />';
		
		}
		
	}
}

/* End of file popular_media.php */
/* Location: ./application/controllers/popular_media.php */