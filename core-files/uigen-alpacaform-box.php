<?php
// ###############################################################################

function alpacaform_box($post, $metabox){
  $data = get_post_meta($post->ID, 'ui_'.$metabox['id'],true);
  //var_dump($data);
  
  echo '<div id="'.$metabox['id'].'_form" class="stuffbox"></div>';
  echo '<div id="'.$metabox['id'].'_output_box"><input id="'.$metabox['id'].'_output_field" name="'.$metabox['id'].'_output_field" type="text" value="'.$data.'" /></div>';
  ?>

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var template_dir = "<?php echo get_template_directory_uri(); ?>";
      $("#<?php echo $metabox['id']; ?>_form").alpaca({          
          // ----------------------------------------------
          // read data json from postmeta
          <?php
          if(get_post_meta($post->ID, 'ui_'.$metabox['id'],true) != ""){
            echo '"data":'.urldecode(get_post_meta($post->ID, 'ui_'.$metabox['id'],true)).','; 
          }
          ?>
          // ----------------------------------------------
          //"optionsSource": "<?php echo $metabox['args']['data_path'].$metabox['args']['options_file'];?>",
          "schemaSource": "<?php echo $metabox['args']['data_path'].$metabox['args']['schema_file'];?>",
          "options": <?php echo $metabox['args']['options'];?>,
          // ----------------------------------------------
          // add form methods
          "postRender": function(renderedForm) {          
            $('select, input, textarea').live('change',function() {            
              if (renderedForm.isValid(true)) {
                var val = renderedForm.getValue();
                $('#<?php echo $metabox["id"]."_output_field"; ?>').val(encodeURIComponent(JSON.stringify(val))); 
              }
            });
          } 
          // ----------------------------------------------      
        }
      );
    });
  </script>
  <?php
}
function render_posttype_to_alpaca_string($args){

    $postTitleString = "";
    global $wpdb;   
    $query = "
      SELECT $wpdb->posts.* 
      FROM $wpdb->posts
      AND $wpdb->posts.post_status = 'publish' 
      AND $wpdb->posts.post_type = 'post'
      ORDER BY $wpdb->posts.post_date DESC
    ";

  
    $posts = $wpdb->get_results( $query , object );

    var_dump( $posts);
    foreach ( $posts as $db_post ){       
        $postTitleString = $postTitleString.$db_post -> ID;
    } 
    var_dump($postTitleString);
    return $postTitleString;
}



// ================================================================================

// save post function
function save_alpaca_form_box( $post_id ) {
  
  include ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-metaboxes/arguments/uigen-metaboxes-arguments.php';
  
  foreach ($uigen_metaboxes as $metabox) {
      if ( $_POST['post_type'] == $metabox[3]) {
           update_post_meta($post_id, 'ui_'.$metabox[0], $_POST[$metabox[0].'_output_field']);
      }  
  }

}
add_action( 'save_post', 'save_alpaca_form_box' );

// ###############################################################################