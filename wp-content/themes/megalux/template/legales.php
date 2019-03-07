<?php
/**
* Template name: Paginas legales
*/
get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page-content page-legales">
 
  <section class="box-header">
    <div class="container">
      <div class="row align-items-end">

        <div class="col-12"> 
          <h1 class="text-center"><?php the_title();?></h1>
          <?php custom_breadcrumbs(); ?>          
        </div>

      </div>
    </div>
  </section>
 
  <section class="box-content-text">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-11">
          <div class="content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php include( get_template_directory() . '/template/content-relacionado.php'); ?>
  
</main>

<?php endwhile; endif;
get_footer(); ?>