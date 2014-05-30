
<div class="addsliderwrapper <?php echo $editClass;  ?>">
	<form action="" method="POST" id="addslider-form" class="form addslider">
		<fieldset>
			<legend><?php _e('Add slider', $this->plugin_slug); ?></legend>
			<?php echo wp_nonce_field('create-new-slider-form'); ?>
			<label for="name"><?php _e('Name', $this->plugin_slug); ?></label>
			<input type="text" name="name" id="name" required title="<?php _e('This needs a unique value', $this->plugin_slug); ?>">
			<br>
			<label for="items"><?php _e('Items class', $this->plugin_slug); ?></label>
			<input type="text" name="item" id="item" placeholder="<?php echo $phA['item']; ?>">
			<br>
			<label for="caption"><?php _e('Caption class', $this->plugin_slug); ?></label>
			<input type="text" name="caption" id="caption" placeholder="<?php echo $phA['caption']; ?>">
			<br>
			<label for="stopOnHover"><?php _e('Pause on hover', $this->plugin_slug); ?></label>
			<input type="checkbox" name="stopOnHover" id="stopOnHover" value="1" checked="checked">
			<br>
			<label for="minis"><?php _e('Minis', $this->plugin_slug); ?></label>
			<input type="checkbox" name="minis" id="minis" value="1" checked="checked">
			<br>
			<label for="highlightMinis"><?php _e('Highlight minis', $this->plugin_slug); ?></label>
			<input type="checkbox" name="highlightMinis" id="highlightMinis" value="1" checked="checked">
			<br>
			<label for="slideDur"><?php _e('Slide duration', $this->plugin_slug); ?></label>
			<input class="small" pattern="[0-9]+(s|ms)?$" type="text" name="slideDur" id="slideDur" placeholder="<?php echo $phA['slideDur']; ?>">
			<br>
			<label for="animationDur"><?php _e('Animation duration', $this->plugin_slug); ?></label>
			<input class="small" type="text" pattern="[0-9]+(s|ms)?$" name="animationDur" id="animationDur" placeholder="<?php echo $phA['animationDur']; ?>">
			<br>
			<label for="timingFunc"><?php _e('Animation swing', $this->plugin_slug); ?></label>
			<input type="text" name="timingFunc" id="timingFunc" placeholder="<?php echo $phA['timingFunc']; ?>" title="ease | ease-out | ease-in | ease-in-out | linear | cubic-bezier(0,0,1,1)">
			<br>
			<label for="animType"><?php _e('Animation Type', $this->plugin_slug); ?></label>
			<input type="text" name="animType" id="animType" title="normal | flip | twist | twirl" placeholder="<?php echo $phA['animType']; ?>">
			<br>
			<label for="itemWidth"><?php _e('Item width', $this->plugin_slug); ?></label>
			<input type="text" name="itemWidth" id="itemWidth" placeholder="<?php echo $phA['itemWidth']; ?>">
			<br>
			<label for="itemHeight"><?php _e('Item height', $this->plugin_slug); ?></label>
			<input class="small" type="text" name="itemHeight" id="itemHeight" placeholder="<?php echo $phA['itemHeight']; ?>">
			<br>
			<label for="captionHeight"><?php _e('Caption height', $this->plugin_slug); ?></label>
			<input type="text" name="captionHeight" id="captionHeight" placeholder="<?php echo $phA['captionHeight']; ?>">
			<br>
			<label for="capMinHeight"><?php _e('Caption min height', $this->plugin_slug); ?></label>
			<input type="text" name="capMinHeight" id="capMinHeight" placeholder="<?php echo $phA['capMinHeight']; ?>">
			<br>
			<label for="captionColor"><?php _e('Caption background-color', $this->plugin_slug); ?></label>
			<input type="text" name="captionColor" id="captionColor" placeholder="<?php echo $phA['captionColor']; ?>">
			<br>
			<label for="capTextColor"><?php _e('Caption text color', $this->plugin_slug); ?></label>
			<input type="text" name="capTextColor" id="capTextColor" placeholder="<?php echo $phA['capTextColor']; ?>">
			<br>
			<label for="capFontSize"><?php _e('Caption font-size', $this->plugin_slug); ?></label>
			<input class="small" type="text" name="capFontSize" id="capFontSize" placeholder="<?php echo $phA['capFontSize']; ?>">
			<br>
			<label for="bullets"><?php _e('Bullets', $this->plugin_slug); ?></label>
			<input type="checkbox" name="bullets" id="bullets" value="1" checked="checked">
			<br>
			<label for="bulletSize"><?php _e('Bullet size', $this->plugin_slug); ?></label>
			<input class="small" type="text" name="bulletSize" id="bulletSize" placeholder="<?php echo $phA['bulletSize']; ?>">
			<br>
			<label for="bulletColor"><?php _e('Bullot color', $this->plugin_slug); ?></label>
			<input type="text" name="bulletColor" id="bulletColor" placeholder="<?php echo $phA['bulletColor']; ?>">
			<br>
			<label for="bulletBright"><?php _e('Bullet brightness', $this->plugin_slug); ?></label>
			<input class="small" type="text" name="bulletBright" id="bulletBright" placeholder="<?php echo $phA['bulletBright']; ?>" title="The amount to alter the color of the highlighted bullet">
			<br>
			<label for="bulAltColor"><?php _e('Bullet highlight color', $this->plugin_slug); ?></label>
			<input type="text" name="bulAltColor" id="bulAltColor" placeholder="<?php echo $phA['bulAltColor']; ?>">
			<br>

			<input class="button right submit-sliderform" id="submit-sliderform" type="submit" value="<?php _e('Save', $this->plugin_slug); ?>">
		</fieldset>
	</form>
</div>
