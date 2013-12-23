<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Display
{
    function __construct()
    {
        $this->_ci =& get_instance();
    }

	public function media($post) {
		if($post->kind == 'media' && $post->data->media) {
			return '<div class="media-wrapper">'.htmlspecialchars_decode($post->data->media_embed->content).'</div>';
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
		return '<div class="extracted-text" data-post="'.$post->data->id.'" data-url="'.$post->data->url.'"><div class="alert alert-info"><i class="icon-refresh icon-spin"></i> Loading...</div></div>';
	}

	public function extractedtext($post) {
		$pos = strpos($post->data->article['article']['body'], ' ', 250);
		$short = substr($post->data->article['article']['body'],0,$pos ); 
		return $short.'&hellip; <a class="btn btn-default btn-mini btn-block showmore">Show More</a> <div class="full-text" style="display:none">'.$post->data->article['article']['body'].'</div>';
	}

	public function misc($post) { 
		return '<div class="alert alert-warning"><span>We\'re sorry but we couldn\'t display this content.</span> <span>You can follow it on your own: <a href="'.$post->data->url.'" target="_blank">'.$post->data->title.'</a></span></div>'; 
	}

	public function nsfw($post) {
		return '<div class="alert alert-danger">This content is NSFW.</div>';
	}
}