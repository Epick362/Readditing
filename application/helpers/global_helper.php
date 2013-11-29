<?php
	function setFlashMessage($type, $text) {
		$CI =& get_instance();
		$CI->session->set_flashdata('message_type', $type);
		$CI->session->set_flashdata('message', $text);
	}