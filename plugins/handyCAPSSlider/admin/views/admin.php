<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php echo $test; ?><br>
	<label for="upload_image"></label>
	<input id="upload_image" type="text" size="36" name="add_image" value="http://">
	<input id="upload_image_button" class="button" type="button" value="Add Image">
	<p>Enter a URL or upload an image</p>

	<div class="slider-images"></div>
	<div class="slider-caption"></div>


</div>
