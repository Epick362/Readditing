<div id="post">
<?
	foreach($post as $key => $_post) {
		echo $this->load->view('templates/post_template', array('post' => $_post, 'user' => $user));
	}
?>
</div>