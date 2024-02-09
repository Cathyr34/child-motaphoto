<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION


add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() .'/style.css');
}

//Placer les menus
add_action('after_setup_theme', 'theme_supports');
function theme_supports()
{
    add_theme_support('menus');
    register_nav_menu('header','En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts() {
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/script.js', 
    array('jquery'), '1.0', true); 
}
 
function theme_scripts() {
    wp_enqueue_script('jquery');
  }
  add_action('wp_enqueue_scripts', 'theme_scripts');

//récupérer les posts
  function motaphoto_request_photos() {
    $args = array( 'post_type' => 'photos', 'posts_per_page' => 8 );$query = new WP_Query($args);
    if($query->have_posts()) {
    $response = $query;
    } else {
    $response = false;
    }
    
    wp_send_json($response);
    wp_die();
    }

    add_action( 'wp_ajax_request_photos', 'motaphoto_request_photos' ); 
    add_action( 'wp_ajax_nopriv_request_photos', 'motaphoto_request_photos' );

    function motaphoto_scripts() {
        wp_enqueue_script('motaphoto', get_template_directory_uri() . '/assets/js/motaphoto.js', array(‘jquery’), '1.0.0', true);
        wp_localize_script('motaphoto', 'motaphoto_js', array('ajax_url' => admin_url('admin-ajax.php')));
        }
        
        add_action('wp_enqueue_scripts', 'motaphoto_scripts');