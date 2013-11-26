<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		if($this->session->userdata('user') && $this->session->userdata('passwd')) {
			$this->login = $this->reddit->login($this->session->userdata('user'), $this->session->userdata('passwd'));
			if($this->login) {
				$this->user = $this->reddit->getUser();
			}else{
				$this->user = null;
			}
		}else{
			$this->login = false;
			$this->user = null;
		}
   }
}
