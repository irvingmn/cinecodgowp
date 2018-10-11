<?php  
/* Da de alta una seccion(menu) de 'Ajustes de menu' en el WP-Admin */
//https://codex.wordpress.org/Class_Reference/wpdb
//https://developer.wordpress.org/reference/classes/wpdb/

if(!function_exists('cinecode_contact_table')):
    function cinecode_contact_table(){
        global $wpdb; /*  */
        global $contact_table_version; /* variable global referencia a mi tabla */
        $contact_table_version = '1.0.0';
        $table = $wpdb->prefix . 'contact_form'; /* nombre de mi tabla concatenado prefigo de tablas */
        $charset_collate = $wpdb->get_charset_collate(); /* caracter charset de la tabla  */
        $sql = "
        CREATE TABLE $table (
            contact_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            subject VARCHAR(50) NOT NULL,
            comments LONGTEXT NOT NULL,
            contact_date DATETIME NOT NULL,
            PRIMARY KEY (contact_id)
        ) $charset_collate;
        ";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';  
        dbDelta( $sql ); /* cada modificacion a bd wordpress se establece con dbDelta y pasamos codigo sql que ejecutaremos*/
        add_option( 'contact_table_version', $contact_table_version ); /* creamos opcion  para guardar version de mi tabla*/
    }
endif;
add_action('after_setup_theme','cinecode_contact_table'); 

if(!function_exists('cinecode_contact_form_menu')):
    function cinecode_contact_form_menu(){
        add_menu_page('Contacto', 'Contacto', 'administrator', 'contact_form','cinecode_contact_form_comments', 'dashicons-admin-id-alt',20);

        /* sub pagina */
        add_submenu_page('contact_form', 'Todos los contactos', 'Todos los contactos', 'administrator', 'contact_form_comments', 'cinecode_contact_form_comments');
    }
endif;
add_action('admin_menu','cinecode_contact_form_menu');

