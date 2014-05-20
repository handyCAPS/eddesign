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

<div class="outerWrap">

	<h2><?php echo $sliderName; ?></h2>
	<input id="upload_button_slider<?php echo $sliderId; ?>" class="button add-media" type="button" value="Add Image">

	<input type="hidden" name='sliderId' class='sliderId' value="<?php echo $sliderId; ?>"><br>
	<?php $this->get_slides($sliderId); ?>


</div>
