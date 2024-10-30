<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

global $page, $postCount, $style, $lastPostYear;
if (!$lastPostYear) {$lastPostYear = get_the_date("Y"); }
// echo '<br>postCount='.$postCount;
// echo 'last Post Year='.$lastPostYear;
// echo '<br>Current Post Year='.get_the_date("Y");
gtertertre


if ($lastPostYear !== get_the_date("Y")) {
	// echo '$lastPostYear='.$lastPostYear;
	$lastPostYear = get_the_date("Y");
	// echo '$lastPostYear='.$lastPostYear;
	echo '<h2>'.$lastPostYear.'</h2>';
}
?>

<!-- wp-content/themes/aai/ajax-load-more/content-loop.php -->

	<?php 
	if ($postCount === 2) : 
		$style = rand(1,3);
	else : 
		$style >= 3 ? $style = 1 : $style++;
	endif;?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('HP-item-style'.$style); ?>>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php the_excerpt(); ?>
				<?php // the_date(); ?>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		</a>
	</article><!-- #post-<?php the_ID(); ?> -->


