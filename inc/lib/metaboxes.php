<?php

// Enqueue the scripts.
function load_custom_wp_admin_scripts() {
        wp_enqueue_script( 'mustang-admin', get_template_directory_uri() . '/js/admin/admin.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_scripts', -100 );

// Registering meta boxes.
add_filter( 'rwmb_meta_boxes', 'mustang_register_meta_boxes' );

/**
 * Register meta boxes.
 * @param array $meta_boxes List of meta boxes.
 * @return array
 */
function mustang_register_meta_boxes( $meta_boxes )
{
	// Prefix of meta keys (optional), better has an underscore as last sign.
	$prefix = 'mustang_';

	// 1st meta box - m1t_banners.
	$meta_boxes[] = array(
		'id'         => 'm1t_banners',
		'title'      => __( 'Banner Options', 'mustang' ),
		'post_types' => array( 'm1t_banners' ),
		'context'    => 'side',
		'priority'   => 'high',
		'autosave'   => true,

		// List of meta fields
		'fields' 		=> array(
			array(
				'name' 	=> __( 'More Text', 'mustang' ),
				'id' 	=> "{$prefix}m1t_banners_more_text",
				'desc' 	=> sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'More "text".', 'mustang' ) ),
				'type' 	=> 'text',
				'std' 	=> __( '', 'mustang' ),
			),
			array(
				'name' 	=> __( 'More Link', 'mustang' ),
				'id' 	=> "{$prefix}m1t_banners_more_link",
				'desc' 	=> sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Paste or type a URL for "LEARN MORE" link.', 'mustang' ) ),
				'type' 	=> 'text',
				'std' 	=> __( '', 'mustang' ),
			),
		),
		'validation' => array(
			'rules' => array(),
			'messages' => array(),
		),
	);

	// Font-awesome icons.
	require_once( get_template_directory() . '/inc/lib/fa-icons.php' );

	foreach( $fa_icons as $fa ) {
		$nfa[ $fa ] = $fa;
	}

	// 2nd meta box - m1t_services.
	$meta_boxes[] = array(
		'id'         => 'm1t_services',
		'title'      => __( 'More', 'mustang' ),
		'post_types' => array( 'm1t_services' ),
		'context'    => 'side',
		'priority'   => 'high',
		'autosave'   => true,

		// List of meta fields
		'fields' 		=> array(
			array(
				'name'        => __( 'Font Awesome Icon', 'mustang' ),
				'id'          => "{$prefix}service_fa_icon",
				'type'        => 'select_advanced',
				'desc' 	=> sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Select one of the font-awesome icon form the dropdown list.', 'mustang' ) ),
				'options'     => $nfa,
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select One', 'mustang' ),
			),
			array(
				'name' => __( 'Text Color', 'mustang' ),
				'id'   => "{$prefix}service_heading_color",
				'type' => 'color',
				'std'  => '#0099cc',
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Pick a color for service heading text.', 'mustang' ) ),
			),
		),
		'validation' => array(
			'rules' => array(),
			'messages' => array(),
		),
	);
	
	// 3rd meta box - m1t_members.
	$meta_boxes[] = array(
		'id'         => 'm1t_members',
		'title'      => __( 'More', 'mustang' ),
		'post_types' => array( 'm1t_members' ),
		'context'    => 'normal',
		'priority'   => '',
		'autosave'   => true,

		// List of meta fields
		'fields' 		=> array(
			array(
				'name'  => __( 'Position', 'mustang' ),
				'id'    => "{$prefix}member_position",
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Mention the member\'s position.', 'mustang' ) ),
				'type'  => 'text',
				'std'   => __( '', 'mustang' ),
				'clone' => false,
			),
			array(
				'type' => 'heading',
				'name' => __( 'Social URLs', 'mustang' ),
				'id'   => 'fake_id', // Not used but needed for plugin
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Social links for the current member.', 'mustang' ) ),
			),
		),
		'validation' => array(
			'rules' => array(
				"{$prefix}member_position" => array(
					'required'  => true,
				),
			),
			'messages' => array(
				"{$prefix}member_position" => array(
					'required'  => __( 'Position is required.', 'mustang' ),
				),
			),
		),
	);

	// Socials.
	$socials = array(
		'facebook' => __( 'Facebook', 'mustang' ),
		'twitter' => __( 'Twitter', 'mustang' ),
		'google' => __( 'Google +', 'mustang' ),
	);

	foreach ( $socials as $key => $value ) {
		$meta_boxes[2]['fields'][] = array(
			'name'  => $value,
			'id'    => "{$prefix}member_{$key}",
			'type'  => 'text',
			'std'   => __( '', 'mustang' ),
			'clone' => false,
			'size'  => 60,
		);
	}

	// 4th meta box - m1t_members.
	$meta_boxes[] = array(
		'id'         => 'm1t_template_home',
		'title'      => __( 'Homepage Options', 'mustang' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => '',
		'autosave'   => true,

		// List of meta fields
		'fields' 		=> array(
			array(
				'type' => 'heading',
				'name' => __( 'Introduction Section', 'mustang' ),
				'id'   => 'fake_id', // Not used but needed for plugin
				'desc' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.', 'mustang' ),
			),
			array(
				'name'  => __( 'Heading', 'mustang' ),
				'id'    => "{$prefix}intro_heading",
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Type a section heading.', 'mustang' ) ),
				'type'  => 'text',
				'std'   => __( '', 'mustang' ),
				'clone' => false,
			),
			array(
				'name'    => __( 'Content', 'mustang' ),
				'id'      => "{$prefix}intro_text",
				'type'    => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'     => false,
				'std'     => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.', 'mustang' ),

				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			array(
				'type' => 'heading',
				'name' => __( 'Your Partners', 'mustang' ),
				'id'   => 'fake_id', // Not used but needed for plugin
				'desc' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. ', 'mustang' ),
			),
			array(
				'name'  => __( 'Heading', 'mustang' ),
				'id'    => "{$prefix}partners_heading",
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Type a section heading.', 'mustang' ) ),
				'type'  => 'text',
				'std'   => __( '', 'mustang' ),
				'clone' => false,
			),
			array(
				'name'             => __( 'Partners', 'mustang' ),
				'desc'			   => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Upload some partners\' logos.', 'mustang' ) ),
				'id'               => "{$prefix}partners",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			),
		),
	);

	// 5th meta box - m1t_template_gallery.
	$meta_boxes[] = array(
		'id'         => 'm1t_template_gallery',
		'title'      => __( 'Gallery', 'mustang' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => '',
		'autosave'   => true,

		// List of meta fields
		'fields' 		=> array(
			array(
				'name'  => __( 'Heading', 'mustang' ),
				'id'    => "{$prefix}gallery_heading",
				'desc' => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Type a section heading.', 'mustang' ) ),
				'type'  => 'text',
				'std'   => __( '', 'mustang' ),
				'clone' => false,
			),
			array(
				'name'             => __( 'Gallery Images', 'mustang' ),
				'desc'			   => sprintf( '<span style="font-style: normal; font-size: 12px;">%s</span>', __( 'Upload some gallery images.', 'mustang' ) ),
				'id'               => "{$prefix}gallery",
				'type'             => 'image_advanced',
				// 'max_file_uploads' => 6,
			),
		),
	);

	return $meta_boxes;
}
