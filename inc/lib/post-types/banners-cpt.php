<?php

// Banners post type.
class Banners_CPT {

	// Constructor.
	public function __construct()
	{
		add_action( 'init', array( &$this, 'mustang_banners_init' ), 0 );

		// Custom thumbnail column for banner post type.
		if ( function_exists( 'mt_columns_head' ) )
			add_filter('manage_m1t_banners_posts_columns', 'mt_columns_head');
		if ( function_exists( 'mt_columns_content' ) )
			add_action('manage_m1t_banners_posts_custom_column', 'mt_columns_content', 0, 2);
	}

	// Banners init.
	public function mustang_banners_init()
	{
		$labels = array(
			'name'               => _x( 'Banners', 'post type general name', 'mustang' ),
			'singular_name'      => _x( 'Banners', 'post type singular name', 'mustang' ),
			'menu_name'          => _x( 'Banners', 'admin menu', 'mustang' ),
			'name_admin_bar'     => _x( 'Banners', 'add new on admin bar', 'mustang' ),
			'add_new'            => _x( 'Add New', 'banner', 'mustang' ),
			'add_new_item'       => __( 'Add New Banner', 'mustang' ),
			'new_item'           => __( 'New Banner', 'mustang' ),
			'edit_item'          => __( 'Edit Banner', 'mustang' ),
			'view_item'          => __( 'View Banner', 'mustang' ),
			'all_items'          => __( 'All Banners', 'mustang' ),
			'search_items'       => __( 'Search Banner', 'mustang' ),
			'parent_item_colon'  => __( 'Parent Banner:', 'mustang' ),
			'not_found'          => __( 'No banners found.', 'mustang' ),
			'not_found_in_trash' => __( 'No banners found in Trash.', 'mustang' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'm1t_banners' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'menu_icon' 		 => 'dashicons-format-gallery',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'm1t_banners', $args );
	}

}

if ( get_theme_mod( 'show_banners_pt' ) === true )
	new Banners_CPT();
