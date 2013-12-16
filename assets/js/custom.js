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
	         return  toLong ? s_ + '&hellip; <a style="margin-top:10px" class="btn btn-default btn-mini btn-block btn-showmore">Show More</a>' : s_;
	      };
	/**
	 * The exports variable is responsible for
	 * storing and returning public functions
	 * in the instantized class.
	 */
	var exports = {};

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

	 }
	 exports.init = init;

	 function comments(baseUrl) {
	 	console.log('comment function start');
	 	$('.comments-btn').on('click', function() {
	 		console.log('click');
	 		var panel = $(this).closest('.panel');
			var postID = panel.data('post');
			var subreddit = panel.data('subreddit');
			console.log(postID);
			 $.ajax({
				  type: 'POST',
				  url: baseUrl,
				  data: {'subreddit': subreddit, 'article': postID},
				  success: function(data){
				  	console.log('request success');
					panel.find('.media-list').append(data);
					panel.find('.comments-container').slideDown();
				  },
				  dataType: 'html'
			 });
		});
		console.log('comment function end');
	 }
	 exports.comments = comments;

	 function extractText() {
	 	$('.extracted-text').each(function() {
	 		var url = $(this).data('url');
	 		var panel = $(this);
			 $.ajax({
				  type: 'GET',
				  url: 'http://reader-api.herokuapp.com/api/article',
				  data: {'url': url},
				  crossDomain: true,
				  success: function(data){
				  	console.log('extraction success');
				  	if(data.article.body) {
				  		var content = data.article.body;
				  		var content_short = content.trunc(250, true);
				  		content = content.replace(/\r\n/g, "<br />");
				  		panel.html(content_short);
				  		panel.parent().append('<div class="full-text" style="display:none;">'+content+'</div>');
				  	}else if(data.article.image != null){
				  		panel.html('<img class="img-rounded img-post" src="'+data.article.image.src+'" />');
				  	}else{
				  		panel.html('<div class="alert alert-danger"><p>There was an error... Sorry about that</p><p>Go to: <a href="'+url+'" target="_blank">Link</a></p></div>');
				  	}
				  },
				  error: function(data) {
				  	console.log('extraction error');
				  	panel.html('<div class="alert alert-danger"><p>There was an error... Sorry about that</p><p>Go to: <a href="'+url+'" target="_blank">Link</a></p></div>');
				  }
			 });	 		
	 	});
	 }
	 exports.extractText = extractText;

	 function showMore() {
	 	$('.btn-showmore').on('click', function() {
	 		console.log('showmore-click');
	 		var fulltext = $(this).closest('.panel-body').find('.full-text');
	 		var extractedtext = $(this).closest('.panel-body').find('.extracted-text');

	 		extractedtext.slideUp();
	 		fulltext.slideDown();
	 	});
	 }
	 exports.showMore = showMore;

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