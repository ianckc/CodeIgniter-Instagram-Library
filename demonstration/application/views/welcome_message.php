
<h1>CodeIgniter Instagram API Library</h1>

<p>This CodeIgniter library provides all the functionality to interact with the Instagram API. <?php echo anchor('https://github.com/ianckc/CodeIgniter-Instagram-Library', 'Download from Github'); ?>.</p>

<?php if($this->session->userdata('instagram-token')) { ?>

<nav>

	<h2>Users</h2>

	<ul>
		<li><?php echo anchor('/user/profile/', 'Your profile'); ?></li>
		<li><?php echo anchor('/user/feed/', 'Your feed'); ?></li>
		<li><?php echo anchor('/user/recent/', 'Your recent media'); ?></li>
		<li><?php echo anchor('/user/search/', 'Search users'); ?></li>
		<li><?php echo anchor('/user/follows/', 'Who you follow'); ?></li>
		<li><?php echo anchor('/user/followed-by/', 'Who follows you'); ?></li>
		<li><?php echo anchor('/user/requested-by/', 'Requested by'); ?></li>
		<li><?php echo anchor('/user/relationship/', 'Relationship'); ?></li>
	</ul>
	
	<h2>Media</h2>
	
	<ul>
		<li><?php echo anchor('/media/item/', 'See a media item'); ?></li>
		<li><?php echo anchor('/media/search/', 'Search for media'); ?></li>
		<li><?php echo anchor('/media/popular/', 'Popular media'); ?></li>
		<li><?php echo anchor('/media/comments/', 'Comments about a media item'); ?></li>
		<li><?php echo anchor('/media/likes/', 'Likes for a media item'); ?></li>
	</ul>
	
	<h2>Tags</h2>
	
	<ul>
		<li><?php echo anchor('/tags/details/', 'Tag details'); ?></li>
		<li><?php echo anchor('/tags/recent/', 'Recent tags'); ?></li>
		<li><?php echo anchor('/tags/search/', 'Search tags'); ?></li>
	</ul>
	
	<h2>Locations</h2>
	
	<ul>
		<li><?php echo anchor('/locations/details/', 'Location data'); ?></li>
		<li><?php echo anchor('/locations/recent/', 'Recent locations'); ?></li>
		<li><?php echo anchor('/locations/search/', 'Search locations'); ?></li>
	</ul>

</nav>

<?php } else { ?>

<p>To see all of the functions please <?php echo anchor($this->instagram_api->instagramLogin(), 'login through Instagram'); ?></p>

<?php } ?>

<section>
	<?php if(is_object($popular_media)) { ?> 
	
		<?php foreach($popular_media as $media_data) { ?>
		
			<?php if(is_array($media_data)) { ?>
			
			<ul class="image-list">
			
			<?php foreach($media_data as $media) { ?>
			
				<li>
					<?php echo anchor($media->images->standard_resolution->url, img(array('src' => $media->images->thumbnail->url, 'width' => '140', 'height' => '140')), 'class="fancybox" rel="fancybox_group"'); ?>
				</li>
				
			<?php } ?>
			
		</ul>
		
		<?php } ?>
	

	<?php } ?>
	
<?php } ?>
	
</section>
