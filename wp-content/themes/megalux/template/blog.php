<?php
/**
* Página Blog
*/

include( get_template_directory() . '/header.php');?>

<main class="blog-page">
 
  <section class="box-header">
    <div class="container">
      <div class="row align-items-end">

        <div class="col-12"> 
          <h1 class="text-center">
            <?php if(is_category()){
              echo single_cat_title( '', false);
            }else {
              the_field('titulo_imagen_cabecera');
            }?>
          </h1>
        </div>

      </div>
    </div>
  </section>

  
  <section class="box-content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
          <div class="row">
            <?php 

                if (is_home() ){
                  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                  $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'paged' => $paged,
                  );
                  query_posts($args);
                }


                if (have_posts()) {
                  while (have_posts()) {
                    the_post(); $terms = get_the_terms( $post->ID, 'category' );?>

                      <div class="col-12 col-lg-6 box-post-title">
                        <a href="<?php echo get_permalink(); ?>" class="col-project col-post">
                           <?php echo print_thumbnail($post->ID);?>
                          <p><?php the_title(); ?></p>
                        </a>
                        <div class="info-post text-center">
                          <?php if ($terms) {
                            foreach($terms as $item){?>
                              <a href="<?php echo get_category_link( $item->term_id )?>">
                                <?php echo $item->name; ?> 
                              </a>
                            <?php }
                          }?>
                          <span>|</span>
                          <?php printf( _nx( '1 Comentario', '%1$s Comentarios', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) ); ?>
                          
                          <div class="share-box d-block">
                            <?php echo wpfai_social(); ?> 
                          </div>
                        </div>

                      </div>

                  <?php } if(!is_archive()){?> 
                    <div class="col-12">
                      <?php numeric_posts_nav(); ?>
                    </div>
                <?php } 
                } else {?>
                <div class="col-12">
                  <h3>No hay resultados</h3>
                </div>
                <?php } wp_reset_query();?>
            </div> 
          </div>
          
          <!-- SIDEBAR -->
          <?php include( get_template_directory() . '/sidebar.php'); ?>

        </div>
      </div>
  </section>
  
</main>

<?php 

include( get_template_directory() . '/footer.php'); ?>