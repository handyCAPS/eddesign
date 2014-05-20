<?php get_header(); ?>
	</header>
	<div id="bodyWrap" class="grid">

	<?php if (have_posts()) : while(have_posts()): the_post(); ?>

	<section class="focus grid__item two-thirds palm-one-whole lap-one-whole">
		<h1><?php the_title(); ?></h1>

		<?php
		the_content();
		edit_post_link();
		?>
	</section><?php endwhile; endif; ?><!--

	  --><section class="sidebar grid__item one-third palm-one-whole lap-one-whole">
	 <?php get_sidebar(); ?>

	</section>

	</div><!--  end .body-wrap  -->

	<hr>

	<footer class="page-footer">
		<h3>Welcome to my portfolio</h3>
	</footer>

</div><!--  end #outerWrap  -->

<?php wp_footer(); ?>

<script>
	handyCAPSSlider.init({
		container: 'side-slide',
		bullets: false,
		minis: false,
		animType: 'spin'
	});
</script>


</body>
</html>