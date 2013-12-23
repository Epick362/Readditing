<?php
	class storage{
		function __construct() {
			$this->_ci =& get_instance();
			log_message('debug', 'Storage Library Initialized');
		}

		public function articleDatabase($url) {
			print_r($this->mongo_db->where(array('url' => $url))->get('articles'));
		}
	}
?>