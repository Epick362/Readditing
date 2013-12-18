<?php if (!defined('BASEPATH')) die();
class Ajax extends Main_Controller {
	public function displayFeed() {
		if($this->input->post('subreddit') && $this->input->post('show')) {
			$feed = $this->reddit->getFeed($this->input->post('subreddit'), $this->input->post('show'), array('after' => $this->input->post('after'), 'limit' => 10));
			foreach($feed as $key => $post) {
				echo $this->load->view('post_template', array('post' => $post, 'user' => $this->user));
			}
		}else{
			echo 'No input';
			return;
		}
	}

	public function getComments() {
		if($this->input->post('subreddit') && $this->input->post('article')) {
			$comments = $this->reddit->getComments($this->input->post('subreddit'), $this->input->post('article'));
			foreach($comments as $key => $comment) {
				if(isset($comment->data->author)) {
					echo $this->load->view('comment_template', array('comment' => $comment));
				}
			}
		}else{
			echo 'No input';
			return;
		}
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/ajax.php */
