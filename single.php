<?php get_header() ?>
  <div class="single-post col-md-offset-1 col-md-8 col-md-push-3 no-gutter">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          $categories = get_the_category();
    ?>
          <span class="category"><?php echo $categories[0]->name ?></span>

          <h2 class="title"><?php the_title() ?></h2>

          <div class="info">
            <?php the_date( __( 'd/m/Y' ), '<span>', ' - </span>') ?>
            <a href="#"><?php the_author() ?></a>
            <a id="comments" href="#"><?php comments_popup_link( '', __( '1 Comment' ), __( '% Comments' ), 'comments', '' ); ?></a>
          </div>

          <div class="content">
            <?php the_content() ?>
          </div>
          
          <div id="post-author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 48, 'retro', '', array( 'class' => 'img-circle' ) ); ?>
            <span><?php the_author() ?></span>
          </div>

    <?php
          if ( comments_open() || get_comments_number() ) :
             comments_template();
          endif;
          
        endwhile;
        avalon_pagination();
      endif;
    ?>
  </div><!--end #blog-->

  <?php get_sidebar() ?>
</div><!--end #main-->

<?php get_footer()?>