if(!function_exists('cinecode_contact_form_comments')): /* formulario en admin para cambiar texto en el footer */
    function cinecode_contact_form_comments(){ 
             
    ?> 
        <div class="wrap">
            <h1><?php  _e('Comentarios de la página de coantacto','cinecode'); ?></h1>
            <table class="wp-list-table widefat striped">
                <thead>
                    <tr>
                        <th class="manage-column"><?php _e('Id', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Nombre', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Email', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Asunto', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Comentarios', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Fecha', 'cinecode'); ?></th>
                        <th class="manage-column"><?php _e('Eliminar', 'cinecode'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        global $wpdb;
                        $table = $wpdb->prefix . 'contact_form';
                        $rows = $wpdb->get_results( "SELECT * FROM $table", ARRAY_A );
                    // echo '<pre>';
                    //   var_dump($rows);
                    // echo '</pre>';
                        foreach ($rows as $row):
                    ?>
                        <tr>
                        <td><?php echo $row['contact_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['comments']; ?></td>
                        <td><?php echo $row['contact_date']; ?></td>
                        <td>
                            <a href="#" class="u-delete" data-contact-id="<?php echo $row['contact_id']; ?>"> <!-- se controla con ajax el link y con data-atributes (data-contact-id) de html5 sabra a que link va -->
                            Eliminar
                            </a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>  
    <?php
    }     
endif;

//https://codex.wordpress.org/Shortcode_API
//https://codex.wordpress.org/Function_Reference/add_shortcode
if ( !function_exists('cinecode_contact_form')):
    function cinecode_contact_form ($atts) {
  ?>
      <form class="ContactForm" method="POST">
       <legend><?php echo $atts['title']; ?></legend>
       <input type="text" name="name" placeholder="Escribe tu nombre">
       <input type="email" name="email" placeholder="Escribe tu email">
       <input type="text" name="subject" placeholder="Asunto a tratar">
        <textarea name="comments" cols="50" rows="5" placeholder="Escribe tus comentarios"></textarea>
        <input type="submit" value="Enviar">
        <input type="hidden" name="send_contact_form"  value="1" >
      </form>
    <?php
    }
  endif;
  add_shortcode( 'contact_form', 'cinecode_contact_form' ); /*  */


 if (!function_exists('cincode_contact_scripts')):
    function cincode_contact_scripts(){
    if(is_page('contacto')):
        wp_register_style('contact-form-style', get_template_directory_uri().'/css/contact_form.css', array(),'1.0.0','all');
        wp_enqueue_style('contact-form-style');

        wp_register_script('contact_form_script', get_template_directory_uri().'/js/contact_form.js',array(),'1.0.0', true);
        wp_enqueue_script('contact_form_script'); 
    endif;
    }
 endif;
 add_action('wp_enqueue_scripts','cincode_contact_scripts');


 if (!function_exists('cincode_contact_form_save')):
    function cincode_contact_form_save(){
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['send_contact_form'])): /*SI var global server para el metodo request sea (exactamnet===) e igual a post (y&&) isset evalua si existe una variable(send_contact_form) ejecuta */

    global $wpdb;
    $name = sanitize_text_field($_POST['name']); /* sanitize impide que se inyecte codigo malicioso desde el form y afectar la bd */
    $email = sanitize_text_field($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $comments = sanitize_text_field($_POST['comments']);
        
    $table= $wpdb->prefix.'contact_form';
    
    /*arreglo asociativo de los datos y tiene qu concidir con el nombre en bd*/
    $form_data = array( 
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'comments' => $comments,
        'contact_date' => date('Y-m-d H:m:s')
    );

    $form_formats =array('%s','%s','%s','%s','%s');  /* arreglo posicional */
    $wpdb ->insert($table,$form_data, $form_formats); /* insertar datos con (nombre de la tabla, datatos, y validacion de tipo de dato */ 

    $url= get_page_by_title('Gracias por tus comentarios'); /* obtener id de publicacion por titulo  */
    wp_redirect(get_permalink($url->ID)); /* redireccionar por la variable url a traves del id */
    exit(); /* para que ya no procese nada al navegador */
    endif;
    }
 endif;
 add_action('init','cincode_contact_form_save');


 if (!function_exists('cincode_contact_admin_scripts')):
    function cincode_contact_admin_scripts(){
        wp_register_script('contact_form_admin_script', get_template_directory_uri().'/js/contact_form_admin.js',array('jquery'),'1.0.0', true);

        wp_enqueue_script('contact_form_admin_script'); 

        wp_localize_script( /* permitir pasar valores de PHP A JS  */
            'contact_form_admin_script', /* al archivo  contact_form_admin_script le paso el objeto "contact_form" con parametros */
            'contact_form',
            array(
                'name'=> 'Modulo de comentarios de contacto',
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }
 endif;

 /* ajax ce wo */
 add_action('admin_enqueue_scripts','cincode_contact_admin_scripts'); /* se ejecuta en el admin_enqueu_scrips */

 if(!function_exists('cinecode_contact_form_delete')):
    function cinecode_contact_form_delete(){
        if(isset($_POST['id'])): /* eliminar id de la peticion en el (confirmDelete contact_form.js) */
             global $wpdb;
             $table = $wpdb ->prefix.'contact_form'; /* nonbre de la tabla en BD */
            $delete_row = $wpdb->delete($table, array( 'contact_id' => $_POST['id'] ), array('%d'));

            if ( $delete_row ) {
                $response = array(
                  'err' => false,
                  'msg' => 'Se elimino el comentario con el ID ' . $_POST['id']
                );
              } else {
                $response = array(
                  'err' => true,
                  'msg' => 'NO se elimino el comentario con el ID ' . $_POST['id']
                );
              }
              die( json_encode($response) ); /* metodo die y se manda decodificada en json para que wp lo interpete con js */
        endif;
    }
 endif;
 add_action('wp_ajax_cinecode_contact_form_delete','cinecode_contact_form_delete'); /*accion para que el ajax de wp ejecute nuestra funcion  */
?>