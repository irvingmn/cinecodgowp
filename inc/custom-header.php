<?php  
    if(!function_exists('cinecode_custom_header')):
    function cinecode_custom_header(){
					/* activamos cabecera configurable
					*/
        add_theme_support('custom-header',apply_filters('cinecode_custom_header_args', 
            array(
                'default-image'=>get_template_directory_uri().'/img/header-image.jpg',
                'default-text-color'=>'F60',
                'width'=>1200,
				'height'=>720,
				'flex-width'=>true,
                'flex-height'=>true,
                'video'=>true,
                'wp-head-callback'=>'cinecode_wp_header_style' 
        ))  );
    } 
    endif;
    
	add_action('after_setup_theme','cinecode_custom_header');

    if(!function_exists('cinecode_wp_header_style')):
        function cinecode_wp_header_style(){
          $header_text_color=get_header_textcolor();
       
?>

<style>
    .WP-Header-branding * {
   		color:#<?php echo esc_attr($header_text_color);?>
        
    }
</style>

<?php
 }
endif;



