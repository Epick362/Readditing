<h1><?=ucfirst($category)?> by <?=$username?></h1>
<hr />
<div id="feed">
<?
	foreach($feed as $key => $post) {
		echo $this->load->view('post_template', array('post' => $post, 'user' => $user));
	}
?>
</div>