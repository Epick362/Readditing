<div class="<? if($post->data->over_18) {echo 'nsfw';} ?> panel panel-reddit" data-post="<?=$post->data->id?>" data-subreddit="<?=$post->data->subreddit?>">
	<div class="upvote-wrapper">
		<figure class="upvote <? if($user) {echo 'upvoteable';} ?> <? if($post->data->likes) {echo 'complete';} ?>">
			<a class="upvoteobject">
				<div class="opening">
					<div class="circle">&nbsp;</div>
				</div>
			</a>

			<a href="#upvote" class="count">
				<span class="num"><?=$post->data->ups?></span>
				<span class="txt">Upvotes</span>
			</a>
		</figure>			
	</div>
	<div class="panel-heading">
		<?=$post->data->title?> <?=anchor($post->data->url, '('.$post->data->domain.')', array('target' => '_blank')) ?>
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
			<div class="col-lg-6"><div class="pull-right"><a data-post="<?=$post->data->id?>" class="btn btn-primary btn-xs comments-btn"><i class="icon-comments"></i> <?=$post->data->num_comments?> comments</a></div></div>
		</div>
	</div>
</div>