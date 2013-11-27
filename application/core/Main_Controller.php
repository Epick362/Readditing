<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		if($this->session->userdata('reddit_session')) {
			$this->user = $this->reddit->getUser();
		}else{
			$this->user = null;
		}
   }
}
