<a href="#top" class="smooth-scroll">
  <i class="fas fa-chevron-up"></i>
</a>
 

<?php if(get_field('titulo', 'option') || get_field('shortcode', 'option') || get_field(' texto_pie', 'option')){?>
  <section class="box-content box-newsletter">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 text-center">
          <?php if(get_field('titulo', 'option')){?>
            <h3><?php echo get_field('titulo', 'option');?></h3>
          <?php } if(get_field('shortcode', 'option')){
            echo do_shortcode(get_field('shortcode', 'option'));
          } if(get_field('texto_pie', 'option')){?>
            <p><?php echo get_field('texto_pie', 'option');?></p>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
<?php }?>
 
<footer class="footer">
  <div class="container">
    <div class="row">
     
      <?php if(get_field('logo_footer_izquierda', 'option') || get_field('logo_footer_derecha', 'option') || get_field('direccion', 'option') || get_field('telefono_de_contacto', 'option') || get_field(' email_de_contacto', 'option')){?>
        <div class="col-12 col-md-4">
          <div class="footer-logo">
            <?php if(get_field('logo_footer_izquierda', 'option') || get_field('logo_footer_derecha', 'option')){
              if(get_field('logo_footer_izquierda', 'option')){?>

                <img src="<?php echo get_field('logo_footer_izquierda', 'option')['url'];?>" alt="<?php echo get_field('logo_footer_izquierda', 'option')['alt'];?>"  title="<?php echo get_field('logo_footer_izquierda', 'option')['title'];?>">

              <?php } if(get_field('logo_footer_izquierda', 'option')){?>

                <img src="<?php echo get_field('logo_footer_derecha', 'option')['url'];?>" alt="<?php echo get_field('logo_footer_derecha', 'option')['alt'];?>"  title="<?php echo get_field('logo_footer_derecha', 'option')['title'];?>">

              <?php } 
            }?>
           </div>
           
           <?php if (get_field('direccion', 'option')){?>
            <div class="content">
              <?php the_field('direccion', 'option');?>
            </div>
          <?php } if (get_field('telefono_de_contacto', 'option') || get_field(' email_de_contacto', 'option')){
          
            if(get_field('telefono_de_contacto', 'option')){?>
              <a href="tel:<?php formatPhone(get_field('telefono_de_contacto', 'option'));?>" class="link-tel">
                <?php the_field('telefono_de_contacto', 'option');?>
              </a>
            <?php } if(get_field('email_de_contacto', 'option')){?>
              <a href="mailto:<?php formatPhone(get_field('email_de_contacto', 'option'));?>" class="link-tel">
                <?php the_field('email_de_contacto', 'option');?>
              </a>
            <?php }
           }?>
        </div>
        
        <div class="col-12 col-md-8">
          <div class="row justify-content-md-end menu-footer">
            <div class="col-12 col-md-4 col-lg-3">
              <?php wp_nav_menu( array( 'theme_location' => 'footer_primary' ) ); ?>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
              <?php wp_nav_menu( array( 'theme_location' => 'footer_second' ) ); ?>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
              <?php wp_nav_menu( array( 'theme_location' => 'footer_third' ) ); ?>
            </div>
          </div>
        </div>
        
      <?php }?>
      
    </div>
    
    <?php if (get_field('texto_legales', 'option') || get_field('enlaces_paginas_legales', 'option')){?>
      <div class="row row-legales">
        <div class="col-12">
          <div class="content">
            <?php if (get_field('texto_legales', 'option') ){?>
          
              <p><?php echo get_field('texto_legales', 'option')?></p>

              <?php } if(get_field('enlaces_paginas_legales', 'option')){
  
               foreach (get_field('enlaces_paginas_legales', 'option') as $item){ ?>
                  <a href="<?php echo get_permalink($item[pagina_legal]->ID);?>">
                    <?php echo $item[pagina_legal]->post_title;?>
                  </a>
               <?php }

            }?>
          </div>
        </div>
      </div>
    <?php }?>
    
    
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
