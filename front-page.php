<head>
    <!-- Autres balises head... -->

    <link href="https://cdn.jsdelivr.net/npm/ [email protected]/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php get_header(); ?>

<main id="container">
       
    <section class="banner">       
        <p>PHOTOGRAPHE EVENT</p>
    </section> 

<!-- filtres -->
<?php
    $categories = get_terms(array(
        'taxonomy' => 'categories-photos',
    ));

    $formats = get_terms(array(
        'taxonomy' => 'format',
    ));

    $args = array(
        'post_type' => 'photo',
        'orderby' => 'date',      
    );
?>

<div>    
    <form id="form-filters" class="trier">
            <!-- catégorie -->
        <label for="categories"></label>
            <select class="selecteur" name="categories" id="categories" size=1>
                <option value="" selected hidden >CATEGORIES</option>
                <?php
                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        $category_value = $category->slug;
                        $category_name = $category->name;
                        echo '<option value="' . $category_value . '">' . $category_name . '</option>';
                    }
                }
                ?>
            </select>

        <!-- format -->
        <label for="formats"></label>
            <select class="selecteur" name="format" id="formats" size=1>
                <option value="" selected hidden >FORMATS</option>
                <?php
                if (!empty($formats) && !is_wp_error($formats)) {
                    foreach ($formats as $format) {
                        $format_value = $format->slug;
                        $format_name = $format->name;
                        echo '<option value="' . $format_value . '">' . $format_name . '</option>';
                    }                    
                }
                ?>
            </select>

        <!-- années -->
            <select class="selecteur" name="annees" id="annees" size=1>
                <option value="" selected hidden >Trier par</option>
                <option value="DESC">Les plus récentes</option>
                <option value="ASC">Les plus anciennes</option>  
            </select>
    </form>

</div>

        <div class="lesphotos" id="ajax_return">
            <!-- nombre de photos -->
            <?             
                $query = new WP_Query($args);
    // fonction wp_set_object_terms pour relier le post à la catégorie et au format
    wp_set_object_terms( $post_id, array( $categorie_slug, $formats_slug ), array( 'categories-photos', 'format' ), true );
    
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
    $query->the_post();
    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $image_description = get_the_content();
    $post_id = get_the_ID();
?>
    <div class="image">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_description; ?>">
        <div class="overlay">
            <a href="<?php echo get_the_permalink(); ?>" class="icon" title="Informations de l'image"><i class="fa fa-eye"></i></a>
            <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a>
        </div>
    </div>
<?php
    }
}
    else {
        // Aucun post trouvé
    }
    wp_reset_postdata(); 
    ?>

    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content">
        <div id="caption"></div>
    </div></div>
        <?php
          $prevPost = get_previous_post();
          $nextPost = get_next_post();
        ?>

    <div class="lightbox-info">
        <p class="lightbox-ref"></p>
        <p class="lightbox-categorie"></p>
    </div>

    <div>
        <button id="plus" class="plus">Charger plus</button>
    </div>
    
</main>    
    
<?php get_footer(); ?>

