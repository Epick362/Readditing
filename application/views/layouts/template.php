<!DOCTYPE html>
<html lang="en">
	<head>
	   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	   <?=chrome_frame() ?>
	   <?=view_port() ?>
	   <?=apple_mobile() ?>
	   <meta name="description" content="Readditing is a social reddit website">
	   <meta name="keywords" content="reddit social friends news information readdit readditing">
	   <meta name="author" content="Filip Hajek">

	   <title>Readditing | <?=$title?></title>
	   <?=add_css(array('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', 'bootstrap-switch', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', 'custom', 'upvoteable', 'http://fonts.googleapis.com/css?family=Montserrat|Roboto'))?>
	   <?=favicons() ?>
	</head>
	<body>
	   <?=$this->load->view('pages/about') ?>
	   <?=$this->load->view('pages/tos') ?>
	   <?=$this->load->view('pages/contact') ?>
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
		<? if($subreddit) { ?>
						<ul class="nav navbar-nav">
							<li class="<?=($show=='hot')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/hot')?>">Hot</a></li>
							<li class="<?=($show=='new')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/new')?>">New</a></li>
							<li class="<?=($show=='rising')? 'active' : ''; ?>"><a href="<?=base_url('r/'.$subreddit.'/rising')?>">Rising</a></li>
						</ul>
		<? } ?>
						<div class="col-sm-4 col-md-4">
							<?=form_open(base_url('user/go'), array('class' => 'navbar-form'))?>
							<div class="input-group">
								<span class="input-group-addon">r/</span>
								<?=form_input(array('name' => 'subreddit', 'class' => 'form-control col-sm-3 col-md-4', 'placeholder' => 'subreddit', 'type' => 'text', 'value' => $subreddit)) ?>
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
									<li><a href="<?=base_url('user/'.$user->data->name.'/overview')?>">Overview</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/comments')?>">Comments</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/submitted')?>">Submitted</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/gilded')?>">Gilded</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/liked')?>">Liked</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/disliked')?>">Disliked</a></li>
									<li><a href="<?=base_url('user/'.$user->data->name.'/saved')?>">Saved</a></li>
									<li class="divider"></li>
									<li><a href="#">Inbox</a></li>
									<li><a href="#">Preferences</a></li>
									<li><a href="<?=base_url('user/logout')?>">Logout</a></li>
								</ul>
		<? }else{ ?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large"></i> Sign In to reddit.com</a>
								<div class="dropdown-menu" style="width:200px;padding:10px;">
									<?=form_open(base_url('user/login'), array('class' => 'form-signin'), array('back' => uri_string(current_url())))?>
										<?=form_input(array('name' => 'user', 'class' => 'form-control', 'placeholder' => 'Username', 'type' => 'text')) ?>
										<?=form_input(array('name' => 'passwd', 'class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password')) ?>
										<div class="alert alert-info"><i>Please note that we <b>DO NOT</b> store your password</i></div>
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
					<div class="col-md-offset-1 col-md-8" role="main">
		<?
				if($this->session->flashdata('message') && $this->session->flashdata('message_type')) {
		?>
						<div class="alert alert-<?=$this->session->flashdata('message_type')?>">
							<?=$this->session->flashdata('message') ?>
						</div>
		<?
				}
		?>
						<div class="notifications">
							<div class="alert alert-info notification" id="nowOpenSource" style="display:none">
								<button type="button" class="close closeNotification" aria-hidden="true">&times;</button>
								<b>Heads Up!</b> Readditing is now open-source and you can find it on <?=anchor('http://epick362.github.com/readditing', 'GitHub.com') ?>
							</div>
							<div class="alert alert-warning notifications" id="noResponseApology" style="display:none">
								<button type="button" class="close closeNotification" aria-hidden="true">&times;</button>
								reddit.com sometimes doesn't reply with any data. We do not know what is causing this and we are looking into it. We apologize for any inconvenience.
							</div>
						</div>
						<? if($subreddit) { echo $this->load->view('templates/settings_template', array('user' => $user)); } ?>
						<?=$content ?>
					</div>
					<div class="col-md-3 visible-md visible-lg">
						<div class="container right-sidebar">
							<? if(isset($subreddits)) { echo $this->load->view('templates/subreddits_template', array('subreddits' => $subreddits)); } ?>
							<center><?=$this->load->view('slices/ad-square')?></center>
							<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#about">About</button>
							 · 
							<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#tos">ToS</button>
							 · 
							<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#contact">Contact</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div class="container">
				<p class="credit">REDDIT and the ALIEN Logo are registered trademarks of reddit inc., Elapsed Time: {elapsed_time} seconds.</p>
			</div>
		</div>
		<?=jquery() ?>
		<?=add_js(array('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', 'bootstrap-switch.min', 'scrollpagination', 'upvoteable', 'scrollTo.min', 'jquery.cookie', 'custom')) ?>
		<script type="text/javascript">
			$(function(){
				var lastID = $('#feed').children('.panel').last().data('post');

		 		$('#nsfw-checkbox').bootstrapSwitch();

				$('#feed').scrollPagination({
					'contentPage': '<?=base_url('ajax/displayFeed')?>', // the url you are fetching the results
					'contentData': {'subreddit': '<?=$subreddit?>',
									'show': '<?=$show?>'}, // these are the variables you can pass to the request, for example: children().size() to know which page you are
					'scrollTarget': $(window), // who gonna scroll? in this example, the full window
					'heightOffset': 10, // it gonna request when scroll is 10 pixels before the page ends
					'beforeLoad': function(){ // before load function, you can display a preloader div
						$('#loading').fadeIn();
					},
					'afterLoad': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
						 $('#loading').fadeOut();
						 $(elementsLoaded).find('.panel').fadeIn();
						 frontpage.init();
					}
				});
			});
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-46225304-1', 'readditing.com');
		  ga('send', 'pageview');

		</script>
	</body>
</html>
