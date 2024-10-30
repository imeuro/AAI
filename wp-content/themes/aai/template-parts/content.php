<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="top-content flex">
		<?php // aai_post_thumbnail(); ?>
		<p class="entry-excerpt">
			<?php echo  get_the_excerpt(); ?><br /><br />
			<?php if (get_field('aai_post_author')) {
					echo "<p class=\"entry-auth\">di ". get_field('aai_post_author') ."</p>";	
			} ?>
		</p>
		<?php if (get_post_type() == 'agenda') {
			echo '<p class="entry-auth">';
			if (get_field('aai_agenda_data_testuale')) {
				echo '<strong>'.get_field('aai_agenda_data_testuale') ."</strong><br />";
			}
			if (get_field('aai_agenda_citta_it')) {
				echo get_field('aai_agenda_citta_it') ."<br />";
			} if (get_field('aai_agenda_sede_it')) {
				echo get_field('aai_agenda_sede_it') ."<br />";
			}
			echo '</p>';
		} ?>
	</div>

	<div class="entry-content serif">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aai' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<!--footer class="entry-footer">
		oooooo fooooter
		<?php // aai_entry_footer(); ?>
	</footer--><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
