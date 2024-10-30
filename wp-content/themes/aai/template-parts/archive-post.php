<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */



global $paged, $postCount, $style, $lastPostYear; ?>


<?php // if ($postCount === 1 && $paged === 0) : 
	// echo '$page'.$paged;
	// echo '$lastPostYear'.$GLOBALS['lastPostYear'];
	if ( get_the_date("Y") != $GLOBALS['lastPostYear']) {
		if ($paged == 0 && $postCount !== 1) {
			echo '<h2 class="heading_year">'.get_the_date("Y").'</h2>';
		}
	}
	$GLOBALS['lastPostYear'] = get_the_date("Y");

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('HP-item-opening'); ?> data-year="<?php echo get_the_date("Y"); ?>">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<p class="entry-excerpt"><?php echo  get_the_excerpt(); ?></p> 
				<?php if (get_field('aai_post_author')) {
					echo "<p class=\"entry-auth\">di". get_field('aai_post_author') ."</p>";
				} ?>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		</a>
	</article><!-- #post-<?php the_ID(); ?> -->

<?php /*
else :  
	// echo $style.'<br>';
	if ($postCount === 2) : 
		$style = rand(1,3);
	else : 
		$style >= 3 ? $style = 1 : $style++;
	endif;

	
	if (get_the_date("Y") != $GLOBALS['lastPostYear']) {
		//
		echo '<h2 class="heading_year">11111'.get_the_date("Y").'</h2>';
	}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('HP-item-style'.$style); ?> data-year="<?php echo get_the_date("Y"); ?>">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<p class="entry-excerpt"><?php echo  get_the_excerpt(); ?></p> 
				<p class="entry-auth"><?php the_field('aai_post_author'); ?></p>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		</a>
		
		<?php
		//echo '$GLOBALS[lastPostYear]'.$GLOBALS['lastPostYear'].'<br>Current Post Year='.get_the_date("Y");
		if (get_the_date("Y") != $GLOBALS['lastPostYear']) {
			$GLOBALS['lastPostYear'] = get_the_date("Y");
		}
		?>
	</article><!-- #post-<?php the_ID(); ?> -->


<?php endif; */ ?>
