<!DOCTYPE html>
<html class="no-js">
<head>
	<title>Codeigniter Instagram API Library</title>
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/stylesheet.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	
	<!-- Google scripts -->
	<script src="http://www.google.com/jsapi"></script>
	<script>
		// Load the jquery library
		google.load("jquery", "1.4");
		// Set the base url
		var base_url = '<?php echo base_url(); ?>';
	</script>

	<!-- IE only scripts -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url(); ?>assets/javascript/DOMAssistant-2.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascript/selectivizr.js"></script>
	<![endif]-->
	
	<!-- Fancy box -->
	<script src="<?php echo base_url(); ?>assets/javascript/jquery.easing-1.3.pack.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascript/jquery.mousewheel-3.0.4.pack.js"></script>
	<script src="<?php echo base_url(); ?>assets/javascript/jquery.fancybox-1.3.4.pack.js"></script>
	
	<!-- Map scripts -->
	<?php $this->carabiner->display(); ?>
	
	<script>
	$(document).ready(function() {

		// Set up fancy box
		$("a[rel=fancybox_group]").fancybox({
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'titlePosition' 	: 'over',
			'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
			    return '<span id="fancybox-title-over">Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
			}
		});

	});
	</script>
	
</head>
<body>
<header>
  
</header>

<section id="main"></section>

	<?php $this->load->view($main_view); ?>

</section>

<footer>
  
  <p>&copy; Ian Luckraft</p>
  
  <p><?php echo anchor('http://twitter.com/ianckc', 'Follow me on Twitter'); ?></p>

</footer>

</body>
</html>
