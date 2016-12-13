<?php
/**
 * Template Name: Contact
 *
 * @package azera-shop
 */

get_header();
azera_shop_wrapper_start(); ?>

	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'contact' ); ?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

<?php
azera_shop_wrapper_end();
get_footer(); ?>
