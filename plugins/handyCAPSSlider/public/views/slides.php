

	<div class="<?php echo $sItem; ?>">

		<img src="<?php echo $imgLink ?>" alt="<?php echo $altText; ?>">
	<?php  if (!preg_match('/^\s*$/', $caption)) { ?>
		<div class="<?php echo $sCaption; ?>">
			<?php echo $caption; ?>
		</div>
	<?php } ?>
	</div>