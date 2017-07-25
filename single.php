<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<div class="single-post col-md-offset-1 col-md-8 col-md-push-3 no-gutter">
		<main id="main-content" class="site-main" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					?>
					<nav class="navigation post-navigation" role="navigation">
						<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'avalon-b' ); ?></h2>
						<div class="nav-links">
							<div class="nav-previous">
								<?php previous_post_link( '<span class="meta-nav dashicons dashicons-arrow-left-alt"></span> %link' ); ?>
							</div>
							<div class="nav-next">
								<?php next_post_link( '<span class="meta-nav dashicons dashicons-arrow-right-alt"></span> %link' ); ?>
							</div>
						</div>
					</nav>
					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
