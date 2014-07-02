<?php
require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	

if ( current_user_can( 'manage_options' ) ) {

	$object_slug = $_POST['object_slug'];
	//var_dump( $_POST['object_data']);
	
	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='landingpage'){
		wp_delete_post( get_ID_by_slug( $object_slug . '-view') , true );
		

		ui_delete_viev_and_hierarhy_files($object_slug, 'landingpage');

		ui_remove_landingpage_declarations($object_slug);

		ui_remove_template_file( $object_slug , 'landingpage' );

	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='posttype'){

	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='user'){

	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add DATABASE                                                  */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='db'){

		//echo 'delete'.$object_slug . '-view';
		//echo get_ID_by_slug( $object_slug . '-view' );
		
		wp_delete_post( get_ID_by_slug( $object_slug . '-view') , true );
		wp_delete_post( get_ID_by_slug( $object_slug . '-list') , true );
		wp_delete_post( get_ID_by_slug( $object_slug . '-form') , true );

		ui_delete_viev_and_hierarhy_files($object_slug, 'db');

		ui_remove_db_declarations($object_slug);

		ui_remove_template_file( $object_slug , 'db' );
	}

} else {
?>
	<pre class="alert alert-danger" style="font-size:24px; margin:20px; font-family:arial">You dont have access to create this object. <br/>You must login as admin to do it.</pre>
<?php

}

function ui_delete_viev_and_hierarhy_files($object_name, $objecttype){

	$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
	$file = $object_name . '-view-slots-hierarchy.yaml';
	unlink( $plugin_dir . $file );

	$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
	$file = $object_name . '-view-slots-properties.yaml';
	unlink( $plugin_dir . $file );

	if($objecttype != 'landingpage' ){
		$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
		$file = $object_name . '-list-slots-hierarchy.yaml';
		unlink( $plugin_dir . $file );

		$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
		$file = $object_name . '-list-slots-properties.yaml';
		unlink( $plugin_dir . $file );

		$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
		$file = $object_name . '-form-slots-hierarchy.yaml';
		unlink( $plugin_dir . $file );

		$plugin_dir = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments/';
		$file = $object_name . '-form-slots-properties.yaml';
		unlink( $plugin_dir . $file );
	}	
}


function ui_remove_landingpage_declarations($object_name){

 	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$landingpage_prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-landing-pages';

	$landingpage_array = Spyc::YAMLLoad( $landingpage_prop_path . '/arguments/landingpages-arguments.yaml' );

	unset( $landingpage_array[$object_name] );
	file_put_contents( $landingpage_prop_path . '/arguments/landingpages-arguments.yaml' , Spyc::YAMLDump( $landingpage_array ));

}
function ui_remove_db_declarations($object_name){

 	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$db_prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-database';

	$db_array = Spyc::YAMLLoad( $db_prop_path . '/arguments/database-arguments.yaml' );

	unset( $db_array[$object_name] );
	file_put_contents( $db_prop_path . '/arguments/database-arguments.yaml' , Spyc::YAMLDump( $db_array ));

}

function ui_remove_template_file( $object_name, $objecttype ){
	
	$theme_dir = get_template_directory();
	$file = '/UiGEN_Tpl_' . $object_name . '_' . $objecttype . '.php';
	unlink( $theme_dir . $file );

}


function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}
?>