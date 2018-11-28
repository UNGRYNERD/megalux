<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post(); 

$terms = get_the_terms( $post->ID, 'category' );
$post_tags = get_the_tags();

?>

<main class="single-post">
 <section class="box-header"></section>
 
 
  <section class="box-content">
    <div class="container">
      <div class="row">
       
          <div class="col-12 col-md-9">
            <div class="col-paginacion">
              <?php                
                $prev_post = get_next_post();
                $next_post = get_previous_post();

                if($prev_post){?>
                  <a class="button button--outline button--blue prev-link" href="<?php echo get_permalink($prev_post->ID); ?>">Anterior</a>
                <?php } if($next_post){?>
                  <a class="button button--outline button--blue next-link" href="<?php echo get_permalink($next_post->ID); ?>">Siguiente</a>
                <?php }?>
            </div>
            
            <div class="content">
              <?php if(post_image_size()){?>
                <img class="box-img w-100" src="<?php echo post_image_size();?>" alt="">
              <?php }?> 
              <div class="box-post">
                <h1><?php the_title();?></h1>
                <div class="info-post">
                  <?php if ($terms) {
                    foreach($terms as $item){?>
                      <a href="<?php echo get_category_link( $item->term_id )?>">
                        <?php echo $item->name; ?> 
                      </a>
                    <?php }
                  }?>
                  <span>|</span>
                  <?php printf( _nx( '1 Comentario', '%1$s Comentarios', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) ); ?>
                </div>
              </div>
              <div class="post-content">
                <?php the_content();?>
              </div>
              
              <div class="tags-content share-content">

                <?php if ( $post_tags ) {?>
                  <div class="box-tags">
                    <span>
                      <i class="fas fa-tag"></i>
                    </span>
                    <?php foreach( $post_tags as $tag ) {?>
                      <a href="<?php echo get_tag_link($tag->term_id); ?>">
                        <?php echo $tag->name?>, 
                      </a>
                    <?php }?>
                  </div>
                <?php }?>
               
                
                
              </div>
              
            </div>
            
          </div>   
          
          <!-- SIDEBAR -->

      </div>
    </div>
  </section>
</main>

<?php endwhile; endif; ?>
<?php include('footer.php'); ?>
