<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instagram extends CI_Controller {

/*
| For Development
| Function provides the link for authorization request
*/
	function index()
	{
		$this->load->library('instagram_api');
		echo "<p>This library uses the Instagram API but is not endorsed or certified by Instagram.</p>";
		echo "<a href=\"https://api.instagram.com/oauth/authorize/?client_id=".$this->config->item('instagram_client_id')."&redirect_uri=".$this->config->item('instagram_redirect_uri')."&response_type=code\">Authorize Instagram</a>";
	}
	
/*
| For Development
| Function handles the authorization request, and outputs the Access Token
*/
	function instagramredirect()
	{
		$this->load->library('instagram_api');		
		$igObj = new Instagram_api($this->config->item('instagram_client_id'), $this->config->item('instagram_client_secret'));
		$token = $igObj->authorize($_GET['code']);
		echo "Copy the next line of text into the value for \"instagram_access_token\" in the application/config/config.php file:<br>".$token->access_token;
	}

}

/* End of file site.php */
/* Location: ./application/controllers/site.php */