<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'entry-photo' ); ?>

<div class='container'>
    <h2><?php the_title(); ?></h2>

    <p>REFERENCE : <?php echo get_field('reference'); ?></p>
    <p>CATEGORIE : <?php echo get_field('categorie'); ?></p>
    <p>FORMAT : <?php echo get_field('format'); ?></p>
    <p>TYPE : <?php echo get_field('type'); ?></p>
    <p>ANNEE : <?php echo get_field('annee'); ?></p>

    <?php 
    $image = get_field('image');
    if( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    <?php endif; ?>

</div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>