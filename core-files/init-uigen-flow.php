<?php
	
	// $args - check core-files/init-uigen-tds.php file
	foreach ($args as $key => $value) {
		if($value['name'] == 'buildForm'){
			if($value['flow']==NULL){
				echo '<pre class=""><b>WARNING</b><br>In your global-data/template-hierarchy propertis file with form element you dont defined valid form slot name</pre>';
			}else{
				require_once  TEMPLATEPATH.'/theme-template-parts/flow/'.$value['flow'].'.php'; 
			}
			
		}
	}

	// deperciated solutions based on ui_flow postmeta
	/*
	if(get_post_meta( $post->ID, 'ui_flow', 'true' ) != ''){
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/'.get_post_meta( $post->ID, 'ui_flow', 'true' ).'.php'; 
	}else{
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/basic-test-flow.php'; 
	}*/