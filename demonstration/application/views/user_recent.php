
<h1><?php echo ucfirst($user_data->data->username); ?>'s Instagram feed</h1>

<?php if(is_array($user_recent_data->data)) { ?>

	<?php foreach($user_recent_data->data as $feed_data) { ?>
	
		<!-- <pre><?php print_r($feed_data); ?></pre><hr /> -->
	
		<p><?php echo img(array('src' => $feed_data->images->thumbnail->url)); ?></p>
	
		<?php if(isset($feed_data->location->name)) { ?>
	
			<p>Taken at <?php echo $feed_data->location->name; ?></p>
	
		<?php } ?>
		
		<?php if(isset($feed_data->comments->count)) { ?>
	
			<p><?php echo $feed_data->comments->count; ?> comments</p>
	
		<?php } ?>
		
		<?php if(isset($feed_data->likes->count)) { ?>
	
			<p><?php echo $feed_data->likes->count; ?> likes</p>
	
		<?php } ?>
		
		<?php if(count($feed_data->tags) > 0) { ?>
		
			<p>Tags</p>
			
			<ul>
			
			<?php foreach($feed_data->tags as $tag) { ?>
				<li><?php echo anchor('/tags/recent/' . $tag, $tag); ?></li>
			<?php } ?>
			
			</ul>
		
		<?php } ?>
	
	<?php } ?>

<?php } else { ?>

<p>There is nothing in the feed</p>

<?php } ?>