
<?php get_header(); ?>

<main id="container">
       
        <section class="banner">  
               
            <p>PHOTOGRAPHE EVENT</p>
        </section>
       
        <div class="entry-photo-meta">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry-photo' ); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>

