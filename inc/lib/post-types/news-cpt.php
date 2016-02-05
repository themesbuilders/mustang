<?php

// News post type.
class News_CPT {

	// Constructor.
	public function __construct()
	{
		add_action( 'init', array( &$this, 'mustang_news_init' ), 0 );
		add_action( 'init', array( &$this, 'mustang_news_tax' ), 10 );

		// Custom thumbnail column for banner post type.
		if ( function_exists( 'mt_columns_head' ) )
			add_filter('manage_m1t_news_posts_columns', 'mt_columns_head');
		if ( function_exists( 'mt_columns_content' ) )
			add_action('manage_m1t_news_posts_custom_column', 'mt_columns_content', 0, 2);

		flush_rewrite_rules( false );
	}

	// News init.
	public function mustang_news_init()
	{
		$labels = array(
			'name'               => _x( 'News', 'post type general name', 'mustang' ),
			'singular_name'      => _x( 'News', 'post type singular name', 'mustang' ),
			'menu_name'          => _x( 'News', 'admin menu', 'mustang' ),
			'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'mustang' ),
			'add_new'            => _x( 'Add New', 'news', 'mustang' ),
			'add_new_item'       => __( 'Add New News', 'mustang' ),
			'new_item'           => __( 'New News', 'mustang' ),
			'edit_item'          => __( 'Edit News', 'mustang' ),
			'view_item'          => __( 'View News', 'mustang' ),
			'all_items'          => __( 'All News', 'mustang' ),
			'search_items'       => __( 'Search News', 'mustang' ),
			'parent_item_colon'  => __( 'Parent News:', 'mustang' ),
			'not_found'          => __( 'No news items found.', 'mustang' ),
			'not_found_in_trash' => __( 'No news items found in Trash.', 'mustang' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'news' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
			'menu_icon' 		 => 'dashicons-feedback',
			'exclude_from_search' => false,
		);

		// Register
		register_post_type( 'm1t_news', $args );
	}

	// Create a taxonomy for the custom post type "news"
	function mustang_news_tax() {

		// Add new taxonomy, hierarchical
		$labels = array(
			'name'                       => _x( 'News Categories', 'taxonomy general name', 'mustang' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name', 'mustang' ),
			'search_items'               => __( 'Search Categories', 'mustang' ),
			'popular_items'              => __( 'Popular Categories', 'mustang' ),
			'all_items'                  => __( 'All Categories', 'mustang' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category', 'mustang' ),
			'update_item'                => __( 'Update Category', 'mustang' ),
			'add_new_item'               => __( 'Add New Category', 'mustang' ),
			'new_item_name'              => __( 'New Category Name', 'mustang' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'mustang' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'mustang' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'mustang' ),
			'not_found'                  => __( 'No categories found.', 'mustang' ),
			'menu_name'                  => __( 'News Categories', 'mustang' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'public'				=> true,
			'show_in_nav_menus'		=> false,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_tagcloud'			=> true,
			'rewrite'               => array( 'slug' => 'news-category' ),
		);

		register_taxonomy( 'news_category', 'm1t_news', $args );

		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => _x( 'News Tags', 'taxonomy general name', 'mustang' ),
			'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'mustang' ),
			'search_items'               => __( 'Search Tags', 'mustang' ),
			'popular_items'              => __( 'Popular Tags', 'mustang' ),
			'all_items'                  => __( 'All Tags', 'mustang' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag', 'mustang' ),
			'update_item'                => __( 'Update Tag', 'mustang' ),
			'add_new_item'               => __( 'Add New Tag', 'mustang' ),
			'new_item_name'              => __( 'New Tag Name', 'mustang' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'mustang' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'mustang' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'mustang' ),
			'not_found'                  => __( 'No tags found.', 'mustang' ),
			'menu_name'                  => __( 'News Tags', 'mustang' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'public'				=> true,
			'show_in_nav_menus'		=> false,
			'show_admin_column'     => false,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_tagcloud'			=> true,
			'rewrite'               => array( 'slug' => 'news-tag' ),
		);

		register_taxonomy( 'news_tag', 'm1t_news', $args );
	}
}

if ( get_theme_mod( 'show_news_pt' ) === true )
	new News_CPT();
