<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
 <?php wp_head(); ?>
  </head>

    <body <?php body_class(); ?>>
      <div class="box-loader">
        <div class="content">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
      
      <div id="top" class="top-header">
        <div class="container">
         <div class="row justify-content-between">
            <?php if(get_field('telefono_superior', 'option') || get_field('enlace', 'option')) {?>
            <div class="col-6">
              <?php if(get_field('telefono_superior', 'option')){?>
                <a href="tel:<?php formatPhone(get_field('telefono_superior', 'option'));?>" class="link-tel">
                  <?php the_field('telefono_superior', 'option');?>
                </a>
              <?php } if(get_field('enlace', 'option')){?>
                <a href="<?php echo get_permalink(get_field('enlace', 'option')->ID)?>">
                  <?php echo get_field('enlace', 'option')->post_title;?>
                </a>
              <?php }?>
            </div>
            <?php }?>
            <div class="col-6 text-right">
              <?php if( get_field('facebook', 'option') || get_field('youtube', 'option') || get_field('twitter', 'option') || get_field('google_plus', 'option') || get_field('linkedin', 'option')){?> 
               
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
                  <?php } if(get_field('google_plus', 'option')){?>
                    <a href="<?php echo get_field('google_plus', 'option');?>" target="_blank">
                      <i class="fab fa-google-plus-g"></i>
                    </a>
                  <?php } if(get_field('linkedin', 'option')){?>
                    <a href="<?php echo get_field('linkedin', 'option');?>" target="_blank">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                  <?php }?>
                </div>
              
              <?php } if(get_field('selector_idiomas', 'option')){?>
                <div class="lang-switch text-right">
                  <?php foreach(get_field('selector_idiomas', 'option') as $item){?>
                    <a href="<?php echo $item[url_pagina]?>">
                      <?php echo $item[idioma]?>
                    </a>
                  <?php } ?>
                </div>
              <?php }?>
              
            </div>
             


              
            
          </div>
        </div>
      </div>

      <header class="header">
        <div class="container">
          <div class="row justify-content-between">

               <nav class="col-5 navbar navbar-custom align-items-start flex-column <?php echo $open;?>" role="navigation">
                   <?php

                    wp_nav_menu( array(
                      'theme_location'    => 'menu_izquierda',
                      'depth'             => 2,
                      'container'         => 'div',
                      'container_id'      => 'menu',
                      'menu_class'        => 'navbar navbar-expand-md justify-content-md-between',
                      'walker'            => new WP_Bootstrap_Navwalker(),
                    ) );
                    ?>


              </nav>
              <?php if(get_field('logo', 'option') || get_field('logo_scroll', 'option') || get_field('logo_movil', 'option') ){?>
                <div class="content-logo">
                  <a href="<?php echo home_url();?>">
                    <?php if ( get_field('logo', 'option')) { ?>
                     
                      <img class="logo" src="<?php echo get_field('logo', 'option')[url];?>" alt="<?php echo get_field('logo', 'option')[alt];?>" title="<?php echo get_field('logo', 'option')[title];?>">
                      
                    <?php } if ( get_field('logo_scroll', 'option')) { ?>
                     
                      <img class="logo__scroll" src="<?php echo get_field('logo_scroll', 'option')[url];?>" alt="<?php echo get_field('logo_scroll', 'option')[alt];?>" title="<?php echo get_field('logo_scroll', 'option')[title];?>">
                      
                    <?php } if ( get_field('logo_movil', 'option')) { ?>
                     
                      <img class="logo__movil" src="<?php echo get_field('logo_movil', 'option')[url];?>" alt="<?php echo get_field('logo_movil', 'option')[alt];?>" title="<?php echo get_field('logo_movil', 'option')[title];?>">
                      
                    <?php }?>
                  </a>
                </div> 
              <?php }?>
              
             <nav class="col-4 navbar navbar-custom align-items-end flex-column <?php echo $open;?>" role="navigation">
                 <?php

                  wp_nav_menu( array(
                    'theme_location'    => 'menu_derecha',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_id'      => 'menu',
                    'menu_class'        => 'navbar navbar-expand-md justify-content-md-between',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                  ) );
                  ?>
            </nav> 

              <div class="col-5 align-self-center d-flex justify-content-end d-lg-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
              </div>

          </div>
        </div>
      </header>

