<?php  /* Template name: Pagina de ancho completo */; ?>
 <?php  get_header(); ?>
<?php  while(have_posts()):the_post(); ?>
<section>
    <?php  the_title(); ?>
    <?php the_content();?>
</section> 
<ol>
    <?php  comments_template(); ?>
</ol>
<?php  endwhile; ?>

<?php  get_footer(); ?>