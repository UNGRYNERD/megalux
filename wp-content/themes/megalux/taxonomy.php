<?php

/**
* Template name: Productos
*/

$producto = get_field('pagina_de_productos','option');;

include('header.php');?>

<main class="single-content single-content--<?php echo $post->post_type?> page-product">
  <section class="box-header">
     <div class="container">
        <div class="row align-items-end">

          <div class="col-12">
            <h1 class="text-center"><?php echo single_cat_title( '', false);?></h1>
          </div>

        </div>
      </div>
  </section>

  <section class="box-content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-3 order-2 order-md-0">

          <div id="accordion" class="sidebar-taxonomy">

            <h4>Productos</h4>
            <?php

              $tax = get_terms(
                'categoria_producto',
                array(
                  'hide_empty' => false,
                  'parent' => 0
                )
              );

              foreach( $tax as $key => $parent_term ) {
                $tax_child = get_terms(
                  'categoria_producto',
                  array(
                    'hide_empty' => false,
                    'parent' => $parent_term->term_id
                  )
                );?>

                  <div class="panel">
                    <div class="panel-header" id="heading<?php echo $key;?>">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#<?php echo $parent_term->slug;?>" aria-expanded="false" aria-controls="<?php echo $parent_term->slug;?>">
                        <?php echo $parent_term->name;?>
                      </button>
                    </div>

                    <?php if($tax_child){?>
                      <div id="<?php echo $parent_term->slug;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#accordion">
                        <div class="panel-body">
                          <?php foreach( $tax_child as $key2 => $child_term ) {
                            $tax_grandchil = get_terms(
                              'categoria_producto',
                              array(
                                'hide_empty' => false,
                                'parent' => $child_term->term_id
                              )
                            );
                            if($tax_grandchil){ // Si tiene nietos?>
                              <div class="panel">
                                <div class="panel-header" id="heading<?php echo $key;?>">
                                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?php echo $child_term->slug;?>" aria-expanded="false" aria-controls="<?php echo $child_term->slug;?>">
                                    <?php echo $child_term->name;?>
                                  </button>
                                </div>
                                <div id="<?php echo $child_term->slug;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#<?php echo $parent_term->slug;?>">
                                <div class="panel-body">

                                  <?php foreach( $tax_grandchil as $grandchild_term ) {?>
                                    <a href="<?php echo get_term_link($grandchild_term);?>"><?php echo $grandchild_term->name;?></a>
                                  <?php }?>

                                  </div>
                                </div>
                              </div>
                            <?php } else {
                              // Aqui cuando no hay nietos?>
                              <a href="<?php echo get_term_link($child_term);?>"><?php echo $child_term->name;?></a>
                            <?php }?>

                          <?php }?>
                        </div>
                      </div>
                    <?php }?>

                  </div>

            <?php }?>
          </div>
          
          <?php if (get_field('imagen_catalogo',$producto) && get_field('archivo_catalogo',$producto)) {?>
            <a href="<?php echo get_field('archivo_catalogo',$producto);?>" target="_blank">
              <img src="<?php echo get_field('imagen_catalogo',$producto)['url'];?>" alt="">
            </a>
          <?php }?>
          
        </div>


        <div class="col-12 col-md-9">
          <div class="row">
            <div class="col-12">
              <?php echo term_description(); ?>
            </div>

            <?php if (have_posts()) {
              while (have_posts()) { the_post();?>
                <?php echo term_description(); echo $description;?>
                <div class="col-12 col-md-6 col-lg-4">
                  <a href="<?php echo get_permalink(); ?>" class="col-project col-archive">
                     <?php echo print_thumbnail($post->ID);?>
                    <p><?php the_title(); ?></p>
                  </a>
                </div>
              <?php } 
            } else {?>
              <div class="col-12">
                <h3 class="text-center">
                  No hay productos en esta categoría.
                </h3>
              </div>
            <?php }
            
            if(get_field('texto_listado', $producto)){?>
              <div class="col-12">
                <div class="content">
                  <?php echo get_field('texto_listado', $producto)?>
                </div>
              </div>
            <?php }?>
            
            
            

          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<?php
include( get_template_directory() . '/footer.php'); ?>
