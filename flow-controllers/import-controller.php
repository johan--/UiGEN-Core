<?php
// -------------------------------------------------------------------------------------------------- //
// -----     main callbacks functions                                                          ------ //
// -------------------------------------------------------------------------------------------------- //

function add_posttype($args){

	$my_post;
	$posttype_regname = $args['call_prop']['posttype']; 	

	foreach ($args['form_data']['data'][$posttype_regname] as $key => $value) {	

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
	
	if($my_post['ID'] != ''){

		$my_post_ID = wp_insert_post( $my_post );
	}else{

		wp_update_post( $my_post );
	}	

	if ( is_wp_error($my_post_ID) )
	echo '<div id="message" class="alert  alert-block error">'.$my_post_ID->get_error_message().'</div>';


	foreach ($args['form_data']['data'][$posttype_regname] as $key => $value) {	
			
			// add meta firlds
			foreach ($args['call_prop']['meta'] as $prop_value) {	

					if($key == $prop_value){

						update_post_meta($my_post_ID, $key, $value['value']);						
					} 
			}
			// add taxonomy
			foreach ($args['call_prop']['taxonomy'] as $prop_value) {	

					if($key == $prop_value){

						$cat_ids = intval($value['value']);
						wp_set_object_terms( $my_post_ID, $cat_ids, $value['args']['taxonomy'] );					
					} 
			}
			// add taxonomy
			foreach ($args['call_prop']['thumbnail'] as $prop_value) {	

					if($key == $prop_value){

						//$cat_ids = intval($value['value']);
						//echo $value['value'];
						add_attachment($my_post_ID,@$value['value']);
						//wp_set_object_terms( $my_post_ID, $cat_ids, $value['args']['taxonomy'] );					
					} 
			}


	}
}

// -------------------------------------------------------------------------------------------------- //
// -----     technical support functions                                                       ------ //
// -------------------------------------------------------------------------------------------------- //

function get_user_ID(){
	$current_user = wp_get_current_user();
	//get_id;
	return $current_user->ID;
}

function add_attachment($id,$attachFile){			
	
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