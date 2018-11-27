<?php include('header.php');

$proyecto = get_field('pagina_de_proyectos', 'option');

if (have_posts()) : while (have_posts()) : the_post();?>

<main class="single-content single-content--<?php echo $post->post_type?>">
  <section class="box-header"></section>
  
  <section class="box-content box-info-post">
    <div class="container">
      <div class="row">
      
      <div class="col-12 col-paginacion">
         <div class="row justify-content-between">
          <div class="col-4">
            <a class="all-projects" href="<?php echo get_permalink($proyecto);?>">
              <span></span>
              <span></span>
            </a>
          </div>

          <div class="col-4 text-right">
            <?php                
              $prev_post = get_next_post();
              $next_post = get_previous_post();
            
              if($prev_post){?>
                <a class="button button--outline button--blue prev-link" href="<?php echo get_permalink($prev_post->ID); ?>">Anterior</a>
              <?php } if($next_post){?>
                <a class="button button--outline button--blue next-link" href="<?php echo get_permalink($next_post->ID); ?>">Siguiente</a>
              <?php }?>
          </div>
        </div>
      </div>
       
        <?php if(get_field('galeria')){?>
          <div class="col-12 col-md-6">
              <div class="thumbslider">
                <ul id="lightSlider">
                  <?php foreach(get_field('galeria') as $item){?>
                    <li data-thumb="<?php echo $item[url]?>">
                      <img src="<?php echo $item[url]?>" />
                    </li>
                  <?php }?>
                </ul>
              </div>
          </div>
        <?php }?>
        
        <div class="col-12 col-md-6 info-post">

          <h1><?php the_title();?></h1>

          <?php if(get_field('texto_derecha')){?>

            <div class="content">
              <?php the_field('texto_derecha');?>
            </div>

          <?php }?>

        </div>
        
        <?php if(get_field('imagen_banner') && get_field('url_banner')) {?>

          <div class="col-12 text-center">
            <a href="<?php echo get_field('url_banner');?>" class="box-cta">
              <img class="img-border" src="<?php echo get_field('imagen_banner')[url];?>" alt="<?php echo get_field('imagen_banner')[alt];?>" title="<?php echo get_field('imagen_banner')[title];?>">
            </a>
          </div>

        <?php }?>
      </div>
      
    </div>
  </section>

  <section class="box-content box-proyectos">
    <div class="container">
      <div class="row">

        <div class="col-12">
          <h2 class="text-center">Ver más</h2>
        </div>

        <?php 

          $args = array(
            'post_type' => 'proyectos',
            'posts_per_page' => 8
          );
          query_posts($args);


          if (have_posts()) {
            while (have_posts()) {
              the_post(); ?>

                  <div class="col-12 col-md-3 ">
                    <a href="<?php echo get_permalink(); ?>" class="col-project">
                      <?php if(get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]){ ?>
                        <img src="<?php echo get_field('galeria')[0][url];?>" alt="<?php echo get_field('galeria')[0][alt];?>" title="<?php echo get_field('galeria')[0][title];?>">
                      <?php }?>

                      <p><?php the_title(); ?></p>
                    </a>
                  </div>

            <?php } 
          } wp_reset_query();?>

      </div>
    </div>
  </section>

  
  include( get_template_directory() . '/template/content-relacionado.php'); ?>

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
