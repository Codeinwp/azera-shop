<?php
/**
 * Welcome Screen Class
 */
class azera_shop_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'azera_shop_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'azera_shop_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'azera_shop_welcome_style_and_scripts' ) );
		
		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'azera_shop_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'azera_shop_welcome', array( $this, 'azera_shop_welcome_getting_started' ), 	    10 );
		add_action( 'azera_shop_welcome', array($this, 'azera_shop_welcome_actions_required' ),         20 );
		add_action( 'azera_shop_welcome', array( $this, 'azera_shop_welcome_github' ), 		            30 );
		add_action( 'azera_shop_welcome', array( $this, 'azera_shop_welcome_support' ), 	            40 );
		add_action( 'azera_shop_welcome', array( $this, 'azera_shop_welcome_changelog' ), 				50 );
		
		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_azera_shop_dismiss_required_action', array( $this, 'azera_shop_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_azera_shop_dismiss_required_action', array($this, 'azera_shop_dismiss_required_action_callback') );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 */
	public function azera_shop_welcome_register_menu() {
		$azera_shop_theme = wp_get_theme();
		$page_menu_title = esc_html__('About', 'azera-shop').' '.$azera_shop_theme->get( 'Name' );
		add_theme_page( $page_menu_title, $page_menu_title, 'edit_theme_options', 'azera-shop-welcome', array( $this, 'azera_shop_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 */
	public function azera_shop_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'azera_shop_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 */
	public function azera_shop_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Azera Shop! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'azera-shop' ), '<a href="' . esc_url( admin_url( 'themes.php?page=azera-shop-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=azera-shop-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Azera Shop', 'azera-shop' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 */
	public function azera_shop_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_azera-shop-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'azera-shop-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'azera-shop-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array('jquery') );
			
			global $azera_shop_required_actions;
			
			$nr_actions_required = 0;
			
			/* get number of required actions */
			if( get_option('azera_shop_show_required_actions') ):
				$azera_shop_show_required_actions = get_option('azera_shop_show_required_actions');
			else:
				$azera_shop_show_required_actions = array();
			endif;
			if( !empty($azera_shop_required_actions) ):
				foreach( $azera_shop_required_actions as $azera_shop_required_action_value ):
					if(( !isset( $azera_shop_required_action_value['check'] ) || ( isset($azera_shop_required_action_value['check'] ) && ( $azera_shop_required_action_value['check'] == false ) ) ) && ( (isset($azera_shop_show_required_actions[$azera_shop_required_action_value['id']]) && ($azera_shop_show_required_actions[$azera_shop_required_action_value['id']] == true)) || !isset($azera_shop_show_required_actions[$azera_shop_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;
			wp_localize_script( 'azera-shop-welcome-screen-js', 'azeraShopWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','azera-shop' )
			) );
		}
	}
	
	/**
	 * Load scripts for customizer page
	 */
	public function azera_shop_welcome_scripts_for_customizer() {
		
		wp_enqueue_style( 'azera-shop-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'azera-shop-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );
		
		global $azera_shop_required_actions;
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
		wp_localize_script( 'azera-shop-welcome-screen-customizer-js', 'azeraShopWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=azera-shop-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) )
		) );
	}
	
	/**
	 * Dismiss required actions
	 */
	public function azera_shop_dismiss_required_action_callback() {
		
		global $azera_shop_required_actions;
		
		$azera_shop_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;
		echo $azera_shop_dismiss_id; /* this is needed and it's the id of the dismissable required action */
		if( !empty($azera_shop_dismiss_id) ):
			/* if the option exists, update the record for the specified id */
			if( get_option('azera_shop_show_required_actions') ):
				$azera_shop_show_required_actions = get_option('azera_shop_show_required_actions');
				$azera_shop_show_required_actions[$azera_shop_dismiss_id] = false;
				update_option( 'azera_shop_show_required_actions',$azera_shop_show_required_actions );
			/* create the new option,with false for the specified id */
			else:
				$azera_shop_show_required_actions_new = array();
				if( !empty($azera_shop_required_actions) ):
					foreach( $azera_shop_required_actions as $azera_shop_required_action ):
						if( $azera_shop_required_action['id'] == $azera_shop_dismiss_id ):
							$azera_shop_show_required_actions_new[$azera_shop_required_action['id']] = false;
						else:
							$azera_shop_show_required_actions_new[$azera_shop_required_action['id']] = true;
						endif;
					endforeach;
				update_option( 'azera_shop_show_required_actions', $azera_shop_show_required_actions_new );
				endif;
			endif;
		endif;
		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 */
	public function azera_shop_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="azera-shop-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','azera-shop'); ?></a></li>
			<li role="presentation" class="azera-shop-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions recommended','azera-shop'); ?></a></li>
			<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute','azera-shop'); ?></a></li>
			<li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab"><?php esc_html_e( 'Support','azera-shop'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Change log','azera-shop'); ?></a></li>
		</ul>

		<div class="azera-shop-tab-content">

			<?php
			/**
			 * @hooked azera_shop_welcome_getting_started - 10
			 * @hooked azera_shop_welcome_actions_required - 20
			 * @hooked azera_shop_welcome_github - 30
			 * @hooked azera_shop_welcome_support - 40
			 * @hooked azera_shop_welcome_changelog - 50
			 */
			do_action( 'azera_shop_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 */
	public function azera_shop_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Actions required
	 */
	public function azera_shop_welcome_actions_required() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/actions-required.php' );
	}

	/**
	 * Contribute
	 */
	public function azera_shop_welcome_github() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/github.php' );
	}
	
	/**
	 * Support
	 */
	public function azera_shop_welcome_support() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/support.php' );
	}

	/**
	 * Changelog
	 */
	public function azera_shop_welcome_changelog() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/changelog.php' );
	}

}

$GLOBALS['azera_shop_Welcome'] = new azera_shop_Welcome();