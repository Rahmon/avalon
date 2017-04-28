<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-9 no-gutter" role="complementary">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</div><!-- #sidebar -->
