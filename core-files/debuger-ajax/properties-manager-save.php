<?php


function save_data($obj){

	global $wpdb;
	require_once("../../../../../wp-load.php");
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	require_once( ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/defines-const.php' );


	if ( !current_user_can( 'manage_options' ) ) {
		echo 'ADMIN BABY !!!';
		die();
	}

/*	echo '<h2>Save</h2>';
	echo '<pre>';
	var_dump($obj['data']);
	echo '</pre>';*/


	$prop_path = GLOBALDATA_PATH . 'template-hierarchy';
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/'.$obj['ui_page_name'].'-slots-properties.yaml' );

	//var_dump($posttypes_array[$_POST['slotname']]);
	//echo '<br>---<br>';
    //var_dump($_POST['data']);

    $execute_array = array_merge($posttypes_array[$obj['slotname']],$obj['data']);
	
	//echo '<br>---<br>';
    //var_dump($execute_array);
    $posttypes_array[$obj['slotname']] = $execute_array;

	//var_dump($posttypes_array);
	file_put_contents( $prop_path . '/arguments/'.$obj['ui_page_name'].'-slots-properties.yaml' , Spyc::YAMLDump( $posttypes_array ));

}



$cb = $_POST['callback'];

if( 

  ($cb == 'save_data')

){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}

?>