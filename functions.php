<?php
/**
 * azera-shop functions and definitions
 *
 * @package azera-shop
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */   
}
if ( ! function_exists( 'azera_shop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function azera_shop_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on azera-shop, use a find and replace
	 * to change 'azera-shop' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'azera-shop', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.  
	 */
	add_theme_support( 'title-tag' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'azera-shop' ),
		'azera_shop_footer_menu' => esc_html__('Footer Menu', 'azera-shop'),
	) );

	
	 /* Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background',apply_filters( 'azera_shop_custom_background_args', array(
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'default-attachment'     => 'fixed'
	)));

	 /*
	 * This feature enables Custom_Headers support for a theme as of Version 3.4.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
	 */
	
	add_theme_support( 'custom-header',apply_filters( 'azera_shop_custom_header_args', array(
		'default-image' => azera_shop_get_file('/images/background-images/background.jpg'),
		'width'         => 1000,
		'height'        => 680,
		'flex-height'   => true,
		'flex-width'    => true,
		'header-text' 	=> false
	)));
	
	register_default_headers( array(
		'azera_shop_default_header_image' => array(
			'url'   => azera_shop_get_file('/images/background-images/background.jpg'),
			'thumbnail_url' => azera_shop_get_file('/images/background-images/background_thumbnail.jpg'),
		),
	));
	
	//Theme Support for WooCommerce
	add_theme_support( 'woocommerce' );

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' ); 

	/* Set the image size by cropping the image */
	add_image_size( 'azera-shop-post-thumbnail-big', 730, 340, true );
	add_image_size( 'azera-shop-post-thumbnail-mobile', 500, 233, true );

	add_image_size( 'azera_shop_team', 268, 273, true );
	add_image_size( 'azera_shop_services',60,62,true );
	add_image_size( 'azera_shop_customers',75,75,true );
	
	
	if( !get_option( 'azera_shop_migrate_translation' ) ) {
		add_option( 'azera_shop_migrate_translation', false );
	}
	
	/**
	* Welcome screen
	*/
	if ( is_admin() ) {
		
		global $azera_shop_required_actions;
        /*
         * id - unique id; required
         * title
         * description
         * check - check for plugins (if installed)
         * plugin_slug - the plugin's slug (used for installing the plugin)
         *
         */
        $azera_shop_required_actions = array(
			array(
				"id" => 'azera-shop-req-ac-check-front-page',
                "title" => esc_html__( 'Switch "Front page displays" to "A static page" ' ,'azera-shop' ),
                "description" => esc_html__( 'In order to have the one page look for your website, please go to Customize -> Static Front Page and switch "Front page displays" to "A static page". Then select the template "Frontpage" for that selected page.','azera-shop' ),
                "check" => azera_shop_is_not_static_page()
			),
			array(
                "id" => 'azera-shop-req-ac-install-intergeo-maps',
                "title" => esc_html__( 'Install Intergeo Maps - Google Maps Plugin' ,'azera-shop' ),
                "description"=> esc_html__( 'In order to use map section, you need to install Intergeo Maps plugin then use it to create a map and paste the generated shortcode in Customize -> Contact section -> Map shortcode','azera-shop' ),
                "check" => defined('INTERGEO_PLUGIN_NAME'),
                "plugin_slug" => 'intergeo-maps'
            ),
            array(
                "id" => 'azera-shop-req-ac-install-pirate-forms',
                "title" => esc_html__( 'Install Pirate Forms' ,'azera-shop' ),
                "description"=> esc_html__( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.','azera-shop' ),
                "check" => defined('PIRATE_FORMS_VERSION'),
                "plugin_slug" => 'pirate-forms'
            ),
		);
		
		require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
	}
}
endif; // azera_shop_setup
add_action( 'after_setup_theme', 'azera_shop_setup' );

