<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<?php
	$categories = get_the_category();

	if ( ! empty( $categories ) ) {
	  $link_category = get_category_link( $categories[0] );
	}
	else {
		$link_category = '';
	}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="info">
			<?php
				if ( ! empty( $categories ) ) {
			?>
      		<a class="category" href="<?php echo $link_category ?>"><?php echo $categories[0]->name ?></a>
			<?php
				}
			?>
      <?php comments_popup_link( '', __( '1 Comment', 'avalon-b' ), __( '% Comments', 'avalon-b' ), 'comments', '' ); ?>
    </div>

	<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>

    <?php
      if ( has_post_thumbnail() ) {
    ?>
        <a class="thumbnail" href="<?php the_permalink() ?>">
          <?php the_post_thumbnail() ?>
        </a>
    <?php
      }
    ?>

	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'avalon-b' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'avalon-b' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
		<div id="tags">
        	<?php the_tags( '<strong>Tags:</strong> ', ', ' ); ?>
      	</div>

      	<div id="post-author">
        	<?php echo get_avatar( get_the_author_meta( 'ID' ), 48, 'retro', '', array( 'class' => 'img-circle' ) ); ?>

			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author(); ?></a>
      	</div>
	<?php endif; ?>
</div><!-- #post-## -->
