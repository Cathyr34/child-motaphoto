</main>


<footer id="footer" role="contentinfo" class="footer">

<?php
     wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto',"nav_menu",
     ]) ;
     ?>
     <p>TOUS DROITS RESERVES</p>

</footer>

<?php include 'modale.php'; ?>
<?php wp_footer(); ?>



</body>
</html>
