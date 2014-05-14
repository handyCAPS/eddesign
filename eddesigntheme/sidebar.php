<ul class="sidebar-list">

	<?php // Dynamic Sidebar
	if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'pagesidebar' ) ) : ?>

		<div>Oh my god, the sidebar is missing !!!</div>

	<?php endif; // End Dynamic Sidebar Sidebar Name ?>

	</ul>