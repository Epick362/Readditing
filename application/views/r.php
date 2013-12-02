<div id="feed">
<?
	foreach($feed as $key => $post) {
		echo $this->load->view('r_post', array('post' => $post));
	}
?>
</div>
<div id="loading" class="alert alert-info" style="display:none"><i class="icon-refresh icon-spin"></i> Loading...</div>
<a id="next-page" class="btn btn-block btn-primary" style="margin-bottom:40px" href="<?=base_url('r/'.$subreddit.'/'.$show.'/'.$post->data->id)?>">Next Page</a>