<?php
/**
 * Theme widgets.
 *
 * @package Mediclean
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'mediclean_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function mediclean_load_widgets() {

		// Social widget.
		register_widget( 'Mediclean_Social_Widget' );

		// Latest News widget.
		register_widget( 'Mediclean_Latest_News_Widget' );

		// Contact widget.
		register_widget( 'Mediclean_Appointment_Widget' );

		// Call To Action widget.
		register_widget( 'Mediclean_Call_To_Action_Widget' );

	}

endif;

add_action( 'widgets_init', 'mediclean_load_widgets' );

if ( ! class_exists( 'Mediclean_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Mediclean_Social_Widget extends Mediclean_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'mediclean_widget_social',
				'description'                 => __( 'Displays social icons.', 'mediclean' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'mediclean' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'mediclean' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'mediclean-social', __( 'Mediclean: Social', 'mediclean' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
					'item_spacing'   => 'discard',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Mediclean_Latest_News_Widget' ) ) :

	/**
	 * Latest news widget Class.
	 *
	 * @since 1.0.0
	 */
	class Mediclean_Latest_News_Widget extends Mediclean_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'mediclean_widget_latest_news',
				'description'                 => __( 'Displays latest posts in grid.', 'mediclean' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'mediclean' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'mediclean' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'mediclean' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'mediclean' ),
					'type'    => 'number',
					'default' => 5,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'mediclean' ),
					'description' => __( 'in words. Applies for first news block.', 'mediclean' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 80,
					'min'         => 1,
					'max'         => 200,
					'adjacent'    => true,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'mediclean' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'mediclean-latest-news', __( 'Mediclean: Latest News', 'mediclean' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				'meta_key'       => '_thumbnail_id',
				);
			if ( absint( $params['post_category'] ) > 0  ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}
			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>
				<?php global $post; ?>

				<div class="latest-news-widget latest-news-col-3">

					<div class="inner-wrapper">
						<?php $cnt = 1; ?>
						<?php foreach ( $all_posts as $key => $post ) : ?>
							<?php setup_postdata( $post ); ?>

							<?php $featured_class = ( 1 == $cnt ) ? 'news-featured' : ''; ?>
							<div class="latest-news-item <?php echo esc_attr( $featured_class ); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="latest-news-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'mediclean-thumb', array( 'class' => 'aligncenter' ) ); ?>
										</a>
									</div><!-- .latest-news-thumb -->
								<?php endif; ?>
								<div class="latest-news-text-wrap">

									<div class="latest-news-text-content">
										<h3 class="latest-news-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3><!-- .latest-news-title -->
										<?php if ( 1 === $cnt ) : ?>
											<div class="latest-news-summary">
												<?php
												$excerpt = mediclean_the_excerpt( absint( $params['excerpt_length'] ), $post );
												echo wp_kses_post( wpautop( $excerpt ) );
												?>
											</div><!-- .latest-news-summary -->
										<?php endif; ?>

									</div><!-- .latest-news-text-content -->

									<?php if ( false === $params['disable_date'] ) : ?>
										<div class="latest-news-meta">
											<ul>
												<?php if ( false === $params['disable_date'] ) : ?>
													<li><span class="latest-news-date"><?php the_time( 'j M Y' ); ?></span></li>
												<?php endif; ?>
											</ul>
										</div><!-- .latest-news-meta -->
									<?php endif; ?>

								</div><!-- .latest-news-text-wrap -->

							</div><!-- .latest-news-item -->

							<?php $cnt++; ?>
						<?php endforeach; ?>

					</div><!-- .inner-wrapper -->

				</div><!-- .latest-news-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Mediclean_Appointment_Widget' ) ) :

	/**
	 * Appointment widget Class.
	 *
	 * @since 1.0.0
	 */
	class Mediclean_Appointment_Widget extends Mediclean_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'mediclean_widget_appointment',
				'description'                 => __( 'Displays appointment form.', 'mediclean' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'mediclean' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'form_id' => array(
					'label'   => __( 'Select Form:', 'mediclean' ),
					'type'    => 'select',
					'options' => mediclean_get_contact_form_options(),
					),
				'form_message' => array(
					'label' => _x( 'OR', 'Mediclean Appointment', 'mediclean' ),
					'type'  => 'heading',
					),
				'form_shortcode' => array(
					'label' => __( 'Enter Form Shortcode:', 'mediclean' ),
					'type'  => 'textarea',
					'class' => 'widefat',
					),
				);

			parent::__construct( 'mediclean-appointment', __( 'Mediclean: Appointment', 'mediclean' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$shortcode_text = null;

			if ( ! empty( $params['form_id'] ) && absint( $params['form_id'] ) > 0 && defined( 'WPCF7_VERSION' ) ) {
				$shortcode_text = '[contact-form-7 id="' . absint( $params['form_id'] ) . '"]';
			}

			if ( empty( $shortcode_text ) ) {
				$shortcode_text = wp_kses_data( $params['form_shortcode'] );
			}

			if ( ! empty( $shortcode_text ) ) {
				echo do_shortcode( $shortcode_text );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Mediclean_Call_To_Action_Widget' ) ) :

	/**
	 * Call to action widget Class.
	 *
	 * @since 1.0.0
	 */
	class Mediclean_Call_To_Action_Widget extends Mediclean_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'mediclean_widget_call_to_action',
				'description'                 => __( 'Call To Action Widget.', 'mediclean' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'mediclean' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'description' => array(
					'label' => __( 'Text:', 'mediclean' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'primary_button_text' => array(
					'label'   => __( 'Button Text:', 'mediclean' ),
					'default' => __( 'Learn more', 'mediclean' ),
					'type'    => 'text',
					'class'   => 'widefat',
					),
				'primary_button_url' => array(
					'label' => __( 'Button URL:', 'mediclean' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				);

			parent::__construct( 'mediclean-call-to-action', __( 'Mediclean: Call To Action', 'mediclean' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}
			?>
			<div class="call-to-action-content">
				<?php if ( ! empty( $params['description'] ) ) : ?>
					<div class="call-to-action-description">
						<?php echo wp_kses_post( wpautop( $params['description'] ) ); ?>
					</div><!-- .call-to-action-description -->
				<?php endif; ?>
				<?php if ( ! empty( $params['primary_button_text'] ) ) : ?>
					<div class="call-to-action-buttons">
						<a href="<?php echo esc_url( $params['primary_button_url'] ); ?>" class="custom-button btn-call-to-action btn-call-to-primary"><?php echo esc_html( $params['primary_button_text'] ); ?></a>
					</div><!-- .call-to-action-buttons -->
				<?php endif; ?>
			</div><!-- .call-to-action-content -->
			<?php

			echo $args['after_widget'];

		}
	}
endif;
