<?php if (!defined('BASEPATH')) die();
class User extends Main_Controller {
	public function index($username = null) {
		if(!$username && $this->user->data->name) {
			$username = $this->user->data->name;
		}else{
			redirect(base_url());
		}

		$data->username = $username;

		$this->template->set('title', $username);
		$this->template->frontpage('user', $data);
	}

	public function login() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$login = $this->reddit->login($this->input->post('user'), $this->input->post('passwd'));
			if($login) {
				setFlashMessage('success', 'Welcome back '.$this->input->post('user').'!');
			}else{
				setFlashMessage('error', 'Incorrect user or password.');
			}
		}

		redirect(base_url());
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
			setFlashMessage('error', 'Incorrect data.');
			redirect(base_url());
		}
	}
}