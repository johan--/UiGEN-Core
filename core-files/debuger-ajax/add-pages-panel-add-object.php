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
			$db_array[$object_name]['object_name'] = $slug_name;

			/* create posttype declarations array */
			$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
			$db_old_array = Spyc::YAMLLoad( $prop_path . 'uigen-database/arguments/database-arguments.yaml' );
			

			require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';

		    $db_array = ui_merge_data_array( $db_old_array , $db_array );



			file_put_contents( $prop_path . 'uigen-database/arguments/database-arguments.yaml' , Spyc::YAMLDump( $db_array ));


		}

		
		/* ------------------------------------ */
		/* 3.1. Create View properties and hierarchy yaml file */
		
		//chmod($prop_path . 'template-hierarchy/arguments', 0755);

		create_properties_and_hierarchy_files($slug_name, $objecttype , 'view');
		
		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.2. Create Form properties and hierarchy yaml file */

		create_properties_and_hierarchy_files($slug_name, $objecttype , 'form');
		
		/* ------------------------------------ */
		/* ------------------------------------ */
		// 3.3. Create list properties and hierarchy yaml file */

		create_properties_and_hierarchy_files($slug_name, $objecttype , 'list');

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


function create_properties_and_hierarchy_files($slug_name , $objecttype , $element_type){
		
		// $element_type -> view form list
		$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
		
		$save_file_guardian = true;
		$yamlDir = $prop_path . 'template-hierarchy/arguments/';
		$yamlPath = $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-'.$element_type.'-slots-properties.yaml';
		//$yamlPath = $yamlDir . $yamlPath;
		if (!is_writable($yamlDir)) {
		    
		    echo '<div><p style="font-family:courier; color:red;">Properties Error: directory '.$yamlDir.' doesn`t exist or isn`t writable.</p></div>';
		    $save_file_guardian = false;
		
		} elseif (!is_writable($yamlPath)) {
		   
		    echo '<div><p style="font-family:courier; color:red;">Properties Error: the file '.$yamlPath.' exists and isn`t writable.</p></div>';
		    $save_file_guardian = false;
		
		}
		$el_schema_prop = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-'. $objecttype .'-properties-'. $element_type .'.yaml' );
        
		if($save_file_guardian == true){
			
			$yamlObject = file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-'. $element_type .'-slots-properties.yaml' , Spyc::YAMLDump( $el_schema_prop ));
			echo '<div><p style="font-family:courier; color:green;">Add form properties<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
		
			if (empty($yamlObject)) {
		    	echo '<div><p style="font-family:courier; color:red;">Properties Error: the '.$yamlPath.' is empty/not accessible.</p></div>';
			}

		}		


		$save_file_guardian = true;
		$yamlDir = $prop_path . 'template-hierarchy/arguments/';
		$yamlPath = $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-'.$element_type.'-slots-properties.yaml';
		//$yamlPath = $yamlDir . $yamlPath;
		if (!is_writable($yamlDir)) {
			
			echo '<div><p style="font-family:courier; color:red;">Hierarchy Error: directory '.$yamlDir.' doesn`t exist or isn`t writable.</p></div>';
		    $save_file_guardian = false;
		
		} elseif (!is_writable($yamlPath)) {
		    
		    echo '<div><p style="font-family:courier; color:red;">Hierarchy Error: the file '.$yamlPath.' exists and isn`t writable.</p></div>';
		    $save_file_guardian = false;
		
		}
		$el_schema_hist = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-'. $objecttype .'-hierarchy-'. $element_type .'.yaml' );
		
		if($save_file_guardian == true){
			
			$yamlObject = file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-'. $element_type .'-slots-hierarchy.yaml' , Spyc::YAMLDump( $el_schema_hist ));
			echo '<div><p style="font-family:courier; color:green;">Add form hierarchy<br>plugins/UiGEN-Core/global-data/template-hierarchy/arguments</p></div>';
			
			if (empty($yamlObject)) {
				echo '<div><p style="font-family:courier; color:red;">Hierarchy Error: the '.$yamlPath.' is empty/not accessible.</p></div>';
			}
		}


		//echo '<div><h2>New form hierarchy and properties files created - OK</h2></div>';

/*		echo '<div><h2>Add form properties</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema ));
		echo '</pre></div>';
		echo '<div><h2>Add form hierarchy</h2><pre>';
		print_r(Spyc::YAMLDump( $form_schema_h ));
		echo '</pre></div>';*/
		
	}
?>