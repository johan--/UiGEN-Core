<?php

function login_user($args){
	global $FC;
	// create wp user array
	$wp_user_array;


	// lock login and delegate to email
	$login_guardian = true;

	foreach ($args['form_data']['data']['user_login'] as $key => $value) {			
		if($key == 'user_login'){
			$login_guardian = false;
			$wp_user_array['user_login'] = $value['value'];
		}
		if($key == 'user_password'){
			$wp_user_array['user_password'] = $value['value'];
		}
		if($key == 'user_email'){
			//var_dump($value);
			$wp_user_array['user_email'] = $value['value'];
		}
	}

	if($login_guardian == true){
			$wp_user_array['user_login'] = $wp_user_array['user_email'];
	}

	// login section
	$wp_user_array['remember'] = true;
	

	//$user_info = get_userdata(get_current_user_id());

	$user = wp_signon( $wp_user_array, false );
	
	$block_redirect = true;
	foreach (@$args['call_prop']['confirmed_statuses'] as $key => $value) {
		
		if($key==@$user->roles[0]){
			if($value == true){
				if(get_user_meta($user->ID, 'ui_status', true) == 'not_confirmed'){
					wp_logout();
					$my_message = 'Nie potwierdziłeś rejestracji za pomocą linka wysłanego na twój adres email';
					$FC->flow_arg['user_login'][$FC->current_step]['msg'][2] = $my_message;
					$block_redirect = false;
				}
			
			}
		}
	}

		
	
	if ( is_wp_error($user) ){
		//echo '<div id="message" class="alert  alert-block error">'.$user_id->get_error_message().'</div>';
		$my_message = $user->get_error_message();
		$FC->flow_arg['user_login'][$FC->current_step]['msg'][2] = $my_message;
	}

	// login true user redirect
		
	if($block_redirect == true){
		@reset($user->caps);
		$first_key = @key($user->caps);
		//var_dump($first_key);
		if($first_key != '')	{
			wp_redirect(@$args['call_prop']['form_data'][$first_key]);
		}
	}
}


