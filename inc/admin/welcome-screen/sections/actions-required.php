<?php
/**
 * Actions required
 */
?>

<div id="actions_required" class="azera-shop-tab-pane">

    <h1><?php esc_html_e( 'Keep up with Azera Shop\'s recommended actions' ,'azera-shop' ); ?></h1>

    <!-- NEWS -->
    <hr />
	
	<?php
	global $azera_shop_required_actions;
	
	if( !empty($azera_shop_required_actions) ):
	
		/* $azera_shop_required_actions is an array of true/false for each required action that was dismissed */
		
		$azera_shop_show_required_actions = get_option("azera_shop_show_required_actions");
		
		foreach( $azera_shop_required_actions as $azera_shop_required_action_key => $azera_shop_required_action_value ):
		
			if(@$azera_shop_show_required_actions[$azera_shop_required_action_value['id']] === false) continue;
			if(@$azera_shop_required_action_value['check']) continue;
			?>
			<div class="azera-shop-action-required-box">
				<span class="dashicons dashicons-no-alt azera-shop-dismiss-required-action" id="<?php echo $azera_shop_required_action_value['id']; ?>"></span>
				<h4><?php echo $azera_shop_required_action_key + 1; ?>. <?php if( !empty($azera_shop_required_action_value['title']) ): echo $azera_shop_required_action_value['title']; endif; ?></h4>
				<p><?php if( !empty($azera_shop_required_action_value['description']) ): echo $azera_shop_required_action_value['description']; endif; ?></p>
				<?php
					if( !empty($azera_shop_required_action_value['plugin_slug']) ):
						?><p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.$azera_shop_required_action_value['plugin_slug'] ), 'install-plugin_'.$azera_shop_required_action_value['plugin_slug'] ) ); ?>" class="button button-primary"><?php if( !empty($azera_shop_required_action_value['title']) ): echo $azera_shop_required_action_value['title']; endif; ?></a></p><?php
					endif;
				?>

				<hr />
			</div>
			<?php
		endforeach;
	endif;
	$nr_actions_required = 0;
	/* get number of required actions */
	if( get_option('azera_shop_show_required_actions') ):
		$azera_shop_show_required_actions = get_option('azera_shop_show_required_actions');
	else:
		$azera_shop_show_required_actions = array();
	endif;
	if( !empty($azera_shop_required_actions) ):
		foreach( $azera_shop_required_actions as $azera_shop_required_action_value ):
			if(( !isset( $azera_shop_required_action_value['check'] ) || ( isset( $azera_shop_required_action_value['check'] ) && ( $azera_shop_required_action_value['check'] == false ) ) ) && ((isset($azera_shop_show_required_actions[$azera_shop_required_action_value['id']]) && ($azera_shop_show_required_actions[$azera_shop_required_action_value['id']] == true)) || !isset($azera_shop_show_required_actions[$azera_shop_required_action_value['id']]) )) :
				$nr_actions_required++;
			endif;
		endforeach;
	endif;
	if( $nr_actions_required == 0 ):
		echo '<p>'.__( 'Hooray! There are no required actions for you right now.','azera-shop' ).'</p>';
	endif;
	?>

</div>