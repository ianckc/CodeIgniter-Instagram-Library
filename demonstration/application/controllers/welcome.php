<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
	
		// Get popular media using the client id call
		$data['popular_media'] = $this->instagram_api->getPopularMedia();

		$data['main_view'] = 'welcome_message';
		
		$this->load->vars($data);
		
		$this->load->view('template');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */