<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Mediclean
 */

if ( ! function_exists( 'mediclean_trigger_custom_css_action' ) ) :

	/**
	 * Do action theme custom CSS.
	 *
	 * @since 1.0.0
	 */
	function mediclean_trigger_custom_css_action() {

		/**
		 * Hook - mediclean_action_theme_custom_css.
		 */
		do_action( 'mediclean_action_theme_custom_css' );

	}

endif;

add_action( 'wp_head', 'mediclean_trigger_custom_css_action', 99 );
