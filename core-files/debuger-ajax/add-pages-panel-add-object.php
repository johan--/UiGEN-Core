<?php
require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	

if ( current_user_can( 'manage_options' ) ) {

	$object_name = $_POST['object_data']['object_name'];
	//var_dump( $_POST['object_data']);
	$object_name = sanitize_title($object_name);

	if($object_name == ''){
		?>
			<div>
			<pre class="alert alert-danger">Input added object Name !!!</pre>
			</div>
		<?php
		die();
	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='page'){
		?>
		<div>
			<pre class="alert alert-warning">
				<?php _e('This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core','basic'); ?>
			</pre>
		</div>
		<?php
	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='posttype'){
		ui_register_object( $object_name , 'posttype' );
	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='user'){
		ui_register_object( $object_name , 'user' );
	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add DATABASE                                                  */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='db'){
		echo 'db';
		ui_register_object( $object_name , 'db' );
	}

} else {
?>
	<pre class="alert alert-danger" style="font-size:24px; margin:20px; font-family:arial">You dont have access to create this object. <br/>You must login as admin to do it.</pre>
<?php

}

function ui_register_object($object_name, $objecttype){

		$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
		$slug_name = sanitize_title($object_name);
		

		
		

		if($objecttype == 'posttype' ){

			/*      check is name exist            */
			foreach ($posttypes_array as $key => $value) {
				if($key == $slug_name){
					?>
					<div>
						<pre class="alert alert-warning" style="font-size:24px; margin:20px; font-family:arial">Posttype on this NAME already exist.<br>Input diffrent name !!!</pre>
					</div>
					<?php
					die();
				}
			}

			/* ----------------------------------- */
			/* 1.1. Create posttype declaration    */
			
			$posttypes_array = Spyc::YAMLLoad( $prop_path . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' );
			$posttype_schema = Spyc::YAMLLoad( $prop_path . 'uigen-posttype/schemas/uigen-posttype-creator-schema.yaml' );
			
			$posttype_added_array[$slug_name] = $posttype_schema['example_posttype'];
			$posttype_added_array[$slug_name]['label'] = $object_name;
			$posttype_added_array[$slug_name]['labels']['name'] = $object_name;
			$posttype_added_array[$slug_name]['labels']['singular_name'] = $object_name;
			
			require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';
			$posttypes_array = ui_merge_data_array($posttypes_array,$posttype_added_array);
			
/*			echo '<div><h2>Declarated posttype - OK</h2><pre>';
			print_r(Spyc::YAMLDump($posttype_added_array ));
			echo '</pre></div>';*/
			echo '<div><p style="font-family:courier; color:green;">Declarated posttype - OK</p><div>';

			/* create posttype declarations array */
			file_put_contents( $prop_path . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' , Spyc::YAMLDump($posttypes_array ));

		}

		if($objecttype == 'db' ){

			/* ----------------------------------- */
			/* 1.1. Create database declaration    */
			$db_array[$object_name] = $_POST['object_data'];
			$db_array[$object_name]['object_name'] = $object_name;

			/* create posttype declarations array */
			$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
			$db_old_array = Spyc::YAMLLoad( $prop_path . 'uigen-database/arguments/database-arguments.yaml' );
			

			require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';

		    $db_array = ui_merge_data_array( $db_old_array , $db_array );






			file_put_contents( $prop_path . 'uigen-database/arguments/database-arguments.yaml' , Spyc::YAMLDump( $db_array ));


		}

		/* ----------------------------------- */
		/* 2.1. Create View page               */

		ui_create_post($object_name . ' - view' , $objecttype,   $slug_name);
		echo '<div><p style="font-family:courier; color:green;">New view '.$objecttype.' created</p></div>';
		

		/* ----------------------------------- */
		/* 2.2. Create Form page               */

		ui_create_post($object_name . ' - form' , $objecttype , $slug_name, 'basic-create-post');
		echo '<div><p style="font-family:courier; color:green;">New form '.$objecttype.' created</p></div>';
		
		/* ----------------------------------- */
		/* 2.3. Create List page               */
		
		ui_create_post($object_name . ' - list' , $objecttype , $slug_name);
		echo '<div><p style="font-family:courier; color:green;">New list '.$objecttype.' created</p></div>';

		/* ------------------------------------ */
		/* ------------------------------------ */
		/* 3.1. Create View properties and hierarchy yaml file */
		
		//chmod($prop_path . 'template-hierarchy/arguments', 0755);

		if($objecttype == 'posttype' ){
			$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-view.yaml' );
		}
		if($objecttype == 'user' ){
			$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-view.yaml' );
		}
		if($objecttype == 'db' ){
			$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-db-properties-view.yaml' );
		}

		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-properties.yaml' , Spyc::YAMLDump( $view_schema ));
		
		if($objecttype == 'posttype' ){
			$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy-view.yaml' );		
		}
		if($objecttype == 'user' ){
			$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-view.yaml' );
		}
		if($objecttype == 'db' ){
			$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-db-hierarchy-view.yaml' );
		}
		
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $view_schema_h ));
		
/*		echo '<div><h2>Add view properties</h2><pre>';
		print_r(Spyc::YAMLDump($view_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add view hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump($view_schema_h ));
		echo '</pre></div>';*/

		echo '<div><p style="font-family:courier; color:green;">Add view properties<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
		echo '<div><p style="font-family:courier; color:green;">Add view hierarchy<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
		
		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.2. Create Form properties and hierarchy yaml file */
		
		if($objecttype == 'posttype' ){
			$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-form.yaml' );
		}
		if($objecttype == 'user' ){
			$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-form.yaml' );
		}
		if($objecttype == 'db' ){
			$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-db-properties-form.yaml' );
		}
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-properties.yaml' , Spyc::YAMLDump( $form_schema ));
	
		if($objecttype == 'posttype' ){
			$form_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy-form.yaml' );
		}
		if($objecttype == 'user' ){
			$form_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-form.yaml' );
		}
		if($objecttype == 'db' ){
			$form_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-form.yaml' );
		}
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $form_schema_h ));
		
		//echo '<div><h2>New form hierarchy and properties files created - OK</h2></div>';

