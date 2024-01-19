<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">

<header class="en_tete">

<a href="http://localhost:8080/Motaphoto/"><img class="logo" src="<?= get_stylesheet_directory_uri() ?>/images/logo-mota.png" alt="logo"></a>

<?php
wp_nav_menu([
'theme_location' => 'header',
'container' => false,
'menu_class' => 'navbar-nav mr-auto'
])?>

</header>
<div id="container">
<main id="content" role="main">

        