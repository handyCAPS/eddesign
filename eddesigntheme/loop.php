<?php

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="post">
<h1><?php the_title(); ?></h1>

<?php

	the_content();
	edit_post_link();

?>

</div><!--  end post  -->

<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

