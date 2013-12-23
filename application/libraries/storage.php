<?php
	class storage{
		function __construct() {
			$this->_ci =& get_instance();
			log_message('debug', 'Storage Library Initialized');
		}

		public function getArticle($url) {
			$article = $this->_ci->cimongo->where(array('url' => $url))->get('articles')->row();
			if($article) {
				return $article->data;
			}

			return false;
		}

		public function saveArticle($url, $data) {
			if(!$this->_ci->cimongo->where(array('url' => $url))->get('articles')->row()) {
				$insert = array('url' => $url, 'data' => $data, 'generated' => time());

				return $this->_ci->cimongo->insert('articles', $insert);
			}
		}
	}
?>