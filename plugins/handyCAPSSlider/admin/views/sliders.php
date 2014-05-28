

<div data-parent-sliderid="<?php echo $sliderId; ?>" data-wpnonce="<?php echo wp_create_nonce('add-slider-image-777j0K'); ?>" class="outerWrap handycapsslider">

	<div class="delete slider" data-sliderid="<?php echo $sliderId; ?>" title='Delete' data-wpnonce="<?php echo wp_create_nonce('delete-single-slider'); ?>">Delete</div>

	<div class="shortcode-wrapper">
		<div class="sliderNum" contentEditable>[handycapsslider id='<?php echo $sliderId; ?>']</div>
	</div>
	<h3><?php echo $sliderName; ?></h3>


	<input id="upload_button_slider<?php echo $sliderId; ?>" class="button add-media" type="button" value="Add Image">
	<input type="button" class="button editslider" value="<?php _e('Edit Slider', 'handycapsslider'); ?>"><br>

	<div class="slider-wrapper" data-sliderid="<?php echo $sliderId; ?>" data-wpSortnonce="<?php echo wp_create_nonce('sort-all-slides'); ?>">
		<?php $this->get_slides($sliderId); ?>
	</div>


</div>