<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

 <body <?php body_class(); ?>>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="col-md-12 no-gutter">
          <div class="navbar-header">

            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
            </button>

            <a class="navbar-brand" href="<?php echo esc_url( home_url() ) ?>"><?php bloginfo( 'name' ); ?></a>
          </div>
          <?php
            wp_nav_menu(
              array(
                'theme_location' => 'header-menu',
                'container_class' => 'collapse navbar-collapse',
                'container_id' => 'bs-navbar-collapse',
                'menu_class' => 'nav navbar-nav navbar-right'
              )
            );
          ?>
        </div>
      </div>
    </nav>

    <div class="container" id="main">
		<div class="row">
