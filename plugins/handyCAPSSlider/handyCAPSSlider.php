<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Handycaps_Slider
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 *
 * @wordpress-plugin
 * Plugin Name:       handyCAPSSlider
 * Plugin URI:        @TODO
 * Description:       A pure js image slider
 * Version:           0.1.0
 * Author:            Tim Doppenberg
 * Author URI:        http://timdoppenberg.nl
 * Text Domain:       handycapsslider-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/handyCAPS/handyCAPSSlider
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/


require_once( plugin_dir_path( __FILE__ ) . 'public/class-handycapsslider.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Handycaps_Slider', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Handycaps_Slider', 'deactivate' ) );

// Add a shortcode
add_shortcode( 'handycapsslider', array( 'Handycaps_Slider', 'shortcode' ) );
add_action( 'plugins_loaded', array( 'Handycaps_Slider', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/


if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-handycapsslider-admin.php' );
	add_action( 'plugins_loaded', array( 'Handycaps_Slider_Admin', 'get_instance' ) );

}
