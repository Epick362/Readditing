<?
	if($post->kind == 't1') {
		echo $this->load->view('templates/comment_template', array('comment' => $post));
	}elseif($post->kind == 't3'){
		echo $this->load->view('templates/post_template', array('post' => $post, 'user' => $user));
	}else{
		echo '...';
	}
?>
<pre><?print_r($post)?></pre>