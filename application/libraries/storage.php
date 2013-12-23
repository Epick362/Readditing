<?php
	class storage{
		public function articleDatabase($url) {
			print_r($this->mongo_db->where(array('url' => $url))->get('articles'));
		}
	}
?>