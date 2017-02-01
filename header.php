<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html class="no-js" lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <title><?php bloginfo('name') ?></title>

    <?php wp_head()?>
  </head>

  <body>
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
