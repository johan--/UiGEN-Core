<?php
	
	// $args - check core-files/init-uigen-tds.php file
	foreach ($args as $key => $value) {
		if($value['name'] == 'buildForm'){
			require_once  TEMPLATEPATH.'/theme-template-parts/flow/'.$value['flow'].'.php'; 
		}
	}

	// deperciated solutions based on ui_flow postmeta
	/*
	if(get_post_meta( $post->ID, 'ui_flow', 'true' ) != ''){
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/'.get_post_meta( $post->ID, 'ui_flow', 'true' ).'.php'; 
	}else{
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/basic-test-flow.php'; 
	}*/