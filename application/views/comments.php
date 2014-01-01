<div id="post">
	<? echo $this->load->view('templates/post_template', array('post' => $post[0]->data->children[0], 'user' => $user)); ?>
</div>