<?php
  $blog_page = get_option('page_for_posts');
?>

 <div class="col-12 col-md-4 col-lg-3 sidebar-blog">
 
  <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <label>
      <input type="submit" id="searchsubmit" value="Search" />
      <i class="fas fa-search"></i>
    </label>
    <input class="inputsearch" type="text" value="" name="s" id="s" placeholder="Buscar"/>
  </form>
  
  <div class="category-list">
    <h4><?php echo __('Categorías','megalux');?></h4>
    <?php $cat = get_categories();
    foreach($cat as $item){ 
      if($item->term_id != '1' ) {?>
        <a href="<?php echo get_category_link( $item->term_id )?>">
          <?php echo $item->name; ?> 
        </a>
      <?php }
    }?>
  </div>
  
  <?php if (get_field('imagen_catalogo',$blog_page) && get_field('archivo_catalogo',$blog_page)) {?>
    <a href="<?php echo get_field('archivo_catalogo',$blog_page);?>" target="_blank">
      <img src="<?php echo get_field('imagen_catalogo',$blog_page)['url'];?>" alt="<?php echo get_field('imagen_catalogo',$blog_page)['alt'];?>"  title="<?php echo get_field('imagen_catalogo',$blog_page)['title'];?>">
    </a>
  <?php }?>
  
  <div class="tags-list">
    <h4><?php echo __('Etiquetas','megalux');?></h4>
    <?php 
    $terms = get_terms( array(
        'taxonomy' => 'post_tag',
        'hide_empty' => false,
    ) );
    foreach($terms as $item){?>
        <a href="<?php echo get_category_link( $item->term_id )?>">
          <?php echo $item->name; ?> 
        </a>
    <?php }?>
  </div>
  
</div>