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
	$element_schema = array_merge($element_schema,$TDC->args[$TDC->current_slot]);
	return $element_schema;

}

function uigen_remove_post($post_id){

	$args = array(
      'ID'           => $post_id,
      'post_ststus' => 'trash'
  	);
	wp_update_post( $args );

}