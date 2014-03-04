<?php
	include(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/endpoint-parser.class.php');
	global $EP;
	$EP = new EndpointParser(); 
	/* processing basic arguments */
	$args = $EP -> procesedTPL($args);
	/* processing wpquery arguments */
	$args = $EP -> procesedQuery($args);