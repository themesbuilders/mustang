<?php

// Contains methods for customizing the theme customization screen.
class MyTheme_Customize {

	// This hooks into 'customize_register' (available as of WP 3.4) and allows 
	// you to add new sections and controls to the Theme Customize screen.
	public static function register ( $wp_customize )
	{
      	// 1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'mytheme_options', 
			array(
            	'title' => __( 'MyTheme Options', 'mustang' ), // Visible title of section
            	'priority' => 35, // Determines what order this appears in
            	'capability' => 'edit_theme_options', // Capability needed to tweak
            	'description' => __('Allows you to customize some example settings for MyTheme.', 'mustang'), // Descriptive tooltip
            ) 
		);

		// 2. Register new settings to the WP database...
		$wp_customize->add_setting( 'link_textcolor',
			array(
				'default' => '#2BA6CB',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_setting( 'tagline_textcolor',
			array(
				'default' => '#EF1C67',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_setting(
			'copyright_textbox',
			array(
				'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_setting(
			'setting_id',
			array(
				'default' => '0',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_setting(
			'color_scheme',
			array(
				'default' => 'red',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_setting(
			'demo_radio',
			array(
				'default' => 'green',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_setting(
			'demo_checkbox',
			array(
				'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);

		// 3. Finally, we define the control itself...
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'link_textcolor',
			array(
				'label' => __( 'Link Color', 'mustang' ),
				'section' => 'mytheme_options',
				'settings' => 'link_textcolor',
				'priority' => 10,
			) 
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'tagline_textcolor',
			array(
				'label' => __( 'Tagline Color', 'mustang' ),
				'section' => 'mytheme_options',
				'settings' => 'tagline_textcolor',
				'priority' => 10,
			) 
		) );
		$wp_customize->add_control(
			'copyright_textbox',
			array(
				'label' => __( 'Custom Copyright', 'mustang' ),
				'section' => 'mytheme_options',
				'type' => 'textarea',
			)
		);
		$wp_customize->add_control( 'setting_id', array(
			'type' => 'range',
			'section' => 'mytheme_options',
			'label' => __( 'Range', 'mustang' ),
			'description' => __( 'This is the range control description. Default: 0' ),
			'input_attrs' => array(
				'min' => 0,
				'max' => 10,
				'step' => 2,
			),
		) );
		$wp_customize->add_control( 'color_scheme', array(
			'label'    => __( 'Base Color Scheme', 'mustang' ),
			'section'  => 'mytheme_options',
			'type'     => 'select',
			'choices'  => array(
				'red' => 'Red',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'pink'	=> 'Pink'
			),
			// 'priority' => 1,
		) );
		$wp_customize->add_control( 'demo_radio', array(
			'label'    => __( 'Base Color Scheme', 'mustang' ),
			'section'  => 'mytheme_options',
			'type'     => 'radio',
			'choices'  => array(
				'red' => 'Red',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'pink'	=> 'Pink'
			),
			// 'priority' => 1,
		) );
		$wp_customize->add_control( 'demo_checkbox', array(
			'label'    => __( 'Demo Checkbox', 'mustang' ),
			'section'  => 'mytheme_options',
			'type'     => 'checkbox',
		) );

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
			'mytheme-themecustomizer',
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
     * @since MyTheme 1.0
     */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true )
	{
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s:%s; }',
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

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );