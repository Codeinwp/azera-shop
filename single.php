<?php
/**
 * The template for displaying all single posts.
 *
 * @package azera-shop
 */

$class_to_add = 'col-md-12';
if ( is_active_sidebar( 'sidebar-1' ) ) {
	$class_to_add = 'col-md-8';
}
get_header();

azera_shop_top_single_post_trigger();

azera_shop_wrapper_start( $class_to_add , false ); ?>

	<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php the_post_navigation(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || get_comments_number() ) :
			comments_template();
			endif;
		?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

<?php

azera_shop_wrapper_end( true );

azera_shop_bottom_single_post_trigger();

get_footer(); ?>
