<?php if (!defined('BASEPATH')) die();
class R extends Main_Controller {
	public function index($subreddit = null, $show = 'hot', $after = null) {
		$data = new stdClass();

		if(!$subreddit){
			$data->subreddit = 'home';
		}else{
			$data->subreddit = $subreddit;
		}
		$data->show = $show;
		$data->user = $this->user;

		if ($show != 'comments') {
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

			$this->template->set('title', $data->subreddit);
			$this->template->frontpage('r', $data);
		}else{
			$data->post = $this->reddit->getComments($subreddit, $after); // AFTER IS POST ID IN THIS CASE
			$this->template->set('title', '#');
			$this->template->frontpage('comments', $data);			
		}
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
