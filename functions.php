<?php
/**
 * Azera-shop functions and definitions
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

		require get_template_directory() . '/inc/hooks.php';

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
			'azera_shop_footer_menu' => esc_html__( 'Footer Menu', 'azera-shop' ),
		) );

		/*
		 Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background',apply_filters( 'azera_shop_custom_background_args', array(
			'default-repeat'         => 'no-repeat',
			'default-position-x'     => 'center',
			'default-attachment'     => 'fixed',
		)));

		/*
		* This feature enables Custom_Headers support for a theme as of Version 3.4.
		*
		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
		*/

		add_theme_support( 'custom-header',apply_filters( 'azera_shop_custom_header_args', array(
			'default-image' => azera_shop_get_file( '/images/background-images/background.jpg' ),
			'width'         => 1000,
			'height'        => 680,
			'flex-height'   => true,
			'flex-width'    => true,
			'header-text' 	=> false,
		)));

		register_default_headers( array(
			'azera_shop_default_header_image' => array(
				'url'   => azera_shop_get_file( '/images/background-images/background.jpg' ),
				'thumbnail_url' => azera_shop_get_file( '/images/background-images/background_thumbnail.jpg' ),
			),
		));

		// Theme Support for WooCommerce
		add_theme_support( 'woocommerce' );

		if ( class_exists( 'WooCommerce' ) ) {
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/* Set the image size by cropping the image */
		add_image_size( 'azera-shop-post-thumbnail-big', 730, 340, true );
		add_image_size( 'azera-shop-post-thumbnail-mobile', 500, 233, true );
		add_image_size( 'azera_shop_home_prod',350,350,true );

		/**
		 * Welcome screen
		 */
		if ( is_admin() ) {

			global $azera_shop_required_actions;

			/**
			 * Variable used:
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 */
			$azera_shop_required_actions = array(
				array(
					'id' => 'azera-shop-req-ac-check-front-page',
					'title' => esc_html__( 'Switch "Front page displays" to "A static page" ' ,'azera-shop' ),
					'description' => esc_html__( 'In order to have the one page look for your website, please go to Customize -> Advanced Options -> Static Front Page and switch "Front page displays" to "A static page". Then select the template "Frontpage" for that selected page.','azera-shop' ),
					'check' => azera_shop_is_not_static_page(),
				),
				array(
					'id' => 'azera-shop-req-ac-install-intergeo-maps',
					'title' => esc_html__( 'Install Intergeo Maps - Google Maps Plugin' ,'azera-shop' ),
					'description' => esc_html__( 'In order to use map section, you need to install Intergeo Maps plugin then use it to create a map and paste the generated shortcode in Customize -> Contact section -> Map shortcode','azera-shop' ),
					'check' => defined( 'INTERGEO_PLUGIN_NAME' ),
					'plugin_slug' => 'intergeo-maps',
				),
			);

			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}

		/*
		 * Notifications in customize
		 */
		if ( ! defined( 'AZERA_SHOP_PLUS_VERSION' ) ) {

			require get_template_directory() . '/ti-customizer-notify/class-ti-customizer-notify.php';

			$config_customizer = array(
				'recommended_plugins'       => array(
					'azera-shop-companion' => array(
						'recommended' => true,
						/* translators: Theme companion install link */
						'description' => sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer, please install and activate %s', 'azera-shop' ), sprintf( '<strong>%s</strong>', 'Azera Shop Companion' ) ),
					),
				),
				'recommended_actions'       => array(),
				'recommended_actions_title' => '',
				'recommended_plugins_title' => esc_html__( 'Recommended Plugins', 'azera-shop' ),
				'install_button_label'      => esc_html__( 'Install', 'azera-shop' ),
				'activate_button_label'     => esc_html__( 'Activate', 'azera-shop' ),
				'deactivate_button_label'   => esc_html__( 'Deactivate', 'azera-shop' ),
			);
			Ti_Customizer_Notify::init( $config_customizer );
		}

	}
endif; // azera_shop_setup
add_action( 'after_setup_theme', 'azera_shop_setup' );

/**
 * Function to check if frontpage is not static page.
 *
 * @return bool
 */
