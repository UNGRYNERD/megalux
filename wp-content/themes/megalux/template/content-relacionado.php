<?php if(get_field('paginas_relacionadas') || get_field('texto') || get_field('titulo') ){?>
  <section class="box-content box-relacionado">
    <div class="container">
      <div class="row">

        <?php if(get_field('titulo')){?>
          <h2 class="text-center"><?php the_field('titulo'); ?></h2>
        <?php } if(get_field('paginas_relacionadas')){
          foreach (get_field('paginas_relacionadas') as $proyecto) {
            if($proyecto['imagen']){
              $img = $proyecto['imagen']['url'];
            } else {
              $img = get_template_directory_uri().'/img/default-img.jpg';
            }?>

              <div class="col-12 col-md-4">
                <a href="<?php echo get_permalink($proyecto['paginas']); ?>" class="col-project col-project--bg" style="background-image: url('<?php echo $img;?>');">
                  <p><?php echo $proyecto['titulo_enlace'] ?></p>
                </a>
              </div>

          <?php }
        } if(get_field('texto')){?>
          <div class="col-12 content">
            <?php echo get_field('texto');?>
          </div>
        <?php }?>

      </div>
    </div>
  </section>
<?php }?>