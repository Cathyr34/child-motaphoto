<?php
/*
 * This is the child theme for BlankSlate theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'child_motaphoto_enqueue_styles' );
function child_motaphoto_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

add_action('after_setup_theme', 'theme_supports');
function theme_supports()
{
    add_theme_support('menus');
    register_nav_menu('header','En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