/*		echo '<div><h2>Add form properties</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add form hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema_h ));
		echo '</pre></div>';*/

		echo '<div><p style="font-family:courier; color:green;">Add form properties<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
		echo '<div><p style="font-family:courier; color:green;">Add form hierarchy<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';

		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.3. Create list properties and hierarchy yaml file */

		if($objecttype == 'posttype' ){
			$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-list.yaml' );
		}
		if($objecttype == 'user' ){
			$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-list.yaml' );
		}
		if($objecttype == 'db' ){
			$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-db-properties-list.yaml' );
		}
		// set query post as current posttype list
		$list_schema['post-list']['query_args']['post_type'] = $slug_name;
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-list' . '-slots-properties.yaml' , Spyc::YAMLDump( $list_schema ));
		
		if($objecttype == 'posttype' ){
			$list_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy-list.yaml' );
		}
		if($objecttype == 'user' ){
			$list_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-list.yaml' );
		}
		if($objecttype == 'db' ){
			$list_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-db-hierarchy-list.yaml' );
		}
		
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-list' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $list_schema_h ));
		
		//echo '<div><h2>New list hierarchy and properties files created - OK</h2></div>';

/*		echo '<div><h2>Add list properties</h2><pre>';
		print_r(Spyc::YAMLDump($list_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add list hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump($list_schema_h ));
		echo '</pre></div>';*/

		echo '<div><p style="font-family:courier; color:green;">Add list properties<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
		echo '<div><p style="font-family:courier; color:green;">Add list hierarchy<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';

		/* ------------------------------------ */
		/* ------------------------------------ */
		// 4.1. Create page template php file */
		
		$output = "<?php\n";
		$output .= "/* Template Name: Page Posttype Template */\n";
		$output .= "get_header();\n";
		$output .= "\$ui_page_name = \$post -> post_name;\n";
		$output .= "require_once COREFILES_PATH . 'init-uigen-tdc.php';\n";
		$output .= "require_once COREFILES_PATH . 'init-uigen-yaml-get-merge.php';\n";
		$output .= "require_once COREFILES_PATH . 'init-uigen-flow.php';\n";
		$output .= "\$TDC -> tdc_get_grid(\$args['grid'], \$args, \$slots_handler,\$SPD);\n";
		$output .= "get_footer();\n";

		//chmod($prop_path . TEMPLATEPATH, 0755);
		file_put_contents(  TEMPLATEPATH . '/UiGEN_Tpl_' . $slug_name . '_'.$objecttype.'.php' , $output);
		
}

function ui_create_post($object_name, $objecttype , $slug_name, $flow_name = false){
	/* Create post object */
	$my_post = array(
		'post_type'     => 'page',
		'post_title'    => $object_name,
		'post_content'  => 'This is my post.',
		'post_status'   => 'publish',
		'post_author'   => 1,
	);

	/* Insert the post into the database */
	$new_post = wp_insert_post( $my_post );
 	update_post_meta( $new_post, '_wp_page_template', 'UiGEN_Tpl_' . $slug_name . '_'.$objecttype.'.php' );
	// TO DO - check $slug_name and post slug and reorganized process

	
	/* Add page to nav-menu */
 	$nav_item = wp_insert_post(array('post_title' => $object_name,
                                     'post_content' => '',
                                     'post_status' => 'publish',
                                     'post_type' => 'nav_menu_item'));


    add_post_meta($nav_item, '_menu_item_type', 'post_type');
    add_post_meta($nav_item, '_menu_item_menu_item_parent', '0');
    add_post_meta($nav_item, '_menu_item_object_id', $new_post);
    add_post_meta($nav_item, '_menu_item_object', 'page');
    add_post_meta($nav_item, '_menu_item_target', '');
    add_post_meta($nav_item, '_menu_item_classes', 'a:1:{i:0;s:0:"";}');
    add_post_meta($nav_item, '_menu_item_xfn', '');
    add_post_meta($nav_item, '_menu_item_url', '');

    wp_set_object_terms($nav_item, 'main-menu-login', 'nav_menu');


    // Depreciated - post meta dont have flow file name - now flowfile name is defined into yaml properties file
	/*
		if($flow_name != false){
		update_post_meta( $new_post, 'ui_flow', $flow_name );
		}
	}*/



}




?>