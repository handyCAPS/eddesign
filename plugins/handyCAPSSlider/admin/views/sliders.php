

<div data-sliderid="<?php echo $sliderId; ?>" data-wpnonce="<?php echo wp_create_nonce('add-slider-image-777j0K'); ?>" class="outerWrap handycapsslider">

	<h2><?php echo $sliderName; ?></h2>
	<input id="upload_button_slider<?php echo $sliderId; ?>" class="button add-media" type="button" value="Add Image"><br>

	<div class="slider-wrapper" data-sliderid="<?php echo $sliderId; ?>">
	<?php $this->get_slides($sliderId); ?>
	</div>


</div>