<?php

function set_site_message($args) {
	global $FC;

	$msg = $FC->data_arg['data']['display_message']['msg_text']['value'];

	// print('<pre>');var_dump($msg);print('</pre>');
	if (strlen($msg) > 0) {
		// print('dodaje');
		update_option('site_message', $msg);
	} else {
		// print('kasuje');
		delete_option('site_message');
	}
}

?>