function azera_shop_is_not_static_page() {

	$azera_shop_is_not_static = 1;

	if ( 'page' == get_option( 'show_on_front' ) ) {

		$azera_shop_front_page_id = get_option( 'page_on_front' );
		$azera_shop_template_name = get_page_template_slug( $azera_shop_front_page_id );
		if ( ! empty( $azera_shop_template_name ) && ( $azera_shop_template_name == 'template-frontpage.php' ) ) {
			$azera_shop_is_not_static = 0;
		}
	}

	return ( ! $azera_shop_is_not_static ? true : false);
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
			'before_title'  => apply_filters( 'azera_shop_widgets_before_title','<h2 class="widget-title">' ),
			'after_title'   => apply_filters( 'azera_shop_widgets_after_title','</h2><div class="colored-line-left"></div><div class="clearfix widget-title-margin"></div>' ),
		)
	);

	register_sidebars( 4,
		array(
			/* translators: footer area number */
			'name' => esc_html__( 'Footer area %d','azera-shop' ),
			'id' => 'footer-area',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		)
	);

}
add_action( 'widgets_init', 'azera_shop_widgets_init' );

/**
 * Fallback Menu
 *
 * If the menu doesn't exist, the fallback function to use.
 */
function azera_shop_wp_page_menu() {
	echo '<ul class="nav navbar-nav navbar-right main-navigation small-text no-menu">';
	wp_list_pages( array(
		'title_li' => '',
		'depth' => 1,
	) );
	echo '</ul>';
}


/**
 * Enqueue scripts and styles.
 */
function azera_shop_scripts() {

	wp_enqueue_style( 'azera-shop-font', '//fonts.googleapis.com/css?family=Cabin:400,600|Open+Sans:400,300,600' );

	wp_enqueue_style( 'azera-shop-fontawesome', azera_shop_get_file( '/css/font-awesome.min.css' ),array(), '4.4.0' );

	wp_enqueue_style( 'azera-shop-bootstrap-style', azera_shop_get_file( '/css/bootstrap.min.css' ),array(), '3.3.1' );

	wp_enqueue_style( 'azera-shop-style', get_stylesheet_uri(), array( 'azera-shop-bootstrap-style' ),'1.0.0' );

	wp_enqueue_script( 'azera-shop-bootstrap', azera_shop_get_file( '/js/bootstrap.min.js' ), array(), '3.3.5', true );

	wp_enqueue_script( 'azera-shop-custom-all', azera_shop_get_file( '/js/custom.all.js' ), array( 'jquery' ), '2.0.2', true );

	wp_localize_script( 'azera-shop-custom-all', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'azera-shop' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'azera-shop' ) . '</span>',
	) );

	$azera_shop_enable_move = get_theme_mod( 'azera_shop_enable_move' );
	if ( ! empty( $azera_shop_enable_move ) && $azera_shop_enable_move && is_page_template( 'template-frontpage.php' ) ) {

		wp_enqueue_script( 'azera-shop-home-plugin', azera_shop_get_file( '/js/plugin.home.js' ), array( 'jquery', 'azera-shop-custom-all' ), '1.0.1', true );

	}

	if ( is_page_template( 'template-frontpage.php' ) ) {

		wp_enqueue_script( 'azera-shop-custom-home', azera_shop_get_file( '/js/custom.home.js' ), array( 'jquery' ), '1.0.0', true );

		$azera_shop_cart_url = '';
		if ( class_exists( 'WooCommerce' ) ) {
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			if ( ! empty( $cart_url ) ) {
				$azera_shop_cart_url = $cart_url;
			}
		}

		wp_localize_script( 'azera-shop-custom-home', 'viewcart', array(
			'view_cart_label' => esc_html__( 'View cart', 'azera-shop' ), // label of View cart button,
			'view_cart_link' => $azera_shop_cart_url, // link of View cart button
		) );

	}

	wp_enqueue_script( 'azera-shop-skip-link-focus-fix', azera_shop_get_file( '/js/skip-link-focus-fix.js' ), array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'azera_shop_scripts' );

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

/**
 *  Customizer info
 */
