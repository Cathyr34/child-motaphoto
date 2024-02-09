
<?php get_header(); ?>

<main id="container">
       
        <section class="banner">  
               
            <p>PHOTOGRAPHE EVENT</p>
        </section>
        
        <?php  $args = array( 'post_type' => 'photos','posts_per_page' => 8 );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
        while ($query->have_posts()) {
        $query->the_post();
        // Affichez ici le contenu du post
    }
} 

else {
    // Aucun post trouvé
}
wp_reset_postdata(); ?>

<?php get_footer(); ?>

