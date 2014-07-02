<?php
    require_once("../../../../../wp-load.php");
?>
<style>

#pages-panel-add-form{
	display:none;
}
#pages-panel-add-buttons button{
	color:#333;
}
#pages-panel-add-buttons span{
	color:#428BCA;
	text-shadow:none;
}
.page-panel{
	float:left; border:1px solid #9E9E9E; border-radius:2px; margin:20px 10px 10px 0px; background-color:#333;
}
.page-panel-header{
	border-bottom:1px solid #ccc; padding:5px 10px; background-color:#aaa;
}
.page-panel-single-object{
	float:left;
	padding-top:4px;
	text-align:center;
	margin:5px;
}
.page-panel-single-object:hover{
	background-color:#aaa;
	cursor:pointer;
	color:#333 !important;
}
.page-panel-single-object span{
	font-size:60px;
	margin:0px;
	padding:0px;
}
.page-panel-single-object div{
	font-size:11px !important;
	margin:0px;
	padding:0px;
}
.page-panel-single-object div span{
	font-size:11px !important;
	margin:0px;
	padding:0px;
}
</style>

<div id="pages-panel-add-buttons">	
	<h1 style="float:left">Pages Creator</h1>
	<button disabled="disabled" style="float:right; margin-left:5px; margin-top:20px" type="button" class="add-new-page-button btn btn-default" style="" data-object-type="db">
		<span style="color:#A431B9;" class="glyphicon glyphicon-plus"></span><span style="color:#A431B9;" class="glyphicon glyphicon-list-alt"></span> New database
	</button>

	<button disabled="disabled" style="float:right; margin-left:5px; margin-top:20px" type="button" class="add-new-page-button btn btn-default" style="" data-object-type="user">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-user"></span> New users
	</button>

	<button disabled="disabled" style="float:right; margin-left:5px; margin-top:20px" type="button" class="add-new-page-button btn btn-default" style="" data-object-type="posttype">
		<span style="color:#39BB39;" class="glyphicon glyphicon-plus"></span><span style="color:#39BB39;" class="glyphicon glyphicon-th-list"></span> New posttype
	</button>

	<button style="float:right; margin-left:5px; margin-top:20px" type="button" class="add-new-page-button btn btn-default" style="" data-object-type="landingpage">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> New page
	</button>
</div>
<br style="clear:both"/>	

<div id="pages-panel-add-form" data-object-type="" class="panel panel-primary" style="">
	<div class="panel-heading"> 
  		<span class="glyphicon glyphicon-briefcase"></span>
  		Add new object
	</div>
	<div class="panel-body">
		<div id="add_landingpage" style="display:none"></div>
		<div id="add_posttype" style="display:none" class="form-group"></div>
		 <div id="add_users" style="display:none"></div>
		 <div id="add_database" style="display:none"></div>
	</div>		
	<div class="panel-footer">
		<button id="pages-panel-add-new" type="button" class="btn btn-success pages-panel-add-new" style="float:right">
			<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> Add new object
		</button>
		<br style="clear:both"/>	
	</div>
</div>

