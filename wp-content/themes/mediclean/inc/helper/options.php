<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package Mediclean
 */

if ( ! function_exists( 'mediclean_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'mediclean' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'mediclean' ),
			'three-columns' => esc_html__( 'Three Columns', 'mediclean' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'mediclean' ),
		);
		$output = apply_filters( 'mediclean_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_breadcrumb_type_options() {

		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'mediclean' ),
			'simple'   => esc_html__( 'Simple', 'mediclean' ),
		);
		return $choices;

	}

endif;


if ( ! function_exists( 'mediclean_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'mediclean' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'mediclean' ),
		);
		$output = apply_filters( 'mediclean_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function mediclean_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'mediclean' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'mediclean' );
		$choices['medium']    = esc_html__( 'Medium', 'mediclean' );
		$choices['large']     = esc_html__( 'Large', 'mediclean' );
		$choices['full']      = esc_html__( 'Full (original)', 'mediclean' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ){
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;


if ( ! function_exists( 'mediclean_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'Alignment', 'mediclean' ),
			'left'   => _x( 'Left', 'Alignment', 'mediclean' ),
			'center' => _x( 'Center', 'Alignment', 'mediclean' ),
			'right'  => _x( 'Right', 'Alignment', 'mediclean' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'mediclean_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'Transition Effect', 'mediclean' ),
			'fadeout'    => _x( 'fadeout', 'Transition Effect', 'mediclean' ),
			'none'       => _x( 'none', 'Transition Effect', 'mediclean' ),
			'scrollHorz' => _x( 'scrollHorz', 'Transition Effect', 'mediclean' ),
		);
		$output = apply_filters( 'mediclean_filter_featured_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_featured_slider_content_options() {

		$choices = array(
			'home-page' => esc_html__( 'Static Front Page Only', 'mediclean' ),
			'disabled'  => esc_html__( 'Disabled', 'mediclean' ),
		);
		$output = apply_filters( 'mediclean_filter_featured_slider_content_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_featured_slider_type() {

		$choices = array(
			'featured-page' => __( 'Featured Pages', 'mediclean' ),
		);
		$output = apply_filters( 'mediclean_filter_featured_slider_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int $min Min.
	 * @param int $max Max.
	 *
	 * @return array Options array.
	 */
	function mediclean_get_numbers_dropdown_options( $min = 1, $max = 4 ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$output[ $i ] = $i;
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'mediclean_get_contact_form_options' ) ) :

	/**
	 * Returns the contact form options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function mediclean_get_contact_form_options() {

		$output = array();
		$output[] = __( '&mdash; Select &mdash;', 'mediclean' );

		if ( defined( 'WPCF7_VERSION' ) ) {
			$qargs = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => 100,
				'no_found_rows'  => true,
				);
			$all_posts = get_posts( $qargs );
			if ( ! empty( $all_posts ) ) {
				foreach ( $all_posts as $p ) {
					$output[ $p->ID ] = esc_html( $p->post_title );
				}
			}
		}
		return $output;

	}

endif;
