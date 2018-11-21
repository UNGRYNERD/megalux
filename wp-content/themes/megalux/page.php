<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page-content">
  <section class="box-content">
    <div class="container">
      <div class="row">
        <div class="col-12">
           <h1 class="border-blue"><?php the_title();?></h1>
          <?php if(get_the_content()) {
          the_content();
          } ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php endwhile; endif; ?>
<?php include('footer.php'); ?>