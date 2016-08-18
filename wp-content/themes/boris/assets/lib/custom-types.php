<?php

/*
 *
 * Custom Post Types
 *
 */

// Note that you only need the arguments and register_post_type function here. They are hooked into WordPress in functions.php.

$labels = array(
  'name'                  => __( 'Works' ),
  'singular_name'         => __( 'Work' ),
  'menu_name'             => __( 'Works', 'text_domain' ),
  'name_admin_bar'        => __( 'work', 'text_domain' ),
  'archives'              => __( 'Item Archives', 'text_domain' ),
  'parent_item_colon'     => __( 'Parent work:', 'text_domain' ),
  'all_items'             => __( 'All works', 'text_domain' ),
  'add_new_item'          => __( 'Add New work', 'text_domain' ),
  'add_new'               => __( 'Add New work', 'text_domain' ),
  'new_item'              => __( 'New work', 'text_domain' ),
  'edit_item'             => __( 'Edit work', 'text_domain' ),
  'update_item'           => __( 'Update work', 'text_domain' ),
  'view_item'             => __( 'View work', 'text_domain' ),
  'search_items'          => __( 'Search work', 'text_domain' ),
  'not_found'             => __( 'Not found', 'text_domain' ),
  'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  'featured_image'        => __( 'Featured Image', 'text_domain' ),
  'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
  'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
  'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
  'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
  'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
  'items_list'            => __( 'work list', 'text_domain' ),
  'items_list_navigation' => __( 'work list navigation', 'text_domain' ),
  'filter_items_list'     => __( 'Filter work list', 'text_domain' ),
);
$args = array(
  'label'                 => __( 'work', 'text_domain' ),
  'description'           => __( 'Work examples', 'text_domain' ),
  'labels'                => $labels,
  'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
  'taxonomies'            => array( ),
  'hierarchical'          => false,
  'public'                => true,
  'show_ui'               => true,
  'show_in_menu'          => true,
  'menu_position'         => 25,
  'menu_icon'             => 'dashicons-smiley',
  'show_in_admin_bar'     => true,
  'show_in_nav_menus'     => true,
  'can_export'            => true,
  'has_archive'           => true,
  'exclude_from_search'   => true,
  'publicly_queryable'    => true,
  'capability_type'       => 'post',
);
register_post_type( 'work', $args );
