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
    'header-menu' => __( 'Header Menu' ),
    'footer-social-menu' => __( 'Footer Social Menu' )
  )
  );
}

/**
 * Regiter sidebars.
 */
function avalon_register_sidebars() {
  register_sidebar(
    array(
    'id'            => 'primary',
    'name'          => __( 'Left Sidebar' ),
    'description'   => __( 'Left sidebar.' ),
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
                 __( 'Read More' )
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
              . __( 'Previous' ) . '
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
            . __( 'Next') . '
          </span>&rsaquo;&rsaquo;
        </a>
      </li>
      ';

    echo '</ul></nav>';
    echo '</div>';
  }
}

