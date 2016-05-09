<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="azera-shop-tab-pane active">

	<div class="azera-shop-tab-pane-center">
		<?php
		$azera_shop_theme = wp_get_theme(); 
		$azera_shop_version = $azera_shop_theme->get('Version'); ?>
		<h1 class="azera-shop-welcome-title">
			<?php printf( __( 'Welcome to %1$s!', 'azera-shop' ), $azera_shop_theme->get( 'Name' ) ); ?> 
			<?php if( !empty( $azera_shop_version ) ): ?> 
				<sup id="azera-shop-theme-version">
					<?php echo esc_attr( $azera_shop_version ); ?> 
				</sup>
			<?php endif; ?>
		</h1>

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

	<div class="azera-shop-tab-pane-half azera-shop-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create a child theme', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/14-how-to-create-a-child-theme/" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'How to Internationalize Your Website', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Although English is the most used language on the internet, you should consider all your web users as well. Find out what it takes to make your website ready for foreign markets from this document.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/80-how-to-translate-zerif" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

	</div>

	<div class="azera-shop-tab-pane-half">

		<h4><?php esc_html_e( 'Speed up your site', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/63-speed-up-your-wordpress-site/" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Link Menu to sections', 'azera-shop' ); ?></h4>
		<p><?php esc_html_e( 'Linking the frontpage sections with the top menu is very simple, all you need to do is assign section anchors to the menu. In the below documentation you will find a nice tutorial about this.', 'azera-shop' ); ?></p>
		<p><a href="http://docs.themeisle.com/article/59-how-to-link-menu-to-sections-in-parallax-one" class="button"><?php esc_html_e( 'View how to do this', 'azera-shop' ); ?></a></p>


	</div>

	<div class="azera-shop-clear"></div>

	<hr />

	<div class="azera-shop-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'azera-shop' ); ?></h1>
		<p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to use Azera Shop.', 'azera-shop' ); ?></p>
		<p><a href="http://themeisle.com/documentation-azera-shop/" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'azera-shop' ); ?></a></p>

	</div>

	<hr />

	<?php if( current_user_can( 'activate_plugins' ) ){ ?> 

		<div class="azera-shop-tab-pane-center">
			<h1><?php esc_html_e( 'Recommended plugins', 'azera-shop' ); ?></h1>
		</div>

		<div class="azera-shop-tab-pane-half azera-shop-tab-pane-first-half">
		
			<!-- Azera Shop Companion -->
			<h4><?php esc_html_e( 'Azera Shop Companion', 'azera-shop' ); ?></h4>
			<p><?php printf(  __('The %1$s plugin is a simple, easy and in the same time quite powerful plugins that adds options for Our Services, Our Team and Testimonials sections on frontpage.', 'azera-shop' ), 'Azera Shop Companion' ); ?></p>

			<?php if ( is_plugin_active( 'azera-shop-companion/azera-shop-companion.php' ) ) { ?>

					<p><span class="azera-shop-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

				<?php
			}
			else { ?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=azera-shop-companion' ), 'install-plugin_azera-shop-companion' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %1$s', 'azera-shop' ), 'Azera Shop Companion' ); ?></a></p>

				<?php
			}
			?>
			<hr />

			<!-- Intergeo Maps -->
			<h4><?php esc_html_e( 'Intergeo Maps - Google Maps Plugin', 'azera-shop' ); ?></h4>
			<p><?php esc_html_e( 'The Intergeo Google Maps plugin is a simple, easy and in the same time quite powerful tool for handling Google Maps in your website. The plugin allows users to create new maps by using powerful UI builder.', 'azera-shop' ); ?></p>

			<?php if ( is_plugin_active( 'intergeo-maps/index.php' ) ) { ?>

					<p><span class="azera-shop-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

				<?php
			}
			else { ?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=intergeo-maps' ), 'install-plugin_intergeo-maps' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Intergeo Maps', 'azera-shop' ); ?></a></p>

				<?php
			}

			?>
		</div>


		
		<div class="azera-shop-tab-pane-half">

			<!-- Pirate Forms -->
			<h4><?php esc_html_e( 'Pirate Forms', 'azera-shop' ); ?></h4>
			<p><?php esc_html_e( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.', 'azera-shop' ); ?></p>

			<?php if ( is_plugin_active( 'pirate-forms/pirate-forms.php' ) ) { ?>

					<p><span class="azera-shop-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

				<?php
			}
			else { ?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pirate-forms' ), 'install-plugin_pirate-forms' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Pirate Forms', 'azera-shop' ); ?></a></p>

				<?php
			}

			?>

			<hr />

			<!-- Adblock Notify -->
			<h4>Adblock Notify</h4>

			<?php if ( is_plugin_active( 'adblock-notify-by-bweb/adblock-notify.php' ) ) { ?>

				<p><span class="azera-shop-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

				<?php
			}
			else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=adblock-notify-by-bweb' ), 'install-plugin_adblock-notify-by-bweb' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'azera-shop' ); ?> Adblock Notify</a></p>

				<?php
			} 
			?>

			<hr />

			<!-- FEEDZY RSS Feeds -->
			<h4>FEEDZY RSS Feeds</h4>

			<?php if ( is_plugin_active( 'feedzy-rss-feeds/feedzy-rss-feed.php' ) ) { ?>

				<p><span class="azera-shop-w-activated button"><?php esc_html_e( 'Already activated', 'azera-shop' ); ?></span></p>

				<?php
			}
			else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=feedzy-rss-feeds' ), 'install-plugin_feedzy-rss-feeds' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'azera-shop' ); ?> FEEDZY RSS Feeds</a></p>

				<?php
			}
			?>

		</div>
	<?php
	}
	?>
	<div class="azera-shop-clear"></div>

</div>
