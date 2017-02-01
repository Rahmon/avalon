<?php
/**
* Template Name: Contact Page
*/
?>
<?php get_header() ?>
  <div class="col-md-offset-1 col-md-8 col-md-push-3 no-gutter contact" id="page">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
    ?>
          <h2 class="title"><?php the_title()?></h2>

          <?php the_content() ?>

          <?php
            if ( isset( $_POST[ 'action' ] ) ) {

              $remetente_nome = $_POST[ 'nameInput' ];
              $remetente_email = $_POST[ 'emailInput' ];
              $remetente_mensagem = $_POST[ 'mensagemlInput' ];

              if ( mail( ) ){
                $email_sent = true;
              }
              else {
                $email_sent = false;
              }
            }
          ?>

          <div class="col-md-6 no-gutter">
            <form action="#" method="post">
              <input type="hidden" name="action" value="contact_form">
              <div class="form-group">
                <label for="nameInput">Nome</label>
                <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Seu nome . . .">
              </div>

              <div class="form-group">
                <label for="emailInput">E-mail</label>
                <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="Seu e-mail . . .">
              </div>
          </div>
          <div class="col-md-12 no-gutter">
              <div class="form-group">
                <label for="mensagemInput">Mensagem</label>
                <textarea class="form-control" id="mensagemInput" name="mensagemInput" rows="10" placeholder="Sua mensagem . . ."></textarea>
              </div>

            <button type="submit" class="btn btn-default btn-avalon-default"><i class="fa fa-paper-plane-o fa-lg"></i> Enviar</button>
            </form>
          </div>

    <?php
        endwhile;
      endif;
    ?>
  </div>

  <?php get_sidebar() ?>
</div><!--end #main-->

<?php get_footer()?>
