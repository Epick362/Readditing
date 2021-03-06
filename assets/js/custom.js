/**
 * Light Javascript "class" frameworking for you
 * to organize your code a little bit better.
 *
 * If you want more complex things, I'd suggest
 * importing something like Backbone.js as it
 * has much better abilities to handle a MVC
 * like framework including persistant stores (+1)
 *
 * @author  sjlu (Steven Lu)
 */
var Frontpage = function()
{

	String.prototype.trunc =
	     function(n,useWordBoundary){
	         var toLong = this.length>n,
	             s_ = toLong ? this.substr(0,n-1) : this;
	         s_ = useWordBoundary && toLong ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
	         return  toLong ? s_ + '&hellip; <a class="btn btn-default btn-mini btn-block showmore">Show More</a>' : s_;
	      };
	/**
	 * The exports variable is responsible for
	 * storing and returning public functions
	 * in the instantized class.
	 */
	var exports = {};

	function nl2br (str, is_xhtml) {
	    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
	    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}

	/**
	 * Write your public functions like this.
	 * Make sure you include it into the exports
	 * variable.
	 */
	function public_function() 
	{
		/**
		 * Note that we can still call
		 * private functions within the scope
		 * of the "class".
		 */
		private_function();
	}
	exports.public_function = public_function;

	/**
	 * Private functions are very similar, they
	 * just are not included in the exports 
	 * function.
	 */
	 function private_function()
	 {

	 }

	 /**
	  * You may wanna have a init() function
	  * to do all your bindings for the class.
	  */
	 function init()
	 {
	 	extractText();
	 	showMore();
	 	scrollPosts();
	 	comments();
	 	nsfw();
	 	showReplyBox();
	 	togglePost();
	 	showNotifications();
	 	readNotification();

		$("figure.upvoteable").upvoteable();
	 	upvotesHandler();
	 }
	 exports.init = init;

	 function showReplyBox() {
	 	$('.reply-btn').on('click', function() {
	 		replyBox = $(this).find('.'+$(this).data('id'));
	 		replyBox.show();
	 	});
	 }


	 function togglePost() {
	 	$('.togglePost').on('click', function() {
	 		var post = $(this).closest('.media');
	 		post.slideToggle('slow');
	 	});
	 }
	 exports.togglePost = togglePost;

	 function showNotifications() {
	 	$('.notification').each( function() {
	 		var id = $(this).attr('id');
	 		if($.cookie(id) === "undefined") {
	 			$(this).show();
	 		}
	 	});
	 }
	 exports.showNotifications = showNotifications;

	 function readNotification() {
	 	$('.closeNotification').on('click', function() {
	 		var notification = $(this).closest('.alert');
	 		notification.slideUp();
	 		$.cookie(notification.attr('id'), 1, { expires: 7 });
	 	});
	 }
	 exports.readNotification = readNotification;

	 function reply() {
	 	//$('.replyForm')
	 }

	 function nsfw() {
		$('#nsfw-checkbox').change(function() {
		    $(this).closest('form').submit();
		});
	 }

	 function comments() {
	 	$('.comments-btn').on('click', function() {
	 		var button = $(this);
	 		var modal = $(button.data('target')).find('.modal-body');
			var postID = button.data('post');
			var subreddit = button.data('subreddit');
			if(modal.hasClass('loaded')) {
				return;
			}

			modal.html('<i class="icon-refresh icon-spin"></i> Loading...');
			 $.ajax({
				  type: 'POST',
				  url: 'http://readditing.com/ajax/getComments',
				  data: {'subreddit': subreddit, 'article': postID},
				  success: function(data){
				  	modal.html('<ul class="media-list"></ul>');
					modal.find('ul').append(data);
					modal.find('ul').slideDown();
					modal.addClass('loaded');
				  },
				  error: function() {
				  	modal.html('Error');
				  },
				  dataType: 'html'
			 });	 		
		});
	 }
	 exports.comments = comments;

	 function showMore() {
	 	$('.showmore').on('click', function() {
	 		var fulltext = $(this).closest('.panel-body').find('.full-text');
	 		var extractedtext = $(this).closest('.panel-body').find('.extracted-text');

	 		extractedtext.hide();
	 		fulltext.fadeIn('fast');
	 	});
	 }
	 exports.showMore = showMore;

	 function extractText() {
	 	$('.extracted-text').each(function() {
	 		if($(this).data('url')) {
		 		var url = $(this).data('url');
		 		var panel = $(this);
				 $.ajax({
					  type: 'GET',
					  url: 'http://reader-api.herokuapp.com/api/article',
					  data: {'url': url},
					  crossDomain: true,
					  success: function(data){
						$.ajax({
						  type: 'POST',
						  url: 'http://readditing.com/ajax/saveArticle',
						  data: {'url': url, 'data': data}
						});

					  	if(data.article.body) {
					  		if(data.article.body.length >= 250) {
								var content = data.article.body;
								var content_short = content.trunc(230, true);
								content = nl2br(content);
								panel.html(content_short);
								panel.parent().append('<div class="full-text" style="display:none;">'+content+'</div>');
					  			showMore();
					  		}else if(data.article.image != null && data.article.image.width >= 300) {
					  			panel.parent().html('<center><img class="img-rounded img-responsive" src="'+data.article.image.src+'" /></center>');
					  		}else{
					  			panel.html('<div class="alert alert-warning"><p>We couldn\'t extract the content of this link for you. Sorry about that</p><p>To open the link in new window click: <a href="'+url+'" target="_blank">Here</a></p></div>');
					  		}
					  	}
					  },
					  error: function(data) {
					  	panel.html('<div class="alert alert-danger"><p>There was an error while communicating with the server... Sorry about that</p><p>To open the link in new window click: <a href="'+url+'" target="_blank">Here</a></p></div>');
					  }
				 });	
	 		} 		
	 	});
	 }
	 exports.extractText = extractText;

    function scroller(direction) {

        var scroll, i,
                positions = [],
                here = $(window).scrollTop(),
                collection = $('.panel');

        collection.each(function() {
            positions.push(parseInt($(this).offset()['top'], 10));
        });

        for(i = 0; i < positions.length; i++) {
            if (direction == 'next' && positions[i] > here) { scroll = collection.get(i); break; }
            if (direction == 'prev' && i > 0 && positions[i] >= here) { scroll = collection.get(i-1); break; }
        }

        if (scroll) {
            $.scrollTo(scroll, {
                duration: 250,
                queue: false     
            });
        }

        return false;
    }

    function scrollPosts() {
		$(window).keydown (function(event) {
	        switch (event.which) {
	            case 78:  // Alt-N = next
	            case 110: // Alt-n = next
	                scroller('next');
	                break;
	            case 80:  // Alt-P = prev
	            case 112: // Alt-p = prev
	                scroller('prev');
	                break;
	        }
		});
    }
    exports.scrollPosts = scrollPosts;

    function upvotesHandler() {
		$("figure.upvote").bind("upvote:added", function(e) {
			var post = $(this).closest('.panel').data('post');
			 $.ajax({
				  type: 'POST',
				  url: 'http://readditing.com/ajax/vote',
				  data: {'fullname': 't3_'+post, 'dir': '1'},
				  success: function(data){
				  	//alert('upvoted!');
				  },
				  error: function() {
				  	//alert('error');
				  },
				  dataType: 'html'
			 });
		});

		$("figure.upvote").bind("upvote:removed", function(e) {
			var post = $(this).closest('.panel').data('post');
			 $.ajax({
				  type: 'POST',
				  url: 'http://readditing.com/ajax/vote',
				  data: {'fullname': 't3_'+post, 'dir': '0'},
				  success: function(data){
				  	//alert('upvote removed!');
				  },
				  error: function() {
				  	//alert('error');
				  },
				  dataType: 'html'
			 });
		});
    }

	 /**
	  * Last but not least, we have to return
	  * the exports object.
	  */
	 return exports;
}

/**
 * To initialize our Frontpage class, we need
 * to define it into a Javascript variable like
 * so.
 */
var frontpage = new Frontpage();

/**
 * We can then call the functions as like any
 * other object, just the ones included in the 
 * exports object that was returned from Frontpage()
 */
frontpage.public_function();

/**
 * Write all your event listeners in the 
 * document.ready function or else they
 * may not bind correctly. As a side note, I like
 * to just call a public function in a class
 * to handle all your bindings here.
 */
$(document).ready(function() {
	frontpage.init();
});