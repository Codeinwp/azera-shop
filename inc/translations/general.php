<?php
/**
 * General functions for translation.
 *
 * @package azera-shop
 */
if ( ! function_exists( 'azera_shop_translate_single_string' ) ) {
	/**
	 * Filter to translate strings
	 */
	function azera_shop_translate_single_string( $original_value, $domain ) {
		if ( is_customize_preview() ) {
			$wpml_translation = $original_value;
		} else {
			$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
			if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
				return pll__( $original_value );
			}
		}
		return $wpml_translation;
	}
	add_filter( 'azera_shop_translate_single_string', 'azera_shop_translate_single_string', 10, 2 );
}


if ( ! function_exists( 'azera_shop_pll_string_register_helper' ) ) {
	/**
	 * Helper to register pll string.
	 *
	 * @param String     $theme_mod Theme mod name.
	 * @param bool /json $default Default value.
	 * @param String     $name Name for polylang backend.
	 */
	function azera_shop_pll_string_register_helper( $theme_mod, $default = false, $name ) {
		if ( ! function_exists( 'pll_register_string' ) ) {
			return;
		}
		$repeater_content = get_theme_mod( $theme_mod, $default );
		$repeater_content = json_decode( $repeater_content );
		if ( ! empty( $repeater_content ) ) {
			foreach ( $repeater_content as $repeater_item ) {
				foreach ( $repeater_item as $field_name => $field_value ) {
					if ( $field_name === 'social_repeater' ) {
						$social_repeater_value = json_decode( $field_value );
						if ( ! empty( $social_repeater_value ) ) {
							foreach ( $social_repeater_value as $social ) {
								foreach ( $social as $key => $value ) {
									if ( $key === 'link' ) {
										pll_register_string( 'Social link', $value, $name );
									}
									if ( $key === 'icon' ) {
										pll_register_string( 'Social icon', $value, $name );
									}
								}
							}
						}
					} else {
						if ( $field_name !== 'id' && $field_name !== 'choice' ) {
							$f_n = ucfirst( $field_name );
							pll_register_string( $f_n, $field_value, $name );
						}
					}
				}
			}
		}
	}
}// End if().


if ( ! function_exists( 'azera_shop_filter_translations' ) ) {
	/**
	 * Define Allowed Files to be included.
	 */
	function azera_shop_filter_translations( $array ) {
		return array_merge( $array, array(
			'translations/translations-logos-section',
			'translations/translations-contact-section',
			'translations/translations-shortcode-section',
			'translations/translations-footer-socials',
		) );
	}
}
add_filter( 'azera_shop_filter_translations', 'azera_shop_filter_translations' );


if ( ! function_exists( 'azera_shop_include_translations' ) ) {
	/**
	 * Include translations files.
	 */
	function azera_shop_include_translations() {
		$azera_shop_allowed_phps = array();
		$azera_shop_allowed_phps = apply_filters( 'azera_shop_filter_translations', $azera_shop_allowed_phps );
		foreach ( $azera_shop_allowed_phps as $file ) {
			$azera_shop_file_to_include = get_template_directory() . '/inc/' . $file . '.php';
			if ( file_exists( $azera_shop_file_to_include ) ) {
				include_once( $azera_shop_file_to_include );
			} else {
				if ( defined( 'AZERA_SHOP_COMPANION_PATH' ) ) {
					$azera_shop_file_to_include_from_companion = AZERA_SHOP_COMPANION_PATH . '/inc/' . $file . '.php';
					if ( file_exists( $azera_shop_file_to_include_from_companion ) ) {
						include_once( $azera_shop_file_to_include_from_companion );
					}
				} elseif ( defined( 'AZERA_SHOP_PLUS_PATH' ) ) {
					$azera_shop_file_to_include_from_pro = AZERA_SHOP_PLUS_PATH . 'public/inc/' . $file . '.php';
					if ( file_exists( $azera_shop_file_to_include_from_pro ) ) {
						include_once( $azera_shop_file_to_include_from_pro );
					}
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'azera_shop_include_translations' );
