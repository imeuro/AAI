<?php
/**
 * Template part for displaying page content in archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

global $paged, $postCount, $style, $lastPostYear; 
$posteven = $postCount % 2 ? 'post-even' : 'post-odd';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(array('HP-item-opening',$posteven)); ?> data-year="<?php echo get_the_date("Y"); ?>">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				<p class="entry-excerpt"><?php echo  get_the_excerpt(); ?></p> 
				<?php if (get_field('aai_post_author')) {
					echo "<p class=\"entry-auth\">di ". get_field('aai_post_author') ."</p>";
				} ?>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php 
				if ($postCount == 1) : the_post_thumbnail();
				else : the_post_thumbnail('large', array( 'loading' => 'lazy' ) ); 
				endif; 
				?>
			</div><!-- .post-thumbnail -->
		</a>
	</article><!-- #post-<?php the_ID(); ?> -->

