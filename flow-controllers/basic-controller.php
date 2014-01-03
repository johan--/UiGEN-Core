<?php
function flow_role_redirect($args){
	
	if ( is_user_logged_in() ) {
	   	// check logged user role
		global $current_user;
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		// check action added to role
		foreach ($args['call_prop'] as $key => $value) {
			if($key == $user_role){
				wp_redirect($value); exit;
			}
		}
	} else {

		if($args['call_prop']['norole'] != ''){
			wp_redirect( $args['call_prop']['norole'] ); exit;
	    	//echo 'Welcome, visitor!';
		}
	}
}
?>