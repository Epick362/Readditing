<div class="panel panel-reddit">
	<div class="panel-body">
		<ul class="media-list">
			<li class="media">
				<a class="pull-left" href="#">
					<img class="media-object" alt="64x64" style="width: 64px; height: 64px;" style="display:none">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?=anchor(base_url('user/'.$comment->data->author), $comment->data->author)?></h4>
					<p><?=htmlspecialchars_decode($comment->data->body_html)?></p>
			</li>				
		</ul>	
	</div>
	<div class="panel-footer">
		Posted in <?=anchor(base_url('r/'.$comment->data->subreddit.'/comments/'.substr($comment->data->link_id, strpos($comment->data->link_id, "_") + 1)), $comment->data->link_title)?> by <?=anchor(base_url('user/'.$comment->data->link_author), $comment->data->link_author)?>
	</div>
</div>