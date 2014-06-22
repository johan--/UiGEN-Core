<?php
//print('echo');
// -------------------------------------------------------------------------------------------------- //
// controler basic data
$current_user = wp_get_current_user();
$date = new DateTime();


// -------------------------------------------------------------------------------------------------- //
// -----     main callbacks functions                                                          ------ //
// -------------------------------------------------------------------------------------------------- //

function add_data($args){



	$posttype_regname = $args['call_prop']['posttype']; 

	$table_name = substr( $args['display_data']['ui_page_name'], 0, strrpos( $args['display_data']['ui_page_name'], "-"));
	


	//$table_name = $args['call_prop']['table_name']; 	
	
	$guardianArray;
	$insertArray;


	//foreach ($args['form_data']['data'][$posttype_regname] as $key => $value) {	
	foreach ($args['form_data']['data'][$table_name] as $key => $value) {	
			
		//var_dump('>>>>>',$value);
		// add meta fields
		foreach ($args['call_prop']['meta'] as $prop_value) {	

			if($key == $prop_value['db']){
				$insertArray[$key] = $value['value'];
				//echo $key."::".$value['value']."<br/>";	
				//$ajax_message = 'dane zostały dodane';								
			}

		}

	}

	

	// Guardian Sql section
	foreach ($args['call_prop']['meta'] as $key => $prop_value) {	
					
		if(@$prop_value['unique'] == true){
			//echo $insertArray[$prop_value['db']]."::".$prop_value['db']."<br/>";		
			$guardianArray[$prop_value['db']] = $insertArray[$prop_value['db']];
												
		} 			
	}						

	// ------------------------------------
	global $wpdb;
	$tableName = $wpdb->prefix . $table_name;
	
	// ------------------------------------
	$insertGuardian = ncb_guardianSqlFunction($tableName, $guardianArray);
	

var_dump($insertArray);

	// ------------------------------------
	//echo $guardianSql;
	//echo $insertGuardian;
	//echo $ajax_message;

	if($insertGuardian == 1){
		$wpdb->insert( $tableName, $insertArray );
	}
	// ------------------------------------
          
	// GROWINGAME SHIT ???? - I hide it [GD]
    //print('Add users points');
/*    if(!$wpdb->insert($wpdb->prefix.'points_users', array(
            'user_id' => $user_id,
            'import_id' => $import_id,
            'points' => '0',
        ))) {
        $error = true;
    }     */ 
    // ^^^^^^^^^^^^^^^^^^^^

}

function get_data($args) {

}

function guardianSql_redirect($args){
	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	//var_dump($args['db_data']);
	$insertGuardian = ncb_guardianSqlFunction($tableName, $args['db_data']);
	if($insertGuardian == 0){
		//echo 'hipotetycznie juz jestem dodany';
		global $FC;
		$FC -> current_step = 'flow_DB_noacces';
	}else{
		//echo 'mozesz mnie dodac';
	}
	
	
	//var_dump($FC -> flow_arg[$FC -> post_type][$FC -> current_step]);	

}


// -------------------------------------------------------------------------------------------------- //
// -----     no calback functions                                                              ------ //
// -------------------------------------------------------------------------------------------------- //
function ncb_add_data($args){
	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	

	$uniQueGuard = ncb_guardianSql($args);
	if($uniQueGuard == true){

		foreach ($args['meta'] as $key => $value) {	
			//var_dump($value);
			unset($value["unique"]);
			$insertArray[$key] = $value;
		}
		//var_dump($insertArray);
		foreach ($insertArray as $value) {	
			//var_dump($value);
			$key_name = key($value);
			$finalInsertArray[$key_name] = $value[$key_name];
			//echo $key_name."->".$value[$key_name].'<br/>--------------</br/>';
		}
		$wpdb->insert( $tableName, $finalInsertArray);
		
		echo  $args['msg_true'];
		//echo 'Dodano usera :)';

	}else{
		echo  $args['msg_false'];
		//echo 'Ten użytkownik jest już dodany do tej oferty<br/>';
	}
	
}
// -------------------------------------------------------------------------------------------------- //

