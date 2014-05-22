<form action="" method="POST" class="form addslider">
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
		<label for="stoponhover"><?php _e('Pause on hover', 'handycapsslider'); ?></label>
		<input type="checkbox" name="stoponhover" id="" value="1" checked="checked">
		<br>
		<label for="minis"><?php _e('Minis', 'handycapsslider'); ?></label>
		<input type="checkbox" name="minis" id="minis" value="1" checked="checked">
		<br>
		<label for="highlightminis"><?php _e('Highlight minis', 'handycapsslider'); ?></label>
		<input type="checkbox" name="highlightminis" id="highlightminis" value="1" checked="checked">
		<br>
		<label for="slidedur"><?php _e('Slide duration', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="slidedur" id="slidedur" placeholder="7s">
		<br>
		<label for="animationdur"><?php _e('Animation duration', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="animationdur" id="animationdur" placeholder="2s">
		<br>
		<label for="timingfunc"><?php _e('Animation swing', 'handycapsslider'); ?></label>
		<input type="text" name="timingfunc" id="timingfunc" placeholder="cubic-bezier(0.75,0,0.3,1)" title="ease | ease-out | ease-in | ease-in-out | linear | cubic-bezier(0,0,1,1)">
		<br>
		<label for="animtype"><?php _e('Animation Type', 'handycapsslider'); ?></label>
		<input type="text" name="animtype" id="animtype" title="normal | flip | twist | twirl" placeholder="normal">
		<br>
		<label for="itemwidth"><?php _e('Item width', 'handycapsslider'); ?></label>
		<input type="text" name="itemwidth" id="itemwidth" placeholder="100%">
		<br>
		<label for="itemheight"><?php _e('Item height', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="itemheight" id="itemheight" placeholder="auto">
		<br>
		<label for="captionheight"><?php _e('Caption height', 'handycapsslider'); ?></label>
		<input type="text" name="captionheight" id="captionheight" placeholder="33.333%">
		<br>
		<label for="capminheight"><?php _e('Caption min height', 'handycapsslider'); ?></label>
		<input type="text" name="capminheight" id="capminheight" placeholder="undefined">
		<br>
		<label for="captioncolor"><?php _e('Caption background-color', 'handycapsslider'); ?></label>
		<input type="text" name="captioncolor" id="captioncolor" placeholder="rgba(0,0,0,0.4)">
		<br>
		<label for="captextcolor"><?php _e('Caption text color', 'handycapsslider'); ?></label>
		<input type="text" name="captextcolor" id="captextcolor" placeholder="#FFF">
		<br>
		<label for="capfontsize"><?php _e('Caption font-size', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="capfontsize" id="capfontsize" placeholder="16px">
		<br>
		<label for="bullets"><?php _e('Bullets', 'handycapsslider'); ?></label>
		<input type="checkbox" name="bullets" id="bullets" value="1" checked="checked">
		<br>
		<label for="bulletsize"><?php _e('Bullet size', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="bulletsize" id="bulletsize" placeholder="16px">
		<br>
		<label for="bulletcolor"><?php _e('bulletColor', 'handycapsslider'); ?></label>
		<input type="text" name="bulletcolor" id="bulletcolor" placeholder="#7F8C8D">
		<br>
		<label for="bulletbright"><?php _e('Bullet brightness', 'handycapsslider'); ?></label>
		<input class="small" type="text" name="bulletbright" id="bulletbright" placeholder="-30" title="The amount to alter the color of the highlighted bullet">
		<br>
		<label for="bulaltcolor"><?php _e('Bullet highlight color', 'handycapsslider'); ?></label>
		<input type="text" name="bulaltcolor" id="bulaltcolor" placeholder="#657273">
		<br>

		<input class="button right" type="submit" value="<?php _e('Save', 'handycapsslider'); ?>">
	</fieldset>
</form>

