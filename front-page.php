<?php
/**
 * The frontpage template file
 *
 * @package Maude_04
 */

get_header();
?>

	<main id="primary" class="site-main heart">
		<section id="welcome">
			<?php
// Obtenez les ID des articles épinglés
$pinned_posts = get_option('sticky_posts');
// Assurez-vous que les articles épinglés sont toujours à jour
rsort($pinned_posts);

// Requête pour les articles épinglés
$args_pinned = array(
    'post_type' => 'post',
    'post__in' => $pinned_posts,
    'posts_per_page' => -1, // Récupérez tous les articles épinglés
    'cat' => '2',
);

$q_pinned = new WP_Query($args_pinned);

if ($q_pinned->have_posts()) {
    while ($q_pinned->have_posts()) {
        $q_pinned->the_post();
        // votre boucle pour les articles épinglés
        get_template_part('template-parts/content-home', get_post_type());
    }
}

// Requête pour les articles non épinglés
$args_regular = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 3,
    'cat' => '2',
    'post__not_in' => $pinned_posts, // Exclure les articles épinglés
    'paged' => get_query_var('paged')
);

$q_regular = new WP_Query($args_regular);

if ($q_regular->have_posts()) {
    while ($q_regular->have_posts()) {
        $q_regular->the_post();
        // votre boucle pour les articles réguliers
        get_template_part('template-parts/content-home', get_post_type());
    }
}

// Réinitialiser la requête principale
wp_reset_postdata();


?>





      </section>
	</main><!-- #main -->

<?php
get_footer();
