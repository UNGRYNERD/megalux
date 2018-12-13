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
            <?php if(!is_front_page()){
              custom_breadcrumbs();
            }?>
          </div>

        </div>
      </div>
    </section>
  <?php } 
  
    if(is_front_page() && get_field('shortcode_slider')){
      echo do_shortcode(get_field('shortcode_slider'));
    }
      
    $bloque = get_field('bloques');
    if ($bloque){
      foreach($bloque as $item){
        
        //caja de texto
        if($item['acf_fc_layout'] == 'caja_de_texto') {?>
        
          <section class="box-content">
            <div class="container">
              <div class="row">
                <?php if($item['titulo']){?>
                  <div class="col-12">
                    <h2 class="text-center"><?php echo $item['titulo'];?></h2>
                  </div>
                <?php } if($item['texto']){?>
                  <div class="col-12">
                    <?php echo $item['texto'];?>
                  </div>
                <?php }?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //tira iconos con texto
        if($item['acf_fc_layout'] == 'tira_iconos') {?>
        
          <section class="box-content box-icons">
            <div class="container">
              <div class="row justify-md-content-between justify-content-center">
                <?php if($item['tira']){
                  foreach ($item['tira'] as $icons){?>
                    <div class="col-6 col-md-2 text-center">
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
        if($item['acf_fc_layout'] == 'imagen_parallax') {?>
        
          <section class="box-content box-parallax">
          
          <div class="skrollr" style="background-image: url(<?php echo $item['imagen_parallax']['url'];?>);" data-bottom-top="top: -100%;" data-top-bottom="top: 0%;"></div>


             <?php if($item['texto']){?>
                <div class="container h-100">
                  <div class="row h-100 align-items-center">
                   <div class="col-12 d-flex">
                     <h2><?php echo $item['texto']?></h2>
                   </div>
                  </div>
                </div>
              <?php }?>
          </section>
        
        <?php }
        
        //bloque clientes
        if($item['acf_fc_layout'] == 'iconos_clientes') {?>
        
          <section class="box-content box-clientes" >
            <div class="container">
              <div class="row justify-content-center">
                <?php if($item['titulo']){?>
                 
                  <div class="col-12">
                    <h2 class="text-center"><?php echo $item['titulo'];?></h2>
                  </div>
                  
                <?php } if($item['texto']){?>
                 
                  <div class="col-12 col-md-10 content">
                    <?php echo $item['texto'];?>
                  </div>
                </div>
                
                <div class="row">
                  
                <?php } if($item['galeria']){
                  foreach($item['galeria'] as $galeria){?>
                   
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                      <img src="<?php echo $galeria['url'];?>" alt="<?php echo $galeria['alt'];?>" title="<?php echo $galeria['title'];?>">
                    </div>
                    
                  <?php }
                }?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //testimonios
        if($item['acf_fc_layout'] == 'testimonios') {?>
        
          <section class="box-content box-testimonios">
            <div class="container">
              <div class="row">
                <?php foreach($item['testimonios'] as $test){ ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex">
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
              <div class="row">
                <?php if($item['texto']){?>
                  <div class="content">
                    <?php echo $item['texto'];?>
                  </div>
                <?php }
                                                   
                if($item['botones_testimonios']){ 
                  
                  if(count($item['botones_testimonios']) == '1'){
                    $align = ' justify-content-center';
                  } else if (count($item['botones_testimonios']) == '2'){
                    $align = ' justify-content-around';
                  }?>
                  <div class="col-12">
                    <div class="row row-buttons <?php echo $align;?>">
                      <?php foreach($item['botones_testimonios'] as $btn){?>
                        <a class="button button--outline button--blue" href="<?php echo $btn['url_boton']?>"><?php echo $btn['texto_boton']?></a>
                      <?php }?>
                    </div>
                  </div>
                <?php } ?>
                                                                  
              </div>
            </div>
          </section>
        
        <?php }
        
        //proyectos destacados
        if($item['acf_fc_layout'] == 'proyectos_destacados') {?>
        
          <section class="box-content box-proyectos">
            <div class="container">
              <div class="row">
                <?php if($item['titulo']){?>
                 
                  <div class="col-12">
                    <h2 class="text-center"><?php echo $item['titulo'];?></h2>
                  </div>
                  
                <?php } if($item['texto_superior']){?>
                 
                  <div class="col-12 content">
                    <?php echo $item['texto_superior'];?>
                  </div>
                  
                <?php } if ($item['proyectos']){ 
                  foreach ($item['proyectos'] as $proyecto){?>
                  
                  <div class="col-12 col-md-4 col-item">
                    <a href="<?php echo get_permalink($proyecto['proyecto_destacado']); ?>" class="col-project">
                     <?php if(get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]){ /*echo '<pre>';print_r(get_field('galeria', $proyecto['proyecto_destacado']->ID ));echo '</pre>'*/?>
                       <img src="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]['sizes']['large'];?>" alt="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]['alt'];?>" title="<?php echo get_field('galeria', $proyecto['proyecto_destacado']->ID )[0]['title'];?>">
                     <?php }?>

                      <p><?php echo $proyecto['proyecto_destacado']->post_title; ?></p>
                    </a>
                  </div>
                
                <?php }
                }//endif itemproyecto
                                                            
                if($item['botones']){ 
                  
                  if(count($item['botones']) == '1'){
                    $align = ' justify-content-center';
                  } else if (count($item['botones']) == '2'){
                    $align = ' justify-content-around';
                  }?>
                  <div class="col-12">
                    <div class="row row-buttons <?php echo $align;?>">
                      <?php foreach($item['botones'] as $btn){?>
                        <a class="button button--outline button--blue" href="<?php echo $btn['url_boton']?>"><?php echo $btn['texto_boton']?></a>
                      <?php }?>
                    </div>
                  </div>
                <?php }
                
                if($item['texto_inferior']){?>

                  <div class="col-12 content">
                    <?php echo $item['texto_inferior'];?>
                  </div>
                  
                <?php }
                ?>
              </div>
            </div>
          </section>
        
        <?php }
        
        //caja de texto
        if($item['acf_fc_layout'] == 'bloque_doble_columna') {?>
        
          <section class="box-content box-doble">
            <div class="container">
              <div class="row">
                <?php if($item['titulo'] || $item['texto_izquierda'] || $item['listado']){?>
                  <div class="col-12 col-md-6 content">
                    <?php if($item['titulo']){?>
                      <h2><?php echo $item['titulo'];?></h2>
                    <?php } if($item['texto_izquierda']){?>
                      <?php echo $item['texto_izquierda'];?>
                    <?php } if($item['listado']){?>
                     
                      <ul>
                      <?php foreach($item['listado'] as $list){?>
                        <li class="d-flex">
                          <img src="<?php echo $list['icono']['sizes']['medium'];?>" alt="<?php echo $list['icono']['alt']?>" title="<?php echo $list['icono']['title']?>">
                          <p><?php echo $list['texto'];?></p>
                        </li>
                      <?php }?>
                      </ul>
                      
                    <?php } ?>
                    
                  </div>
                <?php } //fin bloque izq
                                                            
                if($item['texto_derecha'] || $item['imagen_derecha']){?>
                  <div class="col-12 col-md-6">
                    <?php if($item['texto_derecha']){
                      echo $item['texto_derecha'];
                    } if($item['imagen_derecha']){?>
                      <img class="img-border" src="<?php echo $item['imagen_derecha']['url'];?>" alt="<?php echo $item['imagen_derecha']['alt']?>" title="<?php echo $item['imagen_derecha']['title']?>">
                    <?php }?>
                  </div>
                <?php }?>
              </div>
            </div>
          </section>
        
        <?php }         
        
        //banner
        if($item['acf_fc_layout'] == 'banner') {?>
        
          <section class="box-content box-banner">
            <div class="container">
              <div class="row">
                <?php if($item['imagen_banner'] && $item['url_banner']){?>
                  <div class="col-12 text-center">
                    <a href="<?php echo $item['url_banner'];?>">
                      <img class="img-border" src="<?php echo $item['imagen_banner']['url'];?>" alt="<?php echo $item[imagen_banner][alt]?>" title="<?php echo $item['imagen_banner']['title']?>">
                    </a>
                  </div>
                <?php }?>
              </div>
            </div>
          </section>
        
        <?php }
        
      //endforeach
      }
    } 
  
    //redes sociales fixed en home
    if(is_front_page()){
      if( get_field('facebook', 'option') || get_field('youtube', 'option') || get_field('twitter', 'option') || get_field('linkedin', 'option')){?> 

        <div class="social-box social-fixed">
          <?php if(get_field('facebook', 'option')){?>
            <a class="social--icon social--icon--fb" href="<?php echo get_field('facebook', 'option');?>" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
          <?php } if(get_field('twitter', 'option')){?>
            <a class="social--icon social--icon--twitter" href="<?php echo get_field('twitter', 'option');?>" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
          <?php } if(get_field('linkedin', 'option')){?>
            <a class="social--icon social--icon--linkedin" href="<?php echo get_field('linkedin', 'option');?>" target="_blank">
              <i class="fab fa-linkedin-in"></i>
            </a>
          <?php } if(get_field('youtube', 'option')){?>
            <a class="social--icon social--icon--youtube" href="<?php echo get_field('youtube', 'option');?>" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          <?php } ?>
        </div>

      <?php } 
    }?>
  
</main>

<script>
$(document).ready(function(){  
    var isMobile = false;
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
        isMobile = true;
    }

  if(!isMobile) {
    skrollr.init();
  } else {
    $('.skrollr').addClass('skrollr-mobile');
  }

});

</script>

<?php 

endwhile; endif; 

include( get_template_directory() . '/footer.php'); ?>