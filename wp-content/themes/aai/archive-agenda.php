<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

get_header();
$language = (isset($_GET['lang'])) ? $_GET['lang'] : 'it';
?>

	<main id="primary" class="archive archive-agenda site-main infinite">


		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
			<div class="archive-description">
				<?php if ($language == 'en') : ?>
					<p><em>Discover the exhibitions of the AAI members<br> and those to be visited in museums,<br> in Italy and abroad</em></p>
				<?php else : ?>
					<p><em>Scopri le mostre dei membri<br> dell'Associazione Antiquari d'Italia,<br> e quelle da visitare nei musei,<br> in Italia e all'estero</em></p>
				<?php endif; ?>
			</div>
		</header><!-- .page-header -->

		<div class="agenda-posts"> 

			<?php 

			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			//print_r($paged);
			$today = date("Y-m-j");
			$args = array(
			    'post_type' => 'agenda',
			    'paged' => $paged,
				'posts_per_page' => get_option('posts_per_page'),
				'meta_key' => 'aai_agenda_data_fine',
				'orderby' => 'meta_value',
				'order' => 'DESC',
				// 'meta_query' => array(
				// 	array(
				// 		'key' => 'aai_agenda_data_fine',
				// 		'value' => $today,
				// 		'compare' => '>=',
				// 		'type' => 'DATE'
				// 	)
				// ),
			);
			$query = new WP_Query($args);

			if ($query->have_posts()) :
				while ($query->have_posts()) : 
	    			$query->the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content-archive-agenda' );

				endwhile;

				//the_posts_navigation();
				echo '<nav class="navigation"><div class="nav-links"><div class="nav-previous">'.get_next_posts_link("next", $query->max_num_pages ).'</div></</div></nav>';

			else :

				get_template_part( 'template-parts/content', 'none-agenda' );

			endif;
			?>
		</div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
