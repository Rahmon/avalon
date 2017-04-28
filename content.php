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
  	$link_category = get_category_link( $categories[0] );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="info">
      <a class="category" href="<?php echo $link_category ?>"><?php echo $categories[0]->name ?></a>
      <?php comments_popup_link( '', __( '1 Comment', 'avalon' ), __( '% Comments', 'avalon' ), 'comments', '' ); ?>
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
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>
</div><!-- #post-## -->
