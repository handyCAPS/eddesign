<?php
/**
 * Plugin Name.
 *
 * @package   Handycaps_Slider
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-handycapsslider-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Handycaps_Slider
 * @author  Your Name <email@example.com>
 */
class Handycaps_Slider {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	private static $slider = array();

	/**
	 * @TODO - Rename "handycapsslider" to the name of your plugin
	 *
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	const plugin_slug = 'handycapsslider';

	protected $plugin_slug = 'handycapsslider';

	private $sliderTable;

	private $slideTable;

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		add_filter('widget_text', 'do_shortcode');

		$this->setSliderTable();

		$this->setSlideTable();

	}

	private function setSliderTable() {
		global $wpdb;

		$this->sliderTable = $wpdb->prefix . self::plugin_slug . 'sliders';
	}

	private function setSlideTable() {
		global $wpdb;

		$this->slideTable = $wpdb->prefix . self::plugin_slug . 'sliders';
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	private static function getSlides($id, $sItem, $sCaption) {

		$slideA = self::getSlidesInfo($id);

		foreach ($slideA as $assoc) {
			$imgLink = $assoc['imgLink'];
			$caption = isset($assoc['imgCaption']) ? $assoc['imgCaption'] : '';
			$altText = 'placeholder';

			include 'views/slides.php';
		}
	}

	private static function getSlidesInfo($sliderId) {
		global $wpdb;

		$slideTable = $wpdb->prefix . self::plugin_slug . '_slides';

		$posts = $wpdb->posts;

		$sql = $wpdb->prepare(

				"SELECT {$posts}.guid AS imgLink, {$posts}.post_excerpt AS imgCaption
				FROM $posts
				INNER JOIN $slideTable ON {$slideTable}.slider_id = %d
				WHERE {$posts}.ID = {$slideTable}.slide_id ORDER BY {$slideTable}.slide_order
				"
				, $sliderId
			);

		return $wpdb->get_results($sql, ARRAY_A);
	}

	private static function getSliderClasses($id) {
		global $wpdb;

		$tablename = $wpdb->prefix . self::plugin_slug . '_sliders';

		$sql = $wpdb->prepare("SELECT name, item, caption FROM $tablename WHERE id = %d", $id);

		$sliderA = array_filter($wpdb->get_row($sql, ARRAY_A), 'strlen');

		return array_map(function($val){
			return str_replace(' ', '', strtolower($val));
		}, $sliderA);
	}

	public static function getSliderInfo($id) {
		global $wpdb;

		$tablename = $wpdb->prefix . self::plugin_slug . '_sliders';

		$sql = $wpdb->prepare("SELECT * FROM $tablename WHERE id = %d", $id);

		$sliderA = array_filter($wpdb->get_row($sql, ARRAY_A), 'strlen');

		return $sliderA;
	}

	private static function getSlider($id) {

		$classes = self::getSliderClasses($id);

		$sContainer = isset($classes['name']) ? '_slider_' . $classes['name'] : 'slider-container';
		$sItem = isset($classes['item']) ? $classes['item'] : 'slider-item';
		$sCaption = isset($classes['caption']) ? $classes['caption'] : 'slider-caption';

		include 'views/sliders.php';
	}

	private static function sliderVars($id) {
		$varA = self::getSliderInfo($id);

		foreach ($varA as $options => $value) {

			if ($options === 'name' || $options === 'id') {
				if ($options === 'id') {
					echo '';
				} else {
					echo "container: '_slider_" . str_replace(' ', '',strtolower($value)) . "', ";
				}

			} else {
				echo $options . ": '" . strtolower($value) . "', ";
			}
		}
	}

	public static function initSlider() {

		foreach(self::$slider as $lSlider) {
			$classes = self::getSliderClasses($lSlider);

			include 'views/init-scripts.php';
		}
	}

	public static function shortcode($atts) {

		if (empty($atts)) {
			return;
		}

		self::enqueue_scripts();

		self::$slider[] = $atts['id'];

		add_action('wp_footer', array('Handycaps_Slider', 'initSlider'), 100);

		include 'views/public.php';
	}

	private static function setupDB() {
		global $wpdb;

		$pf = $wpdb->prefix;
		$tablename = $pf . self::plugin_slug;

		$sql =
		"CREATE TABLE IF NOT EXISTS {$tablename}_sliders (
			id int NOT NULL AUTO_INCREMENT,
			name VARCHAR(50),
			item varchar(50),
			caption varchar(50),
			stopOnHover tinyint(1),
			minis tinyint(1),
			highlightMinis tinyint(1),
			slideDur int,
			animationDur int,
			timingFunc varchar(30),
			animType varchar(30),
			itemWidth varchar(30),
			itemHeight varchar(30),
			captionHeight varchar(30),
			capMinHeight varchar(30),
			captionColor varchar(30),
			capTextColor varchar(30),
			capFontSize varchar(30),
			bullets tinyint(1),
			bulletSize varchar(30),
			bulletColor varchar(30),
			bulletBright int,
			bulAltColor varchar(30),
			chevrons tinyint(1),

			PRIMARY KEY  id (id)
			) ENGINE=InnoDB";

		$sql2 = "CREATE TABLE IF NOT EXISTS {$tablename}_slides (
			id int not null AUTO_INCREMENT,
			slide_id int NOT NULL,
			slider_id int NOT NULL REFERENCES {$tablename}_sliders (id) ON DELETE CASCADE,
			slide_order int DEFAULT 100,
			PRIMARY KEY  id (id)
			) ENGINE=InnoDB";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta($sql);
		dbDelta($sql2);
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		self::setupDB();
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public static function enqueue_scripts() {
		wp_enqueue_script( self::plugin_slug . '-plugin-script', plugins_url( 'assets/js/handyCAPSSlider.min.js', __FILE__ ), array(), self::VERSION, true );
	}



}
