<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mediclean
 */

	/**
	 * Hook - mediclean_action_after_content.
	 *
	 * @hooked mediclean_content_end - 10
	 */
	do_action( 'mediclean_action_after_content' );
?>

	<?php
	/**
	 * Hook - mediclean_action_before_footer.
	 *
	 * @hooked mediclean_add_footer_bottom_widget_area - 5
	 * @hooked mediclean_footer_start - 10
	 */
	do_action( 'mediclean_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - mediclean_action_footer.
	   *
	   * @hooked mediclean_footer_copyright - 10
	   */
	  do_action( 'mediclean_action_footer' );
	?>
	<?php
	/**
	 * Hook - mediclean_action_after_footer.
	 *
	 * @hooked mediclean_footer_end - 10
	 */
	do_action( 'mediclean_action_after_footer' );
	?>

<?php
	/**
	 * Hook - mediclean_action_after.
	 *
	 * @hooked mediclean_page_end - 10
	 * @hooked mediclean_footer_goto_top - 20
	 */
	do_action( 'mediclean_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
