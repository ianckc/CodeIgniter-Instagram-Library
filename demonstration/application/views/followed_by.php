
<h1><?php echo ucfirst($user_data->data->username); ?>'s followers</h1>

<?php if(is_array($followed_by->data)) { ?>

<?php foreach($followed_by->data as $follower) { ?>

<p><?php echo anchor('/user/profile/' . $follower->id, $follower->username); ?></p>

<p><?php echo img(array('src' => $follower->profile_picture)); ?></p>

<?php } ?>

<?php } ?>