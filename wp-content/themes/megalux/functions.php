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
  wp_enqueue_style( 'jk-main-styles', get_template_directory_uri() . '/sass/style.css', array(), '0.01');
  
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
        '1.00',
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
        'menu_position' => null,
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
        'rewrite' => true,                             
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => null,
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
        'menu_position' => null,
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
 
    /** Previous Post Link */
//    if ( get_previous_posts_link() )
//        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
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
