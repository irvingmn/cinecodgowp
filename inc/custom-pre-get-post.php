<?php  
if(! function_exists('cinecode_show_post_types_in_loop')):
    function cinecode_show_post_types_in_loop($query){
        if(!is_admin()&& $query->is_main_query()): /* validacion para no mostrar entradas o paginas*/
            $query->set('post_type',array('post','page','festivales'));
        endif;
    }
endif;
add_action('pre_get_posts', 'cinecode_show_post_types_in_loop'); 

?>