require_once get_template_directory() . '/inc/customize-info/class/class-azera-shop-customize-upsell.php';

/**
 * Translations
 */
require get_template_directory() . '/inc/translations/general.php';

/**
 * Admin scripts.
 */
function azera_shop_admin_scripts() {
	wp_enqueue_style( 'azera-shop-admin-fontawesome', azera_shop_get_file( '/css/font-awesome.min.css' ),array(), '4.5.0' );
	wp_enqueue_style( 'azera-shop-admin-stylesheet', azera_shop_get_file( '/css/admin-style.css' ),'1.0.0' );

	wp_enqueue_script( 'azera-shop-customizer-script', azera_shop_get_file( '/js/azera_shop_customizer.js' ), array( 'jquery', 'jquery-ui-draggable' ),'1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'azera_shop_admin_scripts', 10 );

/**
 * Adding IE-only scripts to header.
 */
function azera_shop_ie() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . azera_shop_get_file( '/js/html5shiv.min.js' ) . '"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'azera_shop_ie' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'azera_shop_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'azera_shop_wrapper_end', 10 );

/**
 * Wrapper start for content.
 *
 * @param string $class     class name.
 * @param bool   $is_blog     if is blog.
 */
function azera_shop_wrapper_start( $class = 'col-md-12', $is_blog = false ) {
	$page_bg_image_url = get_background_image();
	$class_to_add = '';
	if ( ! empty( $page_bg_image_url ) && ! is_page_template( 'template-frontpage.php' ) ) {
		$class_to_add = 'content-background';
	} ?>
	</div>
	</header>
	<?php
	if ( $is_blog == true ) {
		do_action( 'blog_header' );
	} ?>
	<div class="content-wrap">
	<div class="container <?php echo $class_to_add; ?>">
	<div id="primary" class="content-area <?php echo esc_attr( $class ); ?>">
	<?php
}

/**
 * Wraooer end for content.
 *
 * @param bool $has_sidebar     if is sidebar then get sidebar.
 */
function azera_shop_wrapper_end( $has_sidebar = false ) {
	?>
	</div>
	<?php
	if ( $has_sidebar == true ) {
		get_sidebar();
	} ?>
	</div>
	</div>
	<?php
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'azera_shop_register_required_plugins' );

/**
 * Register require plugins.
 */
function azera_shop_register_required_plugins() {

	$plugins = array(
		array(
			'name'      => 'Intergeo Maps - Google Maps Plugin',
			'slug'      => 'intergeo-maps',
			'required'  => false,
		),
		array(
			'name'     => 'Pirate Forms',
			'slug' 	   => 'pirate-forms',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug' 	   => 'woocommerce',
			'required' => false,
		),
		array(
			'name'      => 'Azera Shop Companion',
			'slug'      => 'azera-shop-companion',
			'required'  => false,
		),
	);

	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}

add_action( 'wp_footer','azera_shop_php_style', 100 );

/**
 * Inline style.
 */
function azera_shop_php_style() {

	$custom_css                        = '';
	$azera_shop_title_color       = get_theme_mod( 'azera_shop_title_color' );
	$azera_shop_text_color        = get_theme_mod( 'azera_shop_text_color' );
	$azera_shop_enable_move       = get_theme_mod( 'azera_shop_enable_move' );
	$azera_shop_frontpage_opacity = get_theme_mod( 'azera_shop_frontpage_opacity', apply_filters( 'azera_shop_frontpage_opacity_filter','rgba(0, 0, 0, 0.1)' ) );
	$azera_shop_blog_opacity      = get_theme_mod( 'azera_shop_blog_opacity', apply_filters( 'azera_shop_blog_opacity_filter','rgba(0, 0, 0, 0.1)' ) );
	$azera_shop_header_image           = get_header_image();

	if ( ! empty( $azera_shop_title_color ) ) {
		$custom_css .= '.dark-text { color: ' . $azera_shop_title_color . ' }';
	}

	if ( ! empty( $azera_shop_text_color ) ) {
		$custom_css .= 'body{ color: ' . $azera_shop_text_color . '}';
	}

	if ( ( empty( $azera_shop_enable_move ) || ! $azera_shop_enable_move ) && ( is_front_page() || is_page_template( 'template-frontpage.php' ) ) ) {

		if ( ! empty( $azera_shop_header_image ) ) {
			$custom_css .= '.header{ background-image: url(' . $azera_shop_header_image . ');}';
		}
	}

	if ( ! empty( $azera_shop_frontpage_opacity ) ) {
		$custom_css .= '.overlay-layer-wrap{ background:' . $azera_shop_frontpage_opacity . ';}';
	}

	if ( ! empty( $azera_shop_blog_opacity ) ) {
		$custom_css .= '.archive-top .section-overlay-layer{ background:' . $azera_shop_blog_opacity . ';}';
	}

	wp_add_inline_style( 'azera-shop-style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'azera_shop_php_style', 100 );

$pro_functions_path = azera_shop_get_file( '/pro/functions.php' );
if ( file_exists( $pro_functions_path ) ) {
	require $pro_functions_path;
}

/**
 * Get file.
 *
 * @param string $file      link of the file.
 *
 * @return mixed
 */
function azera_shop_get_file( $file ) {
	$file_parts = pathinfo( $file );
	$accepted_ext = array( 'jpg','img','png','css','js' );
	if ( in_array( $file_parts['extension'], $accepted_ext ) ) {
		$file_path = get_stylesheet_directory() . $file;
		if ( file_exists( $file_path ) ) {
			return esc_url( get_stylesheet_directory_uri() . $file );
		} else {
			return esc_url( get_template_directory_uri() . $file );
		}
	}
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 */

add_filter( 'woocommerce_output_related_products_args', 'azera_shop_related_products_args' );

/**
 * Related produts arguments.
 *
 * @param array $args       array with arguments.
 *
 * @return mixed
 */
function azera_shop_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;
	return $args;
}

/**
 * Video container.
 *
 * @param string $html          html to add.
 * @param string $url           url.
 * @param string $attr          attribute name.
 * @param int    $post_id       id of the post.
 *
 * @return string
 */
function azera_shop_responsive_embed( $html, $url, $attr, $post_id ) {
	$return = '<div class="parallax-one-video-container">' . $html . '</div>';
	return $return;
}

add_filter( 'embed_oembed_html', 'azera_shop_responsive_embed', 10, 4 );

/**
 * Comments callback function
 *
 * @param string $comment       comment content.
 * @param array  $args           arguments.
 * @param int    $depth            depth of the comments.
 */
function azera_shop_comment( $comment, $args, $depth ) {
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
						<?php
						/* translators: comment author */
						printf( __( '<span itemprop="name">%s </span><span class="says">says:</span>', 'azera-shop' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'azera-shop' ); ?></em>
						<br />
					<?php endif; ?>
					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink" itemprop="url">
							<time class="comment-published" datetime="<?php comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'azera-shop' ) ); ?>" itemprop="commentTime">
								<?php
								/* translators: 1 - comment date, 2 - comment time */
								printf( __( '%1$s at %2$s', 'azera-shop' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( '(Edit)', 'azera-shop' ), ' ' );?>
					</div><!-- .comment-meta .commentmetadata -->
				</footer>

				<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array(
						'depth' => $depth,
						'max_depth' => $args['max_depth'],
					) ) ); ?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->

			<?php
			break;

	endswitch;
}

/*Polylang repeater translate*/
if ( function_exists( 'pll_register_string' ) || has_action( 'wpml_register_single_string' ) ) {

	/*Logos section*/
	$azera_shop_logos = get_theme_mod( 'azera_shop_logos_content' );
	if ( ! empty( $azera_shop_logos ) ) {
		$azera_shop_logos_decoded = json_decode( $azera_shop_logos );
		foreach ( $azera_shop_logos_decoded as $azera_shop_logo_box ) {
			$id = '';
			$image = '';
			$link = '';
			if ( ! empty( $azera_shop_logo_box->id ) ) {
				$id = $azera_shop_logo_box->id;
			}
			if ( ! empty( $azera_shop_logo_box->image_url ) ) {
				$image = $azera_shop_logo_box->image_url;
			}
			if ( ! empty( $azera_shop_logo_box->link ) ) {
				$link = $azera_shop_logo_box->link;
			}
			if ( ! empty( $id ) ) {
				if ( ! empty( $image ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_logo_image', $image, 'Logos' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Logos section', 'Logo image ' . $id, $image );
					}
				}
				if ( ! empty( $link ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_logo_link', $link, 'Logos' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Logos section', 'Logo link ' . $id, $link );
					}
				}
			}
		}
	}


	/*Shortcode section*/
	$azera_shop_shortcodes_section = get_theme_mod( 'azera_shop_shortcodes_settings' );
	if ( ! empty( $azera_shop_shortcodes_section ) ) {
		$azera_shop_shortcodes_section_decoded = json_decode( $azera_shop_shortcodes_section );
		foreach ( $azera_shop_shortcodes_section_decoded  as $azera_shop_shortcodes_box ) {
			$id = '';
			$title = '';
			$subtitle = '';
			$shortcode = '';
			if ( ! empty( $azera_shop_shortcodes_box->id ) ) {
				$id = $azera_shop_shortcodes_box->id;
			}
			if ( ! empty( $azera_shop_shortcodes_box->title ) ) {
				$title = $azera_shop_shortcodes_box->title;
			}
			if ( ! empty( $azera_shop_shortcodes_box->subtitle ) ) {
				$subtitle = $azera_shop_shortcodes_box->subtitle;
			}
			if ( ! empty( $azera_shop_shortcodes_box->shortcode ) ) {
				$shortcode = $azera_shop_shortcodes_box->shortcode;
			}
			if ( ! empty( $id ) ) {
				if ( ! empty( $title ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_shortcode_section_title', $title, 'Shortcodes section' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Shortcodes section', 'Shortcode title ' . $id, $title );
					}
				}
				if ( ! empty( $subtitle ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_shortcode_section_subtitle', $subtitle, 'Shortcodes section' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Shortcodes section', 'Shortcode subtitle ' . $id, $subtitle );
					}
				}
				if ( ! empty( $shortcode ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_shortcode_section_shortcode', $shortcode, 'Shortcodes section' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Shortcodes section', 'Shortcode ' . $id, $shortcode );
					}
				}
			}
		}// End foreach().
	}// End if().

	/*Footer*/
	$azera_shop_social_icons = get_theme_mod( 'azera_shop_social_icons' );
	if ( ! empty( $azera_shop_social_icons ) ) {
		$azera_shop_social_icons_decoded = json_decode( $azera_shop_social_icons );
		foreach ( $azera_shop_social_icons_decoded as $azera_shop_footer_social ) {
			$id = '';
			$link = '';
			$icon = '';
			if ( ! empty( $azera_shop_footer_social->id ) ) {
				$id = esc_attr( $azera_shop_footer_social->id );
			}
			if ( ! empty( $azera_shop_footer_social->link ) ) {
				$link = $azera_shop_footer_social->link;
			}
			if ( ! empty( $azera_shop_footer_social->icon_value ) ) {
				$icon = $azera_shop_footer_social->icon_value;
			}
			if ( ! empty( $id ) ) {
				if ( ! empty( $icon ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_footer_icon', $icon, 'Footer' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Footer', 'Footer social icon ' . $id, $icon );
					}
				}
				if ( ! empty( $link ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_footer_link', $link, 'Footer' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Footer', 'Footer social link ' . $id, $link );
					}
				}
			}
		}
	}



	/*Contact*/
	$azera_shop_contact = get_theme_mod( 'azera_shop_contact_info_content' );
	if ( ! empty( $azera_shop_contact ) ) {
		$azera_shop_contact_decoded = json_decode( $azera_shop_contact );
		foreach ( $azera_shop_contact_decoded as $azera_shop_contact_box ) {
			$id = '';
			$icon = '';
			$text = '';
			$link = '';
			if ( ! empty( $azera_shop_contact_box->id ) ) {
				$id = esc_attr( $azera_shop_contact_box->id );
			}
			if ( ! empty( $azera_shop_contact_box->icon_value ) ) {
				$icon = $azera_shop_contact_box->icon_value;
			}

			if ( ! empty( $azera_shop_contact_box->text ) ) {
				$text = $azera_shop_contact_box->text;
			}

			if ( ! empty( $azera_shop_contact_box->link ) ) {
				$link = $azera_shop_contact_box->link;
			}
			if ( ! empty( $id ) ) {
				if ( ! empty( $icon ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_contact_icon', $icon, 'Contact' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Contact section', 'Contact box icon ' . $id, $icon );
					}
				}
				if ( ! empty( $link ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_contact_link', $link, 'Contact' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Contact section', 'Contact box link ' . $id, $link );
					}
				}
				if ( ! empty( $text ) ) {
					if ( function_exists( 'pll_register_string' ) ) {
						pll_register_string( $id . '_contact_text', $text, 'Contact' );
					} else {
						do_action( 'wpml_register_single_string', 'Azera Shop -> Contact section', 'Contact box text ' . $id, $text );
					}
				}
			}
		}// End foreach().
	}// End if().
}// End if().
/**
 * Template part.
 *
 * @param string $template      template name.
 */
