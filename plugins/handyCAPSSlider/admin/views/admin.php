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

<div data-sliderid="<?php echo $sliderId; ?>" class="outerWrap handycapsslider slider<?php echo $sliderId; ?>">

	<h2><?php echo $sliderName; ?></h2>
	<input id="upload_button_slider<?php echo $sliderId; ?>" class="button add-media" type="button" value="Add Image"><br>

	<div class="slider-wrapper">
	<?php $this->get_slides($sliderId); ?>
	</div>


</div>
