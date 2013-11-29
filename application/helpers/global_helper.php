<?php
	function setFlashMessage($type, $text) {
		$this->session->set_flashdata('message_type', $type);
		$this->session->set_flashdata('message', $text);
	}