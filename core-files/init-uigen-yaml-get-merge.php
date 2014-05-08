<?php
	// ARGS -> load yaml
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$args = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/'.$ui_page_name.'-slots-properties.yaml');				
	$slots_handler = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/'.$ui_page_name.'-slots-hierarchy.yaml');				
	// parse data url
	if($_GET['data']!=''){
		$getParsedYAML = urldecode($_GET['data'] ); 
		$YAMLParsedArray = Spyc::YAMLLoadString($getParsedYAML);
		$args = array_merge($args, $YAMLParsedArray);
	}