<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post();?>

<main class="single-content single-content--<?php echo $post->post_type?>">
  <section class="box-header"></section>
  
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
              <a class="button button--outline button--blue" href="<?php echo $item[fichero]?>">
                <?php echo $item[texto_boton]?>
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

  <?php include( get_template_directory() . '/template/content-relacionado.php'); ?>

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
