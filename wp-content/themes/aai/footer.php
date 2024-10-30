<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAI_gazzetta
 */

?>

<div id="ammenniccolo-boundary" class="desktop">
	<div class="ammenniccolo desktop" data-href="<?php echo get_permalink( get_page_by_path('newsletter') ); ?>">
		<div class="bollo">
			<img class="spinning" src="<?php echo get_template_directory_uri() . '/assets/img/join-nl.svg' ?>" width="208" height="207" loading="lazy" />
			<img class="bollo-pic" src="<?php echo get_template_directory_uri() . '/assets/img/bollo-gazzetta.svg' ?>" width="165" height="165" loading="lazy" />
		</div>
	</div>
</div>


	<footer id="colophon" class="site-footer">
		<div class="site-info flex">
			<a href="<?php echo bloginfo( 'home' ); ?>">
				<img src="<?php echo get_template_directory_uri() . '/assets/img/aai-logo-footer.svg'; ?>" alt="Associazione Antiquari d'Italia" width="219" height="222" loading="lazy" />
			</a>
			<p>
				ASSOCIAZIONE ANTIQUARI D’ITALIA<br>
				Palazzo Corsini • Via del Parione, 11<br>
				50123 Firenze<br>
				Tel +39 055 28 26 35<br>
				segreteria@antiquariditalia.it<br>
			</p>
		</div><!-- .site-info -->
		<div class="site-links">
			<ul>
				<li><br><br>
					<a href="https://www.iubenda.com/privacy-policy/74590635" target="_blank">privacy</a>
					<a href="https://www.iubenda.com/privacy-policy/74590635/cookie-policy" target="_blank">cookie policy</a>
				</li>
		</div>
	</footer><!-- #colophon -->

	<div id="scroll-up"></div>
	<div id="home-link"></div>
</div><!-- #page -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FLTCHNM1GZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FLTCHNM1GZ', {
  	'anonymize_ip': true
  });
</script>

<?php wp_footer(); ?>

</body>
</html>
