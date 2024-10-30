<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */



global $paged, $postCount, $style, $lastPostYear; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('HP-item-opening'); ?> data-year="<?php echo get_the_date("Y"); ?>">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<p class="entry-excerpt"><?php echo  get_the_excerpt(); ?></p> 
				<?php if (get_field('aai_post_author')) {
					echo "<p class=\"entry-auth\">di ". get_field('aai_post_author') ."</p>";
				} ?>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		</a>
	</article><!-- #post-<?php the_ID(); ?> -->


