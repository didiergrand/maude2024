<?php
/*
Template Name: Articles Tarifs
*/

get_header(); ?>

<div id="tarifs" class="container">
		<h1 class="entry-title text-center heart-below">
			<?php
			echo get_the_title();
			?>
		</h1>
    <?php
    $args = array(
        'category_name' => 'tarifs', // Remplacez 'galerie' par le slug réel de votre catégorie
        'posts_per_page' => -1, // Afficher tous les articles, ajustez selon le besoin
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <div class="grid-container">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="grid-item tarifs--item">
                    <a href="<?php the_permalink(); ?>">
                        <div class="tarifs--title"><?php the_title(); ?></div>
                        <div class="tarifs--more">Plus d'infos</div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>Aucun article trouvé dans cette catégorie.</p>
    <?php endif; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
