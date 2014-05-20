<?php
/*
Template Name: Home template
 */
?>
<?php get_header(); ?>
	</header>
	<div id="bodyWrap">
		<div class="slider-wrapper">
			<div class="slider-container">
				<div class="slider-item">
					<img src="http://fillmurray.com/800/400" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placekitten.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placecage.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://fillmurray.com/600/300" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placekitten.com/800/400" alt="">
				</div><!--  end .slider-item  -->
				<div class="slider-item">
					<img src="http://placecage.com/800/400" alt="">
				</div><!--  end .slider-item  -->
			</div><!--  end .slider-container  -->
		</div><!--  end .slider-wrapper  -->
	</div><!--  end .body-wrap  -->
	<hr>
	<footer class="page-footer">
		<h3>Welcome to my portfolio</h3>
	</footer>
</div><!--  end #outerWrap  -->

<?php wp_footer(); ?>
<script>
	handyCAPSSlider.init({
		bulletColor: '#323F40',
		bulletBright: 20
	});
</script>

</body>
</html>