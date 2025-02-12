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
	<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title">', '</h2>' );
 	  ?>
	</header><!-- .entry-header -->
	<div class="home_actus-img">
		<?php
			if ( has_post_thumbnail() ){
				the_post_thumbnail('actus-size');
			}
		?>

	</div>
	<div class="home_actus-content">
		<?php
			the_excerpt();
			
			
		?>


		<?php if( get_post_meta($post->ID, "custom_link", true) ): ?>
			<a href="<?php echo get_post_meta( get_the_ID(), 'custom_link', true ); ?>" class="btn btn-primary">Lire la suite</a>
		<?php else: ?>
		<!-- something can go here if you don't have the custom field, but it's optional -->
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire la suite</a>
		<?php endif; ?>   


		
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
