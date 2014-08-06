<?php

$wpdb_controller_schema = array(
	'table_name' => 'new-table',
	'insert_data' => array(
		'first-column' => 10,
		'second-column' => 20,
		),
	'unique_compare' => true,
	'db_method' => 'COUNT(*)',
	'logic_operator' => 'AND',
	'where' => array(
		'first-column' => 'NULL', 
		'second-column' => 'NULL',
	),
	'show_columns' => array('first-column')
);

/**
 * insert data with unique guardian
 * 
 * @filesource /UiGEN-Core/global-controllers/wpdb-controller.php
 */
function ui_insert_data($args){
	
	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	$insert_data = $args['insert_data'];

	if($args['unique_compare'] == true ){

		if(ui_unique_guardian($args) == true){			
			$wpdb->insert( $tableName, $insert_data );
			echo '<span>Relation created succesfull</span>';
		}else{
			echo '<span>This relation alredy exist</span>';
		}

	}else{
		$wpdb->insert( $tableName, $insert_data );
		echo '<span>Relation created succesfull</span>';
	}

	
}


function ui_select_data_list($args){
	//echo ui_create_SELECT_SQL($args);

	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];


	$query = $wpdb->prepare( ui_create_SELECT_SQL ( $args ), $tableName);
	$results = $wpdb->get_results($query);
	return $results;
	
}


/**
 * check is unique conndition exist
 * 
 * @filesource /UiGEN-Core/global-controllers/wpdb-controller.php
 */
function ui_unique_guardian($args){ 

	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];

	$args['show_columns'] = 'COUNT(*)';
	
	// set stelect columns vaues from insert
	foreach($args['where'] as $key => $value){
		$data = $args['insert_data'][$key];
		$args['where'][$key] = $data;
		
	}
	$guardianSql = ui_create_SELECT_SQL($args);

	//echo '<pre>';
	//echo $guardianSql;
	//echo '</pre>';

	$insertGuardian = $wpdb->get_var( $guardianSql );

	if($insertGuardian == 0){
		return true;
	}else{
		return false;
	}

}


function ui_create_SELECT_SQL($args){
	
	//echo '<pre>';
	//var_dump($args);
	//echo '</pre>';

	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	//var_dump($args['show_columns']);
	if( is_array( $args['show_columns'] ) ){
		$counter = 0;
		$columns = ' ';
		foreach ($args['show_columns'] as $key => $value) {

			$columns .= $args['show_columns'][$counter].' ';
			$counter++;
		}
	}else{
		$columns = ' '.$args['show_columns'].' ';
	}

	$select_Sql = "
			SELECT ".$columns." FROM `".$tableName."` 
			WHERE ";
			$counter = 0;
			foreach ($args['where'] as $key => $value) { 					
				if($counter != 0){
					$select_Sql .=" ".$args['logic_operator']." ";
				}				
				$select_Sql .= $key." = '". intval($value)."' ";
				$counter ++;
			}
	echo '<pre>';
	print($select_Sql);
	echo '</pre>';

	return $select_Sql;
}
