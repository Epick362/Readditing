<?php if (!defined('BASEPATH')) die();
class Ajax extends Main_Controller {
	public function displayFeed() {
		if($this->input->post('subreddit') && $this->input->post('show')) {
			$feed = $this->reddit->getFeed($this->input->post('subreddit'), $this->input->post('show'), array('after' => $this->input->post('after'), 'limit' => 10));
			foreach($feed as $key => $post) {
				echo $this->load->view('r_post', array('post' => $post));
			}
		}else{
			return;
		}
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/ajax.php */
