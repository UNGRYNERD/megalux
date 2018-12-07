<?php include('header.php');
if (have_posts()) : while (have_posts()) : the_post(); 

$terms = get_the_terms( $post->ID, 'category' );
$post_tags = get_the_tags();

?>

<main class="single-post">
  <section class="box-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php custom_breadcrumbs(); ?>
        </div>
      </div>
    </div>
  </section>
 
 
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
              <div class="box-post-title">
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
                  <span>|</span>
                  <div class="share-box">
                    Compartir: <?php echo wpfai_social(); ?>
                  </div>
                </div>
              </div>
              <div class="post-content">
                <?php the_content();?>
              </div>
              
              <div class="tags-content share-content">

                <?php if ( $post_tags ) {?>
                  <div class="box-tags">
                    <span class="icon-box">
                      <i class="fas fa-tag"></i>
                    </span>
                    <?php foreach( $post_tags as $tag ) {?>
                      <a href="<?php echo get_tag_link($tag->term_id); ?>">
                        <?php echo $tag->name?>, 
                      </a>
                    <?php }?>
                  </div>
                <?php }?>
                
                <div class="share-box">
                  <span class="icon-box">
                    <i class="fas fa-share-alt"></i>
                  </span>
                  <?php echo wpfai_social(); ?> 
                </div>

              </div>
              
              
              <?php
                  $args= array( 
                    'posts_per_page' => 3,
                    'post__not_in' => array($post->ID), 
                    'orderby' => 'rand', 
                  );
                  $my_query = new WP_Query( $args );

                  if( $my_query->have_posts() ) {?>

                    <div class="row related-post">
                      <div class="col-12">
                        <h3>Noticias relacionadas</h3>
                      </div>

                      <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
                        <div class="col-12 col-md-6 col-lg-4 box-post">
                          <a href="<?php echo get_permalink(); ?>" class="col-project">
                             <?php echo print_thumbnail($post->ID);?>
                            <p><?php the_title(); ?></p>
                          </a>
                        </div>

                      <?php }?>
                      </div>
                <?php } wp_reset_query();?>
              
              <div class="comments-box">
                <?php comments_template(); ?>
              </div>
              
            </div>
            
          </div>   
          
          <!-- SIDEBAR -->
          <?php include('sidebar.php'); ?>

      </div>
    </div>
  </section>
</main>

<?php endwhile; endif; ?>
<?php include('footer.php'); ?>
