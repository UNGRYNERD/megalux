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
    <div class="row justify-content-md-center justify-content-lg-between">
     
      <?php if(get_field('logo_footer_izquierda', 'option') || get_field('logo_footer_derecha', 'option') || get_field('direccion', 'option') || get_field('telefono_de_contacto', 'option') || get_field(' email_de_contacto', 'option')){?>
        <div class="col-12 col-md-6 col-lg-4 info-footer">
          <div class="footer-logo">
            <?php if(get_field('logo_footer_izquierda', 'option') || get_field('logo_footer_derecha', 'option')){
              if(get_field('logo_footer_izquierda', 'option')){?>

                <img src="<?php echo get_field('logo_footer_izquierda', 'option')['url'];?>" alt="<?php echo get_field('logo_footer_izquierda', 'option')['alt'];?>"  title="<?php echo get_field('logo_footer_izquierda', 'option')['title'];?>">

              <?php } if(get_field('logo_footer_izquierda', 'option')){?>

                <img src="<?php echo get_field('logo_footer_derecha', 'option')['url'];?>" alt="<?php echo get_field('logo_footer_derecha', 'option')['alt'];?>"  title="<?php echo get_field('logo_footer_derecha', 'option')['title'];?>">

              <?php } 
            }?>
           </div>
           
           <?php if( get_field('facebook', 'option') || get_field('youtube', 'option') || get_field('twitter', 'option') || get_field('linkedin', 'option')){?> 
               
            <div class="social-box">
              <?php if(get_field('facebook', 'option')){?>
                <a href="<?php echo get_field('facebook', 'option');?>" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              <?php } if(get_field('youtube', 'option')){?>
                <a href="<?php echo get_field('youtube', 'option');?>" target="_blank">
                  <i class="fab fa-youtube"></i>
                </a>
              <?php } if(get_field('twitter', 'option')){?>
                <a href="<?php echo get_field('twitter', 'option');?>" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              <?php } if(get_field('linkedin', 'option')){?>
                <a href="<?php echo get_field('linkedin', 'option');?>" target="_blank">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              <?php }?>
            </div>

          <?php }
           
           if (get_field('direccion', 'option')){?>
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
        
        <div class="col-12 col-md-12 col-lg-8">
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
                  <a href="<?php echo get_permalink($item['pagina_legal']->ID);?>">
                    <?php echo $item['pagina_legal']->post_title;?>
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
<script type="text/javascript">
// Set to false if opt-in required
var trackByDefault = true;

function acEnableTracking() {
	var expiration = new Date(new Date().getTime() + 1000 * 60 * 60 * 24 * 30);
	document.cookie = "ac_enable_tracking=1; expires= " + expiration + "; path=/";
	acTrackVisit();
}

function acTrackVisit() {
	var trackcmp_email = '';
	var trackcmp = document.createElement("script");
	trackcmp.async = true;
	trackcmp.type = 'text/javascript';
	trackcmp.src = '//trackcmp.net/visit?actid=1000268488&e='+encodeURIComponent(trackcmp_email)+'&r='+encodeURIComponent(document.referrer)+'&u='+encodeURIComponent(window.location.href);
	var trackcmp_s = document.getElementsByTagName("script");
	if (trackcmp_s.length) {
		trackcmp_s[0].parentNode.appendChild(trackcmp);
	} else {
		var trackcmp_h = document.getElementsByTagName("head");
		trackcmp_h.length && trackcmp_h[0].appendChild(trackcmp);
	}
}

if (trackByDefault || /(^|; )ac_enable_tracking=([^;]+)/.test(document.cookie)) {
	acEnableTracking();
}

</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTNBD89"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
