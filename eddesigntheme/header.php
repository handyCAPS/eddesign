<!doctype html>
<html lang="<?php echo bloginfo('language'); ?>">
<head>
	<meta charset="UTF-8">
	<title>
		<?php
		if (is_home()) {
			echo bloginfo('title');
			echo wp_title('|', true, 'left');
		} else {
			echo wp_title('|', true, 'right');
			echo bloginfo('title');
		}
		?>
	</title>

	<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/favicon.ico">

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