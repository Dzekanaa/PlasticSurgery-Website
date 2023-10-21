<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mediclean
 */

?><?php
	/**
	 * Hook - mediclean_action_doctype.
	 *
	 * @hooked mediclean_doctype -  10
	 */
	do_action( 'mediclean_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - mediclean_action_head.
	 *
	 * @hooked mediclean_head -  10
	 */
	do_action( 'mediclean_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' );  ?>

	<?php
	/**
	 * Hook - mediclean_action_before.
	 *
	 * @hooked mediclean_page_start - 10
	 * @hooked mediclean_skip_to_content - 15
	 */
	do_action( 'mediclean_action_before' );
	?>

    <?php
	  /**
	   * Hook - mediclean_action_before_header.
	   *
	   * @hooked mediclean_header_start - 10
	   */
	  do_action( 'mediclean_action_before_header' );
	?>
		<?php
		/**
		 * Hook - mediclean_action_header.
		 *
		 * @hooked mediclean_site_branding - 10
		 */
		do_action( 'mediclean_action_header' );
		?>
    <?php
	  /**
	   * Hook - mediclean_action_after_header.
	   *
	   * @hooked mediclean_header_end - 10
	   */
	  do_action( 'mediclean_action_after_header' );
	?>

	<?php
	/**
	 * Hook - mediclean_action_before_content.
	 *
	 * @hooked mediclean_add_breadcrumb - 7
	 * @hooked mediclean_content_start - 10
	 */
	do_action( 'mediclean_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - mediclean_action_content.
	   */
	  do_action( 'mediclean_action_content' );
	?>
