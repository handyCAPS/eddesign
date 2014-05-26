<script>
(function() {
	var <?php echo $classes['name'] ?> = new HandyCAPSSlider;
		<?php echo $classes['name'] ?>.init({
			<?php echo self::sliderVars($lSlider); ?>
		});
})();

</script>