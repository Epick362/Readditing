<?php if (!defined('BASEPATH')) die();
class R extends Main_Controller {

	public function index($subreddit = null, $show = 'hot', $after = null) {
		if($subreddit == 'frontpage' || $subreddit == null) {
			$subreddit = null;
			$data->subreddit = 'frontpage';
		}else{
			$data->subreddit = $subreddit;
		}
		$data->show = $show;
		$data->user = $this->user;

		$params = array('limit' => 15);

		if($after) {
			$params['after'] = 't3_'.$after;
		}

		if(!$subreddit) {
			$data->feed = $this->rest->get('.json', $params)->data->children;
		}else{
			$data->feed = $this->rest->get('r/'.$subreddit.'/'.$show.'.json', $params)->data->children;
		}
		
		uasort($data->feed, function($a, $b) {
			return $b->data->score - $a->data->score;
		});
		$data->subreddits = $this->rest->get('subreddits/popular.json')->data->children;

		$imageTypes = array('gif', 'jpg', 'jpeg', 'png');

		foreach($data->feed as $item) {
			if($item->data->over_18 == TRUE) { // NSFW FILTER
				$item->kind = 'nsfw';
				$item->data->title = NULL;
			}else{
				if($item->data->selftext_html) {
					$item->kind = 'selftext';
				}elseif($item->data->media) {
					$item->kind = 'media';
				}elseif(in_array(substr(strrchr($item->data->url,'.'),1), $imageTypes)) {
					$item->kind = 'image';
				}else{
					$item->kind = 'misc';
					$this->rest->initialize(array('server' => 'http://reader-api.herokuapp.com/'));
					$_extracted = $this->rest->get('api/article', array('url' => $item->data->url));
					if(isset($_extracted->article)) {
						$item->data->_extracted = $_extracted->article;
						if($item->data->_extracted->body) {
							if(strlen($item->data->_extracted->body) >= 250) {
								$item->kind = 'extractedtext';
							}elseif(isset($item->data->_extracted->image) && $item->data->_extracted->image->width >= 300) {
								$item->kind = 'image';
								$item->data->url = $item->data->_extracted->image->src;
							}
						}
					}
				}
			}

			$item->_display = $this->display->{$item->kind}($item);
		}

		$this->template->set('title', $data->subreddit);
		$this->template->frontpage('r', $data);
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
