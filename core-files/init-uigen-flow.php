<?php
	if(get_post_meta( $post->ID, 'ui_flow', 'true' ) != ''){
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/'.get_post_meta( $post->ID, 'ui_flow', 'true' ).'.php'; 
	}else{
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/basic-test-flow.php'; 
	}