<?php  

    /* https://codex.wordpress.org/Customizing_the_Login_Form */

    if (!function_exists('cincode_login_scrips')):
        function cincode_login_scrips (){
            
            wp_register_style('google-fonts','https://fonts.googleapis.com/css?family=Kosugi+Maru|Roboto', array(),'1.0.0', 'all');
            wp_register_style('custom-properties', get_template_directory_uri().'/css/custom_properties.css',array(), '1.0.0','all');
            wp_register_style('login-page-style', get_template_directory_uri().'/css/login-page.css',array('google-fonts','custom-properties'), '1.0.0','all');
    
            wp_enqueue_style('google-fonts');
            wp_enqueue_style('custom-properties');
            wp_enqueue_style('login-page-style');
    
            wp_register_script('login-page-scripts', get_template_directory_uri().'/js/login-page.js',array('jquery'),'1.0.0', true);
    
            wp_enqueue_script('jquery'); 
            wp_enqueue_script('login-page-scripts');  
        }
     endif;
     add_action('login_enqueue_scripts','cincode_login_scrips');

     /* cambia url al logo de el login en adminstrador */
     if (!function_exists('cincode_login_logo_url')):
        function cincode_login_logo_url (){

            return home_url();
          
        }
     endif;
     add_filter('login_headerurl','cincode_login_logo_url');

     /* cambia el texto del logo de el login en adminstrador */
     if (!function_exists('cincode_login_logo_url_title')):
        function cincode_login_logo_url_title(){
        return get_bloginfo('title').'|'. get_bloginfo('description');
          
        }
     endif;
     add_filter('login_headertitle','cincode_login_logo_url_title');