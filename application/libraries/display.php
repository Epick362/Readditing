<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Display
{
	public function media($post) {
		if($post->kind == 'media' && $post->data->media) {
			return '<center>'.htmlspecialchars_decode($post->data->media_embed->content).'</center>';
		}

		return false;
	}

	public function image($post) {
		if($post->kind == 'image') {
			return '<center><img class="img-rounded img-post" src="'.$post->data->url.'" /></center>';
			//return 'image';
		}

		return false;
	}

	public function selftext($post) {
		if($post->kind == 'selftext') {
			return htmlspecialchars_decode($post->data->selftext_html);
		}

		return false;
	}

	public function ajax_extractedtext($post) {
		return $this->view->load('extractedtext_template', array('post' => $post));
	}

	public function extractedtext($post) {
		if($post->kind == 'extractedtext') {
			return nl2br($post->data->_extracted->body);
		}

		return false;
	}

	public function misc($post) { 
		return '<div class="alert alert-warning"><span>We\'re sorry but we couldn\'t display this content.</span> <span>You can follow it on your own: <a href="'.$post->data->url.'" target="_blank">'.$post->data->title.'</a></span></div>'; 
	}

	public function nsfw($post) {
		return '<div class="alert alert-danger">This content is NSFW.</div>';
	}
}