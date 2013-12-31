<div class="sidebar panel panel-reddit">
	<div class="panel-heading">Popular Subreddits</div>
	<div class="panel-body">
<?
		foreach($subreddits as $_subreddit) {
			echo anchor(base_url('r/'.$_subreddit->data->display_name), $_subreddit->data->display_name).'<br />';
		}
?>
	</div>
</div>