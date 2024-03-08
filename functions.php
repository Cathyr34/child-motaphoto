<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION

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

 // Localize the script with new data
 $script_data_array = array(
    'ajax_url' => admin_url('admin-ajax.php')
);
wp_localize_script('child-script', 'script_js', $script_data_array);
}

function theme_scripts() {
    wp_enqueue_script('jquery');
  }
  add_action('wp_enqueue_scripts', 'theme_scripts');

    add_action( 'wp_ajax_request_photos', 'motaphoto_request_photos' ); 
    add_action( 'wp_ajax_nopriv_request_photos', 'motaphoto_request_photos' );
   
        
//récupérer les posts
function motaphoto_request_photos() {
    $offset = $_POST["offset"];
    if (empty($offset)) {
        $offset = 0; 
    }
    $categories = $_POST['categories'];
    $format = $_POST['format'];
    $date = $POST['date'];
    $taxquery = array ();

    if($categories != "") {
        $taxquery[] = array(
            'taxonomy' => 'categories-photos',
            'field' => 'slug',
            'terms' => $categories,
        );
    }

    if( $format != "") {
        $taxquery[] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $query = new WP_Query([
        'post_type' => 'photos',
        'posts_per_page' => 8,
        "offset" => $offset,
        'tax_query' => $taxquery,
            'order' => $date,
    ]);

 //print_r($query); die();
    $posts = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $posts[] = array(
                'post_title' => get_the_title(),
                'image_url' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                'lien' => get_the_permalink(),
            );
        }
    }
    wp_send_json($posts);
    wp_die();
}

//Add Ajax Actions
add_action('wp_ajax_format_filter', 'ajax_format_filter');
add_action('wp_ajax_nopriv_format_filter', 'ajax_format_filter');

function ajax_formats_filter(){
    //RECUPERE DONNEES AJAX    
    $query_data = $_GET;
    $format_terms = ($query_data['']);
}   

// Filtres
function motaphoto_request_filtered() {
    
    $categories = $_POST['categories'];
    $formats = $_POST['format'];
    
    if($categories != "") {
        $argCategories = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categories,
        );
    } else {
        $argCategories = null;
    }

    if( $formats != "") {
        $argFormats = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $formats,
        );
    } else {
        $argFormats = null;
    }

    if( $annee != "") {
        $argAnnee = array(
            'date' => 'annee',
            'terms' => $date,    
        );
    } else {
        $argAnnee = null;
    }

    $query = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'tax_query' => array(
            $argCategories ?? "",
            $argFormats ?? "",
            $argAnnee ?? "",
        ),
    ]);
//print_r ($query); die();
    if( $query -> have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post(); 
            $response = get_the_post('photos');
        } 
        $my_html = ob_get_contents();
        ob_end_clean();
        $response = [
            'my_html' => $my_html,
            'found_posts' => $query->found_posts
        ];
        
    } else {
        $response = false;
    }

    wp_send_json($response);
    wp_die();
}
add_action('wp_ajax_request_filtered', 'motaphoto_request_filtered');
add_action('wp_ajax_nopriv_request_filtered', 'motaphoto_request_filtered');