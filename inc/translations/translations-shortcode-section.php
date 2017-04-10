<?php
/**
 * Translation functions for shortcodes section
 *
 * @package azera_shop
 */

if ( ! function_exists( 'azera_shop_shortcodes_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function azera_shop_shortcodes_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = '';
		azera_shop_pll_string_register_helper( 'azera_shop_shortcodes_settings', $default, 'Shortcodes section' );
	}
}
add_action( 'after_setup_theme', 'azera_shop_shortcodes_register_strings', 11 );
