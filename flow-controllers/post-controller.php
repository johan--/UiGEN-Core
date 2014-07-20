<?php
// -------------------------------------------------------------------------------------------------- //
// -----     main callbacks functions                                                          ------ //
// -------------------------------------------------------------------------------------------------- //


/**
 * CONTROLLER Main function - callback flow function.
 * This function created post after finished flow_step
 * 
 * <b>Arguments example</b><br/><br/>
 * <code>
 * bla bla bla
 * </code>
 * @example /path/to/example.php How to use this function
 *
 * @param array $args Get arguments form flow file
 * @filesource /UiGEN-Core/flow-controllers/post-controller.php
 */
function add_posttype($args){
	
	$my_post;


	// get posttype registration name from displayArgs -> ui_page_name
	$posttype_regname = substr( $args['display_data']['ui_page_name'], 0, strrpos( $args['display_data']['ui_page_name'], "-"));
	$my_post['post_type'] = $posttype_regname;
	

	// get first key name	
	$elements_key = array_keys ($args['form_data']['data']);

    foreach ($args['form_data']['data'][$elements_key[0]] as $key => $value) {	
	//foreach ($args['form_data']['data'][$posttype_regname] as $key => $value) {	

			if($key == 'post_ID'){
				$my_post['ID'] = $value['value'];
			}
			if($key == 'post_type'){
				$my_post['post_type'] = $value['value'];
			}
			if($key == 'post_status'){
				$my_post['post_status'] = $value['value'];
			}
			if($key == 'post_author'){
				//$my_post['post_author'] = $value['value'];
				$my_post['post_author'] = get_user_ID();
			}
			if($key == 'post_title'){
				$my_post['post_title'] = $value['value'];
			}
			if($key == 'post_content'){
				$my_post['post_content'] = $value['value'];
			}
			if($key == 'post_excerpt'){
				$my_post['post_excerpt'] = $value['value'];
			}

	}

	// Insert the post into the database

	if( $args['form_data']['data']['flow_steps']['input_edited_ocject_id']['value'] != NULL ){
	//if (array_key_exists('ID', $my_post)) {
			$my_post['ID'] = $args['form_data']['data']['flow_steps']['input_edited_ocject_id']['value'];
			wp_update_post( $my_post );
			//var_dump($my_post['ID']);
			$my_post_ID = ($my_post['ID']);


	}else{
		
			$my_post_ID = wp_insert_post( $my_post );
	}

	

	if ( is_wp_error(@$my_post_ID) )
	echo '<div id="message" class="alert  alert-block error">'.$my_post_ID->get_error_message().'</div>';

 	foreach ($args['form_data']['data'][$elements_key[0]] as $key => $value) {	
	//foreach ($args['form_data']['data'][$posttype_regname] as $key => $value) {	
			
			// add meta firlds
			foreach ($args['call_prop']['meta'] as $prop_value) {	

					if($key == $prop_value){

						update_post_meta(@$my_post_ID, $key, $value['value']);						
					} 
			}
			// add taxonomy
			if( $args['call_prop']['taxonomy'] != NULL ){
				foreach ($args['call_prop']['taxonomy'] as $prop_value) {	

						if($key == $prop_value){

							$cat_ids = intval($value['value']);
							wp_set_object_terms( @$my_post_ID, $cat_ids, $value['args']['taxonomy'] );					
						} 
				}
			}
			// add thumbnail
			foreach ($args['call_prop']['thumbnail'] as $prop_value) {	

					if($key == $prop_value){

						//$cat_ids = intval($value['value']);
						//echo $value['value'];
						add_post_attachment(@$my_post_ID,@$value['value']);
						//wp_set_object_terms( $my_post_ID, $cat_ids, $value['args']['taxonomy'] );					
					} 
			}


	}
}

// -------------------------------------------------------------------------------------------------- //
// -----     technical support functions                                                       ------ //
// -------------------------------------------------------------------------------------------------- //

/**
 * CONTROLLER Tech function.
 * This function get current user id.
 *
 * @filesource /UiGEN-Core/flow-controllers/post-controller.php
 */
function get_user_ID(){
	$current_user = wp_get_current_user();
	//get_id;
	return $current_user->ID;
}

/**
 * CONTROLLER Tech function.
 * This function linked loaded attachment file with created post.
 *
 * @param integer $id Created post id 
 * @param string $attachFile file to attached
 * @filesource /UiGEN-Core/flow-controllers/post-controller.php
 */
function add_post_attachment($id,$attachFile){			
	
	if($attachFile != ''){	
		$wp_upload_dir = wp_upload_dir();
		
		// --------------------------------------------------------------
		//$filename = $attachFile; // <- $attachmentFile is only filename
		$filename = explode('/',$attachFile); // <- all file path
		$filename = end($filename); 
		// --------------------------------------------------------------

		$path =  $wp_upload_dir['baseurl'].'/uigen_'.date('Y') .'/';
		$file =  $path.$filename; 
		
		//echo 'filename:'.$filename.'</br>';
		//echo 'path:'.$path.'</br>';
		//echo 'file:'.$file.'</br>';
		
		$wp_filetype = wp_check_filetype(basename($filename), null );
		
		$attachment = array(
		'guid' => $file, 
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		'post_content' => '',
		'post_status' => 'inherit'
		);
		
		
		$attach_id = wp_insert_attachment( $attachment, $file, $id );
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		//require_once(ABSPATH . 'wp-admin/includes/file.php');
		//require_once(ABSPATH . 'wp-admin/includes/media.php');
		
		$attach_data = wp_generate_attachment_metadata( $attach_id, ABSPATH.'wp-content/uploads/uigen_'.date('Y') .'/'.$filename ); // $upload_dir.$obrazlogo );
		wp_update_attachment_metadata( $attach_id, $attach_data);
		
		update_attached_file( $attach_id, $file);
		update_post_meta($id,'_thumbnail_id',$attach_id);
		/*
		if($thumb=='true'){
			update_post_meta($id,'_thumbnail_id',$attach_id);
		}
		* */
	}
}
?>