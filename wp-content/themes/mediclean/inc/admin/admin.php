<?php
/**
 * Admin functions.
 *
 * @package Mediclean
 */

add_action( 'admin_menu', 'mediclean_admin_menu_page' );

/**
 * Register admin page.
 *
 * @since 1.0.0
 */
function mediclean_admin_menu_page() {

	$theme = wp_get_theme( get_template() );

	add_theme_page(
		$theme->display( 'Name' ),
		$theme->display( 'Name' ),
		'manage_options',
		'mediclean',
		'mediclean_do_admin_page'
	);

}

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function mediclean_do_admin_page() {

	$theme = wp_get_theme( get_template() );
	?>
	<div class="wrap about-wrap">
		<h1><?php echo esc_html( $theme->display( 'Name' ) ); ?></h1>
		<div class="two-col">

			<div class="col about-text">
				<?php
					$description_raw = $theme->display( 'Description' );
					$main_description = explode( 'Official', $description_raw );
					?>
				<?php echo $main_description[0]; ?>
				<p><?php esc_html_e( 'Version', 'mediclean' ); ?>:&nbsp;<?php echo esc_html( $theme->display( 'Version' ) ); ?></p>
			</div><!-- .col -->

			<div class="col about-img">
				<a href="<?php echo esc_url( $theme->display( 'ThemeURI' ) ); ?>" target="_blank"><img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( $theme->display( 'Name' ) ); ?>" /></a>
			</div><!-- .col -->

		</div><!-- .two-col -->
		<div class="four-col">

			<div class="col">

				<h3><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Upgrade to Pro', 'mediclean' ); ?></h3>
				<p>
					<?php esc_html_e( 'Want more features? Try pro version of the theme. It comes with lots of additional features.', 'mediclean' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/downloads/mediclean-pro/' ); ?>" target="_blank"><?php esc_html_e( 'Buy Pro', 'mediclean' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-admin-customizer"></i><?php esc_html_e( 'Theme Options', 'mediclean' ); ?></h3>

				<p>
					<?php esc_html_e( 'We have used Customizer API for theme options which will help you preview your changes live and fast.', 'mediclean' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( wp_customize_url() ); ?>" ><?php esc_html_e( 'Customize', 'mediclean' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-book-alt"></i><?php esc_html_e( 'Theme Instructions', 'mediclean' ); ?></h3>
				<p>
					<?php esc_html_e( 'We have prepared detailed theme instructions which will help you to customize theme as you prefer.', 'mediclean' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/theme-instructions/mediclean/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'mediclean' ); ?></a>
				</p>

			</div><!-- .col -->


			<div class="col">

				<h3><i class="dashicons dashicons-sos"></i><?php esc_html_e( 'Help &amp; Support', 'mediclean' ); ?></h3>

				<p>
					<?php esc_html_e( 'If you have any question/feedback regarding theme, please post in our official support forum.', 'mediclean' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/forum/mediclean/' ); ?>" target="_blank"><?php esc_html_e( 'Get Support', 'mediclean' ); ?></a>
				</p>

			</div><!-- .col -->

		</div><!-- .four-col -->

	</div><!-- .wrap -->
	<?php
}

/**
 * Load admin scripts.
 *
 * @since 1.0.0
 *
 * @param string $hook Current page hook.
 */
function mediclean_load_admin_scripts( $hook ) {

	if ( 'appearance_page_mediclean' === $hook ) {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style( 'mediclean-admin', get_template_directory_uri() . '/css/admin' . $min . '.css', false, '1.3.0' );

	}

}

add_action( 'admin_enqueue_scripts', 'mediclean_load_admin_scripts' );
