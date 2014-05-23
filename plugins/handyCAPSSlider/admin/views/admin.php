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
<h2>HandyCAPSSlider</h2>
<div class='button addslider-button'>Add Slider</div><br>

<?php
foreach ($result as $assoc) {

	$sliderId = $assoc->id;
	$sliderName = ucfirst($assoc->name);

	if (!in_array($sliderId, $sliderA)) {
		include( 'sliders.php' );
		array_push($sliderA, $sliderId);
	}
}
?>