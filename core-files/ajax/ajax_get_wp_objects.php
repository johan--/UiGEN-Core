<?php
require_once("../../../../../wp-load.php");

/**
 * This function return html to display after ajax responce
 *
 * @param json $obj properties set to realize this function . 
 * @filesource /UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php
 */
function ui_get_postmeta($obj) {
    echo get_post_meta($obj["post_id"],$obj['meta_name'],true);
}


/**
 * This function return html to display after ajax responce
 *
 * @param json $obj properties set to realize this function . 
 * @filesource /UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php
 */
function ui_get_usermeta($obj) {
    echo get_user_meta($obj["user_id"],$obj['meta_name'],true);
}


/**
 * This function return html to display after ajax responce
 *
 * @param json $obj properties set to realize this function . 
 * @filesource /UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php
 */
function ui_post_list_as_options($obj) {
  $args = array(
  'post_type' => $obj['post_type'],
 	'meta_query' => array(
       array(
           'key' => $obj['key'],
           'value' => $obj['value'],
           'compare' => 'IN',
       )
   	)  
  	);
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) {
    	$query->the_post();
    	echo '<option value="'.$query->post->ID.'">'.$query->post->post_name.'"</option>"';
  	}
  	wp_reset_postdata();    
}

/**
 * This function return html to display after ajax responce
 *
 * @param json $obj properties set to realize this function . 
 * @filesource /UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php
 */
function ui_post_list_to_modal($obj) {
    $args = array(
    'post_type' => $obj['post_type'],
/*    'meta_query' => array(
         array(
             'key' => $obj['key'],
             'value' => $obj['value'],
             'compare' => 'IN',
         )
      ) */ 
      );
    $query = new WP_Query( $args );
    
    echo '<h2>'.get_the_title($obj['post_id']).' linked with:</h2>';

    echo '<table class="table" data-child-id="'.$obj['post_id'].'">';  
    echo '<tr>';  
    echo '<th>ID</th>';  
    echo '<th>Title</th>'; 
    echo '<th>Related</th>'; 
    echo '<th>Action</th>';   
    echo '</tr>';  
    while ( $query->have_posts() ) {
        $query->the_post(); 

        $rel_id = get_post_meta($query->post->ID,'rel_post_id',true);
        if($rel_id != ''){
          $rel_id_title = get_the_title($rel_id);
        }else{
          $rel_id_title = '-';
        }
        
        if($obj['post_id'] == $rel_id){
          $success = 'class="success"';
          
           $href = '<td><a style="color:red" href="#" class="remove-parent-relation" data-parent-relation="'.$query->post->ID.'">Unlink this object<a></td>';
     
        }else{
          $success = '';
          $href = '<td><a href="#" class="parent-relation" data-parent-relation="'.$query->post->ID.'">Link with this object<a></td>';
         
        }

        echo '<tr '.$success.'>';       
        echo '<td>'.$query->post->ID.'</td>';
        echo '<td>'.$query->post->post_title.'</td>';
        echo '<td>'.$rel_id_title.'</td>';
        echo $href;
        echo '</tr>';
      }
    echo '</table>';       
    wp_reset_postdata();    

}

/**
 * This function return html to display after ajax responce
 *
 * @param json $obj properties set to realize this function . 
 * @filesource /UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php
 */
function ui_get_postmeta_options($obj) {
  foreach (get_post_meta($obj["post_id"],$obj['meta_name']) as $key => $value) {
    echo '<option value="'.$key.'">'.$value.'</option>';
  }
}


/* ------------------------------------------------- */
/* ---------------- CALLBACK BLOCK ----------------- */
/* ------------------------------------------------- */

/*
  data schema:

  callback:function_name
  args:json_input_to_callback_function

*/


$cb = $_POST['callback'];

if( 

  ($cb == 'ui_get_postmeta') ||
  ($cb == 'ui_get_usermeta') ||
  ($cb == 'ui_post_list_as_options') ||
  ($cb == 'ui_get_postmeta_options') ||
  ($cb == 'ui_post_list_to_modal')
  

){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}

?>