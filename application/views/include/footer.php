	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/scrollpagination.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/upvoteable.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/scrollTo.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
	<script type="text/javascript">
		$(function(){
			frontpage.comments('<?=base_url('ajax/getComments')?>', '<?=$subreddit?>');

			var lastID = $('#feed').children('.panel').last().data('post');

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
					 $(elementsLoaded).fadeIn();
					 frontpage.comments('<?=base_url('ajax/getComments')?>', '<?=$subreddit?>');
					 frontpage.init();
				}
			});

			$("figure.upvoteable").upvoteable();
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
