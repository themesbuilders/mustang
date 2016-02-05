<?php

// Contains methods for customizing the theme customization screen.
class MTheme_Customize {

	// This hooks into 'customize_register' (available as of WP 3.4) and allows 
	// you to add new sections and controls to the Theme Customize screen.
	public static function register( $wp_customize )
	{
		// Create a panel for the theme options.
		$wp_customize->add_panel( 'mtheme_panel_id', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Mustang Options', 'mustang' ),
			'description'    => __( 'Allows you to customize some settings for Mustang Theme.', 'mustang' ),
		) );

		// Define a section to the Theme Customizer.
		$wp_customize->add_section( 'mtheme_general', array(
			'title' 	  => __( 'General', 'mustang' ),
			'priority' 	  => 35,
			'capability'  => 'edit_theme_options',
			'description' => __( 'General settings for the theme, make some changes and see.', 'mustang' ),
			'panel'		  => 'mtheme_panel_id',
		) );
		$wp_customize->add_section( 'mtheme_colors', array(
			'title' 	  => __( 'Colors', 'mustang' ),
			'priority' 	  => 35,
			'capability'  => 'edit_theme_options',
			'description' => __( 'Customize some of the colors settings.', 'mustang' ),
			'panel'		  => 'mtheme_panel_id',
		) );
		$wp_customize->add_section( 'mtheme_social_links', array(
			'title' 	  => __( 'Social Links', 'mustang' ),
			'priority' 	  => 35,
			'capability'  => 'edit_theme_options',
			'description' => __( 'Add some social links to show in the footer.', 'mustang' ),
			'panel'		  => 'mtheme_panel_id',
		) );
		$wp_customize->add_section( 'mtheme_contact', array(
			'title' 	  => __( 'Contact', 'mustang' ),
			'priority' 	  => 35,
			'capability'  => 'edit_theme_options',
			'description' => __( 'Add some social links to show in the footer.', 'mustang' ),
			'panel'		  => 'mtheme_panel_id',
		) );

