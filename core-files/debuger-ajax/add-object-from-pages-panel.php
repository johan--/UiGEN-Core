<?php
require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	

if ( current_user_can( 'manage_options' ) ) {
   
	$object_name = $_POST['objectname'];

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

} else {
?>
	<pre class="alert alert-danger">To create post you must be Admin</pre>
<?php

}

function ui_register_object($object_name, $objecttype){

		$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
		$slug_name = sanitize_title($object_name);
		

		
		/*      check is name exist            */
		foreach ($posttypes_array as $key => $value) {
			if($key == $slug_name){
				?>
				<div>
					<pre class="alert alert-warning">This Name exist.<br>Input diffrent name !!!</pre>
				</div>
				<?php
				die();
			}
		}

		if($objecttype == 'posttype' ){

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
			
			echo '<div><h2>Declarated posttype - OK</h2><pre>';
			print_r(Spyc::YAMLDump($posttype_added_array ));
			echo '</pre></div>';

			/* create posttype declarations array */
			file_put_contents( $prop_path . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' , Spyc::YAMLDump($posttypes_array ));

		}

		/* ----------------------------------- */
		/* 2.1. Create View page               */

		ui_create_post($object_name . ' - view' , $slug_name);
		echo '<div><h2>New view '.$objecttype.' created</h2></div>';
		

		/* ----------------------------------- */
		/* 2.2. Create Form page               */

		ui_create_post($object_name . ' - form' , $slug_name, 'basic-create-post');
		echo '<div><h2>New form '.$objecttype.' created</h2></div>';
		
		/* ----------------------------------- */
		/* 2.3. Create List page               */
		
		ui_create_post($object_name . ' - list' , $slug_name);
		echo '<div><h2>New list '.$objecttype.' created</h2></div>';

		/* ------------------------------------ */
		/* ------------------------------------ */
		/* 3.1. Create View properties and hierarchy yaml file */
		
		if($objecttype == 'posttype' ){
			$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-view.yaml' );
		}
		if($objecttype == 'user' ){
			$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-view.yaml' );
		}

		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-properties.yaml' , Spyc::YAMLDump( $view_schema ));
		
		if($objecttype == 'posttype' ){
			$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy-view.yaml' );		
		}
		if($objecttype == 'user' ){
			$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-view.yaml' );
		}
		
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $view_schema_h ));
		
		echo '<div><h2>Add view properties</h2><pre>';
		print_r(Spyc::YAMLDump($view_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add view hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump($view_schema_h ));
		echo '</pre></div>';
		
		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.2. Create Form properties and hierarchy yaml file */
		
		if($objecttype == 'posttype' ){
			$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-form.yaml' );
		}
		if($objecttype == 'user' ){
			$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-form.yaml' );
		}
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-properties.yaml' , Spyc::YAMLDump( $form_schema ));
	
		if($objecttype == 'posttype' ){
			$form_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy-form.yaml' );
		}
		if($objecttype == 'user' ){
			$form_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-hierarchy-form.yaml' );
		}
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $form_schema_h ));
		
		echo '<div><h2>New form hierarchy and properties files created - OK</h2></div>';

		echo '<div><h2>Add form properties</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add form hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema_h ));
		echo '</pre></div>';

		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.3. Create list properties and hierarchy yaml file */

		if($objecttype == 'posttype' ){
			$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-properties-list.yaml' );
		}
		if($objecttype == 'user' ){
			$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-user-properties-list.yaml' );
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
		
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-list' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $list_schema_h ));
		echo '<div><h2>New list hierarchy and properties files created - OK</h2></div>';

		echo '<div><h2>Add list properties</h2><pre>';
		print_r(Spyc::YAMLDump($list_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add list hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump($list_schema_h ));
		echo '</pre></div>';

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

		file_put_contents(  TEMPLATEPATH . '/UiGEN_Tpl_' . $slug_name . '_'.$objecttype.'.php' , $output);
		
}
function ui_create_post($object_name, $slug_name, $flow_name = false){
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




	if($flow_name != false){
		update_post_meta( $new_post, 'ui_flow', $flow_name );
	}





}


?>