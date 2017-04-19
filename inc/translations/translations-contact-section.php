<?php
/**
 * Translation functions for contact section
 *
 * @package azera-shop
 */

if ( ! function_exists( 'azera_shop_contact_get_default_content' ) ) {
	/**
	 * Get testimonials section default content.
	 */
	function azera_shop_contact_get_default_content() {
		return json_encode(
			array(
				array(
					'icon_value' => 'fa-envelope-o',
					'text'       => esc_html__( 'Text from customizer.', 'azera-shop' ),
					'id'         => 'azera_shop_56d6b291454c3',
				),
				array(
					'icon_value' => 'fa-map-o',
					'text'       => esc_html__( 'Text from customizer.', 'azera-shop' ),
					'id'         => 'azera_shop_56d6b293454c4',
				),
				array(
					'icon_value' => 'fa-phone',
					'text'       => esc_html__( 'Text from customizer.', 'azera-shop' ),
					'id'         => 'azera_shop_56d6b295454c5',
				),
		) );
	}
}

if ( ! function_exists( 'azera_shop_contact_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function azera_shop_contact_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = azera_shop_contact_get_default_content();
		azera_shop_pll_string_register_helper( 'azera_shop_contact_info_content', $default, 'Contact section' );
	}
}
add_action( 'after_setup_theme', 'azera_shop_contact_register_strings', 11 );
