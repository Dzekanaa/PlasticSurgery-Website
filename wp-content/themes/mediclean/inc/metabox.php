<?php
/**
 * Implement theme metabox.
 *
 * @package Mediclean
 */

if ( ! function_exists( 'mediclean_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box.
	 *
	 * @since 1.0.0
	 */
	function mediclean_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'theme-settings',
				esc_html__( 'Theme Settings', 'mediclean' ),
				'mediclean_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'mediclean_add_theme_meta_box' );

if ( ! function_exists( 'mediclean_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post    The current post.
	 * @param array   $metabox Metabox arguments.
	 */
	function mediclean_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'mediclean_theme_settings_meta_box_nonce' );

		// Fetch values of current post meta.
		$values = get_post_meta( $post_id, 'mediclean_theme_settings', true );
		$mediclean_theme_settings_post_layout = isset( $values['post_layout'] ) ? esc_attr( $values['post_layout'] ) : '';
		$mediclean_theme_settings_disable_banner_area = isset( $values['disable_banner_area'] ) ? esc_attr( $values['disable_banner_area'] ) : '';
		$mediclean_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
	?>
	<div id="mediclean-settings-metabox-container" class="mediclean-settings-metabox-container">
	  <ul>
	    <li><a href="#mediclean-settings-metabox-tab-layout"><?php echo __( 'Layout', 'mediclean' ); ?></a></li>
	    <li><a href="#mediclean-settings-metabox-tab-header"><?php echo __( 'Header', 'mediclean' ); ?></a></li>
	    <li><a href="#mediclean-settings-metabox-tab-image"><?php echo __( 'Image', 'mediclean' ); ?></a></li>
	  </ul>
	  <div id="mediclean-settings-metabox-tab-layout">
	    <h4><?php echo __( 'Layout Settings', 'mediclean' ); ?></h4>
	    <div class="mediclean-row-content">
	    	<label for="mediclean_theme_settings_post_layout"><?php echo esc_html__( 'Single Layout', 'mediclean' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'mediclean_theme_settings_post_layout',
				'name'        => 'mediclean_theme_settings[post_layout]',
				'selected'    => $mediclean_theme_settings_post_layout,
				'add_default' => true,
	    		);
	    	mediclean_render_select_dropdown( $dropdown_args, 'mediclean_get_global_layout_options' );
	    	?>

	    </div><!-- .mediclean-row-content -->

	  </div><!-- #mediclean-settings-metabox-tab-layout -->

	  <div id="mediclean-settings-metabox-tab-header">
	    <h4><?php echo __( 'Header Settings', 'mediclean' ); ?></h4>
	    <div class="mediclean-row-content">
	    	<label for="mediclean_theme_settings_disable_banner_area"><?php echo esc_html__( 'Header Banner', 'mediclean' ); ?></label>
	    	<input type="checkbox" name="mediclean_theme_settings[disable_banner_area]" id="mediclean_theme_settings_disable_banner_area" value="1" <?php checked( $mediclean_theme_settings_disable_banner_area, '1' ); ?> />&nbsp;<span class="field-description"><?php _e( 'Check to Disable Header Banner', 'mediclean' )?></span>
	    </div><!-- .mediclean-row-content -->

	  </div><!-- #mediclean-settings-metabox-tab-header -->

	  <div id="mediclean-settings-metabox-tab-image">
		    <h4><?php echo __( 'Image Settings', 'mediclean' ); ?></h4>
		    <div class="mediclean-row-content">
			    <label for="mediclean_theme_settings_single_image"><?php echo esc_html__( 'Image in Single Post/Page', 'mediclean' ); ?></label>
	        	<?php
	        	$dropdown_args = array(
	    			'id'          => 'mediclean_theme_settings_single_image',
	    			'name'        => 'mediclean_theme_settings[single_image]',
	    			'selected'    => $mediclean_theme_settings_single_image,
	    			'add_default' => true,
	        		);
	        	mediclean_render_select_dropdown( $dropdown_args, 'mediclean_get_image_sizes_options', array( true, array( 'disable', 'large' ), false ) );
	        	?>
		    </div><!-- .mediclean-row-content -->

	  </div><!-- #mediclean-settings-metabox-tab-image -->

	</div><!-- #mediclean-settings-metabox-container -->

	<?php
	}

endif;

if ( ! function_exists( 'mediclean_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function mediclean_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if (
			! ( isset( $_POST['mediclean_theme_settings_meta_box_nonce'] )
			&& wp_verify_nonce( sanitize_key( $_POST['mediclean_theme_settings_meta_box_nonce'] ), basename( __FILE__ ) ) )
		) {
			return;
		}

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) !== $post_id ) {
			return;
		}

		// Check permission.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['mediclean_theme_settings'] ) && is_array( $_POST['mediclean_theme_settings'] ) ) {
			$raw_value = wp_unslash( $_POST['mediclean_theme_settings'] );

			if ( ! array_filter( $raw_value ) ) {

				// No value.
				delete_post_meta( $post_id, 'mediclean_theme_settings' );

			} else {

				$meta_fields = array(
					'post_layout' => array(
						'type' => 'select',
						),
					'disable_banner_area' => array(
						'type' => 'checkbox',
						),
					'single_image' => array(
						'type' => 'select',
						),
					);

				$sanitized_values = array();

				foreach ( $raw_value as $mk => $mv ) {

					if ( isset( $meta_fields[ $mk ]['type'] ) ) {
						switch ( $meta_fields[ $mk ]['type'] ) {
							case 'select':
								$sanitized_values[ $mk ] = sanitize_key( $mv );
								break;
							case 'checkbox':
								$sanitized_values[ $mk ] = absint( $mv ) > 0 ? 1 : 0;
								break;
							default:
								$sanitized_values[ $mk ] = sanitize_text_field( $mv );
								break;
						}
					} // End if.

				}

				update_post_meta( $post_id, 'mediclean_theme_settings', $sanitized_values );
			}
		} // End if theme settings.

	}

endif;

add_action( 'save_post', 'mediclean_save_theme_settings_meta', 10, 2 );
