<?php
function uigen_content(){
   	global $post;
   	$content = apply_filters('the_content', $post->post_content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function uigen_excerpt(){
   	global $post;
   	$content = $post->post_excerpt;
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


// ------------------------------------
function uigen_nav_menu(){
	global $TDC;
    $menu = $TDC->args[$TDC->current_slot]['menu'];
    if($TDC->args[$TDC->current_slot]['walker'] != false){
        $walker = $TDC->args[$TDC->current_slot]['walker'];
        include( TEMPLATEPATH . '/theme-template-parts/walkers/'.$walker.'.php' ); 
        $obj = create_function('$name','return new $name;');
        $menu['walker'] = $obj($walker);
        return $menu;
    }    
}

function uigen_addattr($element_schema,$attr_data){

	if( $element_schema['element_attr'] == NULL ) { return false; } else {
		
		foreach ($element_schema['element_attr'] as $key => $value) {
			if($key == $attr_data){
				
				$output = ' class="'.$value['class'].'" ';
				$output .= ' style="'.$value['style'].'" ';

				return $output;
			}
		}
			
	}
}

function merge_tplpart_prop($element_schema){
	
	global $TDC;

	$element_schema = @array_replace_recursive($element_schema,$TDC->args[$TDC->current_slot]);
	return $element_schema;

}

function short_text($text, $max) {
    if (strlen($text)<=$max)
        return $text;
    return substr($text, 0, $max-3).'...';
}



function full_path(){
	    $s = &$_SERVER;
	    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
	    $sp = strtolower($s['SERVER_PROTOCOL']);
	    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	    $port = $s['SERVER_PORT'];
	    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
	    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
	    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
	    $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
	    $segments = explode('?', $uri, 2);
	    $url = $segments[0];
	    return $url;
	}