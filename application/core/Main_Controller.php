<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		if($this->session->userdata('reddit_session')) {
			$this->user = $this->reddit->getUser();
			//$this->user = null;/
		}else{
			$this->user = null;
		}
		echo '<pre>'; print_r($_SERVER); echo '</pre>'; 
   }
}
