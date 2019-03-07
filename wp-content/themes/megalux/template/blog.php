<?php
/**
* Página Blog
*/

$blog_page = get_option('page_for_posts');

get_header()?>

<main class="blog-page">
 
  <section class="box-header">
    <div class="container">
      <div class="row align-items-end">

        <div class="col-12"> 
          
            <?php if(is_category() || is_search()){?>
              <h1 class="text-center"><?php echo single_cat_title( '', false); ?></h1>
              <?php custom_breadcrumbs();
            }else { ?>
              <h1 class="text-center"><?php the_field('titulo_imagen_cabecera', $blog_page);?></h1>
            <?php }?>
        </div>

      </div>
    </div>
  </section>

  
  <section class="box-content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-8 col-lg-9 col-blog">
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

                      <div class="col-12 col-lg-6 box-post-title blog-item">
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
                  <h3><?php echo __('No hay resultados','megalux');?></h3>
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

get_footer(); ?>