<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="<?php language_attributes('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php wp_title('|', true, 'right')?></title>
  <?php wp_head();?>
</head>
<body>
<?php get_header('wp');?>
  <header class="header">
    <div class="logo">
        <?php  /* si el logo es config muestra la img, si no el enlace */
         if(has_custom_logo()):
          the_custom_logo();
         else:
          echo '<a href="'.esc_url(home_url('/')).'">'.get_bloginfo('name').'</a>';
         endif;
          ; 
        
        ?>
        <!-- <a href="<?php /* echo esc_url( home_url('/')); */?>">LOGO</a>  -->
    </div>
    <?php   
      if(has_nav_menu('main_menu')):
        wp_nav_menu(array(
          'theme_location' => 'main_menu', /* cual es el menu que definimos en functions */
          'container' => 'nav', /* que etiqueta contenedora tendra */
          'container_class' => 'Menu' /* que clase se le agregara */
        ));
    else:?>
    <nav class="Menu">
      <?php  wp_list_pages('title_li') ?>
    </nav>
    <?php endif;?>
  </header>
  <main class="Main">