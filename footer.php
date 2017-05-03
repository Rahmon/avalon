<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- .row -->
	</div><!-- #wrapper -->

	<footer class="footer">
  <div class="container wrap">

    <div class="row">
      <div class="col-xs-12 col-sm-3">
        <h3 class="logo"><a href="<?php echo esc_url( home_url() ) ?>"><?php bloginfo( 'name' ); ?></a></h3>
      </div>

      <div class="col-xs-12 col-sm-9 text-right">
        <?php
          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_wordpress',
            'icon' => 'fa-wordpress'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_github',
            'icon' => 'fa-github'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_facebook',
            'icon' => 'fa-facebook'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_twitter',
            'icon' => 'fa-twitter'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_instagram',
            'icon' => 'fa-instagram'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_google_plus',
            'icon' => 'fa-google-plus'
          );

          $social_medias[] = array(
            'setting_slug' => 'avalon_social_media_youtube',
            'icon' => 'fa-youtube-play'
          );

          foreach ( $social_medias as $social_media ) {
            $setting_slug = $social_media[ 'setting_slug' ];
            $icon = $social_media[ 'icon' ];

            if ( get_theme_mod( $setting_slug ) ) {
            ?>
              <a href="<?php echo get_theme_mod( $setting_slug ) ?>" target="_blank">
                <i class="fa <?php echo $icon ?> fa-2x" aria-hidden="true"></i>
              </a>
            <?php  
            }
          }
        ?>

      </div>
    </div>
  </div>

  <div class="container-fluid" id="copyright">
    <p class="text-center">
      <?php echo get_theme_mod( 'copyright_text', 'Avalon B Theme' ); ?>
    </p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
