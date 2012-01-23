
<h1>Search for media</h1>

<?php if(isset($media_search_data)) { ?>

	<pre><?php print_r($media_search_data); ?></pre>

<?php } ?>

<?php echo form_open('/media/search/'); ?>

	<div id="map"></div>

	<label for="latitude">Latitude</label>

	<?php echo form_input($latitude_input); ?>
	
	<label for="longitude">Longitude</label>

	<?php echo form_input($longitude_input); ?>
	
	<label for="max_timestamp">Max timestamp</label>

	<?php echo form_input($max_timestamp_input); ?>
	
	<label for="min_timestamp">Min timestamp</label>

	<?php echo form_input($min_timestamp_input); ?>
	
	<label for="distance">Distance</label>

	<?php echo form_dropdown($distance_select['name'], $distance_select['options'], FALSE, 'id="' . $distance_select['id'] . '"'); ?>

	<p><?php echo form_submit($submit_input); ?></p>

</form>