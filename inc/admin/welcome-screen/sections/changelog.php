<?php
/**
 * Changelog
 */

$azera_shop = wp_get_theme( 'azera-shop' );

?>
<div class="azera-shop-tab-pane" id="changelog">

	<div class="azera-shop-tab-pane-center">
	
		<h1>Azera Shop <?php if( !empty($azera_shop['Version']) ): ?> <sup id="azera-shop-theme-version"><?php echo esc_attr( $azera_shop['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$azera_shop_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
	$azera_shop_changelog_lines = explode(PHP_EOL, $azera_shop_changelog);
	foreach($azera_shop_changelog_lines as $azera_shop_changelog_line){
		if(substr( $azera_shop_changelog_line, 0, 3 ) === "###"){
			echo '<hr /><h1>'.substr($azera_shop_changelog_line,3).'</h1>';
		} else {
			echo $azera_shop_changelog_line.'<br/>';
		}
	}

?>
	
</div>
