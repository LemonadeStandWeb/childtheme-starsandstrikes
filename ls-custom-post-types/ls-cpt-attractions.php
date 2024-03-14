<?php 
function ls_create_attractions() {
	$labels = array(
		'name'                => 'Attractions',
		'singular_name'       => 'Attraction',
		'add_new'             => 'Add Attraction',
		'all_items'           => 'All Attractions',
		'add_new_item'        => 'Add New Attraction',
		'edit_item'           => 'Edit Attraction',
		'new_item'	          => 'New Attraction',
		'view_item'           => 'View Attraction',
		'search_items'        => 'Search Attractions',
		'not_found'           => 'No Attractions found',
		'not_found_in_trash'  => 'No Attractions found in Trash',
		'parent_item_colon'   => 'Parent Attraction:',
		'menu_name'           => 'Attractions',
		'update_item'         => 'Update Attraction',	
	);

	$args = array(
		'label'               => 'Attractions',
		'description'         => 'Attractions post type',
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => false,	
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'taxonomies'		  => array('attraction_type'),
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

	register_post_type( 'attractions', $args );
}
add_action( 'init', 'ls_create_attractions', 0 );


//Attraction Type
function ls_create_attraction_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Attraction Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Attraction Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Attraction Categories', 'textdomain' ),
		'all_items'         => __( 'All Attraction Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Attraction Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Attraction Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Attraction Category', 'textdomain' ),
		'update_item'       => __( 'Update Attraction Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Attraction Category', 'textdomain' ),
		'new_item_name'     => __( 'New Attraction Category Name', 'textdomain' ),
		'menu_name'         => __( 'Attraction Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'attraction_category' ),
		'show_in_rest' => true,
	);

	register_taxonomy( 'attraction_category', array( 'attractions' ), $args );
}
add_action( 'init', 'ls_create_attraction_taxonomies', 0 );

add_action( 'init', function () {
	add_ux_builder_post_type( 'attractions' );
} );