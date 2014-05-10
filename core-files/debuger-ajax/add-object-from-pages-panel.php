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
		ui_register_posttype($object_name);
	}

	/* ---------------------------------------------------------------------- */
	/* Swith to add PAGE                                                      */
	/* ---------------------------------------------------------------------- */

	if($_POST['objecttype']=='user'){
		?>
		<div>
			<pre class="alert alert-warning">
				<?php _e('This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core','basic'); ?>
			</pre>
		</div>
		<?php
	}

} else {
?>
	<pre class="alert alert-danger">To create post you must be Admin</pre>
<?php

}

function ui_register_posttype($object_name){

		$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';

		$posttypes_array = Spyc::YAMLLoad( $prop_path . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' );
		$posttype_schema = Spyc::YAMLLoad( $prop_path . 'uigen-posttype/schemas/uigen-posttype-creator-schema.yaml' );
		
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

		/* ----------------------------------- */
		/* 1.1. Create posttype declaration    */

		$posttype_added_array[$slug_name] = $posttype_schema['example_posttype'];
		$posttype_added_array[$slug_name]['template_hierarchy']['label'] = $object_name;
		$posttype_added_array[$slug_name]['template_hierarchy']['labels']['name'] = $object_name;
		$posttype_added_array[$slug_name]['template_hierarchy']['labels']['singular_name'] = $object_name;
		
		require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';
		$posttypes_array = ui_merge_data_array($posttypes_array,$posttype_added_array);
		
		echo '<div><h2>Declarated posttype - OK</h2><pre>';
		print_r(Spyc::YAMLDump($posttype_added_array ));
		echo '</pre></div>';

		/* create posttype declarations array */
		file_put_contents( $prop_path . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' , Spyc::YAMLDump($posttypes_array ));

		/* ----------------------------------- */
		/* 2.1. Create View page               */
		
		ui_create_post($object_name . ' - view' , $slug_name);
		echo '<div><h2>New view post - OK</h2></div>';
		

		/* ----------------------------------- */
		/* 2.2. Create Form page               */

		ui_create_post($object_name . ' - form' , $slug_name);
		echo '<div><h2>New form post - OK</h2></div>';
		
		/* ----------------------------------- */
		/* 2.3. Create List page               */
		
		ui_create_post($object_name . ' - list' , $slug_name);
		echo '<div><h2>New list post - OK</h2></div>';

		/* ------------------------------------ */
		/* 3.1. Create View properties and hierarchy yaml file */
		
		$view_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-view.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-properties.yaml' , Spyc::YAMLDump( $view_schema ));

		$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-view' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $view_schema_h ));
		echo '<div><h2>New view hierarchy and properties files created - OK</h2></div>';
		
		/* ------------------------------------ */
		// 3.2. Create Form properties and hierarchy yaml file */
		
		$form_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-form.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-properties.yaml' , Spyc::YAMLDump( $form_schema ));

		$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-form' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $view_schema_h ));
		echo '<div><h2>New form hierarchy and properties files created - OK</h2></div>';

		/* ------------------------------------ */
		// 3.3. Create list properties and hierarchy yaml file */

		$list_schema = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-list.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-list' . '-slots-properties.yaml' , Spyc::YAMLDump( $list_schema ));
		
		$view_schema_h = Spyc::YAMLLoad( $prop_path . 'template-hierarchy/schemas/page-posttype-hierarchy.yaml' );
		file_put_contents( $prop_path . 'template-hierarchy/arguments/'. $slug_name . '-list' . '-slots-hierarchy.yaml' , Spyc::YAMLDump( $view_schema_h ));
		echo '<div><h2>New list hierarchy and properties files created - OK</h2></div>';

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

		file_put_contents(  TEMPLATEPATH . '/UiGEN_Tpl_' . $slug_name . '_posttype.php' , $output);
		
}
function ui_create_post($object_name,$slug_name){
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
 	update_post_meta( $new_post, '_wp_page_template', 'UiGEN_Tpl_' . $slug_name . '_posttype.php' );
	// TO DO - check $slug_name and post slug and reorganized process



}
?>