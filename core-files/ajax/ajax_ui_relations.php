<?php
require_once("../../../../../wp-load.php");



function ui_add_relation_meta($obj){
	add_post_meta( $obj['child_post_id'] , 'rel_post_id', $obj['parent_post_id'] ,  true ); 
	echo '<h3>'.get_the_title($obj['parent_post_id']).' linked with '. get_the_title($obj['child_post_id']).' successfully</h3>';
}
function ui_remove_relation_meta($obj){
	if ( current_user_can( 'manage_options' ) ) {
	delete_post_meta( $obj['child_post_id'] , 'rel_post_id', $obj['parent_post_id'] ,  true ); 
	echo '<h3>'.get_the_title($obj['parent_post_id']).' unlinked with '. get_the_title($obj['child_post_id']).' successfully</h3>';
	}else{
		echo 'Error:ui_remove_relation_meta is admin method. Login as admin';
	}
}


$cb = $_POST['callback'];

if( 

  ($cb == 'ui_add_relation_meta') ||
  ($cb == 'ui_remove_relation_meta')
  

){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}
?>