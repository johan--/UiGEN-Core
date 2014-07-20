<?php
	require_once realpath('./../../../../../') . '/wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$data = Spyc::YAMLLoadString($_POST['yaml']);
	$element_settings['data'] = $data[$_POST['slotname']];
	

	$json = json_encode($element_settings);

	//$json = stripslashes($json);

	//$json =  str_replace("\\" , "" , $json);
	
	$json =  str_replace("/" , "" , $json);

	$json =  str_replace("\\\"" , "" , $json);

	$json =  str_replace("\\" , "" , $json);

	$json =  str_replace("'" , "" , $json);

	//$a = str_replace('/','',json_encode($element_settings));
	//$a = str_replace("\\" , "" , $a);
//$a = str_replace('\'','',$a);
//$a = stripslashes($a);

	print( $json  );

	die();

?>