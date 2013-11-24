<?
	foreach($feed as $key => $post) {
?>
			<div class="panel panel-reddit" id="<?=$post->data->id?>">
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
<a class="btn btn-block btn-primary" style="margin-bottom:40px" href="<?=base_url('r/'.$subreddit.'/'.$show.'/'.$post->data->id)?>">Next Page</a>