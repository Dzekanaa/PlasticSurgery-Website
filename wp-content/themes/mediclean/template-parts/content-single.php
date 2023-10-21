<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mediclean
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	  /**
	   * Hook - mediclean_single_image.
	   *
	   * @hooked mediclean_add_image_in_single_display -  10
	   */
	  do_action( 'mediclean_single_image' );
	?>

	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mediclean' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-wrapper -->

	<footer class="entry-footer">
		<?php mediclean_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
