<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png">
  
 <?php wp_head(); ?>
  </head>

    <body <?php body_class(); ?>>
      <div class="box-loader">
        <div class="content">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
      
      <?php 
      // Detectar idioma y asignar variable con id traduccion
      /*if (ICL_LANGUAGE_CODE == 'es') { 
         $traduccion = '120'; 
      } elseif (ICL_LANGUAGE_CODE == 'en') {
          $traduccion = '130'; 
      } */
      
      ?>

      <header class="header">
        <div class="container">
          <div class="row justify-content-lg-center ">

               <nav class="navbar navbar-custom align-items-start flex-column <?php echo $open;?>" role="navigation">
                 <div class="w-100">
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

                 </div>
              </nav>
             
              <div class="col">
                <a href="<?php echo home_url();?>">
                 <?php if ( function_exists( 'the_custom_logo' ) ) {
                      the_custom_logo();
                  } else {?>
                    <img class="logo" src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="logo">
                  <?php }?>
                </a>
              </div> 
              
             <nav class="navbar navbar-custom align-items-start flex-column <?php echo $open;?>" role="navigation">
               <div class="w-100">
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

               </div>
            </nav> 

              <div class="col-5 align-self-center d-flex justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
              </div>

          </div>
        </div>
      </header>

