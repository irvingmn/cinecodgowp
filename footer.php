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
        <p>
            <small>
                <?php  
                    if(get_option('cinecode_footer_text')!==''):
                        echo esc_html(get_option('cinecode_footer_text'));/* sanitiza e ignora el texto en html */
                    else: 
                    ?>
                        &copy; <?php  echo date('Y'); ?> por irving
                    <?php  
                    endif;
                ?>
            </small>
        </p>
        
    </div>

</body>
 <?php wp_footer(); ?>
</html>