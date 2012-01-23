
<h1>User search</h1>

<?php if(isset($user_search_data->data)) { ?>

	<?php if(count($user_search_data->data) != 0) { ?>
	
		<p>We found a match for <?php echo $this->uri->segment(3); ?></p>
		
		<p><?php echo anchor('/user/profile/' . $user_search_data->data[0]->id, img(array('src' => $user_search_data->data[0]->profile_picture))); ?></p>
		
		<p>View <?php echo anchor('/user/profile/' . $user_search_data->data[0]->id, $this->uri->segment(3) . "'s profile"); ?></p>
	
	<?php } else { ?>
	
		<p>No users found</p>
	
	<?php } ?>

<?php } ?>

<?php echo form_open('/user/search/'); ?>

	<label for="username">Username</label>

	<?php echo form_input($username_input); ?>
	
	<?php echo form_submit($submit_input); ?>

</form>