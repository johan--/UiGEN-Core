<?php
	// ARGS -> load yaml
				
	// parse data url
	if($_GET['data']!=''){

		$getParsedYAML = urldecode($_GET['data'] ); 
		$YAMLParsedArray = Spyc::YAMLLoadString($getParsedYAML);
		$args = ui_merge_data_array($args,$YAMLParsedArray);

		echo '<pre>';
		var_dump($getParsedYAML);
		echo '</pre>';
		
	}

	function ui_merge_data_array($orgin_array,$part_to_merge){
		$args = array_merge(  $orgin_array , $part_to_merge );
		return $args;
	}