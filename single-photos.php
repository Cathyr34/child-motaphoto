<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'entry-photo' ); ?>

    <div>
        <div class="content">

            <div class="text">
                <h2 class="majuscule"><?php the_title(); ?></h2>

                <p class="renseignements"><span class="field-content">REFERENCE : <?php echo get_field('reference'); ?></span></p>
                <p class="renseignements"><span>CATEGORIE : <?php the_terms(get_the_ID(), 'categories-photos'); ?></span></p>
                <p class="renseignements"><span>FORMAT : <?php the_terms(get_the_ID(), 'format'); ?></span></p>
                <p class="renseignements"><span class="field-content">TYPE : <?php echo get_field('type'); ?></span></p>
                <p class="renseignements"><span>ANNEE : <?php the_date('Y'); ?></span></p>

                </hr>
            </div>
                    
            <?php 
               the_post_thumbnail('large');  
            ?>
                
            <div class="contacter">
                <h2>Cette photo vous intéresse ?</h2>
                <button id="myBtn" class="plus">CONTACT</button>
            </div>
            <hr>
        </div>
        
            <?php endwhile; endif; ?>

    </div></br>

    <div class='lesphotos'>
    
    <div class='aussi'>
        <h2>VOUS AIMEREZ AUSSI</H2>
    </div></br>

    <div class="lesphotos">
        <?php
            $prevPost = get_previous_post();
            $nextPost = get_next_post();
        
            $prevThumbnail = get_the_post_thumbnail_url( $prevPost->ID );
            $prevLink = get_permalink($prevPost); 
                       
            $nextThumbnail = get_the_post_thumbnail_url( $nextPost->ID );
            $nextLink = get_permalink($nextPost);                             
                
            $prevThumbnail = get_the_post_thumbnail_url( $prevPost->ID );
            $prevLink = get_permalink($prevPost); 
        ?>
            <a href="<?= $prevLink; ?>">
                <img id="previous-image" class="previous-image" src="<?php echo $prevThumbnail; ?>" alt="Prévisualisation image précédente">
            </a>

        <?php 
            $nextThumbnail = get_the_post_thumbnail_url( $nextPost->ID );
            $nextLink = get_permalink($nextPost); 
        ?>
            <a href="<?= $nextLink; ?>">
               <img id="next-image" class="next-image" src="<?php echo $nextThumbnail; ?>" alt="Prévisualisation image suivante">
            </a>
               
    </div>
            
    <?php
if (have_posts()) : while (have_posts()) : the_post();
  // catégorie de l'article actuel
  $category = get_the_terms(get_the_ID(), 'categories-photos');
  $category_id = $category[0]->term_id;

  // requête pour récupérer d'autres articles de la même catégorie
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 2, 
    'category__in' => array($category_id), // Utilisez l'ID de la catégorie
    'post__not_in' => array(get_the_ID()), // Excluez l'article actuel
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
    // Affichez les autres articles de la même catégorie ici
    ?>
<div class="content">
        <div class="image">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_description; ?>">
            <div class="overlay">
            <a href="<?php echo get_the_permalink(); ?>" class="icon" title="Informations de l'image"><i class="fa fa-eye"></i></a> 
            <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a>
        </div>

<?php
    endwhile; endif;
    endwhile; endif;
       
    wp_reset_postdata(); // Réinitialisez les données de l'article
?>
    </div></div>

<?php get_footer(); ?>