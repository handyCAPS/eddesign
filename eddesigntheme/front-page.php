<?php
/*
Template Name: Home template
 */
?>
<!doctype html>
<html lang="<?php echo bloginfo('language'); ?>">
<head>
	<meta charset="UTF-8">
	<title>
		<?php
			echo bloginfo('title');
		?>
	</title>

<?php wp_head(); ?>

</head>
<body>
<div id="outerWrap">
	<header>
		<div class="top-nav">
			<div class="nav-label">
				<a href="<?php echo home_url(); ?>"><h1>Eddesign</h1></a>
			</div>

				<?php
				   /**
					* Displays a navigation menu
					* @param array $args Arguments
					*/
					$args = array(
						'theme_location' => 'topmenu',
						'menu' => 'topmenu',
						'container' => 'nav',
						'container_class' => '',
						'container_id' => '',
						'menu_class' => 'menu nav',
						'menu_id' => '',
						'echo' => true,
						'fallback_cb' => 'wp_page_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
						'depth' => 0,
						'walker' => ''
					);

					wp_nav_menu( $args );
				 ?>
		</div><!--  end .top-nav  -->
	</header>
	<div id="bodyWrap">
		<div class="slider-wrapper">
			<div class="slider-container">
				<div class="slider-item">
					<img src="http://fillmurray.com/800/400" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placekitten.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placecage.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://fillmurray.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placekitten.com/800/400" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placecage.com/800/400" alt="">
				</div><!--  end .slider-item  -->
			</div><!--  end .slider-container  -->
		</div><!--  end .slider-wrapper  -->
	</div><!--  end .body-wrap  -->
	<hr>
	<footer class="page-footer">
		<h3>Welcome to my portfolio</h3>
	</footer>
</div><!--  end #outerWrap  -->

<?php wp_footer(); ?>
<script>
	handyCAPSSlider.init({
		bulletColor: '#323F40',
		bulletBright: 20
	});
</script>

</body>
</html>