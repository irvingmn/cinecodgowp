<?php  
/* Da de alta una seccion(menu) de 'Ajustes de menu' en el WP-Admin */
if(!function_exists('cinecode_custom_theme_options_menu')):
    function cinecode_custom_theme_options_menu(){
        add_menu_page('Ajustes del tema', 'Ajustes del Tema', 'administrator', 'custom_theme_options','cinecode_custom_theme_options_form', 'dashicons-admin-generic',20);
    }
endif;
add_action('admin_menu','cinecode_custom_theme_options_menu');

if(!function_exists('cinecode_custom_theme_options_form')): /* formulario en admin para cambiar texto en el footer */
    function cinecode_custom_theme_options_form(){           
    ?> 
        <div class="wrap">
            <h1><?php  _e('Ajustes y Opciones del Tema', 'mawt'); ?></h1>
            <form action="options.php" method="post">
                <?php  
                   settings_fields('cinecode_options_group'); /* captura opciones del grupo */
                   do_settings_sections('cinecode_options_group');/* imprime y regresa a la misma pagina */
                ; ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Texto del footer</th>
                    </tr>
                    <td>
                        <input type="text" name="cinecode_footer_text" value="<?php echo esc_attr(get_option('cinecode_footer_text'));?>"> <!-- evita(limpia) el texto html o sql -->
                    </td>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
    <?php
    }     
endif;

if(!function_exists('cinecode_custom_theme_options_register')):  /* hace registro de texto footer en ajustes de menu */
    function cinecode_custom_theme_options_register(){
        /* un registro por opcion */
        register_setting('cinecode_options_group','cinecode_footer_text');
    }
endif;

add_action('admin_init','cinecode_custom_theme_options_register');

?>
