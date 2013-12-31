<ul class="nav nav-tabs nav-justified" style="margin-bottom:5px">
	<li><?=$username?></li>
<?
	foreach($categories as $_category) {
		if($category == $_category) {
			$_class = 'active';
		}else{
			$_class = null;
		}
?>
	<li class="<?=$_class?>"><?=anchor(base_url('user/'.$username.'/'.$_category), ucfirst($_category))?></li>
<?
	}
?>
</ul>
<div id="listing">
<?
	foreach($feed as $key => $post) {
		if($post->kind == 'comment') {
			echo $this->load->view('templates/comment_template', array('comment' => $post));
		}else{
			echo $this->load->view('templates/post_template', array('post' => $post, 'user' => $user));
		}
	}
?>
</div>