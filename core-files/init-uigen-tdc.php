<?php

	if (!defined('UIGENCLASS_PATH')) {
    	echo '<div class="alert alert-danger" style="margin:20px;">UiGEN Core plugin is not inslall or acitve. Check it in your admin panell</div>';
    	die();
	}

	global $TDC;
	
	include( UIGENCLASS_PATH . 'display-controller.class.php' );	
	@$TDC = new ThemeDisplayController( $post->ID ); 

	require_once UIGENCLASS_PATH . 'Spyc.php';

	$slots_handler = Spyc::YAMLLoad( GLOBALDATA_PATH .'template-hierarchy/arguments/'. $ui_page_name . '-slots-hierarchy.yaml' );				
	$args = Spyc::YAMLLoad( GLOBALDATA_PATH .'template-hierarchy/arguments/'. $ui_page_name . '-slots-properties.yaml');	
	$args['ui_page_name'] = $ui_page_name;