function azera_shop_is_not_static_page() {
	
	$azera_shop_is_not_static = 1;
	
	if( 'page' == get_option( 'show_on_front' ) ):
		
		$azera_shop_front_page_id = get_option( 'page_on_front' );
		$azera_shop_template_name = get_page_template_slug( $azera_shop_front_page_id );
		if ( !empty($azera_shop_template_name) && ( $azera_shop_template_name == 'template-frontpage.php' ) ):
			$azera_shop_is_not_static = 0;
		endif;
		
	endif;
	
	return (!$azera_shop_is_not_static ? true : false);
}


add_filter( 'image_size_names_choose', 'azera_shop_media_uploader_custom_sizes' );

function azera_shop_media_uploader_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'azera_shop_team' => esc_html__('Azera Shop Team Member','azera-shop'),
		'azera_shop_services' => esc_html__('Azera Shop Services','azera-shop'),
		'azera_shop_customers' => esc_html__('Azera Shop Testimonials','azera-shop')
    ) );
}


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function azera_shop_widgets_init() {
	
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Sidebar', 'azera-shop' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2><div class="colored-line-left"></div><div class="clearfix widget-title-margin"></div>',
		)
	);
	
	register_sidebars( 4, 
		array(
			'name' => esc_html__('Footer area %d','azera-shop'),
			'id' => 'footer-area',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>'
		) 
	);
	
}
add_action( 'widgets_init', 'azera_shop_widgets_init' );




/**
 * Fallback Menu
 *
 * If the menu doesn't exist, the fallback function to use.
 */
function azera_shop_wp_page_menu()
{
    echo '<ul class="nav navbar-nav navbar-right main-navigation small-text no-menu">';
    wp_list_pages(array('title_li' => '', 'depth' => 1));
    echo '</ul>';
}


/**
 * Enqueue scripts and styles.
 */
function azera_shop_scripts() {
	
	wp_enqueue_style( 'parallax-one-font', '//fonts.googleapis.com/css?family=Cabin:400,600|Open+Sans:400,300,600');

	wp_enqueue_style( 'parallax-one-bootstrap-style', azera_shop_get_file( '/css/bootstrap.min.css'),array(), '3.3.1');

	wp_enqueue_style( 'parallax-one-style', get_stylesheet_uri(), array('parallax-one-bootstrap-style'),'1.0.0');
	
	wp_enqueue_script( 'parallax-one-bootstrap', azera_shop_get_file('/js/bootstrap.min.js'), array(), '3.3.5', true );
		
	wp_enqueue_script( 'parallax-one-custom-all', azera_shop_get_file('/js/custom.all.js'), array('jquery'), '2.0.2', true );
	
	wp_localize_script( 'parallax-one-custom-all', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'azera-shop' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'azera-shop' ) . '</span>',
	) );
	

	$azera_shop_enable_move = get_theme_mod('azera_shop_enable_move');
	if ( !empty($azera_shop_enable_move) && $azera_shop_enable_move && is_page_template('template-frontpage.php') ) {

		wp_enqueue_script( 'parallax-one-home-plugin', azera_shop_get_file('/js/plugin.home.js'), array('jquery','parallax-one-custom-all'), '1.0.1', true );

	}

	if ( is_page_template('template-frontpage.php') ) {

		wp_enqueue_script( 'parallax-one-custom-home', azera_shop_get_file('/js/custom.home.js'), array('jquery'), '1.0.0', true );
	}

	wp_enqueue_script( 'parallax-one-skip-link-focus-fix', azera_shop_get_file('/js/skip-link-focus-fix.js'), array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'azera_shop_scripts' );


