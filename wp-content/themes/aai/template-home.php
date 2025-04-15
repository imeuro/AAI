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
$postCount = 0; // Contatore per i post totali
$postCountReal = 0; // Contatore per i post reali (escludendo i billboard)
$banda = 0;

// Funzione per recuperare i billboard
function get_billboards() {
    $today = date('Y-m-d');
    $args = array(
        'post_type' => 'billboards',
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'billboard_position',
        'order' => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'billboard_start_date',
                'value' => $today,
                'compare' => '<=',
                'type' => 'DATE'
            ),
            array(
                'key' => 'billboard_end_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE'
            )
        )
    );
    return new WP_Query($args);
}

// Recupera tutti i billboard
$billboards = get_billboards();
$billboards_array = array();
if ($billboards->have_posts()) {
    while ($billboards->have_posts()) {
        $billboards->the_post();
        $position = get_field('billboard_position');
        $billboards_array[$position][] = array(
            'title' => get_the_title(),
            'link' => get_field('billboard_link'),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'new_tab' => get_field('billboard_new_tab')
        );
    }
    wp_reset_postdata();
}
?>

	<main id="primary" class="content-area site-main homepage infinite">
		<div class="posts" id="main">
		<?php
		// Get all post IDs of the post type you want to exclude
		$excluded_post_ids = wp_list_pluck( get_posts( array( 'post_type' => 'biblioteca' ) ), 'ID' );

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
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
				$postCountReal++;
				
				// echo '<pre>';
				// echo $postCount.' - '.$postCountReal;
				// echo '</pre>';

				get_template_part( 'template-parts/content', 'home' );
				
				// Visualizza i billboard dopo il post specificato
				if (isset($billboards_array[$postCountReal])) {
					foreach ($billboards_array[$postCountReal] as $billboard) {
						$postCount++;
						$posteven = $postCount % 2 ? 'post-even' : 'post-odd';
						
						// Verifica solo che esista la thumbnail, il link è opzionale
						if ($billboard['thumbnail']) : 
							$target = isset($billboard['new_tab']) && $billboard['new_tab'] ? ' target="_blank"' : '';
						?>
							<article id="AAI-billboard-<?php echo esc_attr($postCount); ?>" class="HP-item-opening AAI-billboard <?php echo $posteven; ?>">
								<?php if (isset($billboard['link']) && $billboard['link']) : ?>
									<a href="<?php echo esc_url($billboard['link']); ?>"<?php echo $target; ?> title="<?php echo esc_attr($billboard['title']); ?>">
								<?php endif; ?>
								<header class="entry-header"></header>
								<div class="post-thumbnail">
									<img src="<?php echo esc_url($billboard['thumbnail']); ?>" alt="<?php echo esc_attr($billboard['title']); ?>">
								</div>
								<?php if (isset($billboard['link']) && $billboard['link']) : ?>
									</a>
								<?php endif; ?>
								</article>
						<?php endif;
					}
				}
				
				// Aggiungi i div 'banda-home' dopo ogni 3 post
				if ($postCountReal % 4 === 0 && $postCountReal > 1) {
					$banda++;
					include(get_template_directory() . '/template-parts/home-links.php');
				}
			endwhile;

		if ($HPquery->max_num_pages > 1) : ?>
        <nav class="navigation pagination" role="navigation"> 
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

			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
