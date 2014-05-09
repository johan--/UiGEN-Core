<?php
	global $TDC;
	include(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/display-controller.class.php');	
	@$TDC = new ThemeDisplayController( $post->ID ); 
	include(get_template_directory().'/uigen_tpl_hierarchy.php' );