
<h1><?php echo ucfirst($user_data->data->username); ?>'s Instagram feed</h1>

<?php if(is_object($user_feed)) { ?>

	<?php foreach($user_feed->data as $feed_item) { ?>
	
		<?php if($feed_item->type == 'image') { ?>
		
			<p><?php echo anchor($feed_item->images->standard_resolution->url, img(array('src' => $feed_item->images->thumbnail->url))); ?></p>
			
			<p>Posted by <?php echo anchor('#', $feed_item->user->username); ?> using the <?php echo $feed_item->filter; ?> filter</p>
			
			<?php if(isset($feed_item->location->name) && $feed_item->location->name != '') { ?>
			
			<p>Taken at <?php echo anchor('#', $feed_item->location->name); ?></p>
			
			<?php } ?>

			<!-- <pre>
				<?php print_r($feed_item); ?>
				<?php //print_r($feed_item->images); ?>
			</pre>
			<hr /> -->
			
		<?php } ?>

	<?php } ?>

<?php } ?>