function ncb_talking_add_data($args){
	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	

	$uniQueGuard = ncb_guardianSql($args);
	if($uniQueGuard == true){

		foreach ($args['meta'] as $key => $value) {	
			//var_dump($value);
			unset($value["unique"]);
			$insertArray[$key] = $value;
		}
		//var_dump($insertArray);
		foreach ($insertArray as $value) {	
			//var_dump($value);
			$key_name = key($value);
			$finalInsertArray[$key_name] = $value[$key_name];
			//echo $key_name."->".$value[$key_name].'<br/>--------------</br/>';
		}
		$wpdb->insert( $tableName, $finalInsertArray);
		
		return true;
		//echo 'Dodano usera :)';

	}else{
		return false;
		//echo 'Ten użytkownik jest już dodany do tej oferty<br/>';
	}
	
}
// -------------------------------------------------------------------------------------------------- //

function ncb_guardianSql($args){ 
	// insert data with formqat:
	/*	$args = array(
		 	'posttype' => 'bm_work_offer', // < posttype reg name //
		 	'table_name' => 'entry_relations',
		 	'meta' => array(
		 		array('user_id' => $data['userId'], 'unique' => true), // cheqs all uniq with && operator and sent data into database
		 		array('offer_id' => $data['postId'], 'unique' => true),
		 		array('relation_status' => '-'),
		 		array('timestamp' => '-'),
		 		//array('db' => 'message'),
		 	),						
        );*/

	global $wpdb;
	$tableName = $wpdb->prefix . $args['table_name'];
	
	foreach ($args['meta'] as $key => $value) {	

		if(@$value["unique"] == true){
			unset($value["unique"]);
			$guardianArray[$key] = $value;
		}

	}
	foreach ($guardianArray as $value) {	
			//var_dump($value);
			$key_name = key($value);
			$finalGuardiabArray[$key_name] = $value[$key_name];
			//echo $key_name."->".$value[$key_name].'<br/>--------------</br/>';
	}
	return ncb_guardianSqlFunction($tableName,$finalGuardiabArray);
}

function ncb_guardianSqlFunction($tableName, $guardianArray){ 
	


	global $wpdb;
	$guardianSql = "
			SELECT COUNT(*) FROM ".$tableName." 
			WHERE ";
			$counter = 0;
			foreach ($guardianArray as $key => $value){ 
				
				if($counter != 0){
					$guardianSql .=" AND ";
				}
				
				$guardianSql .= $key." = '". $value."' ";
				$counter ++;
			}
	$insertGuardian = $wpdb->get_var( $guardianSql );





	if($insertGuardian == 0){
		return true;
	}else{
		return false;
	}
}
// -------------------------------------------------------------------------------------------------- //

function ncb_get_user_id_from_meta($meta_value, $meta_key = false) {
	global $wpdb;
	//print('begin');
	$mk = '';
	if ($meta_key) {
		$mk = ' AND `meta_key` = '.$meta_key;
	}
	$query = "SELECT `user_id` FROM ".$wpdb->usermeta." WHERE `meta_value` ='".$meta_value."'".$mk .";";
	//print($query."\n");
	$res = $wpdb->get_results($query);
	foreach ($res as $key) {
		$uid = $key->user_id;
	}
	//print('running');
	return $uid;
}

// -------------------------------------------------------------------------------------------------- //

function ncb_get_meta_values($meta_key) {
	global $wpdb;

	$retval = array();
	$query = "SELECT DISTINCT `meta_value` FROM ".$wpdb->prefix."usermeta WHERE `meta_key` ='".$meta_key."';";
	$results = $wpdb->get_results($query);

	foreach ($results as $key) {
		//var_dump($key->meta_value);
		//echo '<br>-----</br>';
		$retval[$key->meta_value] = $key->meta_value;
	}

	return $retval;
}