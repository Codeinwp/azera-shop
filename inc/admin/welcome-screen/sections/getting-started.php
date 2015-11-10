<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="azera-shop-tab-pane active">

	<div class="azera-shop-tab-pane-center">

		<h1 class="parallax-one-welcome-title">Welcome to Azera Shop! <?php if( !empty($azera_shop['Version']) ): ?> <sup id="azera-shop-theme-version"><?php echo esc_attr( $azera_shop['Version'] ); ?> </sup><?php endif; ?></h1>

		<p><?php esc_html_e( 'Our most elegant and professional one-page theme, which turns your scrolling into a smooth and pleasant experience.','azera-shop'); ?></p>
		<p><?php esc_html_e( 'We want to make sure you have the best experience using Azera Shop and that is why we gathered here all the necessary informations for you. We hope you will enjoy using Azera Shop, as much as we enjoy creating great products.', 'azera-shop' ); ?>

	</div>

	<hr />

	<div class="azera-shop-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'azera-shop' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'azera-shop' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'azera-shop' ); ?></a></p>

	</div>

	<hr />

	<div class="azera-shop-tab-pane-center">

		<h1><?php esc_html_e( 'FAQ', 'azera-shop' ); ?></h1>

	</div>

	<div class="parallax-one-tab-pane-half parallax-one-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create a child theme', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/14-how-to-create-a-child-theme/" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'How to Internationalize Your Website', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Although English is the most used language on the internet, you should consider all your web users as well. Find out what it takes to make your website ready for foreign markets from this document.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/80-how-to-translate-zerif" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Change dimensions for footer social icons', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to change the default dimensions for you social icons.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/71-parallax-one-change-dimensions-for-footer-icons" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>
		
		<hr />

		<h4><?php esc_html_e( 'Change customizer in a child theme', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you want to add or remove customizer controls, check out our documentation to find out how.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/74-how-to-override-controls" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

	</div>

	<div class="parallax-one-tab-pane-half">

		<h4><?php esc_html_e( 'Speed up your site', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/63-speed-up-your-wordpress-site/" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Link Menu to sections', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Linking the frontpage sections with the top menu is very simple, all you need to do is assign section anchors to the menu. In the below documentation you will find a nice tutorial about this.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/59-how-to-link-menu-to-sections-in-parallax-one" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Change anchors', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'To better suit your site\'s needs, you can change each section\'s anchor to what you want. The entire process is described below.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/72-parallax-one-how-to-change-section-anchor" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>
		
		<hr />
		
		<h4><?php esc_html_e( 'Slider in big title section', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you are in the position where you want to change the default appearance of the big title section, you may want to replace it with a nice looking slider. This can be accomplished by following the documention below.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/70-parallax-one-replacing-big-title-section-with-an-image-slider" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

	</div>

	<div class="parallax-one-clear"></div>

	<hr />

	<div class="azera-shop-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'azera-shop' ); ?></h1>
		<p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to use Azera Shop.', 'azera-shop' ); ?></p>
		<p><a href="http://themeisle.com/documentation-azera-shop/" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'azera-shop' ); ?></a></p>

	</div>

	<hr />

	<div class="azera-shop-tab-pane-center">
		<h1><?php esc_html_e( 'Recommended plugins', 'azera-shop' ); ?></h1>
	</div>

	<div class="parallax-one-tab-pane-half parallax-one-tab-pane-first-half">

		<!-- WP Product Review -->
		<h4><?php esc_html_e( 'Intergeo Maps - Google Maps Plugin', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'The Intergeo Google Maps plugin is a simple, easy and in the same time quite powerful tool for handling Google Maps in your website. The plugin allows users to create new maps by using powerful UI builder.', 'azera-shop' ); ?></p>

		<?php if ( is_plugin_active( 'intergeo-maps/index.php' ) ) { ?>

				<p><span class="parallax-one-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

			<?php
		}
		else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=intergeo-maps' ), 'install-plugin_intergeo-maps' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Intergeo Maps', 'azera-shop' ); ?></a></p>

			<?php
		}

		?>
		
		<hr/>
		<!-- WP Product Review -->
		<h4><?php esc_html_e( 'Pirate Forms', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.', 'azera-shop' ); ?></p>

		<?php if ( is_plugin_active( 'pirate-forms/pirate-forms.php' ) ) { ?>

				<p><span class="parallax-one-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

			<?php
		}
		else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pirate-forms' ), 'install-plugin_pirate-forms' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Pirate Forms', 'azera-shop' ); ?></a></p>

			<?php
		}

		?>

	</div>


	
	<div class="parallax-one-tab-pane-half">

		<!-- ShortPixel Image Optimizer -->
		<h4><?php esc_html_e( 'ShortPixel Image Optimizer', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Fast, easy-to-use and lightweight plugin that optimizes images & PDFs. Preserve a high visual quality of images and make your website load faster!', 'azera-shop' ); ?></p>

		<?php if ( is_plugin_active( 'shortpixel-image-optimiser/wp-shortpixel.php' ) ) { ?>

				<p><span class="parallax-one-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

			<?php
		}
		else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'themes.php?page=tgmpa-install-plugins&plugin=shortpixel-image-optimiser' ), 'install-plugin_shortpixel-image-optimiser' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install ShortPixel Image Optimizer', 'azera-shop' ); ?></a></p>

			<?php
		}
		?>

	</div>

	<div class="parallax-one-clear"></div>

</div>
