<?php







$uigen_metaboxes = array(
/*	'template_hierarchy_mainbox' => array(
		'template_hierarchy_mainbox',			// $id
		'Form box',								// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'template_hierarchy',					// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'template-hierarchy-schema.json',				
			'options_file' => 'template-hierarchy-options.json',
			// Path to save alpaca form as file
			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
			//'save_data_model' => 'one_to_one',
			//'convert_to_wp_keys_format' => array('file_name','cell_name','key3')
		),						
	),*/
	
	/*'template_hierarchy_posttype_test' => array(
		'template_hierarchy_posttype_test',			// $id
		'Form box',								// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'template_hierarchy',					// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'register-posttype-schema.json',				
			'options_file' => 'register-posttype-options.json',
			// ----------------------------------------------------
			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
		),						
	),*/

	/* --------------------------------------------------------------------------------------- */
	/* TEMPLATE HIERARCHY                                                                      */
	/* --------------------------------------------------------------------------------------- */
	
	// 'atest' => array(
	// 	'atest',			// $id
	// 	'Form box test',						// $title
	// 	'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'template_hierarchy',					// $post_type
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
	// 		'schema_file' => 'template-hierarchy-schema.json',				
	// 		//'options_file' => 'template-hierarchy-options.json',
	// 		// ----------------------------------------------------

	// 		'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		'save_data_type' => 'json', // [json , php]
	// 	),						
	// ),
	// 'template_hierarchy_savebox' => array(
	// 	'template_hierarchy_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'template_hierarchy',					// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),


	/* --------------------------------------------------------------------------------------- */
	/* WIZYTA                                                                     */
	/* --------------------------------------------------------------------------------------- */
	
	'wizyta-box' => array(
		'wizyta-box',							// $id
		'Nowa wizyta',							// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'wizyta',								// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'wizyta-schema.json',				
			//'options_file' => 'wizyta-options.json',
			'options' => '			
			{
		   		"fields": {
			        "item": { 
			        	"fields": {
			        		"visit_name": {
			        		"type":"select",           
			            	"optionLabels": ['.render_posttype_to_alpaca_string('kontrakt').']
			            	}
			        	}
			        }		       
		    	}
			}',

			
			// ----------------------------------------------------

			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
			'view' => 'VIEW_WEB_DISPLAY',
		),						
	),
	// 'wizyta_savebox' => array(
	// 	'wizyta_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'wizyta',								// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),

	/* --------------------------------------------------------------------------------------- */
	/* KONTRAKT                                                                  */
	/* --------------------------------------------------------------------------------------- */
	
	'kontrakt-box' => array(
		'kontrakt-box',							// $id
		'Szczegóły kontraktu',						// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'kontrakt',								// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'kontrakt-schema.json',				
			//'options_file' => 'kontrakt-options.json',
			'options' => '			
			{
		   		"fields": {
		   			"diagnistic_start_date": {
		   				"dateFormat": "yymmdd"
		   			},
		   			"diagnistic_end_date": {
		   				"dateFormat": "yymmdd"
		   			},
			        "place": {            
			            "type":"select",
			            "dataSource": '.render_posttype_to_alpaca_string('osrodki').'
			        },
			        "payer": {
			        	"type":"select",
			        	"dataSource": '.render_users_to_alpaca_string('payer').'
			        },
			        "diagnistic_type": {
			        	"type":"select",
			        	"dataSource": '.render_taxonomy_to_alpaca_string('rodzaj_badania').'
			        }		       
		    	}
			}',
			
			// ----------------------------------------------------

			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
		),						
	),
	// 'kontrakt_savebox' => array(
	// 	'kontrakt_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'kontrakt',								// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),

	'kontrakt-visit-box' => array(
		'kontrakt-visit-box',							// $id
		'Wizyty',						// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'kontrakt',								// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'kontrakt-visit-schema.json',				
			//'options_file' => 'kontrakt-doctor-options.json',
			'options' => '{
		   		"fields": {		   			
		   			"supports": {				
						"fields": {	
		   					"item": {		   				
		   						"fields": {						        
									"visit_name": {
				        				"onFieldChange": function(e) {
				        					var obj = new Object();
				        					//obj["text"] = this.name;
				        					obj["text"] = this.getValue();
				        					obj["value"] = this.getValue();
				        					window.alpacaGlobalObj.push(obj)
				        					//alpacaGlobalObj[window.alpacaGlobalObj.length]=obj;
				                			console.log(JSON.stringify(window.alpacaGlobalObj));
				                			$("#kontrakt-doctor-box_form").alpaca().reload();

										}
									}
					        	}					    	
					    	}
						}
					}	       
		    	}
			}',


			
			// ----------------------------------------------------

			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
		),						
	),
	// 'kontrakt-visit_savebox' => array(
	// 	'kontrakt-visit_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'kontrakt',								// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),

	'kontrakt-doctor-box' => array(
		'kontrakt-doctor-box',							// $id
		'Lekarze',						// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'kontrakt',								// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'kontrakt-doctor-schema.json',				
			//'options_file' => 'kontrakt-doctor-options.json',
			'options' => '			
			{
		   		"fields": {
		   			"item": {
		   				"fields": {
		   					"add_doctor": {
		   						"dataSource": '.render_users_to_alpaca_string('doctor').',
		   						"type": "select",
		   						"onFieldChange": function(e) {



										var thisvalue = this.getValue();
										var setInput = $(e["currentTarget"]).parent().parent().parent().next().find("input");
			   							$.ajax({
											type: "POST",
											url: "'. plugins_url().'/UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php",
											data: { "callback":"ui_get_usermeta" , "args":{ "user_id":thisvalue , "meta_name":"wage_const" } }
										})
										.done(function( msg_event ) {	 
											$(setInput).val(msg_event);
											//alert( msg_event );
										});

										var thisvalue2 = this.getValue();
										var setInput2 = $(e["currentTarget"]).parent().parent().parent().next().next().next().find("input");
			   							$.ajax({
											type: "POST",
											url: "'. plugins_url().'/UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php",
											data: { "callback":"ui_get_usermeta" , "args":{ "user_id":thisvalue2 , "meta_name":"wage_percent" } }
										})
										.done(function( msg_event ) {	 
											$(setInput2).val(msg_event);
											//alert( msg_event );
										});

										var thisvalue3 = this.getValue();
										var setInput3 = $(e["currentTarget"]).parent().parent().parent().next().next().find("select");
			   							$.ajax({
											type: "POST",
											url: "'. plugins_url().'/UiGEN-Core/core-files/ajax/ajax_get_wp_objects.php",
											data: { "callback":"ui_get_usermeta" , "args":{ "user_id":thisvalue2 , "meta_name":"currency" } }
										})
										.done(function( msg_event ) {	 
											$(setInput3).val(msg_event);
											//alert( msg_event );
										});
				        					
									}
		   						},

		   					
		   						"grid_cells": {
		   							"fields": {
		   								"item": {
		   									"fields": {
				   								"visits": {
							   						//"dataSource": window.alpacaGlobalObj,
							   						"dataSource": function(field, callback) {callback(window.alpacaGlobalObj);},
							   						"type": "select"
							   					}
					   						}
					   					}
		   							}	
		   						}
		   					

		   				}
		   			}
		    	}
			}',
			
			// ----------------------------------------------------

			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
		),						
	),
	// 'kontrakt-doctor_savebox' => array(
	// 	'kontrakt-doctor_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'kontrakt',								// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),

	/* --------------------------------------------------------------------------------------- */
	/* osrodki					                                                               */
	/* --------------------------------------------------------------------------------------- */
	
	'osrodki-box' => array(
		'osrodki-box',							// $id
		'Dodawanie pracowników',							// $title
		'alpacaform_box',						// $callback [alpaca_form_box,save_as_file_box]
		'osrodki',								// $post_type
		'normal',								// $context
		'high',									// $priority
		array(
			// Alpaca form box
			'data_path' => plugins_url().'/UiGEN-Core/global-data/uigen-alpacaform/arguments/',
			'schema_file' => 'osrodki-schema.json',				
			//'options_file' => 'wizyta-options.json',
			'options' => '
			{
		   		"fields": {
		   			"item": {
		   				"fields": {
		   					"doctors": {
		   						"dataSource": '.render_users_to_alpaca_string('worker').',
		   						"type": "select"
		   					}
		   				}
		   			}
		    	}
			}			
			',
			
			// ----------------------------------------------------

			'file_save_url' => ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template_hierarchy/arguments/',
			'save_data_type' => 'json', // [json , php]
		),						
	),
	// 'osrodki_savebox' => array(
	// 	'osrodki_savebox',			// $id
	// 	'Save box',								// $title
	// 	'saveasfile_box',						// $callback [alpaca_form_box,save_as_file_box]
	// 	'wizyta',								// $post_type 
	// 	'normal',								// $context
	// 	'high',									// $priority
	// 	array(
	// 		// Alpaca form box
	// 		//'data_path' => plugins_url().'/UiGEN-Core/global-data/template_hierarchy/arguments/',
	// 		//'filename' => 'file',				
	// 		//'file_type' => 'json' // [json,php_array,css]
	// 	),						
	// ),

);




    
?>