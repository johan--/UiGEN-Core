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
		echo '<span>Error:ui_remove_relation_meta is admin method. Login as admin</span>';
	}
}





function ui_init_db_relation($obj){
	
	require_once("../../../../../wp-load.php");

	//echo '<pre>';
	//echo var_dump($obj);
	//echo '</pre>';

    $args = array(
    'post_type' => $obj['post_type'],
		/* 'meta_query' => array(
         array(
            'key' => $obj['key'],
            'value' => $obj['value'],
            'compare' => 'IN',
         )
      ) */ 
    );
    $query = new WP_Query( $args );
    
    echo '<h2>Linked '.get_the_title($obj['post_id']).' with:</h2>';

    echo '<table class="table" data-db-first-column-name="'.$obj['db_first_column_name'].'" data-db-second-column-name="'.$obj['db_second_column_name'].'" data-db-table-name="'.$obj['db_table_name'].'" data-child-id="'.$obj['post_id'].'">';  
    echo '<tr>';  
    echo '<th>Title</th>'; 
    echo '<th>Action</th>';   
    echo '</tr>';  
    while ( $query->have_posts() ) {
        $query->the_post(); 

        echo '<td>'.$query->post->post_title.'</td>';
        echo '<td><a href="#" class="db-relation" data-parent-relation="'.$query->post->ID.'">Link with this object<a></td>';
        echo '</tr>';
      }
    echo '</table>';       
    wp_reset_postdata();    
}

function ui_insert_db_relation($obj){

	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/global-controllers/wpdb-controller.php';
	
	$args = array(
		'table_name' => 'my_table',
		'insert_data' => array(
			//'Children_id' => 10,
			//'Parent_id' => 20,
			),
		'unique' => array(/*'Children_id','Parent_id'*/),			
		'unique_compare' => 'AND' 
	);

	//echo '<pre>';
	//echo var_dump($obj);
	//echo '</pre>';

	ui_insert_data($obj);
	

}

function ui_list_db_relation($obj){

}

$cb = $_POST['callback'];

if( 

  ($cb == 'ui_add_relation_meta') ||
  ($cb == 'ui_remove_relation_meta') ||
  ($cb == 'ui_init_db_relation') ||
  ($cb == 'ui_insert_db_relation') ||
  ($cb == 'ui_list_db_relation')


  
  

){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}
?>