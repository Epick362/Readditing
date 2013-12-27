<? if($user) { ?>
	<div class="panel panel-primary">
		<div class="panel-heading">Settings</div>
		<div class="panel-body">
			<?=form_open(base_url('user/nsfw'), array('class' => 'form-inline'), array('back' => uri_string(current_url())))?>
				<?=form_label('Show NSFW', 'nsfw')?> 
				<input type="checkbox" class="switch-small" name="nsfw" id="nsfw-checkbox" data-on="success" data-off="danger" <? if($this->session->userdata('nsfw')) { echo 'checked'; }?>>
			<?=form_close()?>
		</div>
	</div>
<? } ?>