<?php if (!defined('BASEPATH')) die();
class R extends Main_Controller {
	public function index($subreddit = null, $show = 'hot', $after = null) {
		$this->stencil->layout('template');
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

			$this->stencil->title($data->subreddit);
			$this->stencil->paint('r', $data);
		}else{
			$data->comments = $this->reddit->getComments($subreddit, $after, false); // AFTER IS POST ID IN THIS CASE
			$data->post = $this->reddit->displayFeed($data->comments[0]->data->children)[0];

			if(strtolower($data->post->data->author) === 'kanetoshindo') {
				return show_404();
			}

			$this->stencil->title($data->post->data->title);
			$this->stencil->paint('comments', $data);			
		}
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
