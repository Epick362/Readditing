<h1><?=$username?></h1>
<hr />
<div id="feed">
<?
	foreach($feed as $key => $post) {
		echo $this->load->view('post_template', array('post' => $post, 'user' => $user));
	}
?>
</div>
<div id="loading" class="alert alert-info" style="display:none"><i class="icon-refresh icon-spin"></i> Loading...</div>