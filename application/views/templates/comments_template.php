<li class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="64x64" style="width: 64px; height: 64px;" style=" display: none;">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
			<?=anchor(base_url('user/'.$comment->data->author), $comment->data->author)?> 
			<small>
				<span class="text-warning">
					<i class="icon-arrow-up"></i> <?=$comment->data->ups?>
				</span>

				<span class="text-info">
					<i class="icon-arrow-down"></i> <?=$comment->data->downs?>
				</span>
			</small>
		</h4>
		<p><?=htmlspecialchars_decode($comment->data->body_html)?></p>
		<?
			if($comment->data->replies) {
				foreach($comment->data->replies->data->children as $reply) {
					if($reply->kind == 't1') {
					/*
					if($reply->kind == 't1') {
						echo $this->load->view('comment_template', array('comment' => $reply));
					}
					*/
		?>
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object" alt="64x64" style="width: 64px; height: 64px; display: none;">
				</a>
				<div class="media-body">
					<h4 class="media-heading">
						<?=anchor(base_url('user/'.$reply->data->author), $reply->data->author)?>
						<small>
							<span class="text-warning">
								<i class="icon-arrow-up"></i> <?=$reply->data->ups?>
							</span>

							<span class="text-info">
								<i class="icon-arrow-down"></i> <?=$reply->data->downs?>
							</span>
						</small>
					</h4>
					<p><?=htmlspecialchars_decode($reply->data->body_html)?></p>
				<?
					if($reply->data->replies) {
						foreach($reply->data->replies->data->children as $reply2) {
							if($reply2->kind == 't1') {
							/*
							if($reply->kind == 't1') {
								echo $this->load->view('comment_template', array('comment' => $reply));
							}
							*/
				?>
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" alt="64x64" style="width: 64px; height: 64px; display: none;">
						</a>
						<div class="media-body">
							<h4 class="media-heading">
								<?=anchor(base_url('user/'.$reply2->data->author), $reply2->data->author)?> 
								<small>
									<span class="text-warning">
										<i class="icon-arrow-up"></i> <?=$reply2->data->ups?>
									</span>

									<span class="text-info">
										<i class="icon-arrow-down"></i> <?=$reply2->data->downs?>
									</span>
								</small>
							</h4>
							<p><?=htmlspecialchars_decode($reply2->data->body_html)?></p>
						</div>
					</div>
				<?
							}
						}
					}
				?>
				</div>
			</div>
		<?
					}
				}
			}
		?>
	</div>
</li>