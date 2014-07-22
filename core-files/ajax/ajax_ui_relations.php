<?php
require_once("../../../../../wp-load.php");



function ui_add_relation_meta($obj){
	
	add_post_meta( $obj['parent_post_id'], 'rel_post_id', $obj['child_post_id'] ,  true ); 

	echo '<p>'.$obj['parent_post_id'].' Relation added to '.$obj['child_post_id'].' </p>';
}



$cb = $_POST['callback'];

if( 

  ($cb == 'ui_add_relation_meta') 
  

){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}
?>