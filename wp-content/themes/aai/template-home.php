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

/* Template Name: homepage */

get_header();
$lastPostYear = '';
$postCount = 0;
$banda = 0;
?>

	<main id="primary" class="site-main homepage infinite">

		<?php

		// Get all post IDs of the post type you want to exclude
		$excluded_post_ids = wp_list_pluck( get_posts( array( 'post_type' => 'biblioteca' ) ), 'ID' );
		//print_r($excluded_post_ids);


		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		//print_r($paged);
		$args = array(
		    'post__not_in' => $excluded_post_ids,
		    'paged' => $paged,
			'posts_per_page' => get_option('posts_per_page'),

		);
		$query = new WP_Query($args);

		if ($query->have_posts()) :

    		while ($query->have_posts()) : 
    			$query->the_post();

				$postCount++;

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'home' );

				
				if ($postCount % 3 === 0) {
					$banda++;
					// echo $banda;
					include(get_template_directory() . '/template-parts/home-links.php');
				}

			endwhile;

			//the_posts_navigation();
			echo '<nav class="navigation"><div class="nav-links"><div class="nav-previous">'.get_next_posts_link("next", $query->max_num_pages ).'</div></</div></nav>';


  		    // Reset Query
        	wp_reset_query();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		wp_reset_postdata();
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
