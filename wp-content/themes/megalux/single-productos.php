<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post();

$producto = get_field('pagina_de_productos','option');

?>

<main class="single-content single-content--<?php echo $post->post_type?>">
  <section class="box-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php custom_breadcrumbs(); ?>
        </div>
      </div>
    </div>
  </section>
  
  <section class="box-content box-info-post">
    <div class="container">
      <div class="row">
       
        <?php if(get_field('imagen_izquierda')){?>
          <div class="col-12 col-md-6">
            <img src="<?php echo get_field('imagen_izquierda')['url']?>" alt="<?php echo get_field('imagen_izquierda')['alt']?>" title="<?php echo get_field('imagen_izquierda')['title']?>">
          </div>
        <?php }?>
        
        <div class="col-12 col-md-6 info-post">

          <h1><?php the_title();?></h1>

            <div class="content">
              <?php the_content();?>
            </div>
        
        <div class="row-buttons">
          <?php if (get_field('botones_descarga')) {
            foreach(get_field('botones_descarga') as $item){?>
              <a class="button button--outline button--blue" href="<?php echo $item['fichero']?>">
                <?php echo $item['texto_boton']?>
                <img src="<?php echo get_template_directory_uri()?>/img/icons/flecha.png" alt="download icon">
              </a>
            <?php }
          } ?>
        </div>
         <?php if (get_field('imagen_catalogo') && get_field('archivo_catalogo')) {?>
          <a href="<?php echo get_field('archivo_catalogo');?>" target="_blank">
            <img src="<?php echo get_field('imagen_catalogo')['url'];?>" alt="">
          </a>
        <?php }?>
      </div>

      </div>
      
    </div>
  </section>

  <section class="box-content box-relacionado">
    <div class="container">
      <div class="row">

        <?php if(get_field('titulo', $producto)){?>
          <h2 class="text-center"><?php the_field('titulo', $producto); ?></h2>
        <?php } if(get_field('paginas_relacionadas', $producto)){
          foreach (get_field('paginas_relacionadas', $producto) as $proyecto) {
            if($proyecto['imagen']){
              $img = $proyecto['imagen']['sizes']['large'];
            } else {
              $img = get_template_directory_uri().'/img/default-img.jpg';
            }?>

              <div class="col-12 col-md-4 col-relacionado">
                <a href="<?php echo get_permalink($proyecto['paginas']); ?>" class="col-project col-project--bg" style="background-image: url('<?php echo $img;?>');">
                  <p><?php echo $proyecto['titulo_enlace'] ?></p>
                </a>
              </div>

          <?php }
        } if(get_field('texto', $producto)){?>
          <div class="col-12 content">
            <?php echo get_field('texto', $producto);?>
          </div>
        <?php }?>

      </div>
    </div>
  </section>

</main>

<?php endwhile; endif; ?>
<?php include('footer.php'); ?>

<script>
      
$(document).ready(function(){
  $('#lightSlider').lightSlider({
      gallery: true,
      item: 1,
      loop:true,
      slideMargin: 0,
      thumbItem: 5,
      thumbMargin: 10,
      enableDrag:false,
  });
})
  
</script>
