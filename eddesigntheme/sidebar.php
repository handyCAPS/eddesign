<ul class="sidebar-list">
		<li class="sidebar-list--item">
		 <div class="sidebar-item">
		 	<?php    /**
		 		* Displays a navigation menu
		 		* @param array $args Arguments
		 		*/
		 		$args = array(
		 			'theme_location' => 'sidebarmenu',
		 			'menu' => 'sidebarmenu',
		 			'container' => 'nav',
		 			'container_class' => '',
		 			'container_id' => '',
		 			'menu_class' => 'menu sidebar-menu',
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

		 		wp_nav_menu( $args ); ?>
		 </div><!--  end .sidebar__item  -->
		</li>
<hr>
		<li class="sidebar-list--item">
			<div class="side-slide">
				<div class="slider-item">
					<img alt='placeholder' src="http://fillmurray.com/300/375" alt="">
				</div>
				<div class="slider-item">
					<img alt='placeholder' src="http://lorempixel.com/300/375" alt="">
				</div>
				<div class="slider-item">
					<img alt='placeholder' src="http://baconmockup.com/300/375" alt="">
				</div>
				<div class="slider-item">
					<img alt='placeholder' src="http://placesheen.com/300/375" alt="">
				</div>
				<div class="slider-item">
					<img alt='placeholder' src="http://lorempixel.com/300/375/abstract" alt="">
				</div>
			</div>
		</li>
<hr>
	</ul>