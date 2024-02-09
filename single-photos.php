<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'entry-photo' ); ?>

    <div class='container'>
        <div class="content">

            <div class="text">
                <h2 class="majuscule"><?php the_title(); ?></h2>

                <p class="renseignements">REFERENCE : <?php echo get_field('reference'); ?></p>
                <p class="renseignements">CATEGORIE : <?php echo get_field('categorie'); ?></p>
                <p class="renseignements">FORMAT : <?php echo get_field('format'); ?></p>
                <p class="renseignements">TYPE : <?php echo get_field('type'); ?></p>
                <p class="renseignements">ANNEE : <?php echo get_field('annee'); ?></p>
            </div>

            
            <?php 
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id, 'medium_large');
                if( !empty($image_url) ): ?>
                <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
            <?php endif; ?>
        </div>
            
        <div class="contacter">
            <h2>Cette photo vous intéresse ?</h2>
            <button id="myBtn">CONTACT</button>
        </div>
        
            <?php endwhile; endif; ?>

    </div></br>
    
    <div class='container'>
    
    <div class='aussi'>
        <h2>VOUS AIMEREZ AUSSI</H2>
    </div></br>
    <div class="content.img">
            <?php 
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id, 'medium');
                if( !empty($image_url) ): ?>
                <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
            <?php endif; ?>

            
            <?php 
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id, 'medium');
                if( !empty($image_url) ): ?>
                <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
            <?php endif; ?>

    </div></div>

<?php get_footer(); ?>