function azera_shop_get_template_part( $template ) {

	if ( locate_template( $template . '.php' ) ) {
		get_template_part( $template );
	} else {
		if ( defined( 'AZERA_SHOP_PLUS_PATH' ) ) {
			if ( file_exists( AZERA_SHOP_PLUS_PATH . 'public/templates/' . $template . '.php' ) ) {
				require_once( AZERA_SHOP_PLUS_PATH . 'public/templates/' . $template . '.php' );
			}
		} else {
			if ( defined( 'AZERA_SHOP_COMPANION_PATH' ) ) {
				if ( file_exists( AZERA_SHOP_COMPANION_PATH . 'sections/' . $template . '.php' ) ) {
					require_once( AZERA_SHOP_COMPANION_PATH . 'sections/' . $template . '.php' );
				}
			}
		}
	}

}

/**
 * More link.
 *
 * @param string $more      more text.
 *
 * @return string
 */
function azera_shop_excerpt_more( $more ) {
	global $post;
	return '<a class="moretag" href="' . get_permalink( $post->ID ) . '"><span class="screen-reader-text">' . esc_html__( 'Read more about ', 'azera-shop' ) . esc_html( get_the_title() ) . '</span>[&#8230;]</a>';
}

add_filter( 'excerpt_more', 'azera_shop_excerpt_more' );


