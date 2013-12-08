<?php if (!defined('BASEPATH')) die();
class R extends Main_Controller {
	public function index($subreddit = null, $show = 'hot', $after = null) {
		if(!$subreddit){
			$data->subreddit = 'home';
		}else{
			$data->subreddit = $subreddit;
		}
		$data->show = $show;
		$data->user = $this->user;

		print_r($this->rest->get('r/'.$subreddit.'/comments/'.$postID)->data->children);

		$params = array('limit' => 15);

		if($after) {
			$params['after'] = 't3_'.$after;
		}

		$data->feed = $this->reddit->getFeed($subreddit, $show, $params);

		if($this->user) {
			$data->subreddits = $this->reddit->getSubscriptions();
		}else{
			$data->subreddits = $this->reddit->getPopular();
		}

		setFlashMessage('warning', 'Article extractor has been disabled to optimize load times.');

		$this->template->set('title', $data->subreddit);
		$this->template->frontpage('r', $data);
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
