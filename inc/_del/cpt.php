<?php

// Mustang theme custom post types.
class MT_CPT {

	// Constructor.
	public function __construct()
	{
		if ( get_theme_mod( 'show_banners_pt' ) === true )
			$this->banner_cpt();
		if ( get_theme_mod( 'show_news_pt' ) === true )
			$this->news_cpt();
		if ( get_theme_mod( 'show_services_pt' ) === true )
			$this->services_cpt();
		if ( get_theme_mod( 'show_members_pt' ) === true )
			$this->members_cpt();
	}

	// Banner CPT.
	public function banner_cpt()
	{
		// Init.
		add_action( 'init', array( &$this, 'mt_banners_init' ), 0 );

		// Add meta boxes.
		if ( class_exists( 'RW_Meta_Box' ) )
			add_filter( 'rwmb_meta_boxes', array( &$this, 'mt_banners_metabox' ), 0 );

		// Custom thumbnail column for banner post type.
		if ( function_exists( 'mt_columns_head' ) )
			add_filter('manage_banner_posts_columns', 'mt_columns_head');
		if ( function_exists( 'mt_columns_content' ) )
			add_action('manage_banner_posts_custom_column', 'mt_columns_content', 0, 2);
	}

	// Register post type.
	public function mt_banners_init()
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
			'rewrite'            => array( 'slug' => 'banner' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'menu_icon' 		 => 'dashicons-format-gallery',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'banner', $args );
	}

	// Meta boxes.
	public function mt_banners_metabox( $meta_boxes )
	{
		// Better has an underscore as last sign
		$prefix = 'mt_banner_';

		// Meta.
		$meta_boxes[] = array(
			'id' 			=> 'banners-standard',
			'title' 		=> __( 'More', 'mustang' ),
			'post_types'	=> array( 'banner' ),
			'context'		=> 'side', /* normal, advanced, side */
			'priority'   	=> 'high',
			'autosave'   	=> true,
			'fields' 		=> array(
				array(
					'name' 	=> __( 'More Link', 'mustang' ),
					'id' 	=> "{$prefix}more_link",
					'desc' 	=> sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Paste or type a URL for "LEARN MORE" link.', 'mustang' ) ),
					'type' 	=> 'text',
					'std' 	=> __( '', 'mustang' ),
					'clone' => false
				),
			),
		);

		return $meta_boxes;
	}

	// News CPT.
	public function news_cpt()
	{
		// Init.
		add_action( 'init', array( &$this, 'mt_news_init' ), 0 );

		// Hook into the init action and call xy_news_tax
		add_action( 'init', array( &$this, 'mt_news_tax' ), 0 );

		// Custom thumbnail column for banner post type.
		if ( function_exists( 'mt_columns_head' ) )
			add_filter('manage_news_posts_columns', 'mt_columns_head');
		if ( function_exists( 'mt_columns_content' ) )
			add_action('manage_news_posts_custom_column', 'mt_columns_content', 0, 2);
	}

	// Register post type.
	public function mt_news_init()
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
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'news' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'menu_icon' 		 => 'dashicons-feedback',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'news', $args );
	}

	// Create a taxonomy for the custom post type "news"
	function mt_news_tax() {

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

		register_taxonomy( 'news_category', 'news', $args );

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

		register_taxonomy( 'news_tag', 'news', $args );
	}

	// Services CPT.
	public function services_cpt()
	{
		// Init.
		add_action( 'init', array( &$this, 'mt_services_init' ), 0 );

		// Add meta boxes.
		if ( class_exists( 'RW_Meta_Box' ) )
			add_filter( 'rwmb_meta_boxes', array( &$this, 'mt_service_metabox' ), 0 );
	}

	// Register post type.
	public function mt_services_init()
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
			'rewrite'            => array( 'slug' => 'service' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' ),
			'menu_icon' 		 => 'dashicons-image-filter',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'service', $args );
	}

	// Meta boxes.
	public function mt_service_metabox( $meta_boxes )
	{

		// Font-awesome icons.
		require_once( get_template_directory() . '/inc/fa-icons.php' );

		foreach( $fa_icons as $fa ) {
			$nfa[ $fa ] = $fa;
		}

		// Better has an underscore as last sign
		$prefix = 'mt_service_';

		// Meta.
		$meta_boxes[] = array(
			'id' 			=> 'services-standard',
			'title' 		=> __( 'More', 'mustang' ),
			'post_types'	=> array( 'service' ),
			'context'		=> 'side', /* normal, advanced, side */
			'priority'   	=> 'high',
			'autosave'   	=> true,
			'fields' 		=> array(
				array(
					'name'        => __( 'Font Awesome Icon', 'mustang' ),
					'id'          => "{$prefix}fa_icon",
					'type'        => 'select_advanced',
					'desc' 	=> sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Select one of the font-awesome icon form the dropdown list.', 'mustang' ) ),
					'options'     => $nfa,
					'multiple'    => false,
					'std'         => '',
					'placeholder' => __( 'Select One', 'mustang' ),
				),
				array(
					'name' => __( 'Text Color', 'mustang' ),
					'id'   => "{$prefix}heading_color",
					'type' => 'color',
					'std'  => '#0099cc',
					'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Pick a color for service heading text.', 'mustang' ) ),
				),
			),
		);

		return $meta_boxes;
	}

	// Members CPT.
	public function members_cpt()
	{
		// Init.
		add_action( 'init', array( &$this, 'mt_members_init' ), 0 );

		// Add meta boxes.
		// if ( class_exists( 'RW_Meta_Box' ) )
			// add_filter( 'rwmb_meta_boxes', array( &$this, 'mt_members_metabox' ), 0 );

	}

	// Register the post type.
	public function mt_members_init()
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
			'rewrite'            => array( 'slug' => 'members' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' ),
			'menu_icon' 		 => 'dashicons-groups',
			'exclude_from_search' => true,
		);

		// Register
		register_post_type( 'members', $args );
	}

	// Meta boxes.
	public function mt_members_metabox()
	{
		// Better has an underscore as last sign
		$prefix = 'mt_members_';

		// Socials.
		$socials = array(
			'fb' => __( 'Facebook', 'mustang' ),
			'tw' => __( 'Twitter', 'mustang' ),
			'gp' => __( 'Google +', 'mustang' ),
		);

		// Meta.
		$meta_boxes[] = array(
			'id' 			=> 'members-standard',
			'title' 		=> __( 'More', 'mustang' ),
			'post_types'	=> array( 'members' ),
			'context'		=> 'normal', /* normal, advanced, side */
			'priority'   	=> 'high',
			'autosave'   	=> true,
			'fields' 		=> array(
				array(
					'name'  => __( 'Position', 'mustang' ),
					'id'    => "{$prefix}position",
					'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Mention the member\'s position.', 'mustang' ) ),
					'type'  => 'text',
					'std'   => __( '', 'mustang' ),
					'clone' => false,
				),
				// array(
				// 	'type' => 'divider',
				// 	'id'   => 'fake_divider_id', // Not used, but needed
				// ),
				array(
					'type' => 'heading',
					'name' => __( 'Social URLs', 'mustang' ),
					'id'   => 'fake_id', // Not used but needed for plugin
					'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Social links for the current member.', 'mustang' ) ),
				),
			),
		);

		// foreach ( $socials as $key => $value ) {
		// 	$meta_boxes[0]['fields'][] = array(
		// 		'name'  => $value,
		// 		'id'    => "{$prefix}{$key}",
		// 		'type'  => 'text',
		// 		'std'   => __( 'http://', 'mustang' ),
		// 		'clone' => false,
		// 		'size'  => 60,
		// 	);
		// }

		return $meta_boxes;
	}

}

// Make a call.
new MT_CPT();
