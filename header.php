<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>

<header class="en_tete">

<a href="http://localhost:8080/Motaphoto/"><img class="logo" src="<?= get_stylesheet_directory_uri() ?>/images/logo-mota.png" alt="logo"></a>
<div id='mesliens'>
<?php
wp_nav_menu([

'theme_location' => 'header',
'container' => false,
'menu_class' => 'navbar-nav mr-auto'
])?>
<!-- Trigger/Open The Modal -->
<button id="myBtn">CONTACT</button>
</div>
<button class="responsive-menu" id="site-navigation_hamburger_icon" onclick="showResponsiveMenu()">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="responsive-menu"> 
                
</div>      
</header>

<main id="container" class="entry-content">


        