		// Register settings to the WP database.
		// General settings.
		$wp_customize->add_setting( 'custom_logo', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'show_banners_pt', array(
			'default' => true,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'show_news_pt', array(
			'default' => true,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'show_services_pt', array(
			'default' => true,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'show_members_pt', array(
			'default' => true,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'custom_copyright', array(
			'default' => '&copy; All rights reserved.',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );

		// Partners settings.
		$wp_customize->add_setting( 'partners_heading', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );

		// Colors settings.
		$wp_customize->add_setting( 'link_textcolor', array(
			'default' => '#2BA6CB',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'tagline_textcolor', array(
			'default' => '#EF1C67',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );

		// Social links settings.
		$wp_customize->add_setting( 'social_heading', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'fb_link', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'tw_link', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'gp_link', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'in_link', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );

		// Contact us settings.
		$wp_customize->add_setting( 'contact_heading', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'contact_address', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'contact_phone', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_setting( 'contact_email', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
		) );

		// General controls.
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'mustang_custom_logo',
				array(
					'label'      => __( 'Custom Logo', 'mustang' ),
					'description' => __( 'Upload your custom site logo.', 'mustang' ),
					'section'    => 'mtheme_general',
					'settings'   => 'custom_logo',
					'context'    => 'normal',
					'width'		 => 170,
					'height'	 => 70,
					'flex_width'  => false,
					'flex_height' => false,
				) 
			) 
		);
		$wp_customize->add_control(
			'show_banners_pt',
			array(
				'label' => __( 'Show Banner Posts?', 'mustang' ),
				'description' => __( 'Check the box if you want to show the banners post type.', 'mustang' ),
				'section' => 'mtheme_general',
				'type' => 'checkbox',
			)
		);
		$wp_customize->add_control(
			'show_news_pt',
			array(
				'label' => __( 'Show News Posts?', 'mustang' ),
				'description' => __( 'Check the box if you want to show the news post type.', 'mustang' ),
				'section' => 'mtheme_general',
				'type' => 'checkbox',
			)
		);
		$wp_customize->add_control(
			'show_services_pt',
			array(
				'label' => __( 'Show Service Posts?', 'mustang' ),
				'description' => __( 'Check the box if you want to show the services post type.', 'mustang' ),
				'section' => 'mtheme_general',
				'type' => 'checkbox',
			)
		);
		$wp_customize->add_control(
			'show_members_pt',
			array(
				'label' => __( 'Show Member Posts?', 'mustang' ),
				'description' => __( 'Check the box if you want to show the members post type.', 'mustang' ),
				'section' => 'mtheme_general',
				'type' => 'checkbox',
			)
		);
		$wp_customize->add_control(
			'custom_copyright',
			array(
				'label' => __( 'Custom Copyright', 'mustang' ),
				'description' => __( 'Your custom copyright text goes here.', 'mustang' ),
				'section' => 'mtheme_general',
				'type' => 'textarea',
			)
		);

		// Define a control for the setting.
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
				'label' => __( 'Link Color', 'mustang' ),
				'section' => 'mtheme_colors',
				'settings' => 'link_textcolor',
				'priority' => 10,
			) )
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'tagline_textcolor', array(
				'label' => __( 'Tagline Color', 'mustang' ),
				'section' => 'mtheme_colors',
				'settings' => 'tagline_textcolor',
				'priority' => 10,
			) )
		);

		// Socail links controls.
		$wp_customize->add_control(
			'social_heading',
			array(
				'label' => __( 'Social Heading', 'mustang' ),
				'section' => 'mtheme_social_links',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'fb_link',
			array(
				'label' => __( 'Facebook', 'mustang' ),
				'section' => 'mtheme_social_links',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'tw_link',
			array(
				'label' => __( 'Twitter', 'mustang' ),
				'section' => 'mtheme_social_links',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'gp_link',
			array(
				'label' => __( 'Google +', 'mustang' ),
				'section' => 'mtheme_social_links',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'in_link',
			array(
				'label' => __( 'Linked In', 'mustang' ),
				'section' => 'mtheme_social_links',
				'type' => 'text',
			)
		);

		// Contact details controls.
		$wp_customize->add_control(
			'contact_heading',
			array(
				'label' => __( 'Heading', 'mustang' ),
				'section' => 'mtheme_contact',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'contact_address',
			array(
				'label' => __( 'Address', 'mustang' ),
				'section' => 'mtheme_contact',
				'type' => 'textarea',
			)
		);
		$wp_customize->add_control(
			'contact_phone',
			array(
				'label' => __( 'Phone Number', 'mustang' ),
				'section' => 'mtheme_contact',
				'type' => 'text',
			)
		);
		$wp_customize->add_control(
			'contact_email',
			array(
				'label' => __( 'Email Address', 'mustang' ),
				'section' => 'mtheme_contact',
				'type' => 'text',
			)
		);
	}

	// Output the custom WordPress settings to the live theme's WP head.
	// Used by hook: 'wp_head'
	public static function header_output()
	{
		?>
		<!--Customizer CSS--> 
		<style type="text/css">
			<?php self::generate_css('a', 'color', 'link_textcolor'); ?>
			<?php self::generate_css('p.site-description', 'color', 'tagline_textcolor'); ?>
		</style> 
		<!--/Customizer CSS-->
		<?php
	}

	// Outputs the javascript needed to automate the live settings preview.
	// Used by hook: 'customize_preview_init'
	public static function live_preview()
	{
		wp_enqueue_script( 
			'mtheme-themecustomizer',
			get_template_directory_uri() . '/js/customizer.js',
			array(  'jquery', 'customize-preview' ),
			'',
			true
		);
	}

	/**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since Mustang Theme 1.0
     */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true )
	{
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s: %s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls.
add_action( 'customize_register' , array( 'MTheme_Customize' , 'register' ) );

// Output custom CSS to live site.
add_action( 'wp_head' , array( 'MTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen.
add_action( 'customize_preview_init' , array( 'MTheme_Customize' , 'live_preview' ) );