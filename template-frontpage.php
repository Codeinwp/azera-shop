<?php
/**
 * Template name: Frontpage
 *
 * @package azera-shop
 */

		get_header();

		azera_shop_get_template_part( apply_filters( 'azera_shop_header_layout','/sections/azera_shop_header_section' ) );
	?>
		</div>
		<!-- /END COLOR OVER IMAGE -->
	</header>
	<!-- /END HOME / HEADER  -->

<div itemprop id="content" class="content-warp" role="main">

	<?php

		$sections_array = apply_filters( 'azera_shop_companion_sections_filter',array( 'sections/azera_shop_logos_section', 'sections/azera_shop_shop_section', 'sections/azera_shop_shortcodes_section', 'sections/azera_shop_ribbon_section', 'sections/azera_shop_contact_info_section', 'sections/azera_shop_map_section' ) );

	if ( ! empty( $sections_array ) ) {
		foreach ( $sections_array as $section ) {
			azera_shop_get_template_part( $section );
		}
	}
	?>

</div><!-- .content-wrap -->

<?php get_footer(); ?>
