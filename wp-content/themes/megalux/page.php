<?php get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page-content page-default">
 
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
 
  <section class="box-content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php endwhile; endif; ?>
<?php get_footer(); ?>