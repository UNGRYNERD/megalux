<?php 

if (comments_open()) { ?>

    
    
    <?php if (have_comments()) {?>
     <h3><?php printf( _nx( '1 Comentario', '%1$s Comentarios', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) ); ?></h3>
      <?php wp_list_comments(array('callback' => 'template_list_comments'));
    } ?>

    <h3>Deja tu comentario</h3>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="POST" role="form" id="respond">
     
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="name"></label>
            <input type="text" class="form-control required" name="author" placeholder="Nombre *">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="email"></label>
            <input type="text" class="form-control required email" name="email" placeholder="Email *">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="url"></label>
            <input type="url" class="form-control" name="url" placeholder="Website">
          </div>
        </div>

        <div class="col-12">
          <div class="form-group">
            <label for="comment"></label>                                                
            <textarea name="comment" cols="30" rows="6" placeholder="Mensaje *" class="form-control required"></textarea>
          </div>
          <div>
            <button class="button button--outline button--blue" id="submit-comment">Publicar</button>
            <?php comment_id_fields(); ?>
          </div>
        </div>
      </div>

      <?php do_action('comment_form', $post->ID); ?>
        
    </form>
    
<?php } else { ?>

    <p>Los comentarios están deshabilitados</p>

<?php }

function template_list_comments( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment; ?>
    <div id="comment-<?php comment_ID(); ?>" class="comment d-md-flex">

      <div class="image-author">
        <?php 
        echo get_avatar( $comment, $size='76', '', '', array('class' => 'img-border') );?>
      </div>
      
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-details">
        <div class="title d-md-flex justify-content-between">
          <h4><?php comment_author();?></h4>

          <div class="reply text-md-right">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            <?php edit_comment_link(__('Edit'),'  ','') ?>
          </div>
        </div>
        <div class="singleComment">
          <?php comment_text(); ?>
        </div>

      </div>

    </div>

<?php }


?>