
<div class="addsliderwrapper">
	<form action="" method="POST" id="addslider-form" class="form addslider">
		<fieldset>
			<legend><?php _e('Add slider', 'handycapsslider'); ?></legend>
			<?php echo wp_nonce_field('create-new-slider-form'); ?>
			<label for="name"><?php _e('Name', 'handycapsslider'); ?></label>
			<input type="text" name="name" id="name" required>
			<br>
			<label for="items"><?php _e('Items class', 'handycapsslider'); ?></label>
			<input type="text" name="items" id="items" placeholder="slider-item">
			<br>
			<label for="caption"><?php _e('Caption class', 'handycapsslider'); ?></label>
			<input type="text" name="caption" id="caption" placeholder="slider-caption">
			<br>
			<label for="stopOnHover"><?php _e('Pause on hover', 'handycapsslider'); ?></label>
			<input type="checkbox" name="stopOnHover" id="stopOnHover" value="1" checked="checked">
			<br>
			<label for="minis"><?php _e('Minis', 'handycapsslider'); ?></label>
			<input type="checkbox" name="minis" id="minis" value="1" checked="checked">
			<br>
			<label for="highlightMinis"><?php _e('Highlight minis', 'handycapsslider'); ?></label>
			<input type="checkbox" name="highlightMinis" id="highlightMinis" value="1" checked="checked">
			<br>
			<label for="slideDur"><?php _e('Slide duration', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="slideDur" id="slideDur" placeholder="7s">
			<br>
			<label for="animationDur"><?php _e('Animation duration', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="animationDur" id="animationDur" placeholder="2s">
			<br>
			<label for="timingFunc"><?php _e('Animation swing', 'handycapsslider'); ?></label>
			<input type="text" name="timingFunc" id="timingFunc" placeholder="cubic-bezier(0.75,0,0.3,1)" title="ease | ease-out | ease-in | ease-in-out | linear | cubic-bezier(0,0,1,1)">
			<br>
			<label for="animType"><?php _e('Animation Type', 'handycapsslider'); ?></label>
			<input type="text" name="animType" id="animType" title="normal | flip | twist | twirl" placeholder="normal">
			<br>
			<label for="itemWidth"><?php _e('Item width', 'handycapsslider'); ?></label>
			<input type="text" name="itemWidth" id="itemWidth" placeholder="100%">
			<br>
			<label for="itemHeight"><?php _e('Item height', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="itemHeight" id="itemHeight" placeholder="auto">
			<br>
			<label for="captionHeight"><?php _e('Caption height', 'handycapsslider'); ?></label>
			<input type="text" name="captionHeight" id="captionHeight" placeholder="33.333%">
			<br>
			<label for="capminHeight"><?php _e('Caption min height', 'handycapsslider'); ?></label>
			<input type="text" name="capminHeight" id="capminHeight" placeholder="undefined">
			<br>
			<label for="captionColor"><?php _e('Caption background-color', 'handycapsslider'); ?></label>
			<input type="text" name="captionColor" id="captionColor" placeholder="rgba(0,0,0,0.4)">
			<br>
			<label for="capTextColor"><?php _e('Caption text color', 'handycapsslider'); ?></label>
			<input type="text" name="capTextColor" id="capTextColor" placeholder="#FFF">
			<br>
			<label for="capFontSize"><?php _e('Caption font-size', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="capFontSize" id="capFontSize" placeholder="16px">
			<br>
			<label for="bullets"><?php _e('Bullets', 'handycapsslider'); ?></label>
			<input type="checkbox" name="bullets" id="bullets" value="1" checked="checked">
			<br>
			<label for="bulletSize"><?php _e('Bullet size', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="bulletSize" id="bulletSize" placeholder="16px">
			<br>
			<label for="bulletColor"><?php _e('Bullot color', 'handycapsslider'); ?></label>
			<input type="text" name="bulletColor" id="bulletColor" placeholder="#7F8C8D">
			<br>
			<label for="bulletBright"><?php _e('Bullet brightness', 'handycapsslider'); ?></label>
			<input class="small" type="text" name="bulletBright" id="bulletBright" placeholder="-30" title="The amount to alter the color of the highlighted bullet">
			<br>
			<label for="bulAltColor"><?php _e('Bullet highlight color', 'handycapsslider'); ?></label>
			<input type="text" name="bulAltColor" id="bulAltColor" placeholder="#657273">
			<br>

			<input class="button right submit-sliderform" id="submit-sliderform" type="submit" value="<?php _e('Save', 'handycapsslider'); ?>">
		</fieldset>
	</form>
</div>
