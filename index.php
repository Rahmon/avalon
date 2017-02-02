<?php get_header() ?>
  <div class="col-sm-offset-1 col-sm-8 col-sm-push-3 col-md-offset-1 col-md-8 col-md-push-3 no-gutter" id="blog">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          $categories = get_the_category();
          $link_category = get_category_link( $categories[0] );
    ?>
          <div class="post">
            <div class="info">
              <a class="category" href="<?php echo $link_category ?>"><?php echo $categories[0]->name ?></a>
              <?php comments_popup_link( '', __( '1 Comment' ), __( '% Comments' ), 'comments', '' ); ?>
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

            <p class="content">
              <?php echo get_the_excerpt() ?>
            </p>
          </div><!--end .post-->
    <?php
        endwhile;
        avalon_pagination();
      endif;
    ?>
  </div><!--end #blog-->

  <?php get_sidebar() ?>
</div><!--end #main-->

<?php get_footer()?>
