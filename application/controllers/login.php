<?php if (!defined('BASEPATH')) die();
class Login extends Main_Controller {
	public function index() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->session->set_userdata('user', $this->input->post('user'));
			$this->session->set_userdata('passwd', $this->input->post('passwd'));
		}

		redirect($_SERVER['HTTP_REFERRER']);
	}
}