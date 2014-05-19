<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   HandyCAPS_SLider
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

<!-- This file is used to markup the public facing aspect of the plugin. -->
<h1>It Works !!</h1>
<?php
	$query = new WP_Query(array('post_type' => 'handycapsslider'));

	$posts = '';

	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
?>
<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
<div class="content">
	<?php the_content(); the_excerpt(); the_author();  print_r(get_post_meta( get_the_ID() )); ?>
</div>

<?php wp_reset_postdata();  endwhile; endif;  ?>