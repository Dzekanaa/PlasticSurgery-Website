<?php
/**
 * Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Mediclean
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @since 1.0.0
 */
function mediclean_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'mediclean_custom_header_args', array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 500,
			'flex-height'   => true,
			'header-text'   => false,
	) ) );

	// Register default headers.
	register_default_headers( array(
		'corporate-business' => array(
			'url'           => '%s/images/header-banner.jpg',
			'thumbnail_url' => '%s/images/header-banner.jpg',
			'description'   => _x( 'Corporate Business', 'header image description', 'mediclean' ),
		),

	) );
}

add_action( 'after_setup_theme', 'mediclean_custom_header_setup' );
