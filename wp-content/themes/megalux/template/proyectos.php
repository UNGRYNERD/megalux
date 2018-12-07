<?php
/**
* Template name: Listado proyectos
*/

include( get_template_directory() . '/header.php');
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page-proyectos">
 
  <?php if(post_image_size() && get_field('titulo_imagen_cabecera')){?>
    <section class="box-header" style="background-image:url('<?php echo post_image_size();?>')">
      <div class="container">
        <div class="row align-items-end">

          <div class="col-12"> 
            <h1 class="text-center"><?php the_field('titulo_imagen_cabecera');?></h1>
            <?php custom_breadcrumbs(); ?>
          </div>

        </div>
      </div>
    </section>
  <?php }?>
  
  <section class="box-content box-proyectos" >
    <div class="container">
      <div class="row">
      
        <?php 

          // obtener taxonomias para listado de proyectos
          $taxonomy = get_terms( array(
              'taxonomy' => 'tipo',
              'hide_empty' => false,
          ));  

        if($taxonomy){?>
          <div id="filters" class="col-12 text-center category-list">
            <button class="button button--outline button--blue button--filter is-checked" data-filter="*">Todo</button>

            <?php foreach( $taxonomy as $key => $tax ){?>
              <button class="button button--outline button--blue button--filter" data-filter=".<?php echo $tax->slug?>"><?php echo $tax->name?></button>
            <?php }?>    

          </div>
        <?php }?>

      
      </div>
      <div id="container" class="row">

        <?php 

          $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

          $args = array(
            'post_type' => 'proyecto',
            'posts_per_page' => 75,
            'paged' => $paged,
            
          );
          query_posts($args);
          

          if (have_posts()) {
            while (have_posts()) {
              the_post(); 

               $terms = get_the_terms( $post->ID, 'tipo' );?>

                  <div class="col-12 col-md-6 col-lg-4 item <?php foreach($terms as $item){echo $item->slug.' '; }?> ">
                    <a href="<?php echo get_permalink(); ?>" class="col-project">
                      <?php if(get_field('galeria')){ ?>
                        <img src="<?php echo get_field('galeria')[0]['url'];?>" alt="<?php echo get_field('galeria')[0]['alt'];?>" title="<?php echo get_field('galeria')[0]['title'];?>">
                      <?php }?>

                      <p><?php the_title(); ?></p>
                    </a>
                  </div>

            <?php } ?> 
          </div>
          
           <div class="row">
             <div class="col-12">
                <?php numeric_posts_nav(); ?>
              </div>
           </div>

          <?php } wp_reset_query();?>

      
    </div>
  </section>
  
   <?php include( get_template_directory() . '/template/content-relacionado.php'); ?>
  
</main>

<?php 

endwhile; endif; 

include( get_template_directory() . '/footer.php'); ?>


<script src="<?php echo get_template_directory_uri();?>/js/isotope.pkgd.min.js"></script>
<script>

$(document).ready(function(){
    setTimeout(function(){
      var $container = $('#container').isotope({
        itemSelector : '.item',
        isFitWidth: true
      });

      $container.isotope({ filter: ' *' });

      $('#filters, #filters-mobile').on( 'click', 'button', function() {

        var filterValue = $(this).attr('data-filter');
        $container.isotope({ filter: filterValue });            

      });

    }, 1400);
  
    // change is-checked class on buttons
    $('.category-list').each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
      });
    });
})

</script>