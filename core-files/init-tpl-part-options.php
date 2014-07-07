<?php
	require_once realpath('./../../../../../') . '/wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$data = Spyc::YAMLLoadString($_POST['yaml']);
	$element_settings['data'] = $data[$_POST['slotname']];
	echo stripslashes(json_encode($element_settings));
	die();
?>