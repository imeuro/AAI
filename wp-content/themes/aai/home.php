<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

get_header();
$lastPostYear = '';
$postCount = 0;
$style = 0;
?>

	<main id="primary" class="site-main homepage infinite">

		<?php

		// Get all post IDs of the post type you want to exclude
		$excluded_post_ids = wp_list_pluck( get_posts( array( 'post_type' => 'biblioteca' ) ), 'ID' );

		// print_r($excluded_post_ids);

		$args = array(
		    'post__not_in' => $excluded_post_ids
		);
		$query = new WP_Query($args);

		if ($query->have_posts()) :

    		while ($query->have_posts()) : 
    			$query->the_post();

				$postCount++;
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'home' );

				
				if ($postCount % 3 === 0) {
					include(get_template_directory() . '/template-parts/agenda-home.php');
				}

			endwhile;

			the_posts_navigation();
			// do_shortcode('[ajax-loadmore-button]');
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		wp_reset_postdata();
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
