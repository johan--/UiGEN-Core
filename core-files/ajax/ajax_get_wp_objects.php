<?php
require_once("../../../../../wp-load.php");


function ui_get_postmeta($obj) {
    echo get_post_meta($obj["post_id"],$obj['meta_name'],true);
}

function ui_get_usermeta($obj) {
    echo get_user_meta($obj["user_id"],$obj['meta_name'],true);
}

function ui_post_list_as_options($obj) {
	
var_dump($obj);
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

function ui_get_postmeta_options($obj) {
 // var_dump(get_post_meta($obj["post_id"],$obj['meta_name']));
  foreach (get_post_meta($obj["post_id"],$obj['meta_name']) as $key => $value) {
    echo '<option value="'.$value.'">'.$value.'</option>';
  }


}




$obj = array($_POST['args']);
call_user_func_array($_POST['callback'],$obj);
?>