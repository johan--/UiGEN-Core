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


	if($_POST['objecttype']=='page'){
		?>
		<div>
			<pre class="alert alert-warning">This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core</pre>
		</div>
		<?php

	}

	if($_POST['objecttype']=='posttype'){
		ui_register_posttype($object_name);
	}

	if($_POST['objecttype']=='user'){
		?>
		<div>
			<pre class="alert alert-warning">This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core</pre>
		</div>
		<?php
	}

} else {
?>
	<pre class="alert alert-danger">To create post you must be Admin</pre>
<?php

}

function ui_register_posttype($object_name){

		$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-posttype';

		$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/uigen-posttype-creator-arguments.yaml' );
		$posttype_schema = Spyc::YAMLLoad( $prop_path . '/schemas/uigen-posttype-creator-schema.yaml' );
		
		$slug_name = sanitize_title($object_name);
		

		// -----------------------------------
		// 1.1. Create posttype declaration

		// check is name exist
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

		$posttype_added_array[$slug_name] = $posttype_schema['example_posttype'];
		$posttype_added_array[$slug_name]['template_hierarchy']['label'] = $object_name;
		$posttype_added_array[$slug_name]['template_hierarchy']['labels']['name'] = $object_name;
		$posttype_added_array[$slug_name]['template_hierarchy']['labels']['singular_name'] = $object_name;
		
		require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';
		$posttypes_array = ui_merge_data_array($posttypes_array,$posttype_added_array);
		
		echo '<div><h2>Declarated posttype - OK</h2><pre>';
		print_r(Spyc::YAMLDump($posttype_added_array ));
		echo '</pre></div>';

		// create posttype declarations array
		file_put_contents( $prop_path . '/arguments/uigen-posttype-creator-arguments.yaml' , Spyc::YAMLDump($posttypes_array ));

		// -----------------------------------
		// 2.1. Create View page 
		
		ui_create_post($object_name . ' - view');

		// -----------------------------------
		// 2.2. Create Form page 

		ui_create_post($object_name . ' - form');
		
		// -----------------------------------
		// 2.3. Create List page 
		
		ui_create_post($object_name . ' - list');

		// -----------------------------------
		// 3.1. Create View pagetemplate


		// -----------------------------------
		// 3.2. Create Form pagetemplate


		// -----------------------------------
		// 3.3. Create List pagetemplate



}
function ui_create_post($object_name){
	// Create post object
	$my_post = array(
		'post_type'     => 'page',
		'post_title'    => $object_name,
		'post_content'  => 'This is my post.',
		'post_status'   => 'publish',
		'post_author'   => 1,
	);

	// Insert the post into the database
	wp_insert_post( $my_post );
}
?>