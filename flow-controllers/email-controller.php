<?php
// -------------------------------------------------------------------------------------------------- //
// -----     main callbacks functions                                                          ------ //
// -------------------------------------------------------------------------------------------------- //


function send_email($args){

	global $SPD;
	$form_fields = @$args['call_prop']['form_field'];
	$wp_mail_array = @$SPD->data_arg['data'][$form_fields];


	include(TEMPLATEPATH . '/theme-template-parts/mail/'.$args['call_prop']['email_message'].'.php');
	ts_sendEmail($args['call_prop']['email_adress'],$args['call_prop']['email_title'],$mail_content,$args['call_prop']['email_header']);
}
function confirmed_user($args){
	global $FC;
	$user_ID = $FC->display_arg['form-slot']['eid'];
	$user_data = get_userdata( $user_ID );	
	
	$my_hash = sha1('sEWF343t34G#$FdWd22nf'.$user_ID.$user_data -> user_email.'fwe323dx');
	$acces_hash = $FC->display_arg['form-slot']['hash'];
	
	//echo 'email_controller_link_hash:'.$acces_hash.'<br/>';
	//echo 'email_controller_rebild_hash:'. $my_hash.'<br/>';
	if($my_hash == $acces_hash){
		if(get_user_meta($user_ID, 'ui_status', true) == 'not_confirmed'){
			update_user_meta($user_ID, 'ui_status', 'confirmed');
			$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = '<p style="float:left"> Twoje konto zostało poprawnie potwierdzone.<br> Od tej pory możesz korzystać z serwisu Work4Tech jako Pracodawca.</p><button class="btn goto" style="float:right" value="logowanie">Logowanie</button><br/><br/>';
		
		}else{
			$FC->flow_arg['register_fields'][$FC->current_step]['msg'][2] = '<p style="float:left"> Powyższe konto zostało już potwierdzone. Aby się zalogować przejdz do sekcji logowania.</p><button class="btn goto" style="float:right" value="logowanie">Logowanie</button><br/><br/>';
		
		}
	}
	
	
}

// -------------------------------------------------------------------------------------------------- //
// -----     technical support functions                                                       ------ //
// -------------------------------------------------------------------------------------------------- //

function ts_sendEmail($wpEmailadress,$mail_subject,$mail_content,$headers){

	wp_nonce_field('email-options');				
	//$headers = 'From: NATURALINE <'.$wpEmailadress.'>' . "\r\n";
	$headers = $headers . "\r\n";
	$headers.= "MIME-Version: 1.0\n" .
	//$wpEmailadress." <".$wpEmailadress.">\n" .
	//$wpEmailadress." <".$user_email.">\n" .
	"Content-Type: text/html; charset=\"" .
	get_option('blog_charset') . "\"\n";				
	wp_mail($wpEmailadress,$mail_subject,$mail_content, $headers);
}

function ts_checkHash($hash){
	echo 'jestem';
}



