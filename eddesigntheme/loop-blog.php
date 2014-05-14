<?php

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="post">
<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
<div class="post-meta">
	<?php _e('Posted', 'eddessign'); ?> : <?php  echo get_the_date(); ?>
</div>

<?php

	the_excerpt();
	edit_post_link();

?>

</div><!--  end post  -->
<hr>
<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

