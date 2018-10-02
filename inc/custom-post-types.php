<?php
/*  Crear un nuevo tipo de post para woirdpress */
function custom_post_type() {
  $labels = array(
    'name' => _x( 'Post Types', 'Post Type General Name', 'cinecode' ), /* _x traducciones al dashboard */
    'singular_name' => _x( 'Post Type', 'Post Type Singular Name', 'cinecode' ),
    'menu_name' => __( 'Post Types', 'cinecode' ),
    'name_admin_bar' => __( 'Post Type', 'cinecode' ),
    'archives' => __( 'Item Archives', 'cinecode' ),
    'attributes' => __( 'Item Attributes', 'cinecode' ),
    'parent_item_colon' => __( 'Parent Item:', 'cinecode' ),
    'all_items' => __( 'All Items', 'cinecode' ),
    'add_new_item' => __( 'Add New Item', 'cinecode' ),
    'add_new' => __( 'Add New', 'cinecode' ),
    'new_item' => __( 'New Item', 'cinecode' ),
    'edit_item' => __( 'Edit Item', 'cinecode' ),
    'update_item' => __( 'Update Item', 'cinecode' ),
    'view_item' => __( 'View Item', 'cinecode' ),
    'view_items' => __( 'View Items', 'cinecode' ),
    'search_items' => __( 'Search Item', 'cinecode' ),
    'not_found' => __( 'Not found', 'cinecode' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'cinecode' ),
    'featured_image' => __( 'Featured Image', 'cinecode' ),
    'set_featured_image' => __( 'Set featured image', 'cinecode' ),
    'remove_featured_image' => __( 'Remove featured image', 'cinecode' ),
    'use_featured_image' => __( 'Use as featured image', 'cinecode' ),
    'insert_into_item' => __( 'Insert into item', 'cinecode' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'cinecode' ),
    'items_list' => __( 'Items list', 'cinecode' ),
    'items_list_navigation' => __( 'Items list navigation', 'cinecode' ),
    'filter_items_list' => __( 'Filter items list', 'cinecode' ),
  );
  $args = array(
    'label' => __( 'Post Type', 'cinecode' ),
    'description' => __( 'Post Type Description', 'cinecode' ),
    'labels' => $labels,
    // las taxonomías que soportará
    'taxonomies' => array( 'category', 'post_tag' ),
    // Todo lo que soporta este post type
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
		//hierarchical true se comporta como página, false como entrada
		'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    //El icono que tendrá https://developer.wordpress.org/resource/dashicons
    'menu_icon' => 'dashicons-admin-site',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
  );
  register_post_type( 'a_post_type', $args );
}
add_action( 'init', 'custom_post_type', 0 );
?>