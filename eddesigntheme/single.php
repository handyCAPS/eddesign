<!doctype html>
<!doctype html>
<html lang="<?php echo bloginfo('language'); ?>">
<head>
	<meta charset="UTF-8">
	<title>
		<?php
			echo wp_title('|', true, 'right');
			echo bloginfo('title');
		?>
	</title>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<div id="outerWrap" class="grid">
	<header class="one-whole">
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
						'menu' => '',
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
	<div id="bodyWrap" class="grid">

	<section class="focus grid__item two-thirds palm-one-whole lap-one-whole">
		<?php get_template_part('loop'); ?>
	</section><!--

	  --><section class="sidebar grid__item one-third palm-one-whole lap-one-whole">
	 <?php get_sidebar(); ?>

	</section>

	</div><!--  end .body-wrap  -->

	<hr>

	<footer class="page-footer">
		<h3>Welcome to my portfolio</h3>
	</footer>

</div><!--  end #outerWrap  -->

<?php wp_footer(); ?>

<script>
	handyCAPSSlider.init({
		container: 'side-slide',
		bullets: false,
		minis: false,
		animType: 'spin'
	});
</script>


</body>
</html>