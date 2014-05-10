<?php
	global $TDC;
	$global_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
	$class_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/class/';
	include( $class_path . 'display-controller.class.php' );	
	@$TDC = new ThemeDisplayController( $post->ID ); 

	require_once $class_path . 'Spyc.php';

	$slots_handler = Spyc::YAMLLoad( $global_path . $ui_page_name . '-slots-hierarchy.yaml' );				
	$args = Spyc::YAMLLoad( $global_path . $ui_page_name . '-slots-properties.yaml');	

