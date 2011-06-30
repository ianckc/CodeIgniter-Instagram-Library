<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instagram extends CI_Controller {

/*
| For Development
| Function provides the link for authorization request
*/
	function index()
	{
		$this->load->library('instagram_api');
		$ig_client_id = $this->config->item('instagram_client_id');
		$ig_redirect_uri = $this->config->item('instagram_redirect_uri');

		echo "<p>This library uses the Instagram API but is not endorsed or certified by Instagram.</p>";
		echo "<a href=\"".$this->instagram_api->instagramLogin($ig_client_id, $ig_redirect_uri)."\">Authorize Instagram</a>";
	}
	
/*
| For Development
| Function handles the authorization request, and outputs the Access Token
*/
	function instagramredirect()
	{
		$this->load->library('instagram_api');		
		$ig_client_id = $this->config->item('instagram_client_id');
		$ig_client_secret = $this->config->item('instagram_client_secret');
		$ig_redirect_uri = $this->config->item('instagram_redirect_uri');

		$igObj = new Instagram_api($ig_client_id, $ig_client_secret);
		$token = $igObj->authorize($ig_client_id, $ig_client_secret, $ig_redirect_uri, $_GET['code']);
		echo "Copy the next line of text into the value for \"instagram_access_token\" in the application/config/config.php file:<br>".$token->access_token;
	}

}

/* End of file site.php */
/* Location: ./application/controllers/site.php */