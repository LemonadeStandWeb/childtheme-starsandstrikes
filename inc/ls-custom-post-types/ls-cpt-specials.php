<?php 
function ls_create_specials() {
	$labels = array(
		'name'                => 'Specials',
		'singular_name'       => 'Special',
		'add_new'             => 'Add Special',
		'all_items'           => 'All Specials',
		'add_new_item'        => 'Add New Special',
		'edit_item'           => 'Edit Special',
		'new_item'	          => 'New Special',
		'view_item'           => 'View Special',
		'search_items'        => 'Search Specials',
		'not_found'           => 'No Specials found',
		'not_found_in_trash'  => 'No Specials found in Trash',
		'parent_item_colon'   => 'Parent Special:',
		'menu_name'           => 'Specials',
		'update_item'         => 'Update Special',	
	);

	$args = array(
		'label'               => 'Specials',
		'description'         => 'Specials post type',
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => false,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'taxonomies'		  => array('special_type'), 
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

	register_post_type( 'specials', $args );
}
add_action( 'init', 'ls_create_specials', 0 );


//Special Type
function ls_create_special_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Special Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Special Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Special Categories', 'textdomain' ),
		'all_items'         => __( 'All Special Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Special Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Special Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Special Category', 'textdomain' ),
		'update_item'       => __( 'Update Special Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Special Category', 'textdomain' ),
		'new_item_name'     => __( 'New Special Category Name', 'textdomain' ),
		'menu_name'         => __( 'Special Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'special_category' ), 
		'show_in_rest' => true,
	);

	register_taxonomy( 'special_category', array( 'specials' ), $args ); 
}
add_action( 'init', 'ls_create_special_taxonomies', 0 );

add_action( 'init', function () {
	add_ux_builder_post_type( 'specials' );
} );