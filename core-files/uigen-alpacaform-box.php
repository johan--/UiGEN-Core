<?php
// ###############################################################################

function alpacaform_box($post, $metabox){
  $data = get_post_meta($post->ID, 'ui_'.$metabox['id'],true);
  
  $metadata = get_post_custom($post->ID);
  $tmp_visits = array();
  $tmp_visits2 = array();


  if($metadata!=false){
    foreach ($metadata as $key => $value) {
      if(strpos($key, 'alpc_')===false) {
        unset($metadata[$key]);
      }
      // Let the hardco[d|r]e begin...
      if (in_array($key, array('alpc_visit_currency', 'alpc_visit_price', 'alpc_visit_visit_name'))) {
        $tmp_visits[substr($key, 11)] = $value;
      }
    }
  }
  // var_dump($tmp_visits);

  if (count($tmp_visits) > 0) {
    foreach($tmp_visits['currency'] as $index => $val) {
      $tmp_visits2[$index] = array(
        'currency' => $val, 
        'price' => $tmp_visits['price'][$index], 
        'visit_name' => $tmp_visits['visit_name'][$index],
      );
    }
    $metadata['supports'] = $tmp_visits2;
  // print('<pre>');
  //   var_dump($tmp_visits2);
  // print('</pre>');
  }

  if(count($metadata) != 0) {
    $data = str_replace('alpc_', '', json_encode($metadata));
  } else {
    $data = urldecode($data);
  }
  // var_dump($data);
  echo '<div id="'.$metabox['id'].'_form" class="stuffbox"></div>';
  echo '<div id="'.$metabox['id'].'_output_box"><input id="'.$metabox['id'].'_output_field" name="'.$metabox['id'].'_output_field" type="text" value="'.$data.'" /></div>';
  ?>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var template_dir = "<?php echo get_template_directory_uri(); ?>";
      var alpacaGlobalObj = new Array();       
      $("#<?php echo $metabox['id']; ?>_form").alpaca({  

          // ----------------------------------------------
          // read data json from postmeta
          <?php
          if(get_post_meta($post->ID, 'ui_'.$metabox['id'],true) != ""){
            echo '"data":'.$data.','; 
          }
          ?>
          // ----------------------------------------------
          //"optionsSource": "<?php //echo $metabox['args']['data_path'].$metabox['args']['options_file'];?>",
          "schemaSource": "<?php echo $metabox['args']['data_path'].$metabox['args']['schema_file'];?>",
          "options": <?php echo $metabox['args']['options'];?>,
          <?php 
          if($metabox['args']['view'] != ''){
            echo '"view": "VIEW_WEB_DISPLAY",';
          }
  
          ?>
          // ----------------------------------------------
          // add form methods
          "postRender": function(renderedForm) {          
            $('select, input, textarea').live('change',function() {    
              //if (renderedForm.isValid(true)) {
                var val = renderedForm.getValue();
                $('#<?php echo $metabox["id"]."_output_field"; ?>').val(encodeURIComponent(JSON.stringify(val))); 
              //}
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
  // var_dump($args);
  $postTitleString = "";
  global $wpdb;   
  $query = "
  SELECT $wpdb->posts.* 
  FROM $wpdb->posts
  WHERE $wpdb->posts.post_status = 'publish' 
  AND $wpdb->posts.post_type = '".$args."'
  ORDER BY $wpdb->posts.post_date DESC
  ";

  
  $posts = $wpdb->get_results( $query , object );

    // var_dump( $posts);
  $postTitleString = '';
  foreach ( $posts as $db_post ){       
      $postTitleString .= "'{$db_post->post_title}', ";
  } 
  $postTitleString = rtrim($postTitleString, ', ');
    // var_dump($postTitleString);
  return $postTitleString;
}

function render_users_to_alpaca_string($args){

    $args = array( 'role' => $args);

    // The Query
    $user_query = new WP_User_Query( $args );
    $counter = 0;
    // User Loop
    if ( ! empty( $user_query->results ) ) {

                $postTitleString = 'function(field, callback) { callback([';
                foreach ( $user_query->results as $user ) {
                if($counter == 0){
                  $postTitleString = $postTitleString. '{"text": "'. $user->display_name.'", "value": "'. $user->ID.'"}';
                }else{
                  $postTitleString = $postTitleString. ',{"text": "'. $user->display_name.'", "value": "'. $user->ID.'"}';
                }
                $counter++;
      }
      $postTitleString = $postTitleString.']);}';
      return $postTitleString;

  } else {
    $postTitleString = 'function(field, callback) {callback([{"text": "No users found", "value": "0"}]);}';
    return $postTitleString;
  }

}
// ================================================================================

// save post function
function save_alpaca_form_box( $post_id ) {
  include ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-metaboxes/arguments/uigen-metaboxes-arguments.php';
  foreach ($uigen_metaboxes as $metabox) {
    if ( (isset($_POST['publish']) || isset($_POST['save'])) && $_REQUEST['post_type'] == $metabox[3]) {
      if (strpos($metabox[0], 'savebox') !== false ) {
        continue; // Ignore all saveboxes
      }
      update_post_meta($post_id, 'ui_'.$metabox[0], $_POST[$metabox[0].'_output_field']);
      $data = json_decode(urldecode($_POST[$metabox[0].'_output_field']), true);


      switch ($metabox[0]) {
        case 'kontrakt-visit-box':
          $data = $data['supports'];
          if (is_array($data) && count($data) > 0) {
            foreach ($data[0] as $field) {
              delete_post_meta( $post_id, 'alpc_visit_'.$name);
            }
          }
          foreach ($data as $array) {
            foreach ($array as $name => $value) {
              add_post_meta( $post_id, 'alpc_visit_'.$name, $value);
            }
          }
          break;
        case 'kontrakt-doctor-box':

          // print('<pre>');
          // var_dump($data);
          // print('</pre>');
          break;
        default:
          foreach($data as $name => $value) {
            delete_post_meta( $post_id, "alpc_".$name);
            // if(is_array($value)) {
            //   $fields = array();
            //   foreach ($value as $sub_value) {
            //     $counter = 0;
            //     foreach ($sub_value as $name => $value) {
            //       $fields[$counter++] = $name;
            //       add_post_meta( $post_id, 'alpc_rpt_'.$name, $value);
            //     }
            //   } 
            //   $value = 'rpt'.json_encode($fields);
            // }
            add_post_meta( $post_id, "alpc_".$name, $value);
          }
      }
    }    
  }
  // die();
}
add_action( 'save_post', 'save_alpaca_form_box' );

// ###############################################################################
