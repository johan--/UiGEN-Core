<?php
function uigen_content(){
   	global $post;
   	$content = apply_filters('the_content', $post->post_content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function uigen_menu_swith($args){
	if ( is_user_logged_in() ) {
	    //var_dump('register',$args);
	    return $args['register'];
	} else {
		//var_dump('unregister',$args);
	    return $args['unregister'];
	}
}
?>