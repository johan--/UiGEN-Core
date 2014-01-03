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
		if ( $_POST['post_type'] == $metabox[3]) {
			update_post_meta($post_id, 'ui_'.$metabox[0], $_POST[$metabox[0].'_output_field']);
		}  
	}    

}
add_action( 'save_post', 'save_saveasfile_box' );

// ###############################################################################
?>