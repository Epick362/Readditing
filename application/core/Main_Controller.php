<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		if($this->session->userdata('user') && $this->session->userdata('passwd')) {
			$this->login = $this->reddit->login($this->session->userdata('user'), $this->session->userdata('passwd'));
			$this->user  = $this->reddit->getUser();
		}else{
			$this->login = null;
			$this->user = null;
		}
   }
}
