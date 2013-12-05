<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		if($this->session->userdata('reddit_session')) {
			$this->curl->set_cookies(array('reddit_session' => $this->session->userdata('reddit_session')));
			$this->user = $this->reddit->getUser();
			//$this->user = null;
		}else{
			$this->user = null;
		}

		setFlashMessage('warning', 'Article extractor has been disabled to optimize load times.');
   }
}
