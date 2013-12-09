<div class="panel panel-reddit" data-post="<?=$post->data->id?>">
	<div class="panel-heading">
		<?=$post->data->title?>
	</div>
	<div class="panel-body">
		<?=$post->_display?>
	</div>
	<div class="panel-comments comments-container" style="display:none">
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-lg-6"><?=anchor(base_url('r/'.$post->data->subreddit), $post->data->subreddit)?> <span class="text-muted">by</span> <?=anchor('#', $post->data->author)?></div>
			<div class="col-lg-6"><div class="pull-right"><a data-post="<?=$post->data->id?>" class="btn btn-xs btn-primary comments-btn"><i class="icon-comments"></i> <?=$post->data->num_comments?></a></div></div>
		</div>
	</div>
</div>