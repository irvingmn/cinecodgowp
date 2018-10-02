<?php
/**
 * Cinecodigo tema 
 
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage cinecod
 * @since cinecode 1.0
 */


 if (!function_exists('cincode_scrips')):
    function cincode_scrips (){
        
        wp_register_style('google-fonts','https://fonts.googleapis.com/css?family=Kosugi+Maru|Roboto', array(),'1.0.0', 'all');
        wp_register_style('style', get_stylesheet_uri(), array('google-fonts'),'1.0.0', 'all');

        wp_enqueue_style('google-fonts');
        wp_enqueue_style('style');

        wp_register_script('scripts', get_template_directory_uri().'/script.js',array('jquery'),'1.0.0', true);

        wp_enqueue_script('jquery'); 
        wp_enqueue_script('scripts'); 
    }
 endif;
 add_action('wp_enqueue_scripts','cincode_scrips');


if (!function_exists('cincode_setup')):
    function cincode_setup(){ 
        /* traducciones 
        https://www.icanlocalize.com/tools/php_scanner Genera archibo PO
        */
        load_theme_textdomain('cinecode', get_template_directory().'languages');

        add_theme_support('post-thumbnails');

        add_theme_support('html5',array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'captions '
        ));
        
        add_theme_support('custom-logo', array(  /* customizar logo de pagina*/
            'height' => 100,
            'width' => 100,
            'flex-height'=> true, /* usuario puede resterizar el logo alto */
            'flex-width' => true  /* "" ancho */
        ));

        add_theme_support('custom-background', array(  /* customizar logo de pagina*/
            'default-color' => 'DDD',
            'default-image' => get_template_directory_uri().'/img/background-image.png',
            'default-repeat'=> 'norepeat', 
            'default-position-x' =>'', 
            'default-position-y' =>'',
            'default-size' =>'',
            'default-attachment' =>'fixed'
        ));

        /* activa lalos lapices de edicion en widgets (en parte de personalizar tema) */
        add_theme_support('customize-selective-refresh-widgets');


    }
 endif;
 add_action('after_setup_theme','cincode_setup');


 if (!function_exists('cinecode_menus')):
    function cinecode_menus(){ 
        register_nav_menus(array(
            'main_menu'=>__('Menu Principal','cincode'), /* menu 1 */
            'social_menu'=>__('Menu Social','cincode'), /* menu 2 */
            'site_menu'=>__('Menu sitemap','cincode') /* menu 3 */
        )); /* nav_menu=1 / nav_menus = varios*/
    }
 endif;
 add_action('init', 'cinecode_menus');

 if (!function_exists('cinecode_register_sidebars')):
    function cinecode_register_sidebars(){ 
        register_sidebar(array(
            'name'=>__('Sidebar Principal', 'cinecode'),
            'id'=>'main_sidebar',
            'description'=>__('Tu sidebar principal', 'cinecode'),
            'before_widget'=>'<article id="%1$s" class="Widget %2$s">',
            'after_widget'=>'</article>',
            'after_widget'=>'</article>',
            'after_title'=>'<h3>',
            'after_title'=>'</h3>'
        )); 

        register_sidebar(array(
            'name'=>__('Sidebar lateral', 'cinecode'),
            'id'=>'left_sidebar',
            'description'=>__('Tu sidebar izquierdo', 'cinecode'),
            'before_widget'=>'<article id="%1$s" class="Widget %2$s">',
            'after_widget'=>'</article>',
            'after_widget'=>'</article>',
            'after_title'=>'<h3>',
            'after_title'=>'</h3>'
        ));
    }
 endif; 
 add_action('widgets_init', 'cinecode_register_sidebars');

 /* Invocacion de archivos */
 require_once get_template_directory().'/inc/custom-header.php'; 
 require_once get_template_directory().'/inc/customizer.php'; 
 require_once get_template_directory().'/inc/custom-login.php'; 
 require_once get_template_directory().'/inc/custom-admin.php'; 
 require_once get_template_directory().'/inc/custom-post-types.php'; 

 ?>