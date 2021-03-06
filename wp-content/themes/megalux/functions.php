<?php
/**
 * jkpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jkpress
 */

if ( ! function_exists( 'jkpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jkpress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on jkpress, use a find and replace
	 * to change 'jkpress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'jkpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'jkpress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'jkpress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'jkpress_setup' );

// GET POST IMAGE

function post_image_size($size = 'large') {
    global $post;
    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
    return $img[0];
}

function get_image_size($image = null, $size = 'large' ) {
    if ($image) {
        if (!array_key_exists($size, $image['sizes'])) {
            $size = 'large';
        }
        return $image['sizes'][$size];
    }
}

function print_thumbnail($id,$size="large"){
    $thumb_id = get_post_thumbnail_id( $id );
    $thumbnail = get_post( $thumb_id );

    $title = $thumbnail->post_title;
    $description = $thumbnail->post_content;
    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    $url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );  // Esto devuelve un array...
    $url = $url[0];    // Pero sólo nos interesa ese valor.

    return ("<img src='".$url."' title='".$title."' alt='".$alt."' description='".$description."'>");
}

// THEME SCRIPTS
// Front
function jk_scripts() {
  wp_enqueue_style( 'jk-theme-style', get_stylesheet_uri(), array(), '1.00' );
  wp_enqueue_style( 'jk-main-styles', get_template_directory_uri() . '/sass/style.css', array(), '0.14');

  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_enqueue_script(
      'jquery',
      get_template_directory_uri() . '/js/jquery-2.1.4.min.js',
      '',
      '',
      true
    );
    wp_enqueue_script(
      'bootstrap-js',
       get_template_directory_uri() . '/js/bootstrap.min.js',
        array('jquery'),
        '4.0',
        true
    );
    wp_enqueue_script(
      'jk-js',
       get_template_directory_uri() . '/js/scripts.min.js',
        array('jquery'),
        '0.07',
        true
    );
    wp_enqueue_script(
      'skrollr',
       get_template_directory_uri() . '/js/skrollr.min.js',
        array('jquery'),
        '0.6.30',
        true
    );
  }

  if(is_singular('proyecto') || is_singular('productos')){
    wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/css/lightslider.min.css', array(), '1.1.3');
    wp_enqueue_script(
      'lightslider-js',
       get_template_directory_uri() . '/js/lightslider.min.js',
        array('jquery'),
        '1.1.3',
        true
    );
  }

  wp_localize_script( 'jk_script', 'TEMPLATE', array(
      'uri' => get_template_directory_uri()
  ));

}
add_action('wp_enqueue_scripts', 'jk_scripts');

// CUSTOM LOGIN
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Urvanity Projects';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/magalux-logo-small.png);
          height: 50px;
          width: 320px;
          background-size: contain;
          background-repeat: no-repeat;
          padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//Remove emojis support
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

//Remove recent comments styles in head
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');

