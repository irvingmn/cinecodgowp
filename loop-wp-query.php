
<section class="WP-Query">
    <?php  
        /* WP_Query nos sirve para mostrar varios loops personalizados */
        $wp_query = new WP_Query(array(
            'pos_per_page' => 4, /*  post por pagina*/
            'orderby' => 'rand'
        ));
        if($wp_query -> have_posts()):
            while($wp_query -> have_posts()):  /* se invoca el wpquery */
                $wp_query -> the_post();
    ?>
            <!-- nos imprime una figura con link y tumbnalil  -->
            <figure>
                <a href="<?php the_permalink(); ?>"></a>
                <?php the_post_thumbnail('thumbnail'); ?>
                <?php the_title('<figcaption>', '</figcaption>'); ?>
            </figure>
    <?php
            endwhile;
        endif;
        wp_reset_postdata(); /* limpia el loop y las variables  */
     ?>
</section>