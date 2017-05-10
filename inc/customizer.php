<?php
/**
 * Azera-shop Theme Customizer
 *
 * @package azera-shop
 */

/* Include customizer repeater */
require_once get_template_directory() . '/inc/customizer-repeater/functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function azera_shop_customize_register( $wp_customize ) {

	require_once( 'alpha-control/azera-shop-alpha-control.php' );
	require_once( 'class/azera-shop-text-control.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	************ WP DEFAULT CONTROLS  */

	$wp_customize->remove_control( 'background_color' );
	$wp_customize->get_section( 'background_image' )->panel = 'panel_2';
	$wp_customize->get_section( 'colors' )->panel = 'panel_2';

	/**
	******************* APPEARANCE  */

	$wp_customize->add_panel( 'panel_2', array(
		'priority' => 30,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Appearance', 'azera-shop' ),
	) );

	$wp_customize->add_setting( 'azera_shop_text_color', array(
		'default' => '#313131',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'azera_shop_text_color',
			array(
				'label'      => esc_html__( 'Text color', 'azera-shop' ),
				'section'    => 'colors',
				'priority'   => 5,
			)
		)
	);

	$wp_customize->add_setting( 'azera_shop_title_color', array(
		'default' => '#454545',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'azera_shop_title_color',
			array(
				'label'      => esc_html__( 'Title color', 'azera-shop' ),
				'section'    => 'colors',
				'priority'   => 6,
			)
		)
	);

	if ( ! class_exists( 'Azera_Shop_Plus' ) ) {
		$wp_customize->add_setting( 'azera_shop_colors_management', array(
			'sanitize_callback' => 'azera_shop_sanitize_text',
		) );
		$wp_customize->add_control( new Azera_Shop_Text_Control( $wp_customize, 'azera_shop_colors_management',
			array(
				'section'            => 'colors',
				'priority'           => 100,
				/* translators: Upsell link */
				'azera_shop_message' => sprintf( esc_html__( 'Get full color schemes support for your site. %1$s', 'azera-shop' ), sprintf( '<a href="%1$s" target=_blank"><b>%2$s</b></a><span class="dashicons dashicons-admin-customizer"></span>', esc_url( 'https://themeisle.com/plugins/azera-shop-plus/' ), esc_html__( 'View PRO version', 'azera-shop' ) ) ),
			)
		) );
	}
	$wp_customize->add_section( 'azera_shop_appearance_general' , array(
		'title'       => esc_html__( 'General options', 'azera-shop' ),
	  	'priority'    => 3,
	  	'description' => esc_html__( 'Azera Shop theme general appearance options','azera-shop' ),
		'panel'		  => 'panel_2',
	));

		/* Logo	*/
	$wp_customize->add_setting( 'azera_shop_logo', array(
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_logo', array(
	      	'label'    => esc_html__( 'Logo', 'azera-shop' ),
	      	'section'  => 'azera_shop_appearance_general',
			'priority'    => 1,
	)));

	/* Sticky header */
	$wp_customize->add_setting( 'azera_shop_sticky_header', array(
		'sanitize_callback' => 'azera_shop_sanitize_checkbox',
		'default' => false,
	));
	$wp_customize->add_control(
		'azera_shop_sticky_header',
		array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Header visibility','azera-shop' ),
				'description' => esc_html__( 'If this box is checked, the header will toggle on frontpage.','azera-shop' ),
				'section' => 'azera_shop_appearance_general',
				'priority'    => 2,
			)
	);

	/**
	****  Frontpage - instructions for users when not on Frontpage template */

	$wp_customize->add_setting( 'azera_shop_front_page_instructions', array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
	) );

	/**
	****************     FRONTPAGE SECTIONS    */

	$wp_customize->add_panel( 'azera_shop_front_page_sections', array(
		'title'    => __( 'Frontpage sections', 'azera-shop' ),
		'priority' => 38,
	) );

	/************** BIG TITLE SECTION **************/

	$wp_customize->add_section( 'azera_shop_header_content' , array(
		'title'       => esc_html__( 'Big title section', 'azera-shop' ),
		'priority'    => 1,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback'   => 'azera_shop_show_on_front',
	));

	require_once( 'class/azera-shop-image-picker-custom-control.php' );

	/* Header layout */
	$wp_customize->add_setting( 'azera_shop_header_layout', array(
		'default'        => 'layout2',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));

	$wp_customize->add_control( new Azera_Shop_Image_Picker( $wp_customize, 'azera_shop_header_layout', array(
		'label'   => __( 'Layout','azera-shop' ),
		'section' => 'azera_shop_header_content',
		'priority' => 1,
		'azera-shop-image-picker-options' => array( 'layout1','layout2' ),
	)));

	/**
	 * Header Logo
	 */
	$wp_customize->add_setting( 'azera_shop_header_logo', array(
		'sanitize_callback' => 'esc_url',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_header_logo', array(
		'label'    => esc_html__( 'Header Top Logo', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'priority'    => 10,
	)));

	/* Header title */
	$wp_customize->add_setting( 'azera_shop_header_title', array(
		'default' => get_bloginfo( 'name', 'display' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_header_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'priority'    => 20,
	));

	/* Header subtitle */
	$wp_customize->add_setting( 'azera_shop_header_subtitle', array(
		'default' => get_bloginfo( 'description' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_header_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'priority'    => 30,
	));

	/*Header Button text*/
	$wp_customize->add_setting( 'azera_shop_header_button_text', array(
		'default' => esc_html__( 'GET STARTED','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_header_button_text', array(
		'label'    => esc_html__( 'Button label', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'priority'    => 40,
	));

	$wp_customize->add_setting( 'azera_shop_header_button_link', array(
		'default' => esc_html__( '#','azera-shop' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_header_button_link', array(
		'label'    => esc_html__( 'Button link', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'priority'    => 50,
	));

	$wp_customize->get_section( 'header_image' )->panel = 'azera_shop_front_page_sections';
	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Big title section background', 'azera-shop' );
	$wp_customize->get_section( 'header_image' )->priority = 2;
	$wp_customize->get_section( 'header_image' )->active_callback = 'azera_shop_show_on_front';

	/* Enable parallax effect*/
	$wp_customize->add_setting( 'azera_shop_enable_move', array(
		'sanitize_callback' => 'azera_shop_sanitize_checkbox',
	));
	$wp_customize->add_control(
		'azera_shop_enable_move',
		array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Parallax effect','azera-shop' ),
				'description' => esc_html__( 'If this box is checked, the parallax effect is enabled.','azera-shop' ),
				'section' => 'header_image',
				'priority'    => 3,
			)
	);

	/* Layer one */
	$wp_customize->add_setting( 'azera_shop_first_layer', array(
		'default' => azera_shop_get_file( '/images/background1.png' ),
		'sanitize_callback' => 'esc_url',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_first_layer', array(
	      	'label'    => esc_html__( 'First layer', 'azera-shop' ),
	      	'section'  => 'header_image',
			'priority'    => 4,
	)));

	/* Layer two */
	$wp_customize->add_setting( 'azera_shop_second_layer', array(
		'default' => azera_shop_get_file( '/images/background2.png' ),
		'sanitize_callback' => 'esc_url',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_second_layer', array(
	      	'label'    => esc_html__( 'Second layer', 'azera-shop' ),
	      	'section'  => 'header_image',
			'priority'    => 5,
	)));

	/* LOGOS BAR SECTION */

	$wp_customize->add_section( 'azera_shop_logos_settings_section' , array(
		'title'       => esc_html__( 'Logos Bar section', 'azera-shop' ),
		'priority'    => 3,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback' => 'azera_shop_show_on_front',
	));

	$default = azera_shop_logos_get_default_content();
	$wp_customize->add_setting( 'azera_shop_logos_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => $default,
	));
	$wp_customize->add_control( new Azera_Shop_General_Repeater( $wp_customize, 'azera_shop_logos_content', array(
		'label'   => esc_html__( 'Add new social icon','azera-shop' ),
		'section' => 'azera_shop_logos_settings_section',
		'priority' => 10,
		'azera_shop_image_control' => true,
		'azera_shop_icon_control' => false,
		'azera_shop_text_control' => false,
		'azera_shop_link_control' => true,
	) ) );

	/* SHOP SECTION */

	$wp_customize->add_section( 'azera_shop_shop_section' , array(
		'title'       => esc_html__( 'Shop section', 'azera-shop' ),
		'priority'    => 5,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback'   => 'azera_shop_show_on_front',
	));
	/* Header title */
	$wp_customize->add_setting( 'azera_shop_shop_section_title', array(
		'default' => esc_html__( 'Shop','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_shop_section_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_shop_section',
		'priority'    => 20,
	));

	/* Header subtitle */
	$wp_customize->add_setting( 'azera_shop_shop_section_subtitle', array(
		'default' => esc_html__( 'Showcase your work effectively and in an attractive form that your prospective clients will love.','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_shop_section_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_shop_section',
		'priority'    => 30,
	));

	$wp_customize->add_setting( 'azera_shop_number_of_products', array(
		'default' => 3,
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_number_of_products', array(
		'type' => 'number',
		'label' => __( 'Number of products','azera-shop' ),
		'section' => 'azera_shop_shop_section',
		'active_callback' => 'azera_check_woo',
		'priority'    => 40,
	) );

	require_once( 'class/azera-shop-woocommerce-categories.php' );

	$wp_customize->add_setting( 'azera_shop_woocomerce_categories', array(
		'default'        => 'all',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));

	$wp_customize->add_control( new Azera_Shop_Woocommerce_Categories( $wp_customize, 'azera_shop_woocomerce_categories', array(
		'label'   => __( 'Display products from','azera-shop' ),
		'section' => 'azera_shop_shop_section',
		'active_callback' => 'azera_check_woo',
		'priority' => 50,
	) ) );

	/* SHORTCODES SECTION */

	$wp_customize->add_section( 'azera_shop_shortcodes_section' , array(
		'title'       => esc_html__( 'Shortcodes section', 'azera-shop' ),
		'priority'    => 8,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback'   => 'azera_shop_show_on_front',
	));

	$wp_customize -> add_setting( 'azera_shop_shortcodes_settings',  array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize -> add_control(new Azera_Shop_General_Repeater( $wp_customize , 'azera_shop_shortcodes_settings' , array(
		'label' => esc_html__( 'Edit the shortcode options','azera-shop' ),
		'section' => 'azera_shop_shortcodes_section',
		'priority' => 1,
		'azera_shop_title_control'     => true,
		'azera_shop_subtitle_control'  => true,
		'azera_shop_shortcode_control' => true,
	) ) );

	/* RIBBON OPTIONS */

	/* RIBBON SETTINGS */
	$wp_customize->add_section( 'azera_shop_ribbon_section' , array(
		'title'       => esc_html__( 'Ribbon section', 'azera-shop' ),
		'priority'    => 9,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback'   => 'azera_shop_show_on_front',
	));

	/* Ribbon Background	*/
	$wp_customize->add_setting( 'azera_shop_ribbon_background', array(
		'default' => azera_shop_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_ribbon_background', array(
	      	'label'    => esc_html__( 'Ribbon Background', 'azera-shop' ),
	      	'section'  => 'azera_shop_ribbon_section',
			'priority'    => 10,
	)));

	$wp_customize->add_setting( 'azera_shop_ribbon_title', array(
		'default' => esc_html__( 'In order to edit the text here you should go to customizer.','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_ribbon_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'priority'    => 20,
	));

	$wp_customize->add_setting( 'azera_shop_button_text', array(
		'default' => esc_html__( 'Text from customizer','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_button_text', array(
		'label'    => esc_html__( 'Button label', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'priority'    => 30,
	));

	$wp_customize->add_setting( 'azera_shop_button_link', array(
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_button_link', array(
		'label'    => esc_html__( 'Button link', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'priority'    => 40,
	));

	/* CONTACT OPTIONS */

	/* CONTACT SETTINGS */
	$wp_customize->add_section( 'azera_shop_contact_section' , array(
		'title'       => esc_html__( 'Contact info section', 'azera-shop' ),
		'priority'    => 10,
		'panel' => 'azera_shop_front_page_sections',
		'active_callback'   => 'azera_shop_show_on_front',
	));

	$default = azera_shop_contact_get_default_content();
	$wp_customize->add_setting( 'azera_shop_contact_info_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => $default,
	) );

	$wp_customize->add_control( new Azera_Shop_General_Repeater( $wp_customize, 'azera_shop_contact_info_content', array(
		'label'   => esc_html__( 'Add new contact field','azera-shop' ),
		'section' => 'azera_shop_contact_section',
		'priority' => 10,
		'azera_shop_icon_control' => true,
		'azera_shop_text_control' => true,
		'azera_shop_link_control' => true,
	) ) );

	/* Map ShortCode  */
	$wp_customize->add_setting( 'azera_shop_frontpage_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_frontpage_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'azera-shop' ),
		'description' => __( 'To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','azera-shop' ),
		'section'  => 'azera_shop_contact_section',
		'priority'    => 11,
	));

	/**
	************* CONTACT PAGE OPTIONS  */

	$wp_customize->add_section( 'azera_shop_contact_page' , array(
		'title'       => esc_html__( 'Contact page', 'azera-shop' ),
	  	'priority'    => 75,
		'active_callback' => 'azera_shop_is_contact_page',
	));

	/* Contact Form  */
	$wp_customize->add_setting( 'azera_shop_contact_form_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_contact_form_shortcode', array(
		'label'    => esc_html__( 'Contact form shortcode', 'azera-shop' ),
		'description' => __( 'Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.','azera-shop' ),
		'section'  => 'azera_shop_contact_page',
		'priority'    => 1,
	));

	/* Map ShortCode  */
	$wp_customize->add_setting( 'azera_shop_contact_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_contact_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'azera-shop' ),
		'description' => __( 'To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','azera-shop' ),
		'section'  => 'azera_shop_contact_page',
		'priority'    => 2,
	));

	/**
	**************** FOOTER OPTIONS  */

	$wp_customize->add_section( 'azera_shop_footer_section' , array(
		'title'       => esc_html__( 'Footer options', 'azera-shop' ),
	  	'priority'    => 80,
	  	'description' => esc_html__( 'The main content of this section is customizable in: Customize -> Widgets -> Footer area. ','azera-shop' ),
	));

	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control( 'nav_menu_locations[azera_shop_footer_menu]' );
	if ( ! empty( $nav_menu_locations_footer ) ) {
		$nav_menu_locations_footer->section = 'azera_shop_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting( 'azera_shop_copyright', array(
		'default' => 'Themeisle',
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_copyright', array(
		'label'    => esc_html__( 'Copyright', 'azera-shop' ),
		'section'  => 'azera_shop_footer_section',
		'priority'    => 2,
	));

	/* Socials icons */
	$wp_customize->add_setting( 'azera_shop_social_icons', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
	) );

	$wp_customize->add_control( new Azera_Shop_General_Repeater( $wp_customize, 'azera_shop_social_icons', array(
		'label'   => esc_html__( 'Add new social icon','azera-shop' ),
		'section' => 'azera_shop_footer_section',
		'priority' => 3,
		'azera_shop_image_control' => false,
		'azera_shop_icon_control' => true,
		'azera_shop_text_control' => false,
		'azera_shop_link_control' => true,
	) ) );

	/**
	************ ADVANCED OPTIONS  */

	$wp_customize->add_section( 'azera_shop_general_section' , array(
		'title'       => esc_html__( 'Advanced options', 'azera-shop' ),
	  	'priority'    => 85,
	  	'description' => esc_html__( 'Azera Shop theme general options','azera-shop' ),
	));

	$blogname = $wp_customize->get_control( 'blogname' );
	$blogdescription = $wp_customize->get_control( 'blogdescription' );
	$blogicon = $wp_customize->get_control( 'site_icon' );
	$show_on_front = $wp_customize->get_control( 'show_on_front' );
	$page_on_front = $wp_customize->get_control( 'page_on_front' );
	$page_for_posts = $wp_customize->get_control( 'page_for_posts' );
	if ( ! empty( $blogname ) ) {
		$blogname->section = 'azera_shop_general_section';
		$blogname->priority = 1;
	}
	if ( ! empty( $blogdescription ) ) {
		$blogdescription->section = 'azera_shop_general_section';
		$blogdescription->priority = 2;
	}
	if ( ! empty( $blogicon ) ) {
		$blogicon->section = 'azera_shop_general_section';
		$blogicon->priority = 3;
	}
	if ( ! empty( $show_on_front ) ) {
		$show_on_front->section = 'azera_shop_general_section';
		$show_on_front->priority = 4;
	}
	if ( ! empty( $page_on_front ) ) {
		$page_on_front->section = 'azera_shop_general_section';
		$page_on_front->priority = 5;
	}
	if ( ! empty( $page_for_posts ) ) {
		$page_for_posts->section = 'azera_shop_general_section';
		$page_for_posts->priority = 6;
	}

	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'title_tagline' );

	$nav_menu_locations_primary = $wp_customize->get_control( 'nav_menu_locations[primary]' );
	if ( ! empty( $nav_menu_locations_primary ) ) {
		$nav_menu_locations_primary->section = 'azera_shop_general_section';
		$nav_menu_locations_primary->priority = 6;
	}

	/* Disable preloader */
	$wp_customize->add_setting( 'azera_shop_disable_preloader', array(
		'sanitize_callback' => 'azera_shop_sanitize_checkbox',
	));
	$wp_customize->add_control(
		'azera_shop_disable_preloader',
		array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Disable preloader?','azera-shop' ),
				'description' => esc_html__( 'If this box is checked, the preloader will be disabled from homepage.','azera-shop' ),
				'section' => 'azera_shop_general_section',
				'priority'    => 7,
			)
	);

	/* BLOG HEADER */

	$wp_customize->add_section( 'azera_shop_blog_header_section' , array(
		'title'		=> esc_html__( 'Blog header', 'azera-shop' ),
		'priority'	=> 86,
	));

	/* Blog Header title */
	$wp_customize->add_setting( 'azera_shop_blog_header_title', array(
		'default' 			=> esc_html__( 'BLOG','azera-shop' ),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' 		=> 'postMessage',
	));

	$wp_customize->add_control( 'azera_shop_blog_header_title', array(
		'label'    			=> esc_html__( 'Title', 'azera-shop' ),
		'section'  			=> 'azera_shop_blog_header_section',
		'priority'    		=> 1,
	));

	/* Blog Header subtitle */
	$wp_customize->add_setting( 'azera_shop_blog_header_subtitle', array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' 		=> 'postMessage',
	));
	$wp_customize->add_control( 'azera_shop_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  			=> 'azera_shop_blog_header_section',
		'priority'    		=> 2,
	));

	/* Blog Header image	*/
	$wp_customize->add_setting( 'azera_shop_blog_header_image', array(
		'default' => azera_shop_get_file( '/images/background-images/background.jpg' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_blog_header_image', array(
		'label'    => esc_html__( 'Image', 'azera-shop' ),
		'section'  => 'azera_shop_blog_header_section',
		'priority'    => 3,
	)));

}
add_action( 'customize_register', 'azera_shop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function azera_shop_customize_preview_js() {
	wp_enqueue_script( 'azera_shop_customizer', azera_shop_get_file( '/js/customizer.js' ), array( 'customize-preview' ), '1.0.3', true );
}
add_action( 'customize_preview_init', 'azera_shop_customize_preview_js' );

/**
 * Satinize text.
 *
 * @param string $input string to satinize.
 *
 * @return mixed
 */
function azera_shop_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Check if is used contact template.
 *
 * @return mixed
 */
function azera_shop_is_contact_page() {
	return is_page_template( 'template-contact.php' );
};

/**
 * Check if is used frontpage template.
 *
 * @return mixed
 */
function azera_shop_show_on_front() {
	return is_page_template( 'template-frontpage.php' );
}

/**
 * Check if is used woocommerce in homepage template.
 *
 * @return mixed
 */
function azera_check_woo() {
	return class_exists( 'WooCommerce' ) && is_page_template( 'template-frontpage.php' );
}

/**
 * Sanitize checkboxes
 *
 * @param bool $input Value of checkbox to be sanitize.
 */
function azera_shop_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}
