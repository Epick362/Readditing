<?php
	function setFlashMessage($type, $text) {
		$CI =& get_instance();
		$CI->session->set_flashdata('message_type', $type);
		$CI->session->set_flashdata('message', $text);
	}

	function recursiveComments($post) {
		$CI =& get_instance();
		return $CI->load->view('templates/comments_template', array('post' => $post), TRUE);
	}