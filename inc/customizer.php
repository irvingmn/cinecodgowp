 

<?php 
/* Archivo para cutomizar en tiempo real el texto de titulo y subtiulo en el perzonalizador */ 
if(!function_exists('cinecode_customize_register')):
    function cinecode_customize_register($wp_customize){
     $wp_customize->get_setting('blogname')->transport ='postMessage'; /* modifica txt en perzonalizador */
     $wp_customize->get_setting('blogdescription')->transport ='postMessage';  /* modifica txt en perzonalizador */


    if(isset($wp_customize->selectetive_refresh)){
        $wp_customize->selectetive_refresh->add_partial('blogname', array(
            'selector'=>'.WP-Header-title', /* clase en css */
            'render_callback'=>'cinecode_cuztomize_blogname'
        ));

        $wp_customize->selectetive_refresh->add_partial('blogdescription', array(
            'selector'=>'.WP-Header-description',
            'render_callback'=>'cinecode_cuztomize_blogdescription'
        ));
    }
} 
endif;

if(!function_exists('cinecode_coustomize_blogname')):
    function cinecode_coustomize_blogname () {
        bloginfo('name');
    }
endif; 

if(!function_exists('cinecode_coustomize_blogdescription')):
    function cinecode_coustomize_blogdescription () {
        bloginfo('description');
    }
endif; 