function register_user($args){
	global $wpdb;
	$wp_user_array;
	$wp_mail_array;

	// lock login and delegate to email
	$login_guardian = true;

	foreach ($args['form_data']['data']['register_fields'] as $key => $value) {	

		if($key == 'user_pass'){
			$wp_user_array['user_pass'] = $value['value'];
		}
		if($key == 'user_login'){
			$login_guardian = false;
			$wp_user_array['user_login'] = $value['value'];
		}
		//*/
		if($key == 'user_nicename'){
			$wp_user_array['user_nicename'] = $value['value'];
		}
		if($key == 'user_url'){
			$wp_user_array['user_url'] = $value['value'];
		}
		if($key == 'user_email'){
			//var_dump($value);
			$wp_user_array['user_email'] = $value['value'];
		}
		if($key == 'display_name'){
			$wp_user_array['display_name'] = $value['value'];
		}
		if($key == 'nickname'){
			$wp_user_array['nickname'] = $value['value'];
		}
		if($key == 'first_name'){
			$wp_user_array['first_name'] = $value['value'];
		}
		if($key == 'last_name'){
			$wp_user_array['last_name'] = $value['value'];
		}
		if($key == 'description'){
			$wp_user_array['description'] = $value['value'];
		}
		if($key == 'role'){			
			$wp_user_array['role'] = $value['value'];
		}
	}

	if($login_guardian){
			$wp_user_array['user_login'] = @$wp_user_array['user_email'];
	}

	// get eid


	if($args['call_prop']['new_id'] != 'true'){

		// TODO check is edit id is your id !!!
		$user_id = $args['form_data']['data']['register_fields'][$args['call_prop']['new_id']]['value'];
		$wp_user_array['ID'] = $user_id;
		$updateArray = array('user_login', $wp_user_array['user_login']);
		//var_dump($user_id);
		//if (in_array('user_login', $wp_user_array)) {
			
			$wpdb->update($wpdb->users, array('user_login' => $wp_user_array['user_login']), array('ID' => $user_id));
			if(get_user_meta($user_id, 'ui_status', true) == 'not_confirmed'){
				$wpdb->update($wpdb->users, array('user_registered' => date('Y-m-d H:i:s')), array('ID' => $user_id));
			}
			/*$wpdb->update($wpdb->prefix.'users',
			    array('user_login', $wp_user_array['user_login']), array('ID', $user_id),
			    array('%s'), array('%d'));*/
		//}
		var_dump('user array ->',$wp_user_array);
		wp_update_user( $wp_user_array );
	
	}else{

		$user_id = wp_insert_user( $wp_user_array );

	}
	// error communication swith to msg-slot
	$createdUserGuardian = false;	
	global $FC;
	if ( is_wp_error($user_id) ){
		//echo '<div id="message" class="alert  alert-block error">'.$user_id->get_error_message().'</div>';
		$my_message = $user_id->get_error_message();
		$my_message .= '<button class="btn back2btn" style="float:right" >Popraw dane</button><br/><br/>';
		$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = $my_message;

		$createdUserGuardian = true;
	}



	// set role
	@wp_update_user( array ('ID' => $user_id, 'role' => $wp_user_array['role'] ) ) ;
	//wp_update_user( array ('ID' => $user_id, 'role' => 'administrator' ) ) ;

	// ------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------




  		// if you not created user - dont create usermeta.
		if($createdUserGuardian == false){
		foreach ($args['form_data']['data']['register_fields'] as $key => $value) {	
				// update meta user data by form			
				foreach ($args['call_prop']['form_data'] as $prop_value) {	

						if($key == $prop_value){
							//echo $key.', '.$value['value'].'<br>';
							update_user_meta($user_id, $key, $value['value']);
						} 
				}
				// build email data
				if($args['call_prop']['send_email'] == true){
					foreach (@$args['call_prop']['email_data'] as $key2 => $prop_value) {	

							if($key == $key2){
								$wp_mail_array[$key2] = $value['value'];
								//echo $key." ".$key2.'<br>';
							}else{
								if($key2 == 'email_title'){
									$wp_mail_array[$key2] = $prop_value;
								}								
								if($key2 == 'email_header'){
									$wp_mail_array[$key2] = $prop_value;
								}
								if($key2 == 'email_message'){
									$wp_mail_array[$key2] = $prop_value;
								}	
							} 
					}
				// end email true
				}
		}
		}

		// if user is not created dont send email
		if($createdUserGuardian == false){
		// send email
		if($args['call_prop']['send_email'] == true){
			// add content email template


			include(TEMPLATEPATH . '/theme-template-parts/mail/'.$wp_mail_array['email_message'].'.php');
			//var_dump($wp_mail_array);
			ts_sendEmail($wp_mail_array['user_email'],$wp_mail_array['email_title'],$mail_content,$wp_mail_array['email_header']);
		}
		}



	// ------------------------------------------------------------------------------------
	

}
function change_password($args){
	global $FC;
	$wp_user_array;
	foreach ($args['form_data']['data']['register_fields'] as $key => $value) {	

		if($key == 'user_pass'){
			$wp_user_array['user_pass'] = $value['value'];
		}
		if($key == 'user_email'){			
			$wp_user_array['user_login'] = $value['value'];
		}		
	}
	$user_info = get_userdata(get_current_user_id());
	


	if($user_info == ""){
		$my_message = 'Aby zmienić hasło powinieneś sie najpierw zalogować';
		$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = $my_message;
	}


	if($wp_user_array['user_login'] == $user_info->user_login){
		$my_message = 'Twoje nowe hasło zostało zmienione na: '.$wp_user_array['user_pass'];
		$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = $my_message;
		@wp_update_user( array ('ID' => $user_info->ID, 'user_pass' => $wp_user_array['user_pass'] ) ) ;

	}else{

		$my_message = 'Podałeś adres email nie należący do Twojego konta';
		$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = $my_message;
	}
	
}



?>