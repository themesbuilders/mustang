<?php

// Services post type.
class Services_CPT {

	// Constructor.
	public function __construct()
	{
		add_action( 'init', array( &$this, 'mustang_services_init' ), 0 );
	}

	// Register post type.
	public function mustang_services_init()
	{
		$labels = array(
			'name'               => _x( 'Services', 'post type general name', 'mustang' ),
			'singular_name'      => _x( 'Services', 'post type singular name', 'mustang' ),
			'menu_name'          => _x( 'Our Services', 'admin menu', 'mustang' ),
			'name_admin_bar'     => _x( 'Services', 'add new on admin bar', 'mustang' ),
			'add_new'            => _x( 'Add New', 'service', 'mustang' ),
			'add_new_item'       => __( 'Add New Service', 'mustang' ),
			'new_item'           => __( 'New Service', 'mustang' ),
			'edit_item'          => __( 'Edit Service', 'mustang' ),
			'view_item'          => __( 'View Service', 'mustang' ),
			'all_items'          => __( 'All Services', 'mustang' ),
			'search_items'       => __( 'Search Service', 'mustang' ),
			'parent_item_colon'  => __( 'Parent Service:', 'mustang' ),
			'not_found'          => __( 'No services found.', 'mustang' ),
			'not_found_in_trash' => __( 'No services found in Trash.', 'mustang' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'm1t_services' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' ),
			'menu_icon' 		 => 'dashicons-image-filter',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'm1t_services', $args );
	}

}

if ( get_theme_mod( 'show_services_pt' ) === true )
	new Services_CPT();