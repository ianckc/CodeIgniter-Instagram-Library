
<h1><?php echo ucfirst($user_data->data->username); ?> follows</h1>

<?php if(is_array($follows->data)) { ?>

<?php foreach($follows->data as $follower) { ?>

<p><?php echo anchor('/user/profile/' . $follower->id, $follower->username); ?></p>

<p><?php echo img(array('src' => $follower->profile_picture)); ?></p>

<?php } ?>

<?php } ?>