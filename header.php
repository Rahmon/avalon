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
	<?php wp_head(); ?>
</head>

 <body <?php body_class(); ?>>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="col-md-12 no-gutter">
          <div class="navbar-header">

            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
              <span class="sr-only"><?php _e( 'Toggle navigation', 'avalon-b' ) ?></span>
              <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
            </button>

            <a class="navbar-brand" href="<?php echo esc_url( home_url() ) ?>"><?php bloginfo( 'name' ); ?></a>
          </div>
          <nav id="navbar" class="collapse navbar-collapse navbar-main-navigation" role="navigation">
          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'main-menu',
                'depth'           => 2,
                'container'       => false,
                'menu_class'      => 'nav navbar-nav navbar-right',
                'fallback_cb'     => 'Odin_Bootstrap_Nav_Walker::fallback',
                'walker'          => new Odin_Bootstrap_Nav_Walker()
              )
            );
          ?>
          </nav>
        </div>
      </div>
    </nav>

    <div class="container" id="main">
		<div class="row">
