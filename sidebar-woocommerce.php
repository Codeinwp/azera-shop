<?php
/**
 * Template for sidebar on shop page.
 * The sidebar containing the widget area for shop page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @author Themeisle
 * @version 1.1.11
 * @package azera-shop
 */

if ( ! is_active_sidebar( 'sidebar-woocommerce' ) ) {
	return;
}

?>
<div id="secondary" class="col-md-4 shop-sidebar">
	<aside id="secondary" class="widget-area widget-area-shop">
		<?php dynamic_sidebar( 'sidebar-woocommerce' ); ?>
	</aside><!-- #secondary -->
</div>
