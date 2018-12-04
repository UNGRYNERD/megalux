<?php

include('header.php'); ?>

<main class="page-404">
  <section class="box-content">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-8">
            <div class="content">
              <h1>404</h1>
              <p>
              <?php echo __('La página que intentas solicitar no se encuentra disponible en estos momentos. Por favor,  revise si es correcta la dirección a la que ha accedido.','megalux');?></p>
              <a href="javascript:window.history.back();" class="button button--outline button--blue"><?php echo __('Volver','megalux');?></a>
            </div>
          </div>
        </div>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>

