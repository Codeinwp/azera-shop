<?php
/**
 * Include repeater files
 *
 * @package azera-shop
 */

// Require customizer functions and dependencies
require get_template_directory() . '/inc/customizer-repeater/inc/customizer.php';


/**
 * Check if Repeater is empty
 *
 * @param string $azera_shop_arr Repeater json array.
 *
 * @return bool
 */
function azera_shop_general_repeater_is_empty( $azera_shop_arr ) {
	if ( empty( $azera_shop_arr ) ) {
		return true;
	}
	$azera_shop_arr_decoded = json_decode( $azera_shop_arr, true );
	$not_check_keys = array( 'choice', 'id' );
	foreach ( $azera_shop_arr_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon') ) {
			    return false;
			}
			if ( ! in_array( $key, $not_check_keys ) ) {
				if ( ! empty( $value ) ) {
					return false;
				}
			}
		}
	}
	return true;
}
