<?php

function init_properties_manager($obj){

	require_once("../../../../../wp-load.php");
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	
	//echo '<h2>Send post prop</h2>';
	//echo '<pre>';
	//var_dump($obj);
	//echo '</pre>';

	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy';
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/'.$obj['ui_page_name'].'-slots-properties.yaml' );

	//echo '<h2>yaml from disc</h2>';
	//echo '<pre>';
	//var_dump($posttypes_array[$obj['slotname']]);
	//echo '</pre>';

	
	require_once get_template_directory() . '/theme-template-parts/content-properties-api/content-'.$posttypes_array[$obj['slotname']]['tpl_part'].'-schema.php';
	
/*	echo '<h2>yaml from disc</h2>';
	echo '<pre>';
	var_dump($element_settings);
	echo '</pre>';*/


	$data = json_encode($posttypes_array[$obj['slotname']]);
	$args = json_encode($args);
	$element_attr = json_encode($element_attr);


	require_once get_template_directory() . '/theme-template-parts/content-properties-api/content-'.$posttypes_array[$obj['slotname']]['tpl_part'].'-options.php';

?>

<style>
/* ARGS */
div[data-alpaca-item-container-item-key = "args"] { 
   /* display:none; */
}
/* STYLE */
div[data-alpaca-item-container-item-key = "element_attr"] { 
   display:none;
}
/* SLOT PROPERTIES */

div[data-alpaca-item-container-item-key = "type"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "name"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "tpl_part"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "tpl_start"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "tpl_end"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "post_id"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "html"] { 
   display:none;
}
div[data-alpaca-item-container-item-key = "query_args"] { 
   display:none;
}
</style>



<script>
	
</script>




<div id="alpaca_prop_form" style="margin-top:-20px"></div>
 
<script type="text/javascript">
console.log(args);

		jQuery("#alpaca_prop_form").alpaca({
			"data": <?php echo $data; ?>,			
			"schema":{    
			    "type": "object",
			    "properties": {
			    	"args": <?php echo $args; ?>,
			    	"element_attr": <?php echo $element_attr; ?>,
			    	"type":{
			    		"title":"Slot type",
		                "enum": ["tpl-part", "controller"],   
		                "default":"tpl-part"
			    	},
			    	"name":{
			    		 "title":"Controller Name",
			    		 "enum": ["tdc_get_loop", "tdc_get_user_loop" , "tdc_get_search_loop" , "tdc_get_db_loop"],   
			    		 "dependencies": "type"      
			    	},			    	
			    	"tpl_part":{
			    		"title":"Template part",
		                "enum": ["basic-logo-simple", "basic-button", "post-list-item", "basic-article" , "tiled-title" , "basic-title" , "basic-excerpt-box-3" , "basic-excerpt-box-2" ],   
		                "default":"tpl-part"
			    	},
			    	'tpl_start':{
			    		 "title":"Slot header decorator"      
			    	},
			    	'tpl_end':{
			    		 "title":"Slot footer decorator"      
			    	},
			    	'post_id':{
			    		 "title":"Post ID included into this slot",
			    		 "dependencies": "type"       
			    	},
			    	'html':{
			    		"title":"Your html content",
			    		"dependencies": "type"  
			    	},
			    	"query_args": {
		                "title": "Create WP Query",
		                "type": "object",
		                "dependencies": "type",
			            "properties": {			                
			                "post_type": {
			                    "title": "Posttype registration name",
			                    "type": "string"
			                },
			                "posts_per_page": {
			                    "title": "Posts per page",			                    
			                	"type": "number"
			                },
			                "paged": {
			                    "title": "Set current start page",			                    
			                    "type": "number"
			                },
			                "tax_query": {
		               			"title": "Create Taxonomy Filter",
		                		"type": "object",
		                		"properties": {	
				               		"0": {
						                "title": "Tax Query prop",
						                "type": "object",
						                "properties": {
						                	"taxonomy": {
						                    	"title": "Taxonomy name",			                    
						                    	"type": "string"
						               		},	
						               		"field": {
						                    	"title": "Filter by this field type",			                    
						                    	"type": "string"
						               		},	
						               		"terms": {
						                    	"title": "Terms name",
						                		"type": "object",
						                		"properties": {	
						                			"0": {
								                    	"title": "Category name",			                    
								                    	"type": "string"
								               		},	
						                		}
						               		},	
						   
						                }
						            }
		                		}
		                	}
			            }
		            },		    	
			       
				}
			},
			"options": {		
				"fields": {
					"args": args,
			        "type": {
			         	"removeDefaultNone": true,
			         	"type": "radio",
            			"vertical": false			                
			        },
			        "name": {
                    	"dependencies": {
                        	"type": "controller"
                    	},
                    	"removeDefaultNone": true,
                	},
                	"query_args": {
                    	"dependencies": {
                        	"type": "controller"
                    	},
                    	"removeDefaultNone": true,

							"fields": {
								"post_type": {
									
								},
								"tax_query": {
									"fields": {
										"taxonomy": {
									
										}
									}									
								}
							}
						
                	},
                	"post_id": {
                    	"dependencies": {
                        	"type": "tpl-part"
                    	},
                	},
                	"html": {
                    	"dependencies": {
                        	"type": "tpl-part"
                    	},
                    	"type": "textarea"
                	},
                	"tpl_start":{
                		"type": "textarea"
                	},
                	"tpl_end":{
                		"type": "textarea"
                	}
				}
			},
			"postRender": function(form) {
		        jQuery(document).on('click', ".debug-save-core-properties", function() {
		        	//console.log(form.getValue());
		        			
		        	//var progressBar = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
					//jQuery('.modal-body').append(progressBar);
		        	
		        	//jQuery('.uigen-act-cell').sortable({ disabled: false });
					//jQuery('#properties-mask').remove();
					//jQuery('.debug-tplpart-decorator').find('.portlet-inspect').slideUp();
					//jQuery('.debug-tplpart-decorator').find('.slot_properties_header').fadeOut();


		        	jQuery.ajax({
						type: "POST",
						url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/properties-manager-save.php",
						data: { 
							'callback':'save_data',
							'args':{
								//'definedYAML':definedYAML,
								//'definedJSON':definedJSON,
								//'printschema':'true',
								'ui_page_name': jQuery('#ui_page_name').text(),
			  					'ui_grid_name': jQuery('#ui_grid_name').text(),
								'data':form.getValue(),
								'slotname':'<?php echo $obj['slotname']; ?>',
								'post_id':'<?php echo $obj['post_id']; ?>',
								'post_type':'<?php echo $obj['post_type']; ?>',
							}
						}
				
					})
					.done(function( msg ) {
						
						//jQuery('.modal-body').children().remove();
			  			//jQuery('.modal-body').append(msg);
			  			

			  			location.reload(true);

					});
		        });
		    }




	});




</script>
<?php

}


$cb = $_POST['callback'];

if( 

  ($cb == 'init_properties_manager') 


){

  $obj = array($_POST['args']);
  call_user_func_array($cb,$obj);

}else{

  echo '<h1> U`3 lick`y ??? </h1>';

}

?>