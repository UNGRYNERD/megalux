<?php
/**
* Template name: Página contacto
*/

include( get_template_directory() . '/header.php');
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page-contact">
 
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
  
    if(get_field('texto_izquierda') || get_field('formulario') || get_field('titulo_direcciones') || get_field('direcciones') || get_field('titulo_email') || get_field('direcciones_de_correo') || get_field('titulo_telefono') || get_field('numeros_de_telefono') || get_field('titulo_banner') || get_field('texto_boton') || get_field('url_boton') || get_field('imagen_banner') ){?>
    
    <section class="box-content box-contact">
      <div class="container">
        <div class="row">
          
          <?php if(get_field('texto_izquierda') || get_field('formulario')){?>
            <div class="col-12 col-md-6">
              <?php if(get_field('texto_izquierda')) {
                echo get_field('texto_izquierda');
              } if(get_field('formulario')){
                echo do_shortcode(get_field('formulario'));
              }?>
            </div>
          <?php } 
          
          if( get_field('titulo_direcciones') || get_field('direcciones') || get_field('titulo_email') || get_field('direcciones_de_correo') || get_field('titulo_telefono') || get_field('numeros_de_telefono') ){?>
          
            <div class="col-12 col-md-6">
             
              <?php if( get_field('titulo_direcciones') || get_field('direcciones')){?>
               
                <div class="box-address">
                  <?php if(get_field('titulo_direcciones')){?>
                   
                    <h5><?php echo get_field('titulo_direcciones');?></h5>
                    
                  <?php } if(get_field('titulo_direcciones')) {?>
                   
                    <div class="row">
                      <?php foreach( get_field('direcciones') as $item ){?>
                        <div class="col-12 col-md-4">
                          <?php if($item['titulo']){?>
                            <h6><?php echo $item['titulo'];?></h6>
                          <?php } if($item['texto']){?>
                            <p><?php echo $item['texto'];?></p>
                          <?php }?>
                        </div>
                      <?php }?>

                    </div>
                    
                  <?php }?>
                </div>
                
              <?php } //fin direcciones
              
              //emails
              if( get_field('titulo_email') || get_field('direcciones_de_correo')){?>
                <div class="box-address">
                  <?php if(get_field('titulo_email')){?>
                   
                    <h5><?php echo get_field('titulo_email');?></h5>
                    
                  <?php } if(get_field('direcciones_de_correo')) {?>
                   
                    
                    <div class="row">
                      <?php foreach (get_field('direcciones_de_correo') as $mail){?>
                        <div class="col-12 col-md-4">
                          <?php if($mail['direccion_email']){?>
                            <a href="mailto:<?php echo $mail['direccion_email'];?>"><?php echo $mail['direccion_email'];?></a>                            
                          <?php }?>
                        </div>
                      <?php }?>
                    </div>
                    
                  <?php }?>
                </div>
              <?php } //fin emails
              
              //telefono
              if( get_field('titulo_telefono') || get_field('numeros_de_telefono')){?>
                <div class="box-address">
                  <?php if(get_field('titulo_telefono')){?>
                   
                    <h5><?php echo get_field('titulo_telefono');?></h5>
                    
                  <?php } if(get_field('titulo_telefono')) {?>
 
                    <div class="row">
                      <?php foreach (get_field('numeros_de_telefono') as $tel){ ?>
                        <div class="col-12 col-md-4">
                          <?php if($tel['numero']){?>
                            <a href="tel:<?php formatPhone($tel['numero'])?>"><?php echo $tel['numero'];?></a>
                          <?php }?>
                        </div>
                      <?php }?>
                    </div>
                    
                  <?php }?>
                </div>
              <?php } //fin telefono
              
              if(get_field('titulo_banner') && get_field('texto_boton') && get_field('url_boton') && get_field('imagen_banner')){?>
                <div class="box-banner">
                  <img src="<?php echo get_field('imagen_banner')['url'];?>" alt="<?php echo get_field('imagen_banner')['alt'];?>" title="<?php echo get_field('imagen_banner')['title'];?>">
                  <div class="banner-info">
                    <?php if(get_field('titulo_banner')){?>
                      <h3><?php the_field('titulo_banner');?></h3>
                    <?php } if (get_field('texto_boton') && get_field('url_boton')){?>
                      <a class="button button--outline button--white" href="<?php echo get_field('url_boton');?>"><?php echo get_field('texto_boton');?></a>
                    <?php }?>
                  </div>
                </div>
              <?php }?>
              
            </div>
          <?php }?>
          
        </div>
      </div>
    </section>
    
    <?php } $direccion = get_field('mapa');

      if($direccion){
          
        $lat = $direccion['lat'];
        $lng = $direccion['lng'];
        $direccion = $direccion['address'];
        
      ?>
      <section class="box-map">
        <div id="map"></div>
      </section>
    <?php }?>

  
</main>

<?php 

endwhile; endif; 

include( get_template_directory() . '/footer.php'); ?>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtTH5b1RE_jq8HZkI8N5Kq17folO15MMg"></script>
<script type="text/javascript">
  // When the window has finished loading create our google map below
  google.maps.event.addDomListener(window, 'load', init);

  function init() {
      // Basic options for a simple Google Map
      // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
      var mapOptions = {
          // How zoomed in you want the map to start at (always required)
          zoom: 12,

          // The latitude and longitude to center the map (always required)
          center: new google.maps.LatLng(<?php echo $lat?>, <?php echo $lng?>),
      };

      var mapElement = document.getElementById('map');
      var map = new google.maps.Map(mapElement, mapOptions);

      var infowindow = new google.maps.InfoWindow();
    
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(<?php echo $lat?>, <?php echo $lng?>),

          map: map,
          title: '<?php wp_title(''); ?>'
      });
    
      infowindow.setContent( "<span><?php echo $direccion;?></span>" );
      infowindow.open(map, marker);
  }
</script>