<?php

// Members post type.
class Members_CPT {

	// Constructor.
	public function __construct()
	{
		add_action( 'init', array( &$this, 'mustang_members_init' ), 0 );

		// Custom thumbnail column for banner post type.
		if ( function_exists( 'mt_columns_head' ) )
			add_filter('manage_m1t_members_posts_columns', 'mt_columns_head');
		if ( function_exists( 'mt_columns_content' ) )
			add_action('manage_m1t_members_posts_custom_column', 'mt_columns_content', 0, 2);
	}

	// Members init.
	public function mustang_members_init()
	{
		$labels = array(
			'name'               => _x( 'Members', 'post type general name', 'mustang' ),
			'singular_name'      => _x( 'Members', 'post type singular name', 'mustang' ),
			'menu_name'          => _x( 'Our Team', 'admin menu', 'mustang' ),
			'name_admin_bar'     => _x( 'Members', 'add new on admin bar', 'mustang' ),
			'add_new'            => _x( 'Add New', 'member', 'mustang' ),
			'add_new_item'       => __( 'Add New Member', 'mustang' ),
			'new_item'           => __( 'New Member', 'mustang' ),
			'edit_item'          => __( 'Edit Member', 'mustang' ),
			'view_item'          => __( 'View Member', 'mustang' ),
			'all_items'          => __( 'All Members', 'mustang' ),
			'search_items'       => __( 'Search Member', 'mustang' ),
			'parent_item_colon'  => __( 'Parent Member:', 'mustang' ),
			'not_found'          => __( 'No members found.', 'mustang' ),
			'not_found_in_trash' => __( 'No members found in Trash.', 'mustang' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'm1t_members' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' ),
			'menu_icon' 		 => 'dashicons-groups',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'm1t_members', $args );
	}
}

if ( get_theme_mod( 'show_members_pt' ) === true )
	new Members_CPT();