add_filter( 'woocommerce_add_to_cart_fragments', 'azera_shop_woocommerce_header_add_to_cart_fragment' );
/**
 * Ensure cart contents update when products are added to the cart via AJAX)
 *
 * @param array $fragments      array with content to add.
 *
 * @return mixed
 */
function azera_shop_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>

	<a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','azera-shop' ); ?>" class="cart-contents">
		<span class="fa fa-shopping-cart"></span>
		<span class="cart-item-number"><?php echo trim( WC()->cart->get_cart_contents_count() ); ?></span>
	</a>

	<?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}

if ( ! function_exists( 'azera_shop_blog_header' ) ) {

	/**
	 * Blog header
	 */
	function azera_shop_blog_header() {
		$azera_shop_blog_header_image    = get_theme_mod( 'azera_shop_blog_header_image', azera_shop_get_file( '/images/background-images/background.jpg' ) );
		$azera_shop_blog_header_title    = get_theme_mod( 'azera_shop_blog_header_title', esc_html__( 'BLOG', 'azera-shop' ) );
		$azera_shop_blog_header_subtitle = get_theme_mod( 'azera_shop_blog_header_subtitle' );

		if ( ! empty( $azera_shop_blog_header_image ) || ! empty( $azera_shop_blog_header_title ) || ! empty( $azera_shop_blog_header_subtitle ) ) {

			if ( ! empty( $azera_shop_blog_header_image ) ) {
				echo '<div class="archive-top" style="background-image: url(' . $azera_shop_blog_header_image . ');" role="banner">';
			} else {
				echo '<div class="archive-top" role="banner">';
			}
			echo '<div class="section-overlay-layer">';
			echo '<div class="container">';
			if ( ! empty( $azera_shop_blog_header_title ) ) {
				echo '<p class="archive-top-big-title">' . $azera_shop_blog_header_title . '</p>';
				echo '<p class="colored-line"></p>';
			}

			if ( ! empty( $azera_shop_blog_header_subtitle ) ) {
				echo '<p class="archive-top-text">' . $azera_shop_blog_header_subtitle . '</p>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';

		}
	}
}
add_action( 'blog_header','azera_shop_blog_header' );

if ( ! function_exists( 'azera_shop_footer_powered_by' ) ) {

	/**
	 * Display the powered by section in the footer
	 */
	function azera_shop_footer_powered_by() {
		?>
		<div class="powered-by">
			<?php printf(
				/* translators: 1 - theme name , 2 - WordPress link */
				__( '%1$s powered by %2$s', 'azera-shop' ),
				sprintf( '<a href="https://themeisle.com/themes/azera-shop/" rel="nofollow">%s</a>', esc_html__( 'Azera Shop', 'azera-shop' ) ),
				sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>', esc_html__( 'WordPress', 'azera-shop' ) )
			); ?>
		</div>
		<?php
	}
}

add_action( 'azera_shop_bottom_footer','azera_shop_footer_powered_by' );

if ( ! function_exists( 'azera_shop_post_entry_meta' ) ) {

	/**
	 * Post entry meta.
	 */
	function azera_shop_post_entry_meta() {
		?>
		<div class="entry-meta single-entry-meta">
			<span class="author-link" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
				<span itemprop="name" class="post-author author vcard">
					<i class="fa fa-user" aria-hidden="true"></i><a
						href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemprop="url"
						rel="author"><?php the_author(); ?></a>
				</span>
			</span>
			<time class="post-time posted-on published" datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished">
				<i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( get_option( 'date_format' ) ); ?>
			</time>
			<a href="<?php comments_link(); ?>" class="post-comments">
				<i class="fa fa-comment-o"
				   aria-hidden="true"></i><?php comments_number( esc_html__( 'No comments', 'azera-shop' ), esc_html__( 'One comment', 'azera-shop' ), esc_html__( '% comments', 'azera-shop' ) ); ?>
			</a>
		</div><!-- .entry-meta -->
		<?php
	}
}

add_action( 'azera_shop_content_single_top','azera_shop_post_entry_meta' );

if ( ! function_exists( 'azera_shop_post_date_box_function' ) ) {

	/**
	 * Function to create the box with the post date
	 */
	function azera_shop_post_date_box_function( $class ) {
		?>
		<div class="<?php if ( ! empty( $class ) ) { echo $class; } ?>">
			<span class="post-date-day"><?php the_time( _x( 'd', 'post day fomat', 'azera-shop' ) ); ?></span>
			<span class="post-date-month"><?php the_time( _x( 'M', 'post month fomat', 'azera-shop' ) ); ?></span>
		</div>
		<?php
	}
}

add_action( 'azera_shop_post_date_box','azera_shop_post_date_box_function', 10, 1 );

/**
 * Filter for header layout.
 *
 * @return string
 */
function azera_shop_header_layout() {
	return 'layout2';
}
add_filter( 'azera_shop_header_layout_filter','azera_shop_header_layout' );

/**
 * Filter to remove default options.
 *
 * @return string
 */
function azera_shop_remove_default() {
	return '';
}
add_filter( 'azera_shop_header_logo_filter','azera_shop_remove_default' );

/**
 * Add starter content for fresh sites
 *
 * @since 1.1.6
 */
function azera_shop_starter_content() {
	/*
	 * Starter Content Support
	 */
	add_theme_support( 'starter-content', array(
		'posts' => array(
			'home' => array(
			        'template' => 'template-frontpage.php',
			),
			'blog',
		),

		'nav_menus' => array(
			'primary' => array(
				'name'  => __( 'Primary Menu', 'azera-shop' ),
				'items' => array(
					'page_home',
					'page_blog',
				),
			),
		),

		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
	) );
}
add_action( 'after_setup_theme', 'azera_shop_starter_content' );
