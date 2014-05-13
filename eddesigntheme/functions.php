<?php

define ('THEMEPATH', get_stylesheet_directory_uri());

    /**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function eddesign_script() {
		wp_register_script( 'handyCAPSSlider', THEMEPATH . '/bower_components/handyCAPSSlider/js/handyCAPSSlider.min.js', array());
		wp_register_script('eddesign', THEMEPATH . '/js/eddesign.js', array('handyCAPSSlider'));

		wp_enqueue_script('handyCAPSSlider');
		wp_enqueue_script('eddesign' );

		wp_register_style('eddesignstyle', THEMEPATH . '/css/eddesign.css', array());
		wp_register_style('googlefonts', 'http://fonts.googleapis.com/css?family=Coda|Lobster|Open+Sans', array());

		wp_enqueue_style('eddesignstyle');
		wp_enqueue_style('googlefonts');
	}

	add_action( 'wp_enqueue_scripts', 'eddesign_script' );

	// Register Navigation Menus
	function eddesign_navigation_menus() {

		$locations = array(
			'topmenu' => __( 'The black bar top menu', 'eddesign' ),
			'sidebarmenu' => __( 'A menu for the sidebar', 'eddesign' ),
			'mobilemenu' => __( 'mobile version of the top menu', 'eddesign' ),
		);
		register_nav_menus( $locations );

	}

	// Hook into the 'init' action
	add_action( 'init', 'eddesign_navigation_menus' );