<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAI_gazzetta
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<!-- polylang: get the link for english version -->
	<?php
	if ( function_exists( 'pll_the_languages' ) ) : ?>
		<section id="polylang-selector" class="widget widget_polylang">
			<ul>
				<?php
				if ( is_post_type_archive( 'agenda' ) ) { 
					$language = (isset($_GET['lang'])) ? $_GET['lang'] : 'it';
					if ($language == 'it') {
						echo '<li class="lang-item lang-item-it"><span>ITA</span></li>';
						echo '<li class="lang-item lang-item-en"><a lang="en-GB" hreflang="en-GB" href="'.esc_url( home_url( '/agenda/?lang=en' ) ).'">ENG</a></li>';
					} else {
						echo '<li class="lang-item lang-item-it"><a lang="it-IT" hreflang="it-IT" href="'.esc_url( home_url( '/agenda/?lang=it' ) ).'">ITA</a></li>';
						echo '<li class="lang-item lang-item-en"><span>ENG</span></li>';
					}
				} else { 
					$languages = pll_the_languages( array( 'raw' => 1 ) );
					if ( ! empty( $languages ) ) {
						foreach ( $languages as $language ) { 
							// echo '<pre>';
							// print_r($language);
							// echo '</pre>';
							if ( ! $language['current_lang'] ) {
								$translation_post_id = pll_get_post(get_the_ID(), $language['slug']);
								$translation_post_url = get_permalink($translation_post_id);

								echo '<li class="lang-item lang-item-' . $language['slug'] . '"><a lang="' . $language['locale'] .'" hreflang="' . $language['locale'] .'" href="' . esc_url( $translation_post_url ) . '">' . esc_html( $language['name'] ) . '</a></li>';
							} else {
								echo '<li class="lang-item lang-item-' . $language['slug'] . '"><span>' . esc_html( $language['name'] ) . '</span></li>';}
						}
					} 
				}
				?>
			</ul>
		</section>
	<?php
	endif;
	?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
