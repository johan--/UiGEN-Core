<?php
/**
 * insert data with unique guardian
 * 
 * @filesource /UiGEN-Core/global-controllers/wpdb-controller.php
 */
function ui_insert_data($args){
	
	$args_schema = array(
		'table_name' => 'new-table',
		'insert_data' => array(
			'first-column' => 10,
			'second-column' => 20,
			),
		'unique_compare' => 'compare',
		'unique' => array('first-column','second-column')
		);

	if(ui_unique_guardian($args) == true){
		global $wpdb;
		$tableName = $wpdb->prefix . $args['table_name'];
		$insert_data = $args['insert_data'];
		$wpdb->insert( $tableName, $insert_data );
		echo '<span>Relation created succesfull</span>';
	}else{
		echo '<span>This relation alredy exist</span>';
	}
}

/**
 * check is unique conndition exist
 * 
 * @filesource /UiGEN-Core/global-controllers/wpdb-controller.php
 */
function ui_unique_guardian($args){ 

	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	$guardianSql = "
			SELECT COUNT(*) FROM `".$tableName."` 
			WHERE ";
			$counter = 0;
			foreach ($args['unique'] as $value) { 
				
				if($counter != 0){
					$guardianSql .=" ".$args['unique_compare']." ";
				}
				
				$guardianSql .= $value." = '". intval($args['insert_data'][$value])."' ";
				$counter ++;
			}

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
