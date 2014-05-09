<?php
	global $TDC;
	include(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/display-controller.class.php');	
	@$TDC = new ThemeDisplayController( $post->ID ); 

	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';

	$slots_handler = Spyc::YAMLLoad(ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/'.$ui_page_name.'-slots-hierarchy.yaml');				
	$args = Spyc::YAMLLoad(ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/'.$ui_page_name.'-slots-properties.yaml');	
	//include(get_template_directory().'/uigen_tpl_hierarchy.php' );