<?php
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/uigen-alpacaform-yaml.php';
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-posttype';
	$db_prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-database';
	$landingpages_prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-landing-pages';
	
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/uigen-posttype-creator-arguments.yaml' );
	$db_array = Spyc::YAMLLoad( $db_prop_path . '/arguments/database-arguments.yaml' );
	$landingpages_array = Spyc::YAMLLoad( $landingpages_prop_path . '/arguments/landingpages-arguments.yaml' );

	foreach ($landingpages_array as $key => $value) {
		?>
		<div class="page-panel" data-type="landingpage">
				<div class="page-panel-header" style="background-color: #428BCA;">
					<span style="margin:3px -2px 0 0" class="glyphicon glyphicon-th-list"></span>
					<span class="objectname"><?php echo $value['object_name']; ?></span>
					<span style="float:right; margin:3px -2px 0 0" class="glyphicon glyphicon-cog"></span>
				</div>

				<div>
					<div style="font-size:11px; padding:3px 6px; border-bottom:1px solid #aaa; text-align:right; ">
						<span><a href="#" class="delete_element" data-target="<?php echo $key; ?>">delete</a></span>
					</div>
				</div>
				<div>
					<?php $ob_view = create_display_pages_element( $key , 'view' ); ?>
					<br style="clear:both"/>
				</div>

				<?php
					$filename = get_template_directory().'/UiGEN_Tpl_'.$value['object_name'].'_landingpage.php';
					if (!file_exists($filename)) {
						?>
					   	<div style="padding:5px 10px; background-color:rgb(209, 66, 66); color:#fff; font-size:11px;">
							Warning: <br/>Page Tamplate file doesn't exist !!
						</div>
						<?php
					}
				?>
			</div>	
		<?php
	}

	foreach ($posttypes_array as $key => $value) {
		?>
		<div class="page-panel" data-type="posttype">
				<div class="page-panel-header" style="background-color: #408A40;">
					<span style="margin:3px -2px 0 0" class="glyphicon glyphicon-th-list"></span>
					<span class="objectname"><?php echo $value['object_name']; ?></span>
					<span style="float:right; margin:3px -2px 0 0" class="glyphicon glyphicon-cog"></span>
				</div>

				<div>
					<div style="font-size:11px; padding:3px 6px; border-bottom:1px solid #aaa; text-align:right; ">
						<span><a href="#" class="delete_element" data-target="<?php echo $key; ?>">delete</a></span>
					</div>
				</div>
				<div>
					<?php $ob_view = create_display_pages_element( $key , 'view' ); ?>
					<?php $ob_view = create_display_pages_element( $key , 'form' ); ?>
					<?php $ob_view = create_display_pages_element( $key , 'list' ); ?>
					<br style="clear:both"/>
				</div>

				<?php
					$filename = get_template_directory().'/UiGEN_Tpl_'.$value['object_name'].'_posttype.php';
					if (!file_exists($filename)) {
						?>
					   	<div style="padding:5px 10px; background-color:rgb(209, 66, 66); color:#fff; font-size:11px;">
							Warning: <br/>Page Tamplate file doesn't exist !!
						</div>
						<?php
					}
				?>
			</div>	
		<?php
	}

	foreach ($db_array as $key => $value) {		
		?>		
			<div class="page-panel" data-type="db">
				<div class="page-panel-header" style="background-color: #7A4185;">
					<span style="margin:3px -2px 0 0" class="glyphicon glyphicon-list-alt"></span>
					<span class="objectname"><?php echo $value['object_name']; ?></span>
					<span style="float:right; margin:3px -2px 0 0" class="glyphicon glyphicon-cog"></span>
				</div>

				<div>
					<div style="font-size:11px; padding:3px 6px; border-bottom:1px solid #aaa; text-align:right; ">
						<span><a href="#" class="delete_element" data-target="<?php echo $key; ?>">delete</a></span>
					</div>
				</div>
				<div>
					<?php $ob_view = create_display_pages_element( $key , 'view' ); ?>
					<?php $ob_view = create_display_pages_element( $key , 'form' ); ?>
					<?php $ob_view = create_display_pages_element( $key , 'list' ); ?>
					<br style="clear:both"/>
				</div>

				<?php
					$filename = get_template_directory().'/UiGEN_Tpl_'.$value['object_name'].'_db.php';
					if (!file_exists($filename)) {
						?>
					   	<div style="padding:5px 10px; background-color:rgb(209, 66, 66); color:#fff; font-size:11px;">
							Warning: <br/>Page Tamplate file doesn't exist !!
						</div>
						<?php
					}
				?>
			</div>	

			 <!-- Generated markup by the plugin -->

			<!-- <div class="panel panel-primary" style="width:200px; float:left; margin-right:10px;">
				<div class="panel-heading" style="background-color:#38B1AC;">
			  		<span class="glyphicon glyphicon-list-alt"></span>
			  		<?php echo $value['object_name']; ?>
				</div>
				<div class="panel-body"></div>
				<ul class="list-group">
				    <li class="list-group-item"><span <?php echo $view_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-view/?debug=true&pages_creator=true'; ?>">View</a><?php echo $object_action_view ?></li>	    
				    <li class="list-group-item"><span <?php echo $form_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-form/?debug=true&pages_creator=true'; ?>">Form</a><?php echo $object_action_form ?></li>
				    <li class="list-group-item"><span <?php echo $list_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-list/?debug=true&pages_creator=true'; ?>">List</a><?php echo $object_action_list ?></li>
				</ul>
				<div class="panel-footer"><a class="more_options" href="#">More options</a></div>
			</div> -->
		<?php

	}

	function create_display_pages_element( $key , $element_type ){
			
			$hierarchy = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/arguments';
			$element_return_prop = array(
				'view_exist' => '',
				'view_href' => '',
				'object_action_view' => '',

				);


			if(is_page_exist( $key . '-' . $element_type ) == '' ){

				$element_return_prop['view_exist'] = 'class="glyphicon glyphicon-file"';
				$element_return_prop['view_href'] = get_bloginfo('home') . '/' . $key . '-' . $element_type . '/?debug=true&pages_creator=true';
				$element_return_prop['object_action_view'] = '';

				$filename = $hierarchy.'/' . $key  .'-' . $element_type . '-slots-properties.yaml';
				if (!file_exists($filename)) {
					$element_return_prop['view_exist'] = 'id="recreate-properties" style="color:rgb(209, 66, 66)" class="glyphicon glyphicon-exclamation-sign"';
					$element_return_prop['object_action_view'] = '<span class="recreatre_object" style="color:rgb(66, 163, 209)">ReCreate<br/>YAML</span>';
					$element_return_prop['view_href'] = '#';
				}
				$filename = $hierarchy.'/' . $key  .'-' . $element_type . '-slots-hierarchy.yaml';
				if (!file_exists($filename)) {
					$element_return_prop['view_exist'] = 'style="color:rgb(209, 66, 66)" class="recreate-history glyphicon glyphicon-exclamation-sign"';
					$element_return_prop['object_action_view'] = '<span style="color:rgb(66, 163, 209)">ReCreate<br/>YAML</span>';
					$element_return_prop['view_href'] = '#';
				}
				
			}else{

				$check_page = get_page_by_path( $key . '-' . $element_type );
				$element_return_prop['view_exist'] = 'id="recreate-page" style="color:rgb(209, 66, 66)" class="glyphicon glyphicon-ban-circle"';
				$object_action_view = '<span class="recreatre_object" style="color:rgb(66, 163, 209)">ReCreate<br/>WP Page</span>';
				$element_return_prop['view_href'] = '#';
				if(get_post_status( $check_page -> ID )=='trash'){ 
					$element_return_prop['view_exist'] = 'style="color:rgb(209, 66, 66)" class="recreate-untrash glyphicon glyphicon-trash" data-target="' . $key . '-' . $element_type . '"'; 
					$element_return_prop['object_action_view'] = '<span style="color:rgb(66, 163, 209)">Untrash</span>';
				}
				
			}

			if( $_POST['ui_page_name'] == $key . '-' . $element_type ){
				$element_return_prop['view_exist'] = 'style="text-shadow: 0px 0px 15px #0089FF; color:#fff" class="glyphicon glyphicon-file"';
			} 
			?>
			<div class="page-panel-single-object">
				<a href="<?php echo $element_return_prop['view_href']; ?>">
					<span <?php echo $element_return_prop['view_exist']; ?>></span>
					<div><?php echo $element_return_prop['object_action_view'] ?></div>
					<div><?php echo $element_type; ?></div>
				</a>						
			</div>
			<?php
			//return $element_return_prop;

	}

	function is_page_exist($_slug){
		//$pages = get_pages();
		$pages = get_all_page_ids();		
		foreach ($pages as $page) { 
			//$apage = $page -> post_name;
			$apage = get_post( $post )->post_name;			
			if ($apage == $_slug) {				
				return $_slug;
			}else{
				return '';
				
			} 
		}
	}
