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

	<main id="primary" class="content-area site-main homepage infinite">
		<div class="posts" id="main">
		<?php

		// Get all post IDs of the post type you want to exclude
		$excluded_post_ids = wp_list_pluck( get_posts( array( 'post_type' => 'biblioteca' ) ), 'ID' );
		//print_r($excluded_post_ids);


		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		//print_r($paged);
		$args = array(
		    'post__not_in' => $excluded_post_ids,
		    'paged' => $paged,
			'posts_per_page' => get_option('posts_per_page'),

		);
		$HPquery = new WP_Query($args);

		if ($HPquery->have_posts()) :

    		while ($HPquery->have_posts()) : 
    			$HPquery->the_post();

				$postCount++;

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'home' );

				
				if ($postCount % 3 === 0 && $postCount > 1) {
					$banda++;
					// echo $banda;
					include(get_template_directory() . '/template-parts/home-links.php');
				}

			endwhile;

		if ($HPquery->max_num_pages > 1) : ?> <!-- Importante: mostra navigazione solo se ci sono più pagine -->
        <nav class="navigation pagination" role="navigation"> 
			<!-- Classe navigation necessaria per YITH -->
            <div class="nav-links">
                <?php
                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $HPquery->max_num_pages,
                    'prev_text' => __('Precedente'),
                    'next_text' => __('Successivo'),
                    'type' => 'plain',
                    'end_size' => 0,
                    'mid_size' => 0,
                    'prev_next' => true,
                    'add_args' => false,
                ));
            	?>
            </div>
        </nav>
		<?php endif;



			// Usa wp_reset_postdata() invece di wp_reset_query()
			wp_reset_postdata();


		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
