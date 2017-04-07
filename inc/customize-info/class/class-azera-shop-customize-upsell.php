<?php
/**
 * Singleton class file.
 *
 * @package azera-shop
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Azera_Shop_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-info/class/class-azera-shop-customize-upsell-frontpage-sections.php' );

		// Register custom section types.
		$manager->register_section_type( 'Azera_Shop_Customizer_Upsell_Frontpage_Sections' );

		$page_on_front_id = get_option( 'page_on_front' );

		if ( 'posts' == get_option( 'show_on_front' ) || get_page_template_slug( $page_on_front_id ) !== 'template-frontpage.php' ) {
			$manager->add_section( new Azera_Shop_Customizer_Upsell_Frontpage_Sections( $manager, 'azera-shop-frontpage-instructions', array(
				'upsell_text'               => __( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to Appearance -> Customize -> Static Front Page and under "Static Front Page" select "A static page". Finally, for "Front page" choose the page you previously created.','azera-shop' ) . '<br><br>' . __( 'Need further informations? Check this','azera-shop' ) . ' <a href="http://docs.themeisle.com/article/312-azera-documentation">' . __( 'doc','azera-shop' ) . '</a>',
				'panel'                     => 'azera_shop_front_page_sections',
				'priority'                  => 0,
			) ) );
		}

		if ( ! class_exists( 'Azera_Shop_Plus' ) ) {
			$manager->add_section( new Azera_Shop_Customizer_Upsell_Frontpage_Sections( $manager, 'azera-shop-order-upsell', array(
				/* translators: Upsell link */
				'upsell_text'               => sprintf( esc_html__( 'Check out the %1$s for full control over the frontpage SECTIONS ORDER!', 'azera-shop' ), sprintf( '<a href="%1$s" target="_blank"><b>%2$s</b></a>', esc_url( 'https://themeisle.com/plugins/azera-shop-plus/' ), esc_html__( 'PRO version', 'azera-shop' ) ) ),
				'panel'                     => 'azera_shop_front_page_sections',
				'priority'                  => 500,
				'active_callback'   => 'azera_shop_show_on_front',
			) ) );

			$manager->add_section( new Azera_Shop_Customizer_Upsell_Frontpage_Sections( $manager, 'azera-shop-view-pro', array(
				'upsell_title' => __( 'View PRO version', 'azera-shop' ),
				'upsell_url' => 'https://themeisle.com/plugins/azera-shop-plus/',
				'upsell_text' => __( 'Get it', 'azera-shop' ),
				'priority'                  => 500,
			) ) );
		}
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'azera-shop-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customize-info/js/azera-shop-upsell-customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'azera-shop-upsell-style', trailingslashit( get_template_directory_uri() ) . 'inc/customize-info/css/azera-shop-upsell-customize-controls.css' );
	}
}

Azera_Shop_Customizer_Upsell::get_instance();
