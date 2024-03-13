<?php 
function ls_create_locations() {
	$labels = array(
		'name'                => 'Locations',
		'singular_name'       => 'Location',
		'add_new'             => 'Add Location',
		'all_items'           => 'All Locations',
		'add_new_item'        => 'Add New Location',
		'edit_item'           => 'Edit Location',
		'new_item'	          => 'New Location',
		'view_item'           => 'View Location',
		'search_items'        => 'Search Locations',
		'not_found'           => 'No Locations found',
		'not_found_in_trash'  => 'No Locations found in Trash',
		'parent_item_colon'   => 'Parent Location:',
		'menu_name'           => 'Locations',
		'update_item'         => 'Update Location',	
	);

	$args = array(
		'label'               => 'Locations',
		'description'         => 'Locations post type',
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => false,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'taxonomies'		  => array('location_type'), // Singular name
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

	register_post_type( 'locations', $args );
}
add_action( 'init', 'ls_create_locations', 0 );


//Location Type
function ls_create_location_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Location Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Location Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Location Categories', 'textdomain' ),
		'all_items'         => __( 'All Location Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Location Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Location Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Location Category', 'textdomain' ),
		'update_item'       => __( 'Update Location Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Location Category', 'textdomain' ),
		'new_item_name'     => __( 'New Location Category Name', 'textdomain' ),
		'menu_name'         => __( 'Location Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'locations_category' ), 
		'show_in_rest' => true,
	);

	register_taxonomy( 'location_category', array( 'locations' ), $args ); 
}
add_action( 'init', 'ls_create_location_taxonomies', 0 );

add_action( 'init', function () {
	add_ux_builder_post_type( 'locations' );
} );