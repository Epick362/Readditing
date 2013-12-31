<h1><?=$username?></h1>
<ul class="nav nav-tabs nav-justified">
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
			echo $this->load->view('comment_template', array('comment' => $post));
		}else{
			echo $this->load->view('post_template', array('post' => $post, 'user' => $user));
		}
	}
?>
</div>