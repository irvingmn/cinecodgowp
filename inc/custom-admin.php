<?php
//https://codex.wordpress.org/Dashboard_Widgets_API
//https://codex.wordpress.org/Plugin_API/Admin_Screen_Reference
//https://codex.wordpress.org/Administration_Screens
//https://codex.wordpress.org/Adding_Administration_Menus
if ( !function_exists( 'cinecode_admin_scripts' ) ):
  function cinecode_admin_scripts () {
    wp_register_style( 'custom-properties', get_stylesheet_directory_uri() . '/css/custom_properties.css', array(), '1.0.0', 'all' );
    wp_register_style( 'admin-page-style', get_template_directory_uri() . '/css/admin_page.css', array(), '1.0.0', 'all' );

    wp_enqueue_style( 'custom-properties' );
    wp_enqueue_style( 'admin-page-style' );

    wp_register_script( 'admin-page-script', get_template_directory_uri() . '/js/admin_page.js', array('jquery'), '1.0.0', true );
    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'admin-page-script' );
  }
endif;
add_action( 'admin_enqueue_scripts', 'cinecode_admin_scripts' );


if ( !function_exists( 'cinecode_add_editor_styles')):
  function cinecode_add_editor_styles () {
    add_editor_style('https://fonts.googleapis.com/css?family=Kosugi+Maru|Roboto');
    add_editor_style('css/custom_properties.css');
    add_editor_style('css/custom_editor_style.css');
  }
endif;
add_action( 'admin_init', 'cinecode_add_editor_styles' ); /* hook para modificar estilos de adminWP */


if ( !function_exists( 'cinecode_admin_menu' ) ):
  function cinecode_admin_menu () {
    //remove_menu_page('edit.php'); // Entradas
    //remove_menu_page('upload.php'); // Multimedia
    //remove_menu_page('link-manager.php'); // Enlaces
    //remove_menu_page('edit.php?post_type=page'); // Páginas
    //remove_menu_page('edit-comments.php'); // Comentarios
    //remove_menu_page('themes.php'); // Apariencia
    //remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('users.php'); // Usuarios
    //remove_menu_page('tools.php'); // Herramientas
    //remove_menu_page('options-general.php'); // Ajustes
  }
endif;
add_action( 'admin_menu', 'cinecode_admin_menu' );

if ( !function_exists( 'cinecode_before_admin_bar' ) ):
  function cinecode_before_admin_bar () {
    global $wp_admin_bar;
    /*
      search:para eliminar la caja de búsqueda
      comments:Para eliminar el aviso de comentarios
      updates:Eliminar el aviso de actualizaciones
      edit:Elimina editar entrada y páginas
      get-shortlink:Proporciona un enlace corto a esa página/post
      my-sites:Elimina el menu my sitios, si utilizas la función multisitios de wordpress
      site-name:Elimina el nombre de la web
      wp-logo:Elimina el logo(y el sub Menú)
      my-account:Elimina los enlaces a su cuenta. El ID depende de si usted tiene Avatar habilitado o no.
      view-site:Elimina el sub menú que aparece al pasar el cursor sobre el nombre de la web
      about:Elimina el enlace “Sobre WordPress
      wporg:Elimina el enlace a wordpress.org
      documentation:Elimina el enlace a la documentación oficial(Codex)
      support-forums:Elimina el enlace a los foros de ayuda
      feedback:Elimina el enlace Sugerencias
    */
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('comments');
  }
endif;


add_action( 'wp_before_admin_bar_render', 'cinecode_before_admin_bar' ); /* quita elementos del admin-bar del wordpress */

if ( !function_exists( 'cinecode_admin_bar_menu' ) ):
  function cinecode_admin_bar_menu () {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
      'id' => 'mi_menu',
      'title' => __('Mis Redes', 'cinecode'),
      'href' => false
    ) );
    $wp_admin_bar->add_menu( array(
      'parent' => 'mi_menu',
      'id' => 'link-jonmircha',
      'title' => __('webdesignrs', 'cinecode'),
      'href' => __('https://webdesignrs.com')
    ) );
    $wp_admin_bar->add_menu( array(
      'parent' => 'mi_menu',
      'id' => 'link-facebook',
      'title' => __('Facebook', 'cinecode'),
      'href' => __('https://facebook.com/')
    ) );
    $wp_admin_bar->add_menu( array(
      'parent' => 'mi_menu',
      'id' => 'link-twitter',
      'title' => __('Twitter', 'cinecode'),
      'href' => __('https://twitter.com/')
    ) );
  }
endif;
add_action( 'admin_bar_menu', 'cinecode_admin_bar_menu' ); /* añadir menu perzonalizado a bar-admin */

if ( !function_exists( 'cinecode_user_contactmethods' ) ):
  function cinecode_user_contactmethods ($data_user) {
    $data_user['facebook']=__('Facebook');
    $data_user['twitter']=__('Twitter');
    return $data_user;
  }
endif;
add_filter( 'user_contactmethods', 'cinecode_user_contactmethods' ); /* agregar opcion para que usario agrege sus redes sociales */

if ( !function_exists( 'cinecode_admin_footer_text' ) ):
  function cinecode_admin_footer_text () {
    return '<i>
      Sitio creado por
      <a href="https://webdesignrs.com" target="_blank">webdesignrs.com</a>.
    </i>';
  }
endif;
add_filter( 'admin_footer_text', 'cinecode_admin_footer_text' );


if ( !function_exists( 'mawt_wp_dashboard_setup' ) ):
  function mawt_wp_dashboard_setup () {
    //Actividad
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    //De un vistazo
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    // Comentarios recientes
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    // Enlaces entrantes
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    // Plugins
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    //Publicación rápida
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    // Borradores recientes
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    //Noticas del blog de WordPress
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    //Otras noticias de WordPress
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
  }
endif;
add_action( 'wp_dashboard_setup', 'mawt_wp_dashboard_setup' ); /* quitar opciones de dashboard INICIO */

?>