?>

<br style="clear:both"/>
<div style="border-top:1px dashed #ccc; margin-top:40px" style="clear:both">&nbsp;</div>

<script>
jQuery( ".add-new-page-button" ).click(function() {
	jQuery('#pages-panel-add-form').slideDown(300);
	jQuery('#pages-panel-add-form').attr('data-object-type',jQuery(this).attr('data-object-type'));
	
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'db'){
		jQuery('#add_database').css('display','block');
		jQuery('#add_posttype').css('display','none');
		jQuery('#add_landingpage').css('display','none');
		jQuery('#add_users').css('display','none');

		jQuery('.pages-panel-add-new').attr('id','pages-panel-add-new-db');

	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'landingpage'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','none');
		jQuery('#add_landingpage').css('display','block');
		jQuery('#add_users').css('display','none');

		jQuery('.pages-panel-add-new').attr('id','pages-panel-add-new-landingpage');
	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'user'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','none');
		jQuery('#add_landingpage').css('display','none');
		jQuery('#add_users').css('display','block');

		jQuery('.pages-panel-add-new').attr('id','pages-panel-add-new-user');
	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'posttype'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','block');
		jQuery('#add_landingpage').css('display','none');
		jQuery('#add_users').css('display','none');

		jQuery('.pages-panel-add-new').attr('id','pages-panel-add-new-posttype');
	}
});
var donateString = 'This feature not implemented yet.\n If You want donate this please contact me on\ndadmor@gmail.com or wath me on GitHub:\nhttps://github.com/dadmor/UiGEN-Core'

