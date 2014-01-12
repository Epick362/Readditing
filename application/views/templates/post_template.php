<?
	$rand_id = substr(md5(mt_rand(1,200)), 0, 12);
?>
<div class="panel panel-reddit <? if($post->data->over_18) {echo 'nsfw';} ?>" data-post="<?=$post->data->id?>" data-subreddit="<?=$post->data->subreddit?>">
	<div class="upvote-wrapper">
		<figure class="upvote <? if($user) {echo 'upvoteable';} ?> <? if($post->data->likes) {echo 'complete';} ?>">
			<a class="upvoteobject">
				<div class="opening">
					<div class="circle"><div class="inner-circle"><i class="icon-arrow-up icon-2x"></i></div></div>
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
<!--
	<div class="panel-comments comments-container" style="display:none">
		<ul class="media-list"></ul>
	</div>
-->
	<div class="panel-footer">
		<div class="row">
			<div class="col-lg-6"><?=anchor(base_url('r/'.$post->data->subreddit), $post->data->subreddit)?> <span class="text-muted">by</span> <?=anchor(base_url('u/'.$post->data->author), $post->data->author)?></div>
			<div class="col-lg-6">
				<div class="pull-right">
					<button class="btn btn-primary btn-xs comments-btn" data-post="<?=$post->data->id?>" data-toggle="modal" data-target="#<?=$rand_id?>">
						<i class="icon-comments"></i> <?=$post->data->num_comments?> comments</a>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?=$rand_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=$rand_id?></h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->