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

	private $sliderVars     = array();

	private $sliderOptions  = array();

	private $sliderValues   = array();

	private $sliderDefaults = array();

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

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

		$this->ajaxActions();

		$this->setSlideTable();

		$this->setSliderTable();

		$this->setSliderDefaults();


		/*
		 * Define custom functionality.
		 *
		 * Read more about actions and filters:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		// add_action( '@TODO', array( $this, 'action_method_name' ) );
		// add_filter( '@TODO', array( $this, 'filter_method_name' ) );

	}

	public function flatten($array) {

		$flatArray = array();

		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$flatArray = array_merge($flatArray, $this->flatten($value));
			} else {
				$flatArray[$key] = $value;
			}
		}

		return $flatArray;
	}

	public function checkIntval($val) {

		if (is_array($val)) {
			foreach ($val as $int) {
				return $this->checkIntval($int);
			}
		}

		if ($val !== 0) {
			return true;
		}

		return false;
	}

	private function setSlideTable() {
		global $wpdb;

		$this->slideTable = $wpdb->prefix . $this->plugin_slug . '_slides';
	}

	private function setSliderTable() {
		global $wpdb;

		$this->sliderTable = $wpdb->prefix . $this->plugin_slug . '_sliders';
	}

	private function setSliderDefaults() {
		$this->sliderDefaults = array(
				'name'          => '',
				'item'          => 'slider-item',
				'caption'       => 'slider-caption',
				'slideDur'      => '7s',
				'animationDur'  => '2s',
				'timingFunc'    => 'cubic-bezier(0.75,0,0.3,1)',
				'animType'      => 'normal',
				'itemWidth'     => '100%',
				'itemHeight'    => 'auto',
				'captionHeight' => '33.3333%',
				'capMinHeight'  => '',
				'captionColor'  => 'rgba(0,,0,0,0.4)',
				'capTextColor'  => '#FFF',
				'capFontSize'   => '16px',
				'bulletSize'    => '16px',
				'bulletColor'   => '#7F8C8D',
				'bulletBright'  => '-30',
				'bulAltColor'   => '#657273'
			);
	}

	private function ajaxActions() {
		add_action('wp_ajax_new_slider', array($this, 'new_slider'));

		add_action('wp_ajax_save_slide', array($this, 'save_slide'));

		add_action('wp_ajax_delete_slide', array($this, 'delete_slide'));

		add_action('wp_ajax_delete_slider', array($this, 'delete_slider'));

		add_action('wp_ajax_sort_all_slides', array($this, 'sort_all_slides'));

		add_action('wp_ajax_edit_single_slider', array($this, 'edit_single_slider'));
	}

	private function setSliderValues($formA) {

		$setBools = array();

		$sliderBooleans = array(
				'stopOnHover',
				'minis',
				'highlightMinis',
				'bullets'
			);

		$nonceKeys = array(
				'_wpnonce',
				'_wp_http_referer'
			);

		foreach ($formA as $key => $sliderVar) {
			if (in_array($key, $sliderBooleans)) {
				array_push($setBools, $key);
				unset($formA[$key]);
			}
			if (in_array($key, $nonceKeys)) {
				unset($formA[$key]);
			}
		}

		$notSet = array_diff($sliderBooleans, $setBools);

		$addFalse = function($val) {
			return array($val => 0);
		};

		$falseA = array_map($addFalse, $notSet);


		$this->sliderVars = array_filter($this->flatten(array_merge($formA, $falseA)), 'strlen');

	}

	private function splitSliderValues() {
		foreach ($this->sliderVars as $option => $value) {
			$this->sliderOptions[] = "`" . $option . "`" ;
			$this->sliderValues[] = "'" . sanitize_text_field($value) . "'" ;
		}
	}

	private function insertSlider() {

		global $wpdb;

		$this->splitSliderValues();

		$tablename = $this->sliderTable;

		$options = implode(',', $this->sliderOptions);
		$values = implode(',', $this->sliderValues);

		$sql = "INSERT INTO $tablename ($options) VALUES ($values)";

		$wpdb->query($sql);
	}

	private function addSlide($slider, $slide) {
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

	private function removeSingle($tablename, $id) {
		global $wpdb;


		if ($wpdb->delete($tablename, array('id' => $id), array('%d'))) {
			return TRUE;
		}

		return FALSE;
	}


	public function new_slider() {

		check_ajax_referer('create-new-slider-form', 'newSliderNonce' );

		parse_str($_POST['formdata'], $postA);

		$this->setSliderValues($postA);

		$this->insertSlider();

		echo $this->display_plugin_admin_page();


		die();
	}


	public function delete_slider() {

		check_ajax_referer('delete-single-slider', 'deleteSliderNonce');

		if (!$this->checkIntval(intval($_POST['sliderId']))) {
			die();
		}

		if ($this->removeSingle($this->sliderTable, $_POST['sliderId'])) {
			echo $this->display_plugin_admin_page();
		} else {
			if (WP_DEBUG) {
				global $wpdb;
				echo $wpdb->last_query;
			}
		}

		die();
	}

	public function edit_single_slider() {

		check_ajax_referer('edit-single-slider', 'editNonce');

		$sliderVals = Handycaps_Slider::getSliderInfo($_POST['sliderId']);

		$this->setSliderValues($sliderVals);

		echo print_r($this->sliderValues);

		die();
	}


	public function save_slide() {

		check_ajax_referer('add-slider-image-777j0K', 'addNonce');


		if (!$this->checkIntval(array(intval($_POST['slider_id']), intval($_POST['att_id'])))) {
			die();
		}

		if ($this->addSlide(intval($_POST['slider_id']), intval($_POST['att_id']))) {

			echo $this->get_slides(intval($_POST['slider_id']));

		} else {
			echo 'Failure';
		}

		die();
	}


	public function delete_slide() {
		check_ajax_referer('delete-slider-image-055HbbM0', 'deleteNonce');

		global $wpdb;

		$id = intval($_POST['slideId']);
		$slider = intval($_POST['sliderId']);

		if ($this->removeSingle($this->slideTable, $id)) {

			echo $this->get_slides($slider);

		} else {
			if (WP_DEBUG) {
				echo 'Query failed: ' . $wpdb->last_query;
			}

		}

		die();
	}


	public function sort_all_slides() {
		global $wpdb;
		check_ajax_referer('sort-all-slides', 'sortNonce' );

		$sId = $_POST['sliderId'];
		$sAr = $_POST['orderArray'];
		$this->updateSlideOrder($sId, $sAr);

		if (WP_DEBUG) {
			echo 'Query Failed' . $wpdb->last_query;
		}


		die();
	}
	private function updateSlideOrder($sliderId, $slideOrderA) {

		global $wpdb;

		$tablename = $this->slideTable;

		$weGood = TRUE;

		if (!is_array($slideOrderA)) {
			return;
		}

		foreach ($slideOrderA as $order => $slideId) {
			if (!$wpdb->update($tablename, array('slide_order' => $order), array('id' => $slideId, 'slider_id' => $sliderId), array('%d', '%d') )) {
				$weGood = FALSE;
				};
			}

			return $weGood;
		}

	private function get_slider_info() {
		global $wpdb;

		$tablename = $this->sliderTable;
		$slideTable = $this->slideTable;

		$sql = "SELECT name, id
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
			WHERE {$posts}.ID = {$slideTable}.slide_id ORDER BY {$slideTable}.slide_order
		";

		return $wpdb->get_results($sql);
	}

	private function get_slides($slider) {
		if ($result = $this->get_slide_info($slider)) {
			foreach ($result as $assoc) {
				$slideId = $assoc->slideId;
				$imgLink = $assoc->imgLink;
				$imgCaption = $assoc->imgCaption;
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


			wp_enqueue_style('wp-jquery-ui');
			wp_enqueue_style('wp-jquery-ui-dialog');
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
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
			wp_enqueue_script('jquery-ui');
			wp_enqueue_script('jquery-ui-dialog' );

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
		 */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'HandyCAPSSlider', $this->plugin_slug ),
			__( 'HandyCAPSSlider', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
			'dashicons-images-alt2',
			'35.78'
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {

		$result = $this->get_slider_info();

		$sliderA = array();

		$phA = $this->sliderDefaults;

		$this->showAddSliderForm();

		include 'views/admin.php';

	}

	public function showAddSliderForm($id = FALSE,$editClass = '') {


		if (!$id) {
			$phA = $this->sliderDefaults;
		}

		include 'views/addslider-form.php';

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
