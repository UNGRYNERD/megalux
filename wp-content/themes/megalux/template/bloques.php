<?php
/**
* Template name: Página bloques
*/

include( get_template_directory() . '/header.php');
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main>
 
  <?php if(post_image_size() && get_field('titulo_imagen_cabecera')){?>
    <section class="box-header" style="background-image:url('<?php echo post_image_size();?>')">
      <div class="container">
        <div class="row align-items-end">

          <div class="col-12"> 
            <h1 class="text-center"><?php the_field('titulo_imagen_cabecera');?></h1>
          </div>

        </div>
      </div>
    </section>
  <?php } 
    $bloque = get_field('bloques');
    if ($bloque){
      foreach($bloque as $item){
        
        //caja de texto
        if($item[acf_fc_layout] == 'caja_de_texto') {?>
        
          <section class="box-content">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <?php echo $item[texto]?>
                </div>
              </div>
            </div>
          </section>
        
        <?php }
        
        //tira iconos con texto
        if($item[acf_fc_layout] == 'tira_iconos') {?>
        
          <section class="box-content box-icons">
            <div class="container">
              <div class="row justify-content-between">
                <?php if($item[tira]){
                  foreach ($item[tira] as $icons){?>
                    <div class="col-12 col-sm-6 col-md-2 text-center">
                      <img src="<?php echo $icons['icono']['url'];?>" alt="<?php echo $icons['icono']['alt'];?>" title="<?php echo $icons['icono']['title'];?>">
                      <p><?php echo $icons['texto'];?></p>
                    </div>
                  <?php }
                  
                } ?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //imagen parallax
        if($item[acf_fc_layout] == 'imagen_parallax') {?>
        
          <section class="box-content parallax" style="background-image:url('<?php echo $item['imagen_parallax']['url'];?>'); height: 400px" data-type="background-image" data-speed="2">
            <div class="container">
              <div class="row">
                <?php echo $item[texto]?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //bloque clientes
        if($item[acf_fc_layout] == 'iconos_clientes') {?>
        
          <section class="box-content box-clientes" >
            <div class="container">
              <div class="row">
                <?php if($item[titulo]){?>
                 
                  <div class="col-12">
                    <h2 class="text-center"><?php echo $item[titulo];?></h2>
                  </div>
                  
                <?php } if($item[texto]){?>
                 
                  <div class="content">
                    <?php echo $item[texto];?>
                  </div>
                  
                <?php } if($item[galeria]){
                  foreach($item[galeria] as $galeria){?>
                   
                    <div class="col-6 col-sm-4 col-md-2">
                      <img src="<?php echo $galeria[url];?>" alt="<?php echo $galeria[alt];?>" title="<?php echo $galeria[title];?>">
                    </div>
                    
                  <?php }
                }?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //testimonios
        if($item[acf_fc_layout] == 'testimonios') {?>
        
          <section class="box-content box-testimonios">
            <div class="container">
              <div class="row">
                <?php foreach($item[testimonios] as $test){ ?>
                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="col-test">
                      <?php if(print_thumbnail($test['elegir_testimonios']->ID)){ 
                        echo print_thumbnail($test['elegir_testimonios']->ID);
                      }?>
                      <p><?php echo $test['elegir_testimonios']->post_content; ?></p>

                      <div class="autor">
                        <p><?php echo $test['elegir_testimonios']->post_title; ?></p>
                        <p class="puesto"><?php echo get_field('subtitulo',$test['elegir_testimonios']->ID);?></p>
                      </div>
                    </div>
                  </div>
                <?php }?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //proyectos destacados
        if($item[acf_fc_layout] == 'proyectos_destacados') {?>
        
          <section class="box-content box-proyectos" >
            <div class="container">
              <div class="row">
                <?php if($item[titulo]){?>
                 
                  <div class="col-12">
                    <h2 class="text-center"><?php echo $item[titulo];?></h2>
                  </div>
                  
                <?php } if($item[texto_superior]){?>
                 
                  <div class="col-12 content">
                    <?php echo $item[texto_superior];?>
                  </div>
                  
                <?php } if ($item[proyectos]){ 
                  foreach ($item[proyectos] as $proyecto){
                  //echo '<pre>';print_r($proyecto);echo '</pre>'; ?>
                  
                  <div class="col-12 col-md-4">
                    <a href="<?php echo get_permalink($proyecto['proyecto_destacado']); ?>" class="col-project">
                     <?php if(get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]){ ?>
                       <img src="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0][url];?>" alt="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0][alt];?>" title="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0][title];?>">
                     <?php }?>

                      <p><?php echo $proyecto['proyecto_destacado']->post_title; ?></p>
                    </a>
                  </div>
                
                <?php }
                }//endif itemproyecto
                                                            
                if($item[botones]){ 
                  
                  if(count($item[botones]) == '1'){
                    $align = ' justify-content-center';
                  } else if (count($item[botones]) == '2'){
                    $align = ' justify-content-between';
                  }?>
                  <div class="row row-buttons w-100 <?php echo $align;?>">
                    <?php foreach($item[botones] as $btn){?>

                        <a class="button button--outline button--blue" href="<?php echo $btn[url_boton]?>"><?php echo $btn[texto_boton]?></a>

                    <?php }?>
                  </div>
                <?php }
                
                if($item[texto_inferior]){?>

                  <div class="col-12 content">
                    <?php echo $item[texto_inferior];?>
                  </div>
                  
                <?php }
                ?>
              </div>
            </div>
          </section>
        
        <?php }
        
      //endforeach
      }
    }?>
  
</main>

<?php 

endwhile; endif; 

include( get_template_directory() . '/footer.php'); ?>