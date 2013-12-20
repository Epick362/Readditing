<h1><?=ucfirst($category)?> by <?=$username?></h1>
<hr />
<div id="listing">
<?
	foreach($feed as $key => $post) {
		if($post->kind == 'comment') {
			echo $this->load->view('comment_template', array('comment' => $post));
		}else{
			echo $this->load->view('post_template', array('post' => $post, 'user' => $user));
		}
	}
?>
</div>