<?php
$uigen_metaboxes = array(
	'template_hierarchy_mainbox' => array(
		'template_hierarchy_mainbox',			// $id
		'Form box',								// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'template_hierarchy',					// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/uigen-core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'template-hierarchy-schema.json',				
			'options_file' => 'template-hierarchy-options.json',
		),						
	),
	'template_hierarchy_savebox' => array(
		'template_hierarchy_savebox',			// $id
		'Save box',								// $title
		'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
		'template_hierarchy',					// $post_type 
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/uigen-core/global-data/template_hierarchy/arguments/',
			//'filename' => 'file',				
			'file_type' => 'json' // [json,php_array,css]
		),						
	),
	/*'template_hierarchy_posttype_test' => array(
		'template_hierarchy_posttype_test',			// $id
		'Form box',								// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'template_hierarchy',					// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/uigen-core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'register-posttype-schema.json',				
			'options_file' => 'register-posttype-options.json',
		),						
	),*/
);
?>