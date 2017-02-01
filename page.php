<?php get_header() ?>
  <div class="col-md-offset-1 col-md-8 col-md-push-3 no-gutter" id="page">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
    ?>
          <h2 class="title"><?php the_title()?></h2>

          <?php the_content() ?>
    <?php
        endwhile;
      endif;
    ?>
  </div><!--end #blog-->

  <?php get_sidebar() ?>
</div><!--end #main-->

<?php get_footer()?>
