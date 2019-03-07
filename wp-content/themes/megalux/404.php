<?php

get_header(); ?>

<main class="page-404">
  <section class="box-header">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-12"> 
          <h1 class="text-center"><?php echo __('Page not found', 'megalux');?></h1>
        </div>

      </div>
    </div>
  </section>
 
  <section class="box-content">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-8">
            <div class="content text-center">
              <h3><?php echo __('¡Vaya, no se pudo encontrar esta página!', 'megalux');?></h3>
              <p>
              <?php echo __('La página que intentas solicitar no se encuentra disponible en estos momentos. Por favor,  revise si es correcta la dirección a la que ha accedido.','megalux');?></p>
              <a href="javascript:window.history.back();" class="button button--outline button--blue"><?php echo __('Volver','megalux');?></a>
            </div>
          </div>
        </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

