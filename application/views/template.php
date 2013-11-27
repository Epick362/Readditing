<?=$this->load->view('include/header', array('title' => $title)) ?>
<div id="wrap">
	<div class="navbar navbar-fixed-top navbar-reddit" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=base_url()?>"><div class="brand-image">r</div></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="<?=($show=='hot')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/hot')?>">Hot</a></li>
					<li class="<?=($show=='new')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/new')?>">New</a></li>
					<li class="<?=($show=='rising')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/rising')?>">Rising</a></li>
				</ul>
				<div class="col-sm-3 col-md-3">
					<?=form_open(base_url('user/go'), array('class' => 'navbar-form'))?>
					<div class="input-group">
						<span class="input-group-addon">r/</span>
						<?=form_input(array('name' => 'subreddit', 'class' => 'form-control', 'placeholder' => 'subreddit', 'type' => 'text', 'value' => $subreddit)) ?>
						<div class="input-group-btn">
							<?=form_submit(array('class' => 'btn btn-primary'), 'Go!')?>
						</div>
					</div>
					<?=form_close()?>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
<? if($user) { ?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large"></i> <?=$user->data->name?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="<?=base_url('user/logout')?>">Logout</a></li>
						</ul>
<? }else{ ?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large"></i> Sign In </a>
						<div class="dropdown-menu" style="padding:10px;">
							<?=form_open(base_url('user/login'), array('class' => 'form-signin'))?>
								<?=form_input(array('name' => 'user', 'class' => 'form-control', 'placeholder' => 'Username', 'type' => 'text')) ?>
								<?=form_input(array('name' => 'passwd', 'class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password')) ?>
								<?=form_submit(array('class' => 'btn btn-primary btn-block'), 'Log In')?>
							<?=form_close()?>
						</div>
<? } ?>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-9" role="main">
				<?=$contents ?>
			</div>
			<div class="col-md-3 visible-md visible-lg">
				<div class="container right-sidebar">
					<div class="panel panel-info">
						<div class="panel-heading">Subreddits</div>
						<div class="panel-body">
<?
							foreach($subreddits as $_subreddit) {
								echo anchor(base_url('r/'.$_subreddit->data->display_name), $_subreddit->data->display_name).'<br />';
							}
?>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div class="container">
		<p class="text-muted credit">RedditReader &copy; Filip Hajek. Elapsed Time: {elapsed_time} seconds.</p>
	</div>
</div>
<?=$this->load->view('include/footer') ?>