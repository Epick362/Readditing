<?php
class Main_Controller extends MY_Controller 
{
   function __construct()
   {
		parent::__construct();
		$this->login = $this->reddit->login('epick_362', 'osnipers362');
		//$this->rest->debug();

		//$this->user = $this->reddit->getUser();
		$this->user = null;
		//$this->rest->debug();
   }
}
