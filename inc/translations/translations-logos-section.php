<?php
/**
 * Translation functions for logos section
 *
 * @package azera-shop
 */

if ( ! function_exists( 'azera_shop_logos_get_default_content' ) ) {
	/**
	 * Get logos section default content.
	 */
	function azera_shop_logos_get_default_content() {
		return json_encode( array(
			array(
				'image_url' => azera_shop_get_file( '/images/companies/1.png' ),
				'link'      => '#',
				'id'        => 'azera_shop_56d069bb8cb71',
			),
			array(
				'image_url' => azera_shop_get_file( '/images/companies/2.png' ),
				'link'      => '#',
				'id'        => 'azera_shop_56d069bc8cb72',
			),
			array(
				'image_url' => azera_shop_get_file( '/images/companies/3.png' ),
				'link'      => '#',
				'id'        => 'azera_shop_56d069bd8cb73',
			),
			array(
				'image_url' => azera_shop_get_file( '/images/companies/4.png' ),
				'link'      => '#',
				'id'        => 'azera_shop_56d06d128cb74',
			),
			array(
				'image_url' => azera_shop_get_file( '/images/companies/5.png' ),
				'link'      => '#',
				'id'        => 'azera_shop_56d06d3d8cb75',
			),
		) );
	}
}

if ( ! function_exists( 'azera_shop_logos_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function azera_shop_logos_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = azera_shop_logos_get_default_content();
		azera_shop_pll_string_register_helper( 'azera_shop_logos_content', $default, 'Logos section' );
	}
}
add_action( 'after_setup_theme', 'azera_shop_logos_register_strings', 11 );
