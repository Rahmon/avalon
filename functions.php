<?php
/**
* Theme Setup
*/
function avalon_setup() {
  avalon_register_menus();

  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 200, 125 );
}
add_action( 'after_setup_theme', 'avalon_setup' );

/**
 * Enqueues scripts and styles.
 */
function avalon_scripts() {
  wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7' );
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array ( 'jquery' ), '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'avalon_scripts' );

/**
 * Register menus.
 */
function avalon_register_menus() {
  register_nav_menus(
    array(
    'header-menu' => __( 'Header Menu', 'avalon' ),
    'footer-social-menu' => __( 'Footer Social Menu', 'avalon' )
  )
  );
}

/**
 * Register sidebars.
 */
function avalon_register_sidebars() {
  register_sidebar(
    array(
    'id'            => 'primary',
    'name'          => __( 'Left Sidebar', 'avalon' ),
    'description'   => __( 'Left sidebar.', 'avalon' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="title text-center">',
    'after_title'   => '</h4>',
  )
  );
}
add_action( 'widgets_init', 'avalon_register_sidebars' );

/**
* Filter the "read more" excerpt string link to the post.
*/
function avalon_excerpt_more( $more ) {
  return sprintf( '... <a class="read-more" href="%1$s"> %2$s</a>',
                 get_permalink( get_the_ID() ),
                 __( 'Read More', 'avalon' )
                );
}
add_filter( 'excerpt_more', 'avalon_excerpt_more' );

/*
* Pagination
*/
function avalon_pagination( $pages = '', $range = 4 ) {

  $showitems = ($range * 2) + 1;

  global $paged;

  if ( empty ( $paged ) ) $paged = 1;

  if ( $pages == '' ) {
    global $wp_query;

    $pages = $wp_query->max_num_pages;

    if ( !$pages ) {
      $pages = 1;
    }
  }

  if ( 1 != $pages ) {
    echo '<div>';
    echo '<nav><ul class="pagination">';

    if ( $paged > 1 /*&& $showitems < $pages*/ )
      echo
        '
        <li>
          <a href="' . get_pagenum_link( $paged - 1 ) . '" aria-label="Previous">
            &lsaquo;&lsaquo;
            <span class="hidden-xs">'
              . __( 'Previous', 'avalon' ) . '
            </span>
          </a>
        </li>
        ';

    if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )
      echo
        '<li>
          <a href="' . get_pagenum_link( 1 ) . '">
            <span class="hidden-xs">1</span>
          </a>
          </li>
          <li><a class="gap">...</a></li>';

    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
        echo ( $paged == $i ) ? '<li class="active"><span>' . $i . '</span></li>' : '<li><a href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
      }
    }

    if ( $paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages )
      echo
        '
        <li>
          <a class="gap">...</a>
        </li>
        <li>
          <a href="' . get_pagenum_link( $pages ) . '">
            <span>' . $pages . '</span>
          </a>
        </li>';

    if ( $paged < $pages /*&& $showitems < $pages*/ )
      echo
      '
      <li>
        <a href="' . get_pagenum_link( $paged + 1 ) . '"  aria-label="Next">
          <span class="hidden-xs">'
            . __( 'Next', 'avalon' ) . '
          </span>&rsaquo;&rsaquo;
        </a>
      </li>
      ';

    echo '</ul></nav>';
    echo '</div>';
  }
}

if ( ! function_exists( 'avalon_comment' ) ) {
  /**
   * Avalon comment template
   *
   * @param array $comment the comment array.
   * @param array $args the comment args.
   * @param int   $depth the comment depth.
   * @since 1.0.0
   */
  function avalon_comment( $comment, $args, $depth ) {
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <div class="comment-body">
    <div class="comment-meta commentmetadata">
      <div class="comment-author vcard">
      <?php echo get_avatar( $comment, 42 ); ?>
      <?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'avalon' ), get_comment_author_link() ); ?>
      <?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
      </div>
      <?php if ( '0' == $comment->comment_approved ) : ?>
        <div class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'avalon' ); ?></div>
        <br />
      <?php endif; ?>

    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-content">
    <?php endif; ?>
    <div class="comment-text">
    <?php comment_text(); ?>
    </div>
    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    <?php edit_comment_link( __( 'Edit', 'avalon' ), '  ', '' ); ?>
    </div>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
  <?php
  }
}

/**
 * Customize Theme
 */

add_action( 'customize_register', 'avalon_customizer_options' );

function avalon_customizer_options( $wp_customize ) {
  $colors[] = array(
    'slug' => 'avalon_header_background_color',
    'default' => '#f5f7fa',
    'label' => __( 'Header Background', 'avalon' ),
  );

  $colors[] = array(
    'slug' => 'avalon_main_background_color',
    'default' => '#349bc0',
    'label' => __( 'Main Background', 'avalon' ),
  );

  $colors[] = array(
    'slug' => 'avalon_widget_header_background_color',
    'default' => '#bdc3c7',
    'label' => __( 'Widget Header Background', 'avalon' ),
  );

  foreach ( $colors as $color ) {
    $wp_customize->add_setting(
      $color[ 'slug' ], array(
        'default' => $color[ 'default' ],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );

    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $color[ 'slug' ], 
        array(
          'label' => $color[ 'label' ], 
          'section' => 'colors', 
          'settings' => $color[ 'slug' ] 
        )
      )
    );
  }

  $wp_customize->add_section(
    'social_media_settings_section',
    array(
      'title' => __( 'Social Media', 'avalon' ),
      'description' => __( 'Add yours social media links', 'avalon' ),
      'priority' => 160,
    )
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_wordpress',
    'default' => '',
    'label' => __( 'WordPress Profile', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_github',
    'default' => '',
    'label' => __( 'GitHub', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_facebook',
    'default' => '',
    'label' => __( 'Facebook', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_twitter',
    'default' => '',
    'label' => __( 'Twitter', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_instagram',
    'default' => '',
    'label' => __( 'Instagram', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_google_plus',
    'default' => '',
    'label' => __( 'Google Plus', 'avalon' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_youtube',
    'default' => '',
    'label' => __( 'Youtube', 'avalon' ), 
  );

  foreach ( $social_medias as $social_media ) {
    $wp_customize->add_setting(
      $social_media[ 'slug' ], array(
        'default' => $social_media[ 'default' ],
      )
    );

    $wp_customize->add_control(
      $social_media[ 'slug' ],
      array(
        'label' => $social_media[ 'label' ],
        'section' => 'social_media_settings_section',
        'type' => 'text',
      )
    );
  }

  $wp_customize->add_section(
    'avalon_footer_section',
    array(
        'title' => 'Footer',
        'description' => 'Set a text to copyright.',
        'priority' => 165,
    )
  );

  $wp_customize->add_setting(
    'copyright_text',
    array(
        'default' => 'Theme Avalon',
    )
  );

  $wp_customize->add_control(
    'copyright_text',
    array(
        'label' => 'Copyright text',
        'section' => 'avalon_footer_section',
        'type' => 'text',
    )
  );
}