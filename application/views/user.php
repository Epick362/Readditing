<h1><?=ucfirst($category)?> by <?=$username?></h1>
<hr />
<div id="feed">
<?
	foreach($feed as $key => $post) {
		if($post->kind == 'comment') {
			echo '<div class="panel panel-reddit">';
			echo '<div class="panel-body">';
			echo $this->load->view('comment_template', array('comment' => $post));
			echo '</div>';
			echo '<div class="panel-footer">';
			echo 'Posted in '.$post->data->link_title.' by '.$post->data->link_author;
			echo '</div>';
			echo '</div>';
		}else{
			echo $this->load->view('post_template', array('post' => $post, 'user' => $user));
		}
	}
?>
</div>