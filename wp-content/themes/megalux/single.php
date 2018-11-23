<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post();?>

<main class="single-content">
  <section class="box-content">
    <div class="container">
      <div class="row">      
        <?php if(post_image_size()){?>
          <div class="col-12">
            <img class="box-img" src="<?php echo post_image_size();?>" alt="">         
          </div>
        <?php }?>
    
        <div class="col-12">
          <h1><?php the_title();?></h1>

          <div class="post-content">
            <?php the_content();?>
          </div>
          
        </div>
      </div>
    </div>
  </section>
</main>

<?php endwhile; endif; ?>
<?php include('footer.php'); ?>
