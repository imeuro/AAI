<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAI_gazzetta
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if( is_single() || is_singular() ) : ?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@300;700&display=swap" rel="stylesheet">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aai' ); ?></a>

	<header id="masthead" class="site-header flex">
		<?php if ( is_front_page() || is_home() ) { echo '<h1 class="site-logo">'; } else { echo '<div class="site-logo">'; } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
				<img src="<?php echo get_template_directory_uri() . '/assets/img/logo-gazzetta-antiquaria.svg' ?>" alt="<?php bloginfo( 'name' ); ?>" width="280" height="90" />
			</a>
		<?php if ( is_front_page() || is_home() ) { echo '</h1>'; } else { echo '</div>'; } ?> 
		
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-label="menu" aria-controls="primary-menu" aria-expanded="false"></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<?php get_sidebar(); ?>

	</header><!-- #masthead -->
