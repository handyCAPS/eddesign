<?php

require_once( plugin_dir_path( __DIR__ ) . 'public/class-handycapsslider.php' );
/**
 * Plugin Name.
 *
 * @package   Handycaps_Slider_Admin
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 *
 * @package Handycaps_Slider_Admin
 * @author  Your Name <email@example.com>
 */
class Handycaps_Slider_Admin {


	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	private $plugin_slug;

	private $slideTable;

	private $sliderTable;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = Handycaps_Slider::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action('wp_ajax_save_slide', array($this, 'save_slide'));

		add_action('wp_ajax_delete_slide', array($this, 'delete_slide'));

		$this->setSlideTable();

		$this->setSliderTable();

		/*
		 * Define custom functionality.
		 *
		 * Read more about actions and filters:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		// add_action( '@TODO', array( $this, 'action_method_name' ) );
		// add_filter( '@TODO', array( $this, 'filter_method_name' ) );

	}

	private function setSlideTable() {
		global $wpdb;

		$this->slideTable = $wpdb->prefix . $this->plugin_slug . '_slides';
	}

	private function setSliderTable() {
		global $wpdb;

		$this->sliderTable = $wpdb->prefix . $this->plugin_slug . '_sliders';
	}

	private function dbDelta($sql) {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta($sql);
	}

	private function add_slide($slider, $slide) {
		global $wpdb;

		$tablename = $this->slideTable;

		if ($wpdb->insert($tablename, array(
					'slide_id' => $slide,
					'slider_id' => $slider
					), array('%d','%d'))) {
			$slide_id = $wpdb->insert_id;
			return true;
		}

		return false;

	}

	private function remove_slide($id) {
		global $wpdb;

		$tablename = $this->slideTable;

		if ($wpdb->delete($tablename, array('id' => $id), array('%d'))) {
			return true;
		}

		return false;
	}

	public function save_slide() {
		if ($this->add_slide($_POST['slider_id'], $_POST['att_id'])) {
		echo $this->get_slides($_POST['slider_id']);
		} else {
			echo 'Failure';
		}
		die();
	}

	public function delete_slide() {
		global $wpdb;
		$id = $_POST['slideId'];
		$slider = $_POST['sliderId'];

		if ($this->remove_slide($id)) {
			echo $this->get_slides($slider);
		} else {
			echo $wpdb->last_query;
		}
		die();
	}

	private function get_slider_info() {
		global $wpdb;

		$tablename = $this->sliderTable;
		$slideTable = $this->slideTable;

		$sql = "SELECT {$tablename}.id, {$tablename}.name
		FROM $tablename
		";

		return $wpdb->get_results($sql);
	}

	private function get_slide_info($slider) {
		global $wpdb;

		$slideTable = $this->slideTable;
		$posts = $wpdb->posts;

		$sql = "SELECT {$posts}.guid AS imgLink, {$posts}.post_excerpt AS imgCaption, {$slideTable}.id AS slideId FROM $posts
			JOIN $slideTable ON {$slideTable}.slider_id = $slider
			WHERE {$posts}.ID = {$slideTable}.slide_id
		";

		return $wpdb->get_results($sql);
	}

	private function get_slides($slider) {
		if ($result = $this->get_slide_info($slider)) {
			foreach ($result as $assoc) {
				$slideId = $assoc->slideId;
				$imgLink = $assoc->imgLink;
				$imgCaption = $assoc->imgCaption !== '' ? $assoc->imgCaption : 'No caption';
				include 'views/slides.php';
			}
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @TODO:
	 *
	 * - Rename "Handycaps_Slider" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Handycaps_Slider::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Handycaps_Slider" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Handycaps_Slider::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'HandyCAPSSlider', $this->plugin_slug ),
			__( 'HandyCAPSSlider', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		echo "<h2>HandyCAPSSlider</h2>";
		global $wpdb;

		$result = $this->get_slider_info();

		$sliderA = array();

		foreach ($result as $assoc) {

			$sliderId = $assoc->id;
			$sliderName = ucfirst($assoc->name);

			if (!in_array($sliderId, $sliderA)) {
				include( 'views/admin.php' );
				array_push($sliderA, $sliderId);
			}
		}
		include 'views/sliders.php';
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}

	/**
	 * NOTE:     Filters are points of execution in which WordPress modifies data
	 *           before saving it or sending it to the browser.
	 *
	 *           Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// @TODO: Define your filter hook callback here
	}

}
