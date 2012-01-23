
<h1><?php echo ucfirst($user_data->data->username); ?>'s Instagram profile</h1>

<?php echo img(array('src' => $user_data->data->profile_picture)); ?>

<h2><?php echo ucfirst($user_data->data->username); ?> has</h2>

<ul>
	<li><?php echo anchor('/user/recent/' . $user_data->data->id, 'Recent items'); ?></li>
	<li><?php echo anchor('user/followed-by/' . $user_data->data->id, $user_data->data->counts->followed_by . 'Followers'); ?></li>
	<li><?php echo anchor('/user/follows/' . $user_data->data->id, $user_data->data->counts->follows . 'Follows'); ?></li>
</ul>
