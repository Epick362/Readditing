<? if($user) { ?>
	<div class="panel panel-default">
		<div class="panel-heading"><i class="icon-cogs"></i> Settings</div>
		<div class="panel-body">
			<?=form_open(base_url('user/nsfw'), array('class' => 'form-inline'), array('back' => uri_string(current_url())))?>
				<?=form_label('Show NSFW', 'nsfw')?> 
				<input type="checkbox" class="switch-small" name="nsfw" id="nsfw-checkbox" data-on="success" data-off="danger" <? if($this->session->userdata('nsfw')) { echo 'checked'; }?>>
			<?=form_close()?>
		</div>
	</div>
<? } ?>