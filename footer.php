<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Niremont_V0
 */

?>

</div>
</div><!-- #page -->
<?php if ( is_active_sidebar( 'footer-widget-zone' ) ) : ?>
<footer id="colophon" class="site-footer">
	<div class="container-small">	
		<div id="footer-widgets">		
			<?php dynamic_sidebar( 'footer-widget-zone' ); ?>
		</div>
		<?php endif; ?>
	</div>
</footer><!-- #colophon -->

<div class="site-info">
	<div class="container-small">	
		© Maude Photo | <img src="https://maude.alpettes.ch/wp-content/uploads/2024/04/dg-logo.png" height="12" width="12" style="border-radius: 0" /> webdesign &amp; code : Didier Grand - <a href="https://www.digitalgarage.ch?ref=maudephoto">digitalgarage.ch</a>
	</div>
</div><!-- .site-info -->

<?php wp_footer(); ?>
</body>
</html>