function azera_shop_add_id(){
	$migrate = get_option( 'azera_shop_migrate_translation' );
	if( isset($migrate) && $migrate == false ) {
		
		/*Logo*/
		$azera_shop_logos = get_theme_mod('azera_shop_logos_content', json_encode(array( array("image_url" => azera_shop_get_file('/images/companies/1.png') ,"link" => "#" ),array("image_url" => azera_shop_get_file('/images/companies/2.png') ,"link" => "#" ),array("image_url" => azera_shop_get_file('/images/companies/3.png') ,"link" => "#" ),array("image_url" => azera_shop_get_file('/images/companies/4.png') ,"link" => "#" ),array("image_url" => azera_shop_get_file('/images/companies/5.png') ,"link" => "#" ) )));
		if(!empty($azera_shop_logos)){
			
			$azera_shop_logos_decoded = json_decode($azera_shop_logos);
			foreach($azera_shop_logos_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			$azera_shop_logos = json_encode($azera_shop_logos_decoded);
			set_theme_mod( 'azera_shop_logos_content', $azera_shop_logos );
		}
		
		
		/*Services*/
		$azera_shop_services = get_theme_mod('azera_shop_services_content', json_encode(
							array(
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-basic-webpage-multiple','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop')),
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-ecommerce-graph3','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop')),
									array('choice'=>'azera_shop_icon','icon_value' => 'icon-basic-geolocalize-05','title' => esc_html__('Lorem Ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','azera-shop'))
							)
						));
		if(!empty($azera_shop_services)){
			
			$azera_shop_services_decoded = json_decode($azera_shop_services);
			foreach($azera_shop_services_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			
			$azera_shop_services = json_encode($azera_shop_services_decoded);
			set_theme_mod( 'azera_shop_services_content', $azera_shop_services );
		}
		
		/*Team*/
		$azera_shop_team = get_theme_mod('azera_shop_team_content', json_encode(
							array(
									array('image_url' => azera_shop_get_file('/images/team/1.jpg'),'title' => esc_html__('Albert Jacobs','azera-shop'),'subtitle' => esc_html__('Founder & CEO','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/team/2.jpg'),'title' => esc_html__('Tonya Garcia','azera-shop'),'subtitle' => esc_html__('Account Manager','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/team/3.jpg'),'title' => esc_html__('Linda Guthrie','azera-shop'),'subtitle' => esc_html__('Business Development','azera-shop'))
							)
						));
		if(!empty($azera_shop_team)){
			
			$azera_shop_team_decoded = json_decode($azera_shop_team);
			foreach($azera_shop_team_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			
			$azera_shop_team = json_encode($azera_shop_team_decoded);
			set_theme_mod( 'azera_shop_team_content', $azera_shop_team );
		}
		
		/*Testimonials*/
		$azera_shop_testimonials = get_theme_mod('azera_shop_testimonials_content', json_encode(
							array(
									array('image_url' => azera_shop_get_file('/images/clients/1.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/clients/2.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
									array('image_url' => azera_shop_get_file('/images/clients/3.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop'))
							)
						));
		if(!empty($azera_shop_testimonials)){
			
			$azera_shop_testimonials_decoded = json_decode($azera_shop_testimonials);
			foreach($azera_shop_testimonials_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			
			$azera_shop_testimonials = json_encode($azera_shop_testimonials_decoded);
			set_theme_mod( 'azera_shop_testimonials_content', $azera_shop_testimonials );
		}
		
		/*Contact Info*/
		$azera_shop_contact_info = get_theme_mod('azera_shop_contact_info_content', json_encode(
			array( 
					array("icon_value" => "icon-basic-mail" ,"text" => "contact@site.com", "link" => "#" ), 
					array("icon_value" => "icon-basic-geolocalize-01" ,"text" => "Company address", "link" => "#" ), 
					array("icon_value" => "icon-basic-tablet" ,"text" => "0 332 548 954", "link" => "#" ) 
			)
		));
		if(!empty($azera_shop_contact_info)){
			
			$azera_shop_contact_info_decoded = json_decode($azera_shop_contact_info);
			foreach($azera_shop_contact_info_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			
			$azera_shop_contact_info = json_encode($azera_shop_contact_info_decoded);
			set_theme_mod( 'azera_shop_contact_info_content', $azera_shop_contact_info );
		}
		
		/*Social Icons*/
		$azera_shop_social_icons = get_theme_mod('azera_shop_social_icons', json_encode(
			array(
				array('icon_value' =>'icon-social-facebook' , 'link' => '#'),
				array('icon_value' =>'icon-social-twitter' , 'link' => '#'),
				array('icon_value' =>'icon-social-googleplus' , 'link' => '#')
			)
		));
		if(!empty($azera_shop_social_icons)){
			
			$azera_shop_social_icons_decoded = json_decode($azera_shop_social_icons);
			foreach($azera_shop_social_icons_decoded as &$it){
				if(!array_key_exists ( "id" , $it ) || !($it->id) ){
					$it = (object) array_merge( (array)$it, array( 'id' => 'azera_shop_'.uniqid() ) );
				}
			}
			
			$azera_shop_social_icons = json_encode($azera_shop_social_icons_decoded);
			set_theme_mod( 'azera_shop_social_icons', $azera_shop_social_icons );
		}
		
		update_option( 'azera_shop_migrate_translation', true );
	}
}
add_action( 'shutdown', 'azera_shop_add_id' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function azera_shop_admin_styles() {
	wp_enqueue_style( 'parallax_admin_stylesheet', azera_shop_get_file('/css/admin-style.css'),'1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'azera_shop_admin_styles', 10 );

// Adding IE-only scripts to header.
function azera_shop_ie () {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="'. azera_shop_get_file('/js/html5shiv.min.js').'"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'azera_shop_ie');




	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	add_action('woocommerce_before_main_content', 'azera_shop_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'azera_shop_wrapper_end', 10);
	function azera_shop_wrapper_start() {
		echo '</div> </header>';
		echo '<div class="content-wrap">
				<div class="container">
					<div id="primary" class="content-area col-md-12">';
	}
	function azera_shop_wrapper_end() {
		echo '</div></div></div>';
	}


// add this code directly, no action needed
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';


add_action( 'tgmpa_register', 'azera_shop_register_required_plugins' );
function azera_shop_register_required_plugins() {
	
		$plugins = array(
			array(
	 
				'name'      => 'Intergeo Maps - Google Maps Plugin',
	 
				'slug'      => 'intergeo-maps',
	 
				'required'  => false
	 
			),
			
			array(
			
				'name'     => 'Pirate Forms',
			
				'slug' 	   => 'pirate-forms',

				'required' => false
			
			),
			
			array(
			
				'name'     => 'ShortPixel Image Optimizer',
			
				'slug' 	   => 'shortpixel-image-optimiser',
				
				'source'   => get_template_directory() . '/lib/plugins/shortpixel-image-optimiser.zip',
				
				'required' => false
			
			)
		);
	
	$config = array(
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,                   
        'dismissable'  => true,                  
        'dismiss_msg'  => '',                   
        'is_automatic' => false,                 
        'message'      => '',     
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'azera-shop' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'azera-shop' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'azera-shop' ), 
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'azera-shop' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'azera-shop' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'azera-shop' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'azera-shop' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'azera-shop' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'azera-shop' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'azera-shop' ), 
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'azera-shop' ), 
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'azera-shop' ), 
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'azera-shop' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'azera-shop' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'azera-shop' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'azera-shop' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'azera-shop' ), 
            'nag_type'                        => 'updated'
        )
    );
 
	tgmpa( $plugins, $config );	
 
}

add_action('wp_footer','azera_shop_php_style', 100);
function azera_shop_php_style() {
	
	echo '<style type="text/css">';
	
	$azera_shop_title_color = get_theme_mod('azera_shop_title_color');
	if(!empty($azera_shop_title_color)){
		echo '.dark-text { color: '. $azera_shop_title_color .' }';
	}
	$azera_shop_text_color = get_theme_mod('azera_shop_text_color');
	if(!empty($azera_shop_text_color)){
		echo 'body{ color: '.$azera_shop_text_color.'}';
	}
	
	$azera_shop_enable_move = get_theme_mod('azera_shop_enable_move');
	$azera_shop_first_layer = get_theme_mod('azera_shop_first_layer', azera_shop_get_file('/images/background1.png'));
	$azera_shop_second_layer = get_theme_mod('azera_shop_second_layer',azera_shop_get_file('/images/background2.png'));

	if( ( empty($azera_shop_enable_move) || !$azera_shop_enable_move) && is_page_template('template-frontpage.php') ) {
		$azera_shop_header_image = get_header_image();
		if(!empty($azera_shop_header_image)){
			echo '.header{ background-image: url('.$azera_shop_header_image.');}';
		}
	}

	echo '</style>';
}



$pro_functions_path = azera_shop_get_file('/pro/functions.php');
if (file_exists($pro_functions_path)) {
	require $pro_functions_path;
}


function azera_shop_get_file($file){
	$file_parts = pathinfo($file);
	$accepted_ext = array('jpg','img','png','css','js');
	if( in_array($file_parts['extension'], $accepted_ext) ){
		$file_path = get_stylesheet_directory() . $file;
		if ( file_exists( $file_path ) ){
			return esc_url(get_stylesheet_directory_uri() . $file); 
		} else {
			return esc_url(get_template_directory_uri() . $file);
		}
	}
}


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 

add_filter( 'woocommerce_output_related_products_args', 'azera_shop_related_products_args' );

function azera_shop_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;
	return $args;
}

function azera_shop_responsive_embed($html, $url, $attr, $post_ID) {
	$return = '<div class="parallax-one-video-container">'.$html.'</div>';
	return $return;
}

add_filter( 'embed_oembed_html', 'azera_shop_responsive_embed', 10, 4 );



/* Comments callback function*/
function azera_shop_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case 'pingback' :
	
	
		case 'trackback' :
		?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'azera-shop' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'azera-shop' ), ' ' ); ?></p>
		<?php
		break;

	
		default :
		?>
			<li itemscope itemtype="http://schema.org/UserComments" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment-body">
					<footer>
						<div itemscope itemprop="creator" itemtype="http://schema.org/Person" class="comment-author vcard" >
							<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							<?php printf( __( '<span itemprop="name">%s </span><span class="says">says:</span>', 'azera-shop' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'azera-shop' ); ?></em>
							<br />
						<?php endif; ?>
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink" itemprop="url">
								<time class="comment-published" datetime="<?php comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'azera-shop' ) ); ?>" itemprop="commentTime">
									<?php printf( __( '%1$s at %2$s', 'azera-shop' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'azera-shop' ), ' ' );?>
						</div><!-- .comment-meta .commentmetadata -->
					</footer>

					<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->

<?php
		break;
	
	endswitch;
}

/*Polylang repeater translate*/

if(function_exists('icl_unregister_string') && function_exists('icl_register_string')){
	
	/*Services*/
	$azera_shop_services_pl = get_theme_mod('azera_shop_services_content');
	if(!empty($azera_shop_services_pl)){
		$azera_shop_services_pl_decoded = json_decode($azera_shop_services_pl);
		foreach($azera_shop_services_pl_decoded as $azera_shop_service_box){
			$title = $azera_shop_service_box->title;
			$text = $azera_shop_service_box->text;
			$id = $azera_shop_service_box->id;
			$link = $azera_shop_service_box->link;
			if(!empty($id)) {
				if(!empty($title)){
					icl_unregister_string ('Featured Area' , $id.'_services_title' );
					icl_register_string( 'Featured Area' , $id.'_services_title' , $title );
				} else {
					icl_unregister_string ('Featured Area' , $id.'_services_title' );
				}
				if(!empty($text)){
					icl_unregister_string ('Featured Area' , $id.'_services_text' );
					icl_register_string( 'Featured Area' , $id.'_services_text' , $text );
				} else {
					icl_unregister_string ('Featured Area' , $id.'_services_text' );
				}
				if(!empty($link)){
 					icl_unregister_string ('Featured Area' , $id.'_services_link' );
 					icl_register_string( 'Featured Area' , $id.'_services_link' , $link );
 				} else {
 					icl_unregister_string ('Featured Area' , $id.'_services_link' );
 				}
			}
		}
	}
	
	/*Team*/
	$azera_shop_team_pl = get_theme_mod('azera_shop_team_content');
	if(!empty($azera_shop_team_pl)){
		$azera_shop_team_pl_decoded = json_decode($azera_shop_team_pl);
		foreach($azera_shop_team_pl_decoded as $azera_shop_team_box){
			$title = $azera_shop_team_box->title;
			$text = $azera_shop_team_box->subtitle;
			$id = esc_attr($azera_shop_team_box->id);
			if(!empty($id)) {
				if(!empty($title)){
					icl_unregister_string ('Team' , $id.'_team_title' );
					icl_register_string( 'Team' , $id.'_team_title' , $title );
				} else {
					icl_unregister_string ('Team' , $id.'_team_title' );
				}
				if(!empty($text)){
					icl_unregister_string ('Team' , $id.'_team_subtitle' );
					icl_register_string( 'Team' , $id.'_team_subtitle' , $text );
				} else {
					icl_unregister_string ('Team' , $id.'_team_subtitle' );
				}
			}
		}
	}
	
	/*Testimonials*/
	$azera_shop_testimonials_pl = get_theme_mod('azera_shop_testimonials_content');
	if(!empty($azera_shop_testimonials_pl)){
		$azera_shop_testimonials_pl_decoded = json_decode($azera_shop_testimonials_pl);
		foreach($azera_shop_testimonials_pl_decoded as $azera_shop_testimonials_box){
			$title = $azera_shop_testimonials_box->title;
			$subtitle = $azera_shop_testimonials_box->subtitle;
			$text = $azera_shop_testimonials_box->text;
			$id = esc_attr($azera_shop_testimonials_box->id);
			if(!empty($id)) {
				if(!empty($title)){
					icl_unregister_string ('Testimonials' , $id.'_testimonials_title' );
					icl_register_string( 'Testimonials' , $id.'_testimonials_title' , $title );
				} else {
					icl_unregister_string ('Testimonials' , $id.'_testimonials_title' );
				}
				if(!empty($subtitle)){
					icl_unregister_string ('Testimonials' , $id.'_testimonials_subtitle' );
					icl_register_string( 'Testimonials' , $id.'_testimonials_subtitle' , $subtitle );
				} else {
					icl_unregister_string ('Testimonials' , $id.'_testimonials_subtitle' );
				}
				if(!empty($text)){
					icl_unregister_string ('Testimonials' , $id.'_testimonials_text' );
					icl_register_string( 'Testimonials' , $id.'_testimonials_text' , $text );
				} else {
					icl_unregister_string ('Testimonials' , $id.'_testimonials_text' );
				}
			}
		}
	}
	
	/*Contact*/
	$azera_shop_contact_pl = get_theme_mod('azera_shop_contact_info_content');
	if(!empty($azera_shop_contact_pl)){
		$azera_shop_contact_pl_decoded = json_decode($azera_shop_contact_pl);
		foreach($azera_shop_contact_pl_decoded as $azera_shop_contact_box){
			$text = $azera_shop_contact_box->text;
			$id = esc_attr($azera_shop_contact_box->id);
			if(!empty($id)) {
				if(!empty($text)){
					icl_unregister_string ('Contact' , $id.'_contact' );
					icl_register_string( 'Contact' , $id.'_contact' , $title );
				} else {
					icl_unregister_string ('Contact' , $id.'_contact' );
				}
			}
		}
	}
}

/*Check if Repeater is empty*/
function azera_shop_general_repeater_is_empty($azera_shop_arr){
	$azera_shop_services_decoded = json_decode($azera_shop_arr);
	foreach($azera_shop_services_decoded as $azera_shop_box){
		if(!empty($azera_shop_box->choice) && $azera_shop_box->choice == 'azera_shop_none'){
			$azera_shop_box->icon_value = '';
			$azera_shop_box->image_url = '';
		}
		foreach ($azera_shop_box as $key => $value){
			if(!empty($value) && $key!='choice' && $key!='id' && ($value!='No Icon' && $key=='icon_value') ) {
				return false;
			}
		}
	}
	return true;
}

function azera_shop_get_template_part($template){

    if(locate_template($template.'.php')) {
		get_template_part($template);
    } else {
		if(defined('AZERA_SHOP_PLUS_PATH')){
			if(file_exists ( AZERA_SHOP_PLUS_PATH.'public/templates/'.$template.'.php' )){
				require_once ( AZERA_SHOP_PLUS_PATH.'public/templates/'.$template.'.php' );
			}
		}
	}
}