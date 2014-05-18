<?php
	global $TDC;
	
	include( UIGENCLASS_PATH . 'display-controller.class.php' );	
	@$TDC = new ThemeDisplayController( $post->ID ); 

	require_once UIGENCLASS_PATH . 'Spyc.php';

	$slots_handler = Spyc::YAMLLoad( GLOBALDATA_PATH .'template-hierarchy/arguments/'. $ui_page_name . '-slots-hierarchy.yaml' );				
	$args = Spyc::YAMLLoad( GLOBALDATA_PATH .'template-hierarchy/arguments/'. $ui_page_name . '-slots-properties.yaml');	
	$args['ui_page_name'] = $ui_page_name;