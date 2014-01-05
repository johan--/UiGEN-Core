<?php
// ###############################################################################

function saveasfile_box($post, $metabox){
	echo 'savefileBox';

}
// ================================================================================

// save post function
function save_saveasfile_box( $post_id ) {

	include ABSPATH . 'wp-content/plugins/uigen-core/global-data/uigen-metaboxes/arguments/uigen-metaboxes-arguments.php';
	
	foreach ($uigen_metaboxes as $metabox) {
		// check boxes into current posttype
		if ( $_POST['post_type'] == $metabox[3]) {
			if($metabox[2] == 'alpacaform_box'){

				/*	
				echo '<pre>';
					var_dump($metabox);
				echo '</pre>';
				*/
				
				// Open the file to get existing content
				//$current_content = file_get_contents($file);

				// get file output content
				$current_content = urldecode($_POST[$metabox[0].'_output_field']);

				// create file path to save
				$file = $metabox[6]['file_save_url'].get_the_title($post_id).'.'.$metabox[6]['save_data_type'];

				// Write the contents back to the file
				if (!is_dir($metabox[6]['file_save_url'])) {
				  // dir doesn't exist, make it
				  mkdir($metabox[6]['file_save_url']);
				}

				// create file
				file_put_contents($file, $current_content);
			}

			
		}  
	} 
	//die();   

}
add_action( 'save_post', 'save_saveasfile_box' );

// ###############################################################################
?>