<?php if (!defined('BASEPATH')) die();
class Ajax extends Main_Controller {
	public function displayFeed() {
		if($this->input->post('subreddit') && $this->input->post('show')) {
			$feed = $this->reddit->getFeed($this->input->post('subreddit'), $this->input->post('show'), array('after' => $this->input->post('after'), 'limit' => 10));
			echo $this->load->view('slices/ad-leaderboard');
			foreach($feed as $key => $post) {
				echo $this->load->view('templates/post_template', array('post' => $post, 'user' => $this->user));
			}
		}else{
			http_response_code(400);
			echo 'No input';
			return;
		}
	}

	public function getComments() {
		if($this->input->post('subreddit') && $this->input->post('article')) {
			$comments = $this->reddit->getComments($this->input->post('subreddit'), $this->input->post('article'));
			foreach($comments as $key => $comment) {
				if(isset($comment->data->author)) {
					echo $this->load->view('templates/comments_template', array('comment' => $comment));
				}
			}
		}else{
			http_response_code(400);
			echo 'No input';
			return;
		}
	}

	public function vote() {
		if($this->input->post('fullname') && $this->input->post('dir') != '') {
			$response = $this->reddit->addVote($this->input->post('fullname'), $this->input->post('dir'));
		}else{
			http_response_code(400);
			echo 'No input';
			return;			
		}
	}

	public function saveArticle() {
		if($this->input->post('url') && $this->input->post('data')) {
			$response = $this->storage->saveArticle($this->input->post('url'), $this->input->post('data'));
		}else{
			http_response_code(400);
			echo 'No input';
			return;
		}
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/ajax.php */
