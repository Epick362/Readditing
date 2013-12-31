<?php if (!defined('BASEPATH')) die();
class User extends Main_Controller {
	public function index($username = null, $category = 'overview') {
		if(!$username && $this->user->data->name) {
			$username = $this->user->data->name;
		}elseif(!$username){
			redirect(base_url());
		}

		$this->template->set('title', $username.'\'s user profile');
		
		$data = new stdClass();
		$data->username = $username;
		$data->subreddit = '';
		$data->show = '';
		$data->user = $this->user;
		$data->category = $category;

		if($this->user && $username == $this->user->data->name) {
			$categories = array('overview', 'comments', 'submitted', 'gilded', 'liked', 'disliked', 'saved');
		}else{
			$categories = array('overview', 'comments', 'submitted', 'gilded');
		}
		$data->categories = $categories;

		if(in_array($category, $categories)) {
			$data->listing = $this->reddit->getUserListings($username, $category);
			$data->feed = $this->reddit->displayFeed($data->listing);
			$this->template->frontpage('user', $data);
		}else{
			redirect(base_url('user/'));
		}
	}

	public function login() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('back', 'Back', 'xss_clean');
		if ($this->form_validation->run())
		{
			$login = $this->reddit->login($this->input->post('user'), $this->input->post('passwd'));
			if($login) {
				setFlashMessage('success', 'Welcome back '.$this->input->post('user').'!');
			}else{
				setFlashMessage('warning', 'Incorrect user or password.');
			}
		}

		redirect(base_url($this->input->post('back')));
	}

	public function logout() {
		$this->session->unset_userdata('reddit_session');
		setFlashMessage('info', 'You have been sucessfully logged out.');
		redirect(base_url());
	}

	public function go() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subreddit', 'Subreddit', 'trim|xss_clean');
		if ($this->form_validation->run()) {
			redirect(base_url('r/'.$this->input->post('subreddit')));
		}else{
			setFlashMessage('warning', 'Incorrect data.');
			redirect(base_url());
		}
	}

	public function nsfw() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('back', 'Back', 'xss_clean');
		$this->form_validation->set_rules('nsfw', 'NSFW', 'trim|xss_clean');
		if ($this->form_validation->run() && !$this->session->userdata('nsfw')) {
			$this->session->set_userdata('nsfw', 1);
		}else{
			$this->session->unset_userdata('nsfw');
		}

		redirect(base_url($this->input->post('back')));
	}
}