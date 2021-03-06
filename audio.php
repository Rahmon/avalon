<?php
/**
 * The template for displaying audio attachments.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="col-md-offset-1 col-md-8 col-md-push-3 no-gutter" tabindex="-1" role="main">

			<?php while ( have_posts() ) : the_post(); $metadata = wp_get_attachment_metadata(); ?>
				<article <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content entry-attachment">
						<?php echo wp_audio_shortcode( array( 'src' => wp_get_attachment_url() ) ); ?>

						<p><strong><?php _e( 'URL:', 'avalon-b' ); ?></strong> <a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><span><?php echo esc_html( basename( wp_get_attachment_url() ) ); ?></span></a></p>

						<?php the_content(); ?>

						<?php if ( ! empty( $post->post_parent ) ) : ?>
							<ul class="pager page-title">
								<li class="previous"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo esc_attr( sprintf( __( 'Back to %s', 'avalon-b' ), strip_tags( get_the_title( $post->post_parent ) ) ) ); ?>"><?php printf( __( '<span class="meta-nav">&larr;</span> %s', 'avalon-b' ), get_the_title( $post->post_parent ) ); ?></a></li>
							</ul><!-- .pager -->
						<?php endif; ?>
					</div><!-- .entry-content -->
				</article>
			<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
