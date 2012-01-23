
<h1>Recent tags</h1>

<?php if(is_array($tags_recent_data->data)) { ?>

	<p>Media for the tag <?php echo $this->uri->segment(3); ?></p>
	
	<?php foreach($tags_recent_data->data as $tag_data) { ?>
	
		<pre><?php print_r($tag_data); ?></pre><hr />
		
		<p><?php echo img(array('src' => $tag_data->images->thumbnail->url)); ?></p>
		
		<p>Taken by <?php echo anchor('/user/profile/' . $tag_data->user->id, $tag_data->user->username); ?></p>
	
	<?php } ?>
	
<?php } else { ?>

	<p>There is no media for the tag <?php echo $this->uri->segment(3); ?></p>

<?php } ?>