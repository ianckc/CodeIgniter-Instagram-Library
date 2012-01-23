
<h1>Popular media</h1>

<?php foreach($popular_media_data->data as $data) { ?>
	
	<p><?php echo img(array('src' => $data->images->thumbnail->url)); ?></p>
	
	<p>Taken by <?php echo anchor('/user/profile/' . $data->user->id, $data->user->username); ?></p>
	
	<?php if(isset($data->location->name)) { ?>
	
		<p>Taken at <?php echo $data->location->name; ?></p>
	
	<?php } ?>
		
	<?php if(isset($data->comments->count)) { ?>
	
		<p><?php echo $data->comments->count; ?> comments</p>
	
	<?php } ?>
		
	<?php if(isset($data->likes->count)) { ?>
	
		<p><?php echo $data->likes->count; ?> likes</p>
	
	<?php } ?>

<?php } ?>