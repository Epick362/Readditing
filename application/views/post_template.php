<div class="panel panel-reddit" data-post="<?=$post->data->id?>" data-subreddit="<?=$post->data->subreddit?>">
	<div class="panel-heading">
		<?=$post->data->title?> <?=anchor($post->data->url, '('.$post->data->domain.')') ?>
	</div>
	<div class="panel-body">
		<?=$post->_display?>
	</div>
	<div class="panel-comments comments-container" style="display:none">
		<ul class="media-list"></ul>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-lg-6"><?=anchor(base_url('r/'.$post->data->subreddit), $post->data->subreddit)?> <span class="text-muted">by</span> <?=anchor(base_url('u/'.$post->data->author), $post->data->author)?></div>
			<div class="col-lg-6"><div class="pull-right"><a data-post="<?=$post->data->id?>" class="btn btn-primary comments-btn"><i class="icon-comments"></i> <?=$post->data->num_comments?></a></div></div>
		</div>
	</div>
</div>