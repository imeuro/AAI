<?php
/**
 * Template part for displaying page content in archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAI_gazzetta
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('HP-item-opening'); ?>>
		<div class="event-content">
			<header class="entry-header">
				
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<p class="entry-excerpt"><?php echo  get_the_excerpt(); ?></p> 


				<p class="entry-auth">
				<?php if (get_field('aai_agenda_data_inizio')) {
					$d = DateTime::createFromFormat("Y-m-d", get_field('aai_agenda_data_inizio'));
					echo '<strong>'. $d->format("d F Y") ."</strong>";
				} ?>
				<?php if (get_field('aai_agenda_data_inizio') && get_field('aai_agenda_data_fine')) {
					echo ' - '; 
				} else {
					echo '<br />'; 
				} ?>
				<?php if (get_field('aai_agenda_data_fine')) {
					$d = DateTime::createFromFormat("Y-m-d", get_field('aai_agenda_data_fine'));
					echo '<strong>'. $d->format("d F Y") ."</strong><br />";
				} ?>


				<?php if (get_field('aai_agenda_citta_it')) {
					echo get_field('aai_agenda_citta_it') ."<br />";
				} ?>
				<?php 
				if (get_field('aai_agenda_link') && get_field('aai_agenda_sede_it')) {
					$url = get_field('aai_agenda_link');
					if ($ret = parse_url(get_field('aai_agenda_link'))) {
				      if ( !isset($ret["scheme"]) ) { $url = "https://{$url}"; }
					}
					echo '<a href="'. $url .'" target="_blank">'. get_field('aai_agenda_sede_it') ."</a><br />";
				} else if (get_field('aai_agenda_sede_it')) {
					echo get_field('aai_agenda_sede_it') ."<br />";
				}  ?>
				</p>
			</header><!-- .entry-header -->

			<div class="post-thumbnail">
				<?php the_post_thumbnail('medium'); ?>
			</div><!-- .post-thumbnail -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
