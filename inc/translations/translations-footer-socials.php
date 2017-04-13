<?php
/**
 * Translation functions for footer socials
 *
 * @package azera_shop
 */

if ( ! function_exists( 'azera_shop_footer_socials_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function azera_shop_footer_socials_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = '';
		azera_shop_pll_string_register_helper( 'azera_shop_social_icons', $default, 'Footer socials' );
	}
}
add_action( 'after_setup_theme', 'azera_shop_footer_socials_register_strings', 11 );
