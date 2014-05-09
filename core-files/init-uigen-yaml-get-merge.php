<?php
	// ARGS -> load yaml
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$args = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/'.$ui_page_name.'-slots-properties.yaml');				
	$slots_handler = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/'.$ui_page_name.'-slots-hierarchy.yaml');				
	// parse data url
	if($_GET['data']!=''){

		$getParsedYAML = urldecode($_GET['data'] ); 
		$YAMLParsedArray = Spyc::YAMLLoadString($getParsedYAML);
		$args = ui_merge_data_array($args,$YAMLParsedArray);
		
	}

	function ui_merge_data_array($orgin_array,$part_to_merge){
		$args = array_merge($orgin_array, $part_to_merge);
		return $args;
	}