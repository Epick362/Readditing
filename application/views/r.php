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
					<div class="row">
						<div class="col-lg-6"><?=$post->data->subreddit?> <span class="text-muted">by</span> <b><?=$post->data->author?></b></div>
						<div class="col-lg-6"><div class="pull-right"><a id="comments-btn" data-post="<?=$post->data->id?>" class="btn btn-xs btn-primary"><i class="icon-comments"></i> <?=$post->data->num_comments?></a></div></div>
					</div>
				</div>
			</div>
<?
	}
?>
<a class="btn btn-block btn-primary" style="margin-bottom:40px" href="<?=base_url('r/'.$subreddit.'/'.$show.'/'.$post->data->id)?>">Next Page</a>