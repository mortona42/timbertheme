<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Since_I_Left_You
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part('template-parts/entry-header'); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sinceileftyou' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sinceileftyou' ),
				'after'  => '</div>',
			) );

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php sinceileftyou_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
