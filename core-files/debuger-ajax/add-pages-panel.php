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
}
.untrash_object:hover{
	color:#428BCA; cursor:pointer;
}
.recreatre_object:hover{
	color:#428BCA; cursor:pointer;
}
</style>




<h1>Pages Creator</h1>

<?php
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/uigen-alpacaform-yaml.php';
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-posttype';
	$db_prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-database';
	
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/uigen-posttype-creator-arguments.yaml' );
	$db_array = Spyc::YAMLLoad( $db_prop_path . '/arguments/database-arguments.yaml' );


	foreach ($posttypes_array as $key => $value) {
			if(is_page_exist($key.'-view')==true){
				$view_exist = 'class="glyphicon glyphicon-file"';
			}else{
				$object_action_view = '';
				$check_page = get_page_by_path($key.'-view');
				$view_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_view = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID )=='trash'){ 
					$view_exist = 'style="color:red" class="glyphicon glyphicon-trash"'; 
					$object_action_view = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
			}

			if(is_page_exist($key.'-form')==true){
				$form_exist = 'class="glyphicon glyphicon-file"';
			}else{
				$object_action_form = '';
				$check_page = get_page_by_path($key.'-form');
				$form_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_form = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID )=='trash'){ 
					$form_exist = 'style="color:red" class="glyphicon glyphicon-trash"'; 
					$object_action_form = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
			}

			if(is_page_exist($key.'-list')==true){
				$list_exist = 'class="glyphicon glyphicon-file"';
			}else{
				$object_action_list = '';
				$check_page = get_page_by_path($key.'-list');
				$list_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_list = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID )=='trash'){ 
					$list_exist = 'style="color:red" class="glyphicon glyphicon-trash"'; 
					$object_action_list = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
			}
		?>		
			<div class="panel panel-primary" style="width:200px; float:left; margin-right:10px;">
				<div class="panel-heading">
			  		<span class="glyphicon glyphicon-briefcase"></span>
			  		<?php echo $value['label']; ?>
				</div>
				<!-- <div class="panel-body"></div> -->
				<ul class="list-group">
				    <li class="list-group-item"><span <?php echo $view_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-view/?debug=true'; ?>">View</a><?php echo $object_action_view ?></li>	    
				    <li class="list-group-item"><span <?php echo $form_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-form/?debug=true'; ?>">Form</a><?php echo $object_action_form ?></li>
				    <li class="list-group-item"><span <?php echo $list_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-list/?debug=true'; ?>">List</a><?php echo $object_action_list ?></li>
				</ul>
				<div class="panel-footer"><a class="more_options" href="#">More options</a></div>
			</div>
		<?php
	}

	foreach ($db_array as $key => $value) {
			
			if(is_page_exist($key.'-view')==true){
				$view_exist = 'class="glyphicon glyphicon-file"';
				
			}else{
				$object_action_view = '';
				$check_page = get_page_by_path($key.'-view');
				$view_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_view = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID )=='trash'){ 
					$view_exist = 'style="color:red" class="glyphicon glyphicon-trash"'; 
					$object_action_view = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
				
			}
			if(is_page_exist($key.'-form')==true){
				$form_exist = 'class="glyphicon glyphicon-file"';
				
			}else{
				$object_action_form = '';
				$check_page = get_page_by_path($key.'-form');
				$form_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_form = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID )=='trash'){
				 $form_exist = 'style="color:red" class="glyphicon glyphicon-trash"'; 
				 $object_action_form = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
			}
			if(is_page_exist($key.'-list')==true){
				$list_exist = 'class="glyphicon glyphicon-file"';
				
			}else{
				$object_action_list = '';
				$check_page = get_page_by_path($key.'-list');				
				$list_exist = 'style="color:red" class="glyphicon glyphicon-ban-circle"';
				$object_action_list = '<span class="recreatre_object" style="float:right; text-decoration:underline">ReCreate</span>';
				if(get_post_status( $check_page -> ID ) == 'trash'){
				 $list_exist = 'style="color:orange" class="glyphicon glyphicon-trash"'; 
				 $object_action_list = '<span class="untrash_object" style="float:right; text-decoration:underline">Untrash</span>';
				}
			}
		?>		
			<div class="panel panel-primary" style="width:200px; float:left; margin-right:10px;">
				<div class="panel-heading" style="background-color:#38B1AC;">
			  		<span class="glyphicon glyphicon-list-alt"></span>
			  		<?php echo $value['object_name']; ?>
				</div>
				<!-- <div class="panel-body"></div> -->
				<ul class="list-group">
				    <li class="list-group-item"><span <?php echo $view_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-view/?debug=true'; ?>">View</a><?php echo $object_action_view ?></li>	    
				    <li class="list-group-item"><span <?php echo $form_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-form/?debug=true'; ?>">Form</a><?php echo $object_action_form ?></li>
				    <li class="list-group-item"><span <?php echo $list_exist; ?>></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-list/?debug=true'; ?>">List</a><?php echo $object_action_list ?></li>
				</ul>
				<div class="panel-footer"><a class="more_options" href="#">More options</a></div>
			</div>
		<?php

	}

	function is_page_exist($slug){
		$pages = get_pages();
		foreach ($pages as $page) { 
			$apage = $page->post_name;
			if ($apage == $slug) { 
				return true;
			 } 
		}
	}





?>



<br style="clear:both"/>
<div id="pages-panel-add-buttons">	
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="page">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> Add new page
	</button>
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="posttype">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-briefcase"></span> Add new posttype
	</button>
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="user">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-user"></span> Add new users
	</button>
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="db">
		<span style="color:#38B1AC;" class="glyphicon glyphicon-plus"></span><span style="color:#38B1AC;" class="glyphicon glyphicon-list-alt"></span> Add new database
	</button>
</div>
<br style="clear:both"/>	

<div id="pages-panel-add-form" data-object-type="" class="panel panel-primary" style="">
	<div class="panel-heading"> 
  		<span class="glyphicon glyphicon-briefcase"></span>
  		Add new object
	</div>
	<div class="panel-body">
		<div id="add_posttype" style="display:none" class="form-group">
		    <label for="exampleInputEmail1">Object name</label>
		    <input  type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter object name">
		 </div>
		 <div id="add_database" style="display:none"></div>
	</div>		
	<div class="panel-footer">
		<button id="pages-panel-add-new" type="button" class="btn btn-success" style="float:right">
			<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> Add new object
		</button>
		<br style="clear:both"/>	
	</div>
</div>

<br style="clear:both"/>





<script>
jQuery( ".add-new-page-button" ).click(function() {
	jQuery('#pages-panel-add-form').slideDown(300);
	jQuery('#pages-panel-add-form').attr('data-object-type',jQuery(this).attr('data-object-type'));
	
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'db'){
		jQuery('#add_database').css('display','block');
		jQuery('#add_posttype').css('display','none');
	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'page'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','none');
	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'user'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','none');
	}
	if(jQuery('#pages-panel-add-form').attr('data-object-type') == 'posttype'){
		jQuery('#add_database').css('display','none');
		jQuery('#add_posttype').css('display','block');
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

</script>



<script type="text/javascript">
	var json = "";
  jQuery("#add_database").alpaca({
    "data": {
      "name": "Diego Maradona",
      "feedback": "Very impressive.",
      "ranking": "excellent"
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
                                    "default":"CHAR(255)"

                            }                            
                        }
                    }
                } 
        }
       
	},
	"options": {		
		"fields": {
			"db_table_columns": {
              		"toolbarSticky": true        	
             }
   		}
	},
	"postRender": function(form) {
            jQuery("#pages-panel-add-new").click(function() {
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