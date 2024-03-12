<?php 
function ls_create_promotions() {
	$labels = array(
		'name'                => 'Promotions',
		'singular_name'       => 'Promotion',
		'add_new'             => 'Add Promotion',
		'all_items'           => 'All Promotions',
		'add_new_item'        => 'Add New Promotion',
		'edit_item'           => 'Edit Promotion',
		'new_item'	          => 'New Promotion',
		'view_item'           => 'View Promotion',
		'search_items'        => 'Search Promotions',
		'not_found'           => 'No Promotions found',
		'not_found_in_trash'  => 'No Promotions found in Trash',
		'parent_item_colon'   => 'Parent Promotion:',
		'menu_name'           => 'Promotions',
		'update_item'         => 'Update Promotion',	
	);

	$args = array(
		'label'               => 'Promotions',
		'description'         => 'Promotions post type',
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => false,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'taxonomies'		  => array('promotion_type'), // Singular name
		'menu_position'       => 6,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'show_in_rest'		  => true,	
		'menu_icon' => 'dashicons-clipboard',
	);

	register_post_type( 'promotions', $args );
}
add_action( 'init', 'ls_create_promotions', 0 );


//Promotion Type
function ls_create_promotion_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Promotion Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Promotion Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Promotion Categories', 'textdomain' ),
		'all_items'         => __( 'All Promotion Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Promotion Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Promotion Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Promotion Category', 'textdomain' ),
		'update_item'       => __( 'Update Promotion Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Promotion Category', 'textdomain' ),
		'new_item_name'     => __( 'New Promotion Category Name', 'textdomain' ),
		'menu_name'         => __( 'Promotion Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'promotion_category' ), 
		'show_in_rest' => true,
	);

	register_taxonomy( 'promotion_category', array( 'promotions' ), $args ); 
}
add_action( 'init', 'ls_create_promotion_taxonomies', 0 );

add_action( 'init', function () {
	add_ux_builder_post_type( 'promotions' );
} );