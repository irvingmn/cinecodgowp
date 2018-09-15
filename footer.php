</main>
    <footer class="Footer">
    <?php   
      
        wp_nav_menu(array(
          'theme_location' => 'social_menu', /* cual es el menu que definimos en functions */
          'container' => 'nav', /* que etiqueta contenedora tendra */
          'container_class' => 'social' /* que clase se le agregara */
        ));
    ?>
    </footer>
    <div>
        <small>&copy; <?php  echo date('Y'); ?> por irving</small>
    </div>

</body>
 <?php wp_footer(); ?>
</html>