jQuery( ".untrash_object" ).click(function() {
	alert(donateString);
});
jQuery( ".recreatre_object" ).click(function() {
	alert(donateString);
});
jQuery( ".more_options" ).click(function() {
	alert(donateString);
});
jQuery( ".delete_element" ).click(function() {
	//alert(jQuery(this).attr('data-target'));
	var panel = jQuery(this).parents('.page-panel');
	jQuery(this).text('processing...');
	jQuery(this).css('color','green');
	jQuery.ajax({
		
		type: "POST",
		url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel-remove-object.php",
		data: { object_slug: jQuery(this).attr('data-target'), objecttype: jQuery(this).parents('.page-panel').attr('data-type') }
	})
	.done(function( msg ) {	
		panel.remove();
	});
});

</script>

<script type="text/javascript">
	/* ----------------------------------------------------------- */
	/*   NEW PAGE                                                  */
	/* ----------------------------------------------------------- */
	var json = "";
	jQuery("#add_landingpage").alpaca({
	"data": {

	},
	"schema":{    
	    "type": "object",
	    "properties": {
	    	"object_name":{
	            "title":"Page Name"            
	        },
	        "more_options": {                    
	                "type": "boolean"
	        },
	        
	        "view_schema":{
                "title":"View Schema",
                "enum": ["simple-landing-page-1", "something-else-soon-2", "something-else-soon-3", "something-else-soon-4" ],   
                "default":"simple-landing-page-1",
                "dependencies": "more_options"         
            },
            "link_to_exist_page":{
                "title":"Link to exist page",
                "enum": ["something-else-soon-1", "something-else-soon-2", "something-else-soon-3", "something-else-soon-4" ],   
                "default":"simple-landing-page-1",
                "description": "Create landing page from your exist wordpress page. NOT IMPLEMENTED YET !!!",
                "dependencies": "more_options"         
            }, 
		}
	},
	"options": {		
		"fields": {
	         "more_options": {
	                "rightLabel": "More options"
	         }
		}
	},
	"postRender": function(form) {
	        jQuery(document).on('click', "#pages-panel-add-new-landingpage", function() {
	        	
	        	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'landingpage'){
	        		jQuery('#debugModal').modal('show');
	        		jQuery('#pages-panel-add-form').slideUp(300);
	            	
	            	var json = form.getValue();
	            	jQuery.ajax({
						type: "POST",
						url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel-add-object.php",
						data: { object_data: json, objecttype: jQuery('#pages-panel-add-form').attr('data-object-type') }
					})
					.done(function( msg ) {	
						jQuery('.modal-content').children('.modal-body').children('div').remove();
						jQuery('.modal-content').children('.modal-body').append(msg);
					});
	            	//alert(JSON.stringify(json));
	        	}
	        });
	    }
	});

	/* ----------------------------------------------------------- */
	/*   NEW POSTTYPE                                              */
	/* ----------------------------------------------------------- */
	var json = "";
	jQuery("#add_posttype").alpaca({
	"data": {

	},
	"schema":{    
	    "type": "object",
	    "properties": {
	    	"object_name":{
	            "title":"Posttype Name"            
	        },
	        "more_options": {                    
	                "type": "boolean"
	        },
            "view_schema":{
                "title":"View Schema",
                "enum": ["clear-data-view", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"clear-data-view",
                "dependencies": "more_options"         
            }, 
            "list_schema":{
                "title":"List Schema",
                "enum": ["clear-data-list", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"clear-data-list", 
                "dependencies": "more_options"        
            },
            "form_schema":{
                "title":"Form Schema",
                "enum": ["simple-add-new-post", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"simple-add-new-post",  
                "dependencies": "more_options"        
            },
		}
	},
	"options": {		
		"fields": {
	         "more_options": {
	                "rightLabel": "More options"
	         }
		}
	},
	"postRender": function(form) {
	        jQuery(document).on('click', "#pages-panel-add-new-posttype", function() {
	        	alert(jQuery('#pages-panel-add-form').attr('data-object-type'));
	        	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'posttype'){
	        		jQuery('#debugModal').modal('show');
	        		jQuery('#pages-panel-add-form').slideUp(300);
	            	
	            	var json = form.getValue();
	            	jQuery.ajax({
						type: "POST",
						url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel-add-object.php",
						data: { object_data: json, objecttype: jQuery('#pages-panel-add-form').attr('data-object-type') }
					})
					.done(function( msg ) {	
						jQuery('.modal-content').children('.modal-body').children('div').remove();
						jQuery('.modal-content').children('.modal-body').append(msg);
					});
	            	//alert(JSON.stringify(json));
	        	}
	        });
	    }
	});

	/* ----------------------------------------------------------- */
	/*   NEW USERS                                                 */
	/* ----------------------------------------------------------- */
	var json = "";
	jQuery("#add_users").alpaca({
	"data": {

	},
	"schema":{    
	    "type": "object",
	    "properties": {
	    	"object_name":{
	            "title":"Users Name"            
	        },
	        "users_role":{
	            "title":"Users Role",
	            "enum": ["Administrator", "Contributor", "Author", "Subscriber" ],   
                "default":"Subscriber",            
	        },
	        "more_options": {                    
	                "type": "boolean"
	        },
            "view_schema":{
                "title":"View Schema",
                "enum": ["clear-users-view", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"clear-users-view",
                "dependencies": "more_options"         
            }, 
            "list_schema":{
                "title":"List Schema",
                "enum": ["clear-users-list", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"clear-users-list", 
                "dependencies": "more_options"        
            },
            "form_schema":{
                "title":"Form Schema",
                "enum": ["simple-register-user", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
                "default":"simple-register-user",  
                "dependencies": "more_options"        
            },
		}
	},
	"options": {		
		"fields": {
	         "more_options": {
	                "rightLabel": "More options"
	         }
		}
	},
	"postRender": function(form) {
	        jQuery(document).on('click', "#pages-panel-add-new-user", function() {
	        	alert(jQuery('#pages-panel-add-form').attr('data-object-type'));
	        	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'user'){
	        		jQuery('#debugModal').modal('show');
	        		jQuery('#pages-panel-add-form').slideUp(300);
	            	
	            	var json = form.getValue();
	            	jQuery.ajax({
						type: "POST",
						url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel-add-object.php",
						data: { object_data: json, objecttype: jQuery('#pages-panel-add-form').attr('data-object-type') }
					})
					.done(function( msg ) {	
						jQuery('.modal-content').children('.modal-body').children('div').remove();
						jQuery('.modal-content').children('.modal-body').append(msg);
					});
	            	//alert(JSON.stringify(json));
	        	}
	        });
	    }
	});




	/* ----------------------------------------------------------- */
	/*   NEW DATABASE                                              */
	/* ----------------------------------------------------------- */
	var json = "";
	jQuery("#add_database").alpaca({
	"data": {

	},
	"schema":{    
	    "type": "object",
	    "properties": {
	            "object_name":{
	                "title":"Database Name"            
	            },
	            "db_table_columns": {
	                "title": "Add columns to database",
	                "type": "array",
	                "items": {
	                    "type": "object",
	                    "properties": {
	                        "db_column_name": {   
	                                "title":"Database column name",                     
	                                "type": "string"

	                        },    
	                        "db_column_type": {   
	                                "enum": ["int(1)", "int(255)", "char(255)", "text(4095)" , "date" , "datetime", "timestamp", "boolean"],
	                                "default":"char(255)"

	                        }                            
	                    }
	                }
	            },
	            "more_options": {                    
	                "type": "boolean"
	            },
	            "view_schema":{
	                "title":"View Schema",
	                "enum": ["clear-data-contest", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
	                "default":"clear-data-contest",
	                "dependencies": "more_options"         
	            }, 
	            "list_schema":{
	                "title":"List Schema",
	                "enum": ["clear-data-contest", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
	                "default":"clear-data-contest", 
	                "dependencies": "more_options"        
	            },
	            "form_schema":{
	                "title":"Form Schema",
	                "enum": ["clear-data-contest", "something-else-soon-1", "something-else-soon-2", "something-else-soon-3" ],   
	                "default":"clear-data-contest",  
	                "dependencies": "more_options"        
	            },
	    }
	   
	},
	"options": {		
		"fields": {
			"db_table_columns": {
	          		"toolbarSticky": true        	
	         },
	         "more_options": {
	                "rightLabel": "More options"
	         }
			}
	},
	"postRender": function(form) {
			jQuery(document).on('click', "#pages-panel-add-new-db", function() {	
	        	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'db'){
	        		jQuery('#debugModal').modal('show');
	        		jQuery('#pages-panel-add-form').slideUp(300);
	            	
	            	var json = form.getValue();
	            	jQuery.ajax({
						type: "POST",
						url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel-add-object.php",
						data: { object_data: json, objecttype: jQuery('#pages-panel-add-form').attr('data-object-type') }
					})
					.done(function( msg ) {	
						jQuery('.modal-content').children('.modal-body').children('div').remove();
						jQuery('.modal-content').children('.modal-body').append(msg);
					});
	            	//alert(JSON.stringify(json));
	        	}
	        });
	    }
	});

</script>