// REMOVE ADMIN BAR IN FRONT
function remove_admin_bar() {
    show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');

// MENUS
//Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

register_nav_menus( array(
	'menu_izquierda' => __( 'Menu izquierda', 'magalux' ),
	'menu_derecha' => __( 'Menu derecha', 'magalux' ),
	'menu_movil' => __( 'Menu movil', 'magalux' ),

) );

// ENABLE SVG UPLOAD
add_filter( 'upload_mimes', 'custom_upload_mimes' );

function custom_upload_mimes( $existing_mimes = array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

// FORMAT PHONE
function formatPhone($phone) {
  $phone = str_replace('+', '', $phone);
  $phone = str_replace(' ', '', $phone);
  $phone = str_replace('(', '', $phone);
  $phone = str_replace(')', '', $phone);

  echo $phone;
}

/*CPT*/
//Proyectos
add_action( 'init', 'post_type_projects' );

function post_type_projects() {
    $labels = array(
    'name' => _x( 'Proyecto', 'post type general name' ),
        'singular_name' => _x( 'Proyecto', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo Proyecto', 'proyectos' ),
        'add_new_item' => __( 'Añadir nuevo Proyecto' ),
        'edit_item' => __( 'Editar Proyecto' ),
        'new_item' => __( 'Nuevo Proyecto' ),
        'view_item' => __( 'Ver Proyecto' ),
        'search_items' => __( 'Buscar Proyecto' ),
        'not_found' =>  __( 'No se han encontrado Proyecto' ),
        'not_found_in_trash' => __( 'No se han encontrado Proyecto en la papelera' )
    );

    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-multisite',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    );

    register_post_type( 'proyecto', $args );
}

//Productos
add_action( 'init', 'post_type_productos' );

function post_type_productos() {
    $labels = array(
    'name' => _x( 'Productos', 'post type general name' ),
        'singular_name' => _x( 'Productos', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo Productos', 'proyectos' ),
        'add_new_item' => __( 'Añadir nuevo Productos' ),
        'edit_item' => __( 'Editar Producto' ),
        'new_item' => __( 'Nuevo Producto' ),
        'view_item' => __( 'Ver Producto' ),
        'search_items' => __( 'Buscar Producto' ),
        'not_found' =>  __( 'No se han encontrado Producto' ),
        'not_found_in_trash' => __( 'No se han encontrado Producto en la papelera' )
    );

    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'producto'),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-screenoptions',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    );

    register_post_type( 'productos', $args );
}

//Testimonios
add_action( 'init', 'post_type_testimonios' );

function post_type_testimonios() {
    $labels = array(
    'name' => _x( 'Testimonios', 'post type general name' ),
        'singular_name' => _x( 'Testimonios', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo Testimonios', 'proyectos' ),
        'add_new_item' => __( 'Añadir nuevo Testimonios' ),
        'edit_item' => __( 'Editar Testimonio' ),
        'new_item' => __( 'Nuevo Testimonio' ),
        'view_item' => __( 'Ver Testimonio' ),
        'search_items' => __( 'Buscar Testimonio' ),
        'not_found' =>  __( 'No se han encontrado Testimonio' ),
        'not_found_in_trash' => __( 'No se han encontrado Testimonio en la papelera' )
    );

    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-thumbs-up',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    );

    register_post_type( 'testimonios', $args );
}

// TAXONOMIES
// Tax productos
add_action( 'init', 'create_tax_producto');

function create_tax_producto() {
    $labels = array(
        'name' => _x( 'Categoría de producto', 'taxonomy general name' ),
        'singular_name' => _x( 'Categoría de producto', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar por Categoría de producto' ),
        'all_items' => __( 'Todas las Categoría de producto' ),
        'parent_item' => __( 'Categoría de producto padre' ),
        'parent_item_colon' => __( 'Categoría de producto padre:' ),
        'edit_item' => __( 'Editar Categoría de producto' ),
        'update_item' => __( 'Actualizar Categoría de producto' ),
        'add_new_item' => __( 'Añadir nuevo Categoría de producto' ),
        'new_item_name' => __( 'Nombre del nuevo Categoría de producto' ),
    );
    register_taxonomy( 'categoria_producto', array( 'productos' ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'categoria-producto' ),
    ));
}

//Tax Tipo proyecto
add_action( 'init', 'create_tax_tipo', 0 );

function create_tax_tipo() {
    $labels = array(
        'name' => _x( 'Tipo de proyecto', 'taxonomy general name' ),
        'singular_name' => _x( 'Tipo de proyecto', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar por Tipo de proyecto' ),
        'all_items' => __( 'Todos los Tipo de proyecto' ),
        'parent_item' => __( 'Tipo de proyecto padre' ),
        'parent_item_colon' => __( 'Tipo de proyecto padre:' ),
        'edit_item' => __( 'Editar Tipo de proyecto' ),
        'update_item' => __( 'Actualizar Tipo de proyecto' ),
        'add_new_item' => __( 'Añadir nuevo Tipo de proyecto' ),
        'new_item_name' => __( 'Nombre del nuevo Tipo de proyecto' ),
    );
    register_taxonomy( 'tipo', array( 'proyecto' ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'tipos' ),
    ));
}

// CUSTOM SWITCHER FOR WPML

//function myselector(){
//  $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
//
//    $items = "";
//    foreach($languages as $key => $l){
//
//      if($l['active'] == 1) {
//        $active = ' active';
//      } else {
//        $active = ' ';
//      }
//
//      $items .= '<a class="nav-link '. $active .' " href="' . $l['url'] . '">' . $l['code'] . '</a>';
//    }
//
//    return $items;
//
//}

// NUMERIC PAGINATION

function numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="post-navigation"><ul>' . "\n";

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
//    if ( get_next_posts_link() )
//        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Página de opciones',
		'menu_title'	=> 'Página de opciones',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

//EXCLUIR PAGINAS DE RESULTADOS BUSQUEDA EN BLOG
if (!is_admin()) {
  function wpb_search_filter($query) {
    if ($query->is_search) {
    $query->set('post_type', 'post');
  }
    return $query;
  }
  add_filter('pre_get_posts','wpb_search_filter');
}

//MENU FOOTER
function register_my_menus() {
  register_nav_menus(
    array(
    'footer_primary' => __( 'Footer 1' ),
    'footer_second' => __( 'Footer 2' ),
    'footer_third' => __( 'Footer 3' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// BREADCUMBS
// Breadcrumbs
function custom_breadcrumbs() {

    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = __('Inicio', 'megalux');

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo '<li class="item-current item-archive">' . post_type_archive_title($prefix, false) . '</li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                if($post_type_object){
                  echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                  echo '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive">' . $custom_tax_name . '</li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // CPT PRODUCTOS
            if($post_type == 'productos') {

              $terms = get_the_terms( get_the_ID(), 'categoria_producto' );

              if($terms){
                //padres
                foreach ( $terms as $term ){
                  if ( $term->parent == 0 ) {
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_term_link($term->term_id) . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                  }
                }
                //Hijos
                $total = count($terms);
                foreach ( $terms as $key => $term ){
                  if ( $term->parent != 0) {
                    if($key == $total-1){
                      echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_term_link($term->term_id) . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                      echo '<li class="separator"> ' . $separator . ' </li>';
                    }
                  }
                }

              }
            }

            // CPT PROYECTO
            if($post_type == 'proyecto') {

              $taxonomy = get_terms( array(
                  'taxonomy' => 'tipo',
                  'hide_empty' => false,
              ));

              echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_term_link($taxonomy[0]->term_id) . '" title="' . $taxonomy[0]->name . '">' . $taxonomy[0]->name . '</a></li>';
              echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $cat = array_values($category);
                $last_category = end($cat);

              //print_r($category);

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. __('Noticias - ').$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat">' . single_cat_title('', false) . '</li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '">' . $get_term_name . '</li>';

        }  else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '">' . __('Resultados para: ', 'megalux') . ' " ' . get_search_query() . '"</li>';

        }

        echo '</ul>';

    }
}

/**
 * Custom posts per page for Taxonomy
 */
function cs_custom_posts_per_page( $query ) {
	if ( is_tax( 'categoria_producto' ) ) {
        $query->set('posts_per_page', -1);
    }
}
add_filter( 'pre_get_posts', 'cs_custom_posts_per_page' );

/*
// patch fix custom post type order using switch_to_blog instead of restore_current_blog
add_action( 'switch_blog', function( $new_blog, $prev_blog_id ){
	// avoid recursion, because switch_blog action is called by restore_current_blog too
	if( empty( $GLOBALS['_wp_switched_stack'] ) ){
		return;
	}
	if( $new_blog === get_current_blog_id() ){
		// prepare the stack in order to be emptied by restore_current_blog()
		$GLOBALS['_wp_switched_stack'] = array( get_current_blog_id() );

		// call what everyone should call: https://codex.wordpress.org/Function_Reference/restore_current_blog
		// "When calling switch_to_blog() repeatedly, either call restore_current_blog() each time"
		restore_current_blog();
	}
}, PHP_INT_MAX, 2 );*/
