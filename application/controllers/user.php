<?php if (!defined('BASEPATH')) die();
class User extends CI_Controller {
	public function index() {
		redirect(base_url());
	}

	public function login() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$login = $this->reddit->login($this->input->post('user'), $this->input->post('passwd'));
		}

		redirect(base_url());
	}

	public function logout() {
		$this->session->unset_userdata('reddit_session');
		redirect(base_url());
	}
}