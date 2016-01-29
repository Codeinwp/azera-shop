<?php
/**
 * azera-shop Theme Customizer
 *
 * @package azera-shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function azera_shop_customize_register( $wp_customize ) {
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/********************************************************/
	/************** WP DEFAULT CONTROLS  ********************/
	/********************************************************/
	
	$wp_customize->remove_control('background_color');
	$wp_customize->get_section('background_image')->panel='panel_2';
	$wp_customize->get_section('colors')->panel='panel_2';


	/********************************************************/
	/********************* APPEARANCE  **********************/
	/********************************************************/
	$wp_customize->add_panel( 'panel_2', array(
		'priority' => 30,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Appearance', 'azera-shop' )
	) );
	
	$wp_customize->add_setting( 'azera_shop_text_color', array(
		'default' => '#313131',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'azera_shop_text_color',
			array(
				'label'      => esc_html__( 'Text color', 'azera-shop' ),
				'section'    => 'colors',
				'priority'   => 5
			)
		)
	);
	
	
	$wp_customize->add_setting( 'azera_shop_title_color', array(
		'default' => '#454545',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'azera_shop_title_color',
			array(
				'label'      => esc_html__( 'Title color', 'azera-shop' ),
				'section'    => 'colors',
				'priority'   => 6
			)
		)
	);
	
	$wp_customize->add_section( 'azera_shop_appearance_general' , array(
		'title'       => esc_html__( 'General options', 'azera-shop' ),
      	'priority'    => 3,
      	'description' => esc_html__('Azera Shop theme general appearance options','azera-shop'),
		'panel'		  => 'panel_2'
	));
	
		/* Logo	*/
	$wp_customize->add_setting( 'azera_shop_logo', array(
		'default' => azera_shop_get_file('/images/logo-nav.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_logo', array(
	      	'label'    => esc_html__( 'Logo', 'azera-shop' ),
	      	'section'  => 'azera_shop_appearance_general',
			'priority'    => 1,
	)));
	
	/* Sticky header */
	$wp_customize->add_setting( 'azera_shop_sticky_header', array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control(
			'azera_shop_sticky_header',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Header visibility','azera-shop'),
				'description' => esc_html__('If this box is checked, the header will toggle on frontpage.','azera-shop'),
				'section' => 'azera_shop_appearance_general',
				'priority'    => 2,
			)
	);


	/********************************************************/
	/************* HEADER OPTIONS  ********************/
	/********************************************************/	
	$wp_customize->add_panel( 'panel_1', array(
		'priority' => 35,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Header section', 'azera-shop' )
	) );
	
	/* HEADER CONTENT */
	
	$wp_customize->add_section( 'azera_shop_header_content' , array(
			'title'       => esc_html__( 'Content', 'azera-shop' ),
			'priority'    => 1,
			'panel' => 'panel_1'
	));
	
	/* Header Logo	*/
	$wp_customize->add_setting( 'azera_shop_header_logo', array(
		'default' => azera_shop_get_file('/images/logo-2.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_header_logo', array(
	      	'label'    => esc_html__( 'Header Logo', 'azera-shop' ),
	      	'section'  => 'azera_shop_header_content',
			'active_callback' => 'azera_shop_show_on_front',
			'priority'    => 10
	)));
	
	/* Header title */
	$wp_customize->add_setting( 'azera_shop_header_title', array(
		'default' => esc_html__('AZERA SHOP','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_header_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20
	));
	
	/* Header subtitle */
	$wp_customize->add_setting( 'azera_shop_header_subtitle', array(
		'default' => esc_html__('From the creators of the popular Zerif Lite meet the new ecommerce theme','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_header_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 30
	));

	
	/*Header Button text*/
	$wp_customize->add_setting( 'azera_shop_header_button_text', array(
		'default' => esc_html__('GET STARTED','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_header_button_text', array(
		'label'    => esc_html__( 'Button label', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 40
	));
	
	
	$wp_customize->add_setting( 'azera_shop_header_button_link', array(
		'default' => esc_html__('#','azera-shop'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_header_button_link', array(
		'label'    => esc_html__( 'Button link', 'azera-shop' ),
		'section'  => 'azera_shop_header_content',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 50
	));
	
	
	/* LOGOS SETTINGS */
	
	$wp_customize->add_section( 'azera_shop_logos_settings_section' , array(
			'title'       => esc_html__( 'Logos Bar', 'azera-shop' ),
			'priority'    => 2,
			'panel' => 'panel_1'
	));
	
    
    require_once ( 'class/azera-shop-general-control.php');
	
	$wp_customize->add_setting( 'azera_shop_logos_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
				array( 
					array("image_url" => azera_shop_get_file('/images/companies/1.png') ,"link" => "#" ),
					array("image_url" => azera_shop_get_file('/images/companies/2.png') ,"link" => "#" ),
					array("image_url" => azera_shop_get_file('/images/companies/3.png') ,"link" => "#" ),
					array("image_url" => azera_shop_get_file('/images/companies/4.png') ,"link" => "#" ),
					array("image_url" => azera_shop_get_file('/images/companies/5.png') ,"link" => "#" )
				)
		)

	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_logos_content', array(
		'label'   => esc_html__('Add new social icon','azera-shop'),
		'section' => 'azera_shop_logos_settings_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 10,
        'azera_shop_image_control' => true,
        'azera_shop_icon_control' => false,
        'azera_shop_text_control' => false,
        'azera_shop_link_control' => true
	) ) );
	
	$wp_customize->get_section('header_image')->panel='panel_1';
	$wp_customize->get_section('header_image')->title=esc_html__( 'Background', 'azera-shop' );
	$wp_customize->get_section('header_image')->active_callback = 'azera_shop_show_on_front';
	
	/* Enable parallax effect*/
	$wp_customize->add_setting( 'azera_shop_enable_move', array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control(
			'azera_shop_enable_move',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Parallax effect','azera-shop'),
				'description' => esc_html__('If this box is checked, the parallax effect is enabled.','azera-shop'),
				'section' => 'header_image',
				'priority'    => 3,
			)
	);
	
	/* Layer one */
	$wp_customize->add_setting( 'azera_shop_first_layer', array(
		'default' => azera_shop_get_file('/images/background1.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_first_layer', array(
	      	'label'    => esc_html__( 'First layer', 'azera-shop' ),
	      	'section'  => 'header_image',
			'priority'    => 4,
	)));
	
	/* Layer two */
	$wp_customize->add_setting( 'azera_shop_second_layer', array(
		'default' => azera_shop_get_file('/images/background2.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_second_layer', array(
	      	'label'    => esc_html__( 'Second layer', 'azera-shop' ),
	      	'section'  => 'header_image',
			'priority'    => 5,
	)));

	/********************************************************/
	/****************** SHOP SECTION  ***********************/
	/********************************************************/
	$wp_customize->add_section( 'azera_shop_shop_section' , array(
		'title'       => esc_html__( 'Shop section', 'azera-shop' ),
		'priority'    => 39,
	));
	/* Header title */
	$wp_customize->add_setting( 'azera_shop_shop_section_title', array(
		'default' => esc_html__('Shop','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_shop_section_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_shop_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20
	));

	/* Header subtitle */
	$wp_customize->add_setting( 'azera_shop_shop_section_subtitle', array(
		'default' => esc_html__('Showcase your work effectively and in an attractive form that your prospective clients will love.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_shop_section_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_shop_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 30
	));

	$wp_customize->add_setting( 'azera_shop_number_of_products', array(
		'default' => 3,
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize->add_control( 'azera_shop_number_of_products',
		array(
			'type' => 'number',
			'label' => __('Number of products','azera-shop'),
			'section' => 'azera_shop_shop_section',
			'active_callback' => 'azera_shop_show_on_front',
			'priority'    => 40,
		)
	);

	require_once ( 'class/azera-shop-woocommerce-categories.php');

	$wp_customize->add_setting( 'azera_shop_woocomerce_categories', array(
		'default'        => 'all',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));

	$wp_customize->add_control( new Azera_Shop_Woocommerce_Categories( $wp_customize, 'azera_shop_woocomerce_categories',
		array(
			'label'   => __('Display products from','azera-shop'),
			'section' => 'azera_shop_shop_section',
			'active_callback' => 'azera_shop_show_on_front',
			'priority' => 50
		)
	));
	

	/********************************************************/
	/****************** SERVICES OPTIONS  *******************/
	/********************************************************/
	
	
	/* SERVICES SECTION */
	$wp_customize->add_section( 'azera_shop_services_section' , array(
			'title'       => esc_html__( 'Services section', 'azera-shop' ),
			'priority'    => 40,
	));
	
	/* Services title */
	$wp_customize->add_setting( 'azera_shop_our_services_title', array(
		'default' => esc_html__('Our Services','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_our_services_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_services_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 10
	));
	
	/* Services subtitle */
	$wp_customize->add_setting( 'azera_shop_our_services_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_our_services_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_services_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20
	));
    
    
    /* Services content */
	$wp_customize->add_setting( 'azera_shop_services_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
							array(
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-basic-webpage-multiple','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop')),
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-ecommerce-graph3','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop')),
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-basic-geolocalize-05','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop'))
							)
						)
	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_services_content', array(
		'label'   => esc_html__('Add new service box','azera-shop'),
		'section' => 'azera_shop_services_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 30,
        'azera_shop_image_control' => true,
        'azera_shop_icon_control' => true,
		'azera_shop_title_control' => true,
        'azera_shop_text_control' => true,
		'azera_shop_link_control' => true
	) ) );
	/********************************************************/
	/******************** ABOUT OPTIONS  ********************/
	/********************************************************/

	
	$wp_customize->add_section( 'azera_shop_about_section' , array(
			'title'       => esc_html__( 'About section', 'azera-shop' ),
			'priority'    => 45,
	));
	
	/* About title */
	$wp_customize->add_setting( 'azera_shop_our_story_title', array(
		'default' => esc_html__('Our Story','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_our_story_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_about_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 10,
	));

	/* About Content */
	
	$wp_customize->add_setting( 'azera_shop_our_story_text', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_html',
		'transport' => 'postMessage'
		
	));
	
	$wp_customize->add_control(
			'azera_shop_our_story_text',
			array(
				'type' => 'textarea',
				'label'   => esc_html__( 'Content', 'azera-shop' ),
				'section' => 'azera_shop_about_section',
				'active_callback' => 'azera_shop_show_on_front',
				'priority'    => 20,
			)
	);
	
	/* About Image	*/
	$wp_customize->add_setting( 'azera_shop_our_story_image', array(
		'default' => azera_shop_get_file('/images/about-us.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_our_story_image', array(
	      	'label'    => esc_html__( 'Image', 'azera-shop' ),
	      	'section'  => 'azera_shop_about_section',
			'active_callback' => 'azera_shop_show_on_front',
			'priority'    => 30,
	)));

	/********************************************************/
	/***************** SHORTCODES SECTION  ******************/
	/********************************************************/

	$wp_customize->add_section( 'azera_shop_shortcodes_section' , array(
		'title'       => esc_html__( 'Shortcodes section', 'azera-shop' ),
		'priority'    => 49,
	));

	$wp_customize -> add_setting( 'azera_shop_shortcodes_settings',  array(
		'sanitize_callback' => 'azera_shop_sanitize_text',
	));
	$wp_customize -> add_control (new Azera_Shop_General_Repeater ( $wp_customize , 'azera_shop_shortcodes_settings' , array(
		'label' => esc_html__('Edit the shortcode options','azera-shop'),
		'section' => 'azera_shop_shortcodes_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 1,
		'azera_shop_title_control'     => true,
		'azera_shop_subtitle_control'  => true,
		'azera_shop_shortcode_control' => true
	) ) );

	/********************************************************/
	/*******************  TEAM OPTIONS  *********************/
	/********************************************************/

	
	$wp_customize->add_section( 'azera_shop_team_section' , array(
			'title'       => esc_html__( 'Team section', 'azera-shop' ),
			'priority'    => 50,
	));
	
	/* Team title */
	$wp_customize->add_setting( 'azera_shop_our_team_title', array(
		'default' => esc_html__('Our Team','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_our_team_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_team_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 10,
	));
	
	/* Team subtitle */
	$wp_customize->add_setting( 'azera_shop_our_team_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_our_team_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_team_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20,
	));
	
	
    /* Team content */
	$wp_customize->add_setting( 'azera_shop_team_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
							array(
									array('image_url' => azera_shop_get_file('/images/team/1.jpg'),'title' => esc_html__('Albert Jacobs','azera-shop'),'subtitle' => esc_html__('Founder & CEO','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/team/2.jpg'),'title' => esc_html__('Tonya Garcia','azera-shop'),'subtitle' => esc_html__('Account Manager','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/team/3.jpg'),'title' => esc_html__('Linda Guthrie','azera-shop'),'subtitle' => esc_html__('Business Development','azera-shop'))
							)
						)
	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_team_content', array(
		'label'   => esc_html__('Add new team member','azera-shop'),
		'section' => 'azera_shop_team_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 3,
        'azera_shop_image_control' => true,
		'azera_shop_title_control' => true,
		'azera_shop_subtitle_control' => true
	) ) );
	
	/********************************************************/
	/********** TESTIMONIALS OPTIONS  ***********************/
	/********************************************************/
	
	
	$wp_customize->add_section( 'azera_shop_testimonials_section' , array(
			'title'       => esc_html__( 'Testimonial section', 'azera-shop' ),
			'priority'    => 55,
	));
	
	
	/* Testimonials title */
	$wp_customize->add_setting( 'azera_shop_happy_customers_title', array(
		'default' => esc_html__('Happy Customers','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_happy_customers_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_testimonials_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 10,
	));
	
	/* Testimonials subtitle */
	$wp_customize->add_setting( 'azera_shop_happy_customers_subtitle', array(
		'default' => esc_html__('Cloud computing subscription model out of the box proactive solution.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_happy_customers_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  => 'azera_shop_testimonials_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20,
	));
	
	
    /* Testimonials content */
	$wp_customize->add_setting( 'azera_shop_testimonials_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
							array(
									array('image_url' => azera_shop_get_file('/images/clients/1.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/clients/2.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/clients/3.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop'))
							)
						)
	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_testimonials_content', array(
		'label'   => esc_html__('Add new testimonial','azera-shop'),
		'section' => 'azera_shop_testimonials_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 30,
        'azera_shop_image_control' => true,
		'azera_shop_title_control' => true,
		'azera_shop_subtitle_control' => true,
		'azera_shop_text_control' => true
	) ) );


	/********************************************************/
	/***************** RIBBON OPTIONS  *****************/
	/********************************************************/
	
    
	/* RIBBON SETTINGS */
	$wp_customize->add_section( 'azera_shop_ribbon_section' , array(
		'title'       => esc_html__( 'Ribbon section', 'azera-shop' ),
		'priority'    => 60,
	));
	

	/* Ribbon Background	*/
	$wp_customize->add_setting( 'azera_shop_ribbon_background', array(
		'default' => azera_shop_get_file('/images/background-images/parallax-img/parallax-img1.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_ribbon_background', array(
	      	'label'    => esc_html__( 'Ribbon Background', 'azera-shop' ),
	      	'section'  => 'azera_shop_ribbon_section',
			'active_callback' => 'azera_shop_show_on_front',
			'priority'    => 10
	)));
	
	$wp_customize->add_setting( 'azera_shop_ribbon_title', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_ribbon_title', array(
		'label'    => esc_html__( 'Main title', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20
	));
	

	$wp_customize->add_setting( 'azera_shop_button_text', array(
		'default' => esc_html__('GET STARTED','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_button_text', array(
		'label'    => esc_html__( 'Button label', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 30
	));
	
	
	$wp_customize->add_setting( 'azera_shop_button_link', array(
		'default' => esc_html__('#','azera-shop'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_button_link', array(
		'label'    => esc_html__( 'Button link', 'azera-shop' ),
		'section'  => 'azera_shop_ribbon_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 40
	));
	
	/********************************************************/
	/****************** CONTACT OPTIONS  ********************/
	/********************************************************/
	
	
	/* CONTACT SETTINGS */
	$wp_customize->add_section( 'azera_shop_contact_section' , array(
		'title'       => esc_html__( 'Contact section', 'azera-shop' ),
		'priority'    => 70,
	));


	$wp_customize->add_setting( 'azera_shop_contact_info_content', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
			array( 
					array("icon_value" => "icon-basic-mail" ,"text" => "contact@site.com", "link" => "#" ), 
					array("icon_value" => "icon-basic-geolocalize-01" ,"text" => "Company address", "link" => "#" ), 
					array("icon_value" => "icon-basic-tablet" ,"text" => "0 332 548 954", "link" => "#" ) 
			)
		)
	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_contact_info_content', array(
		'label'   => esc_html__('Add new contact field','azera-shop'),
		'section' => 'azera_shop_contact_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority' => 10,
        'azera_shop_image_control' => false,
        'azera_shop_icon_control' => true,
        'azera_shop_text_control' => true,
        'azera_shop_link_control' => true
	) ) );
	
    
	/* Map ShortCode  */
	$wp_customize->add_setting( 'azera_shop_frontpage_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
	$wp_customize->add_control( 'azera_shop_frontpage_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'azera-shop' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','azera-shop'),
		'section'  => 'azera_shop_contact_section',
		'active_callback' => 'azera_shop_show_on_front',
		'priority'    => 20
	));
	
    
	/********************************************************/
	/*************** CONTACT PAGE OPTIONS  ******************/
	/********************************************************/
	
	
	$wp_customize->add_section( 'azera_shop_contact_page' , array(
		'title'       => esc_html__( 'Contact page', 'azera-shop' ),
      	'priority'    => 75,
	));

	/* Contact Form  */
	$wp_customize->add_setting( 'azera_shop_contact_form_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
	$wp_customize->add_control( 'azera_shop_contact_form_shortcode', array(
		'label'    => esc_html__( 'Contact form shortcode', 'azera-shop' ),
		'description' => __('Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.','azera-shop'),
		'section'  => 'azera_shop_contact_page',
		'active_callback' => 'azera_shop_is_contact_page',
		'priority'    => 1
	));
	
	/* Map ShortCode  */
	$wp_customize->add_setting( 'azera_shop_contact_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
	$wp_customize->add_control( 'azera_shop_contact_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'azera-shop' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','azera-shop'),
		'section'  => 'azera_shop_contact_page',
		'active_callback' => 'azera_shop_is_contact_page',
		'priority'    => 2
	));
	
	/********************************************************/
	/****************** FOOTER OPTIONS  *********************/
	/********************************************************/	
	
	$wp_customize->add_section( 'azera_shop_footer_section' , array(
		'title'       => esc_html__( 'Footer options', 'azera-shop' ),
      	'priority'    => 80,
      	'description' => esc_html__('The main content of this section is customizable in: Customize -> Widgets -> Footer area. ','azera-shop'),
	));	
	
	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control('nav_menu_locations[azera_shop_footer_menu]');
	if(!empty($nav_menu_locations_footer)){
		$nav_menu_locations_footer->section = 'azera_shop_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting( 'azera_shop_copyright', array(
		'default' => 'Themeisle',
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_copyright', array(
		'label'    => esc_html__( 'Copyright', 'azera-shop' ),
		'section'  => 'azera_shop_footer_section',
		'priority'    => 2
	));
	
	
	/* Socials icons */
	
	
	$wp_customize->add_setting( 'azera_shop_social_icons', array(
		'sanitize_callback' => 'azera_shop_sanitize_repeater',
		'default' => json_encode(
			array(
				array('icon_value' =>'icon-social-facebook' , 'link' => '#'),
				array('icon_value' =>'icon-social-twitter' , 'link' => '#'),
				array('icon_value' =>'icon-social-googleplus' , 'link' => '#')
			)
		)

	));
	$wp_customize->add_control( new azera_shop_General_Repeater( $wp_customize, 'azera_shop_social_icons', array(
		'label'   => esc_html__('Add new social icon','azera-shop'),
		'section' => 'azera_shop_footer_section',
		'priority' => 3,
        'azera_shop_image_control' => false,
        'azera_shop_icon_control' => true,
        'azera_shop_text_control' => false,
        'azera_shop_link_control' => true
	) ) );
	
	/********************************************************/
	/************** ADVANCED OPTIONS  ***********************/
	/********************************************************/
	
	$wp_customize->add_section( 'azera_shop_general_section' , array(
		'title'       => esc_html__( 'Advanced options', 'azera-shop' ),
      	'priority'    => 85,
      	'description' => esc_html__('Azera Shop theme general options','azera-shop'),
	));
	
	$blogname = $wp_customize->get_control('blogname');
	$blogdescription = $wp_customize->get_control('blogdescription');
	$blogicon = $wp_customize->get_control('site_icon');
	$show_on_front = $wp_customize->get_control('show_on_front');
	$page_on_front = $wp_customize->get_control('page_on_front');
	$page_for_posts = $wp_customize->get_control('page_for_posts');
	if(!empty($blogname)){
		$blogname->section = 'azera_shop_general_section';
		$blogname->priority = 1;
	}
	if(!empty($blogdescription)){
		$blogdescription->section = 'azera_shop_general_section';
		$blogdescription->priority = 2;
	}
	if(!empty($blogicon)){
		$blogicon->section = 'azera_shop_general_section';
		$blogicon->priority = 3;
	}
	if(!empty($show_on_front)){
		$show_on_front->section='azera_shop_general_section';
		$show_on_front->priority=4;
	}
	if(!empty($page_on_front)){
		$page_on_front->section='azera_shop_general_section';
		$page_on_front->priority=5;
	}
	if(!empty($page_for_posts)){
		$page_for_posts->section='azera_shop_general_section';
		$page_for_posts->priority=6;
	}
	
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('title_tagline');
	
	$nav_menu_locations_primary = $wp_customize->get_control('nav_menu_locations[primary]');
	if(!empty($nav_menu_locations_primary)){
		$nav_menu_locations_primary->section = 'azera_shop_general_section';
		$nav_menu_locations_primary->priority = 6;
	}
	
	/* Disable preloader */
	$wp_customize->add_setting( 'azera_shop_disable_preloader', array(
		'sanitize_callback' => 'azera_shop_sanitize_text'
	));
	$wp_customize->add_control(
			'azera_shop_disable_preloader',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Disable preloader?','azera-shop'),
				'description' => esc_html__('If this box is checked, the preloader will be disabled from homepage.','azera-shop'),
				'section' => 'azera_shop_general_section',
				'priority'    => 7,
			) 
	);

	/* BLOG HEADER */
	
	$wp_customize->add_section( 'azera_shop_blog_header_section' , array(
		'title'		=> esc_html__( 'Blog header', 'azera-shop' ),
		'priority'	=> 86,
		'panel'     => 'panel_1'
	));

	/* Blog Header title */
	$wp_customize->add_setting( 'azera_shop_blog_header_title', array(
		'default' 			=> esc_html__('BLOG','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' 		=> 'postMessage'
	));

	$wp_customize->add_control( 'azera_shop_blog_header_title', array(
		'label'    			=> esc_html__( 'Title', 'azera-shop' ),
		'section'  			=> 'azera_shop_blog_header_section',
		'priority'    		=> 1
	));

	/* Blog Header subtitle */
	$wp_customize->add_setting( 'azera_shop_blog_header_subtitle', array(
		'default' 			=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis risus augue. Cras at mollis eros. Sed porttitor quam eget aliquam mattis. Fusce leo nibh, ornare at volutpat ut, luctus dictum elit. Mauris non vehicula eros, ac lacinia lorem. Quisque fermentum purus ac scelerisque suscipit. Morbi et iaculis tellus. Proin ut urna ac purus suscipit iaculis. Aliquam erat volutpat. Donec at viverra magna. Fusce efficitur eros a nunc volutpat ultrices. Aenean mattis purus lectus, quis fermentum diam placerat in.','azera-shop'),
		'sanitize_callback' => 'azera_shop_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'azera_shop_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Subtitle', 'azera-shop' ),
		'section'  			=> 'azera_shop_blog_header_section',
		'priority'    		=> 2
	));

	/* Blog Header image	*/
	$wp_customize->add_setting( 'azera_shop_blog_header_image', array(
		'default' => azera_shop_get_file('/images/background-images/background.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
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
	wp_enqueue_script( 'azera_shop_customizer', azera_shop_get_file('/js/customizer.js'), array( 'customize-preview' ), '1.0.2', true );
}
add_action( 'customize_preview_init', 'azera_shop_customize_preview_js' );


function azera_shop_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function azera_shop_sanitize_repeater($input){
	  
	$input_decoded = json_decode($input,true);
	$allowed_html = array(
								'br' => array(),
								'em' => array(),
								'strong' => array(),
								'a' => array(
									'href' => array(),
									'class' => array(),
									'id' => array(),
									'target' => array()
								),
								'button' => array(
									'class' => array(),
									'id' => array()
								)
							);
	
	
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
				if ($key == 'text'){
					$value = html_entity_decode($value);
					$input_decoded[$boxk][$key] = wp_kses( $value, $allowed_html);
				} else {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}

			}
		}

		return json_encode($input_decoded);
	}
	
	return $input;
}


function azera_shop_sanitize_html( $input){
	
	$allowed_html = array(
							'p' => array(
								'class' => array(),
								'id' => array()
							),
							'br' => array(),
							'em' => array(),
							'strong' => array(),
							'ul' => array(
								'class' => array(),
								'id' => array()
							),
							'li' => array(
								'class' => array(),
								'id' => array()
							),
							'a' => array(
								'href' => array(),
								'class' => array(),
								'id' => array(),
								'target' => array()
							),
							'button' => array(
								'class' => array(),
								'id' => array()
							)
						);
	
	$string = force_balance_tags($input);
	return wp_kses($string, $allowed_html);
}


function azera_shop_customizer_script() {
	wp_enqueue_script( 'azera_shop_customizer_script', azera_shop_get_file('/js/azera_shop_customizer.js'), array("jquery","jquery-ui-draggable"),'1.0.0', true  );
	
	wp_localize_script( 'azera_shop_customizer_script', 'azeraShopCustomizerObject', array(
		
		'documentation' => esc_html__( 'Documentation', 'azera-shop' ),
		'support' => esc_html__('Support Forum','azera-shop'),
		'pro' => __('Upgrade to PRO','azera-shop'),
		
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'azera_shop_customizer_script' );

function azera_shop_is_contact_page() {
	return is_page_template('template-contact.php');
};

function azera_shop_show_on_front(){
	return is_page_template('template-frontpage.php');
}
