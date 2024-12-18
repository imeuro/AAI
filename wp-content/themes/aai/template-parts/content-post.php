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
			<?php echo get_the_excerpt(); ?>
		</p>
		<?php if (get_field('aai_post_author')) {
			echo "<p class=\"entry-auth\">di ". get_field('aai_post_author') ."</p>";
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
		<p class="entry-date"><?php echo get_the_date(); ?></p>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
