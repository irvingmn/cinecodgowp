<article class="Content">

<?php 
/* query_posts(null); */ /* para el loop de la clase wp-query no afecte el loop normal*/

if(have_posts()):while(have_posts()):the_post();?>
  <article>
      
      <!-- imagen destcada -->
      <img src="<?php  echo get_the_post_thumbnail_url()?>" alt="<?php  echo get_the_title() ?>">
      <h2><a href="<?php the_permalink();?>"> <?php  the_title() ?></a></h2><!-- permalink -->

      <?php
        the_excerpt();  /* extraxto de entrada */
        the_category(); /* categoria de entrada en list*/
        the_tags(); echo "<br> <br>";/* etiquetas de la entrada */
        the_time(get_option('date_format')); echo "<br> <br>";  /* fecha desde admin */
        the_author_posts_link(); /* autor con link  */
      ?>
      <h3>Custom Fields & Metaboxes</h3>
      <?php  the_meta();?> <!-- agrega todos los custom fields -->
      <p>
        <?php  echo get_post_meta(get_the_ID(),'Año', true); ?>
      </p> 
      <p>
        <?php  echo get_post_meta(get_the_ID(),'Director', true); ?>
      </p>
      <h3>AFC</h3>
      <p>
        <?php echo get_field('estrenos_pais'); ?>
      </p> 
      <p><?php the_category(',');?></p>  <!-- cat separado por coma -->
    
  </article>
  <?php  comments_template(); ?>
  <hr>
  <?php endwhile;else:?>
  <p>el contenido no existe</p>
  <?php endif; wp_reset_query();wp_reset_postdata(); ?>
</article>
<section class=" Pagination Other">
  <?php  previous_post_link(); ?> <!-- paginacion flechas -->
  <?php  next_post_link(); echo "<br> <br>"; ?>  
  <?php  echo paginate_links(); ?> <!-- por numeros -->
</section>