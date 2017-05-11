<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
// require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
// require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
//require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'avalon-b', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'avalon-b' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'avalon-b' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'avalon-b' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="title text-center">',
			'after_title' => '</h4>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}

/**
 * Customize Theme
 */
add_action( 'customize_register', 'avalon_customizer_options' );

function avalon_customizer_options( $wp_customize ) {
  $colors[] = array(
    'slug' => 'avalon_header_background_color',
    'default' => '#349bc0',
    'label' => __( 'Header Background', 'avalon-b' ),
  );

  $colors[] = array(
    'slug' => 'avalon_widget_header_background_color',
    'default' => '#bdc3c7',
    'label' => __( 'Widget Header Background', 'avalon-b' ),
  );

  foreach ( $colors as $color ) {
    $wp_customize->add_setting(
      $color[ 'slug' ], array(
        'default' => $color[ 'default' ],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
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
      'title' => __( 'Social Media', 'avalon-b' ),
      'description' => __( 'Add yours social media links', 'avalon-b' ),
      'priority' => 160,
    )
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_wordpress',
    'default' => '',
    'label' => __( 'WordPress Profile', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_github',
    'default' => '',
    'label' => __( 'GitHub', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_facebook',
    'default' => '',
    'label' => __( 'Facebook', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_twitter',
    'default' => '',
    'label' => __( 'Twitter', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_instagram',
    'default' => '',
    'label' => __( 'Instagram', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_google_plus',
    'default' => '',
    'label' => __( 'Google Plus', 'avalon-b' ), 
  );

  $social_medias[] = array(
    'slug' => 'avalon_social_media_youtube',
    'default' => '',
    'label' => __( 'Youtube', 'avalon-b' ), 
  );

  foreach ( $social_medias as $social_media ) {
    $wp_customize->add_setting(
      $social_media[ 'slug' ], array(
        'default' => $social_media[ 'default' ],
        'sanitize_callback' => 'sanitize_text_field',
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
        'default' => 'Theme Avalon B',
        'sanitize_callback' => 'sanitize_text_field',
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

/**
 * Enqueues scripts and styles.
 */
function avalon_b_scripts() {
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
}
add_action( 'wp_enqueue_scripts', 'avalon_b_scripts' );



function avalon_b_customizer_css()
{
    ?>
         <style type="text/css">
         	.navbar-default { background-color: <?php echo get_theme_mod('avalon_header_background_color', '#349bc0'); ?>; }
            .widget .title { background-color: <?php echo get_theme_mod('avalon_widget_header_background_color', '#bdc3c7'); ?>; } 
         </style>
    <?php
}
add_action( 'wp_head', 'avalon_b_customizer_css');

/**
 * Used by hook: 'customize_preview_init'
 * 
 * @see add_action('customize_preview_init',$func)
 */
function avalon_b_customizer_live_preview()
{
	wp_enqueue_script( 
		  'avalon-b-themecustomizer',			//Give the script an ID
		  get_template_directory_uri() . '/assets/js/avalon-b-customizer.js',//Point to file
		  array( 'jquery', 'customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'avalon_b_customizer_live_preview' );