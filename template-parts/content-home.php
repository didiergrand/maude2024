<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Giron_Porsel_2024
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php maude_2024_post_thumbnail(); ?>

	<div class="entry-content">	
		<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title">', '</h2>' );
 	  	?>
		</header><!-- .entry-header -->
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'porsel2024' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
