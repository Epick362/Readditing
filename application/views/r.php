<?
	foreach($feed as $key => $post) {
?>
			<div class="panel panel-reddit">
				<div class="panel-heading">
					<?=$post->data->title?>
				</div>
				<div class="panel-body">
					<?=$post->_display?>
				</div>
				<div class="panel-footer">
					<span><?=$post->data->subreddit?>: <?=$post->data->author?></span>
					<span class="pull-right"><?=$post->data->num_comments?> comments</span>
				</div>
			</div>		
<?
	}
?>