<style>

@media only screen 
	and (min-width : 640px)
	and (max-width : 1500px) {

		.container{
			width:80% !important;

		}

}
h1, h2,span{
	 text-shadow: 0px 0px 3px #000; 
}
#onHandler{
	/* border-right:5px solid #333; */
}
#new-inspector{
	position:absolute;
	border:50px solid #333;
	margin:10px;
	padding:20px;
	background-color: #333;
	color:#eee;
	display:none;

/* 	box-shadow: 0px 0px 20px #000;  */
}
#debug-manager{
	position:fixed;
	width: 250px;
	height:100%;	
	background-color: #333;
	color:#eee;
	padding:0px 20px;
	right:-250px;
	z-index:2000;
	transition: right 0.5s ease-in-out;
	border-left:5px solid #333;
	box-shadow: 0px 0px 15px #000; 
	
}
#debug-manager.right0{
	right:0px;
}
#debug-manager.right-200{
	right:-250px;
}


#debug-manager .ui_slot_element{
	display:none;
}
#debug-manager .btn-group{
	display:none;
}
#debug-manager .form-group{
	display:none;
}

#debug-manager .flow-workspace{
	display:none;
}
#debug-manager .save-form-properties{
	display:none;
}
}


.ui_page_label, .ui_page_ico, #ui_page_name{
	color:#D2D84F !important;
}
body{
	position:relative;
	transition: margin-left 0.5s ease-in-out,margin-right 0.5s ease-in-out;
}
body.right250{
	margin-right:250px;
}
body.left200{
	margin-left:200px;
}

#uigen_asset_list{
	position:fixed;
	top:0;
	width:200px;
	height:100%;
	left:-100px;
	border-right:5px solid #333;
	background-color: #333;
	font-size:12px;
	margin-left:-200px;
	padding:5px;


    box-shadow: 0px 0px 15px #000; 
	transition: left 0.5s ease-in-out;

}

#uigen_asset_list .panel-title{
	font-size:14px !important;

}

.uigen-act-cell{
	/* border:2px solid #999;  */
	padding:10px;
	margin-bottom:10px;
	/* display:none; */
	/* box-shadow: 0px 0px 10px #888888; */
	min-height:60px !important;
	background-color: rgb(255,255,255);

}
.ui-state-active{
	/* border:3px solid #64992C !important; */
	/* box-shadow: 0px 0px 10px green; */
}
/* .ui-draggable{max-width: 500px;} */
.modal-title{padding:10px; font-size:16px;}
/* .container{
	transition: border-width 0.5s ease-in-out;
}
.row div{
	-webkit-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	-moz-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	-o-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;

} */
#footer_save_info{
	position:fixed; 
	width:100%;
	bottom:0;
	z-index:10000;
	padding:20px 20px 0px 20px;
	display:none;
	background-color: #333;
	border-top:5px solid #333;
	box-shadow: 0px 0px 15px #000; 
}
/* ------------------------*/
.debug-grid-bar-decorator{

	background-image: url(data:image/png;base64,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);

	background-color:#222; 
	color:#aaa; 
	font-size:16px; 
	padding:10px; 
	margin-bottom:10px;
	display:none;
}
.debug-grid-bar-decorator span{
	vertical-align:-1px; 
	margin-left:3px; 
	color:#ccc;
}
/* ------------------------*/
.debug-tplpart-decorator{
	position:relative; 
	
	border:1px solid #9E9E9E; 
	margin-bottom:5px; 
	border-radius: 2px;
}
.tplpart_decorator_options_panel{
	/* font-weight: bold; */
	/* text-shadow: 1px 1px white; */
	/* background-image: linear-gradient(to bottom, #ffffff 0%, #e0e0e0 100%); */
	background-color:#333;
	
	font-size:12px; 
	display:none; 
	padding:8px;
	cursor:move;


}
.tplpart_decorator_options_panel span{
	vertical-align:-1px; 
	margin-left:3px; 
	color:#ccc;	
}
.tplpart_decorator_options_panel button span{
	color:#333;	
}

.portlet-inspect{
	padding:10px; 
	display:none; 
	position:absolute; 
	width:100%; 
	z-index:2500; 
	background-image: url(data:image/png;base64,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);

	background-color:#222; 
	left:0;
	min-width:580px;
	box-shadow: 0px 0px 5px 0px #222;
	/* border:1px solid #000; */
	margin-top:13px;
	border-radius: 3px;

}



.portlet-inspect label{
	color:#aaa !important;
	text-shadow:0px 0px 3px #000;

}

.portlet-inspect h2{
	color:#D2D84F !important;
	text-shadow:0px 0px 3px #000;
	margin-left:10px;
}



.portlet-inspect .alpaca-controlfield-radio{
	margin:0px;
}
.alpaca-fieldset-legend .alpaca-fieldset-legend-button{
	display:none;
}
.portlet-inspect .alpaca-fieldset-legend-button-text{
	line-height:60px;
	font-size:22px;
	color:#ccc !important;
	text-shadow:0px 0px 5px #000;
}
.portlet-inspect .alpaca-fieldset {
  margin-top:10px;
  margin-bottom:10px;

}
.portlet-inspect .control-label{
	display:block;
	float:left;
	width:180px;
	line-height: 36px;
	text-align:right;
	margin-right:20px;
}
.portlet-inspect .alpaca-controlfield-container{
	display:block;
	float:left;
}
.portlet-inspect .alpaca-controlfield-radio .radio {
    float:left;
	margin:-5px 20px 10px 10px !important;
	padding: 0 !important;
}
.portlet-inspect .alpaca-controlfield-checkbox{
	margin-left:200px;
}
.portlet-inspect .alpaca-field{
	clear:both;
}
.alpaca-controlfield-helper{ 
clear:both;
}

.debug-tplpart-decorator .navbar-inverse{
	border-color:#363636 !important;

}
.debug-tplpart-decorator .navbar-brand{
	font-size:14px;

}
.debug-tplpart-decorator .navbar-nav{
	font-size:12px;
}
.slot_properties_header{
	display:none;
	position:absolute; 
	min-width:580px;
	z-index:2510; 
	margin-top:-8px;
	width:100%; 
	box-shadow: 0px 0px 5px 0px #222;
	/* 
	
	
	height:40px; 
	background-color:#D2D84F !important; 
	
	
	padding:10px; 
	border:1px solid #333;
	border-radius: 2px; */
}


#pages_creator{
	display:none;

}
#add_pages,#ui_grid_selector{
	cursor:pointer;
}
#add_pages span{
	color:#A0CBEF;	
}
.modal-dialog{
	margin:50px auto;
}

.purple{
	/* background-image: linear-gradient(to bottom, #E5D6EC 0%, #C297D3 100%); */
	
	box-shadow: 0px 0px 2px #D800FF; 

}
.light-green{
	/* background-image: linear-gradient(to bottom, #D8ECD6 0%, #6CB46F 100%) */
	box-shadow: 0px 0px 2px #00FF00; 
}
.slot-fade{
	outline:#FFD76E solid 6px;
	/* box-shadow: 0px 0px 1100px 1180px #fff; */
}
.help-panel{
	position:fixed;
	width:100%;
	height:100%;
	background-color:rgba(0,0,0,0.7);
	z-index:3000;
	display:none;
}
#change-grid span{
		color:#A0CBEF;
}
.dropdown-menu{
	z-index:5000 !important;
}

.dropdown-menu span{
	text-shadow:none;
	color:#333;
}
#properties-mask{
	position:fixed;
	 width:100%;
	  height:100%;
	  top:0;
	  background-color:rgba(200,200,200,0.6);
	  z-index:2100
}
.debuger-all-options{
	cursor:pointer;
	color:rgb(160, 203, 239);
}
.debuger-all-options:hover{
	color:#2d6ca2;
}
#add_taxonomy{
	cursor:pointer;
}
.notransition {
  -webkit-transition: none !important;
  -moz-transition: none !important;
  -o-transition: none !important;
  -ms-transition: none !important;
  transition: none !important;
}
.modal{
	z-index:10000;
}
iframe{
	height:100px !important;
}
#flow_steps{
	display:none;
}
.form-slot-debug-decorator #progress{
	display:none;
}
</style>

<script>
	jQuery('body').addClass('debuger');
	var static_el_schema = {    
		    "type": "object",
		    "properties": {
		    	"object_name":{
		            "title":"Page Name"            
		        },
		        "more_options": {                    
		                "type": "boolean"
		        },
		        "link_to_exist_page":{
	                "title":"Link to exist page",
	                "enum": ["something-else-soon-1", "something-else-soon-2", "something-else-soon-3", "something-else-soon-4" ],   
	                "default":"simple-landing-page-1",
	                "description": "Create landing page from your exist wordpress page. NOT IMPLEMENTED YET !!!",
	                "dependencies": "more_options"         
	            }, 
		        "view_schema":{
	                "title":"View Schema",
	                "enum": ["simple-landing-page-1", "something-else-soon-2", "something-else-soon-3", "something-else-soon-4" ],   
	                "default":"simple-landing-page-1",
	                "dependencies": "more_options"         
	            }, 
			}
		}

	var list_el_schema = {};

</script>

<?php
/**
 * This function decorate display page without debugging mode
 *
 * @param string $gridName Get acctualy grid defined into page_template file localized into theme folder. 
 * @param array $args Get hierarchy properties localized into UiGEN-Core/gloal-data/template-hierarchy/arguments
 * @filesource /UiGEN-Core/core-files/uigen-debuger.php
 */


function decorate_debuged_page_header($gridName,$args){
	if ( !current_user_can( 'manage_options' ) ) {
	?>
		<div style="background-color:rgb(209, 66, 66); color:#fff; padding:20px">
			<span style="line-height:34px">You don't have login as <b>administrator !!!</b> Some of Your actions can't be saved.</span>
			<a href="<?php echo wp_login_url( home_url() ); ?>" type="button" class="btn btn-success" title="Login" style="float:right;">LOGIN</a>
			<br style="clear:both"/>
		</div>
	<?php
	}
	?>
	<div class="debug-grid-bar-decorator draggable-decorator-guardian" data-page-name="<?php echo $args['ui_page_name']; ?>" data-slot-list-file="<?php echo $args['ui_slot_list_name']?>">

		<div id="pages_creator">
			<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>
		</div>

		<div>
			
			<span style="font-size:28px" class="ui_page_ico glyphicon glyphicon-file"></span>
			<span class="ui_page_label" style="font-size:22px">Page:</span> <span id="ui_page_name" style="font-size:26px"><?php echo $args['ui_page_name']; ?></span>

			<div  style="float:right; margin-right:10px; margin-top:3px; font-size:18px">
				<div id="add_pages">
				<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span><span>Add/edit pages</span>
				</div>
				<div id="add_taxonomy" style="font-size:12px; margin-top:5px;">
				<span style="margin-right:5px; margin-left:8px" class="glyphicon glyphicon-plus"></span><span style="margin-right:3px;" class="glyphicon glyphicon-tag"></span><span>Add/edit texonomiues</span>
				</div>
			</div>
		</div>
		<div id="ui_grid_selector" style="margin-top:5px; margin-left:5px; margin-bottom:10px">
			<div style="float:left">
				<span class="glyphicon glyphicon-th-large"></span> <span>Grid name:</span>
				<span id="ui_grid_name"><?php echo $gridName; ?></span>
			</div>
			<div id="change-grid" style="float:left; margin-left:10px; margin-top:3px; font-size:12px">
				<span class="glyphicon glyphicon-refresh"></span><span>Change grid</span>
			</div>
		</div>	
		<br style="clear:both"/>	

		<?php
			decorate_slot('start',$gridName,$args);
			decorate_slot('end',$gridName,$args);
		?>
	</div>

	<div id="new-inspector">

	</div>	

	<div id="footer_save_info">
		<table>
			<tr>
				<td width="100%" valign="top">
					<div id="saved_info_box" style="font-size:12px; max-height:120px; overflow:hidden" class="alert alert-success">

					</div>
				</td>
				<td valign="top" style="padding-left:20px">
					<button type="button" class="save_slots_hierarchy btn btn-default btn-success" style="width:210px; margin-bottom:10px" data-toggle="modal" data-target="#debugModal">
						<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
					</button>
					<button type="button" class="undoLast btn btn-default" style="width:210px; margin-bottom:10px">
						<span class="glyphicon glyphicon-step-backward"></span> Undo Last Change
					</button>
					<p>To reset changes refresh your browser</p>
				</td>				
			</tr>
		</table>		
	</div>

	<div id="uigen_asset_list">
		
	</div>
	<?php
}
/**
 * This function decorate UiGEN Slot without debugging mode
 *
 * @filesource /UiGEN-Core/core-files/uigen-debuger.php
 */
function decorate_slot($position,$slotName,$slot){

	global $TDC;
	$data_posttype_name = $TDC->args[$TDC->current_slot]['query_args']['post_type'];
	if($data_posttype_name != ''){
		//echo $data_posttype_name;
	}else{
		$data_posttype_name = explode('-',$TDC->args['ui_page_name']);
		$data_posttype_name = $data_posttype_name[0];
	}
	if($position=='start'){
	?>
		<div id="<?php echo $slotName; ?>" class="debug-tplpart-decorator" data-tplname="<?php ; echo $slot['tpl_part']?>" data-posttype-name="<?php echo $data_posttype_name?>" >
			
			<nav class="navbar navbar-inverse slot_properties_header" role="navigation">
				<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">          
					<span class="navbar-brand" href="#">Slot properties</span>
				</div>
				   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
					<ul class="nav navbar-nav">
						<li class="prop_main active"><a href="Javascript: void(0);"><span class="glyphicon glyphicon-wrench"></span> Main</a></li>
						<li class="prop_style "><a href="Javascript: void(0);"><span class="glyphicon glyphicon-adjust"></span> Styles & CSS</a></li>
						<li class="prop_slot "><a href="Javascript: void(0);"><span class="glyphicon glyphicon glyphicon-dashboard"></span> Core slot</a></li>
					</ul>
					<button style="float:right; margin:8px -5px 0 0" type="button" class="debug-core-properties-hide btn btn-danger btn-sm"><span class="glyphicon glyphicon glyphicon-remove-circle"></span></button>
				
				</div><!-- /.navbar-collapse -->
				</div>
			</nav>

			

<!-- 			<div class="slot_properties_header">
	<div style="float:left" class="core-properties-title">Slot Core Properties</div>
	<button style="float:right; margin:-5px -5px 0 0" type="button" class="debug-core-properties-hide btn btn-danger btn-sm"><span class="glyphicon glyphicon glyphicon-remove-circle"></span></button>
</div> -->
			<div class="tplpart_decorator_options_panel <?php
			 	if($slot['debug_type'] == 'form'){ echo 'purple'; }
			 	if($slot['debug_type'] == 'list'){ echo 'light-green'; }
			 ?>">
				<?php 
					if($slot['debug_type'] == 'menu'){
						?>
							<span class="glyphicon glyphicon-align-justify"></span> &nbsp; &nbsp; 
						<?php
					}
					if($slot['debug_type'] == 'list'){
						?>
							<span class="glyphicon glyphicon-th-list"></span> &nbsp; &nbsp; 							
						<?php
					}
					if($slot['debug_type'] == 'static'){
						?>
							<span class="glyphicon glyphicon-file"></span> &nbsp; &nbsp; 
						<?php
					}
					if($slot['debug_type'] == 'form'){
						?>
							<span class="glyphicon glyphicon-list-alt"></span> &nbsp; &nbsp; 							
						<?php
					}
					if($slot['debug_type'] == 'img'){
						?>
							<span class="glyphicon glyphicon glyphicon-picture"></span> &nbsp; &nbsp; 							
						<?php
					}

					

/*					{

						?>
							<span class="glyphicon glyphicon-pushpin"></span> &nbsp; &nbsp; 
						<?php

					}*/
				?>
				
				<!--Slot name: --><span class="slot_name"><?php echo $slotName; ?></span>
				
				<div class="btn-group" style="float:right; margin-top:-6px; margin-right:-6px">
				  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				    <span class="glyphicon glyphicon-cog"></span>  <span class="caret" style="vertical-align:2px !important"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				  	<?php if($slot['debug_type'] == 'form'){ ?>
				  	<li class="formSlotEdit">
				  		<a href="Javascript: void(0);"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit Form </a>
				  	</li>
				  	<li class="formSlotLoad">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Load Form </a>
				    </li>
				  	<?php }else{ ?>
					<!-- 
					<li class="slotEdit  disabled">
						<a href="Javascript: void(0);" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit Slot</a>
					</li> -->
				  	<?php } ?>
				  	<li class="edit-slot-properties">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp; Properties</a>
				    </li>
					<!-- 				  	
					<li class="slotSettings">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Settings and CSS</a>
				    </li> -->
					<li class="divider"></li>
					<!--  
					<li class="slotProperties">
				   	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp; Core Slot Properties</a>
					</li> -->
				    <li class="debugInspect">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp; Write Script</a>
				    </li>
				    <li class="divider"></li>
				    <li class="deleteSlot">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp; Delete Slot</a>
				    </li>
				  </ul>
				</div>


				<!-- <button style="float:right;" type="button" class="debug-edit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</button> -->
				
			</div>

			<div class="portlet-inspect">

				<textarea style="display:none" class="portlet-inspect-yaml" rows="5"><?php
					require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
					$fullSlot = array($slotName => $slot);
					$Data = Spyc::YAMLDump($fullSlot);
					echo $Data;
					
				?></textarea>
				
				<textarea style="display:none" class="portlet-inspect-properties" rows="5"><?php
					$fullSlot = $slot;
					$Data = json_encode($fullSlot);
					echo $Data;
					
				?></textarea>
				<div class="portlet-inspect-properties-form"></div>
				<button style="float:right" type="button" class="debug-save-core-properties btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save properties</button>
			</div>	
	<?php
	}
	if($position=='end'){
	?>
		<div style="clear:both; height:0px; font-size:0px">&nbsp;</div>

			<?php if($slot['debug_type'] == 'form'){ ?>
				<div class="flow-workspace" style="border:1px solid red; padding:10px; margin:10px">
					Flow workspace - not implemented yet
				</div>

				<div class="save-form-properties" style="border:1px solid red; padding:10px; margin:10px">
					<button style="float:right" type="button" class="save-form-properties btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save form properties</button>
					<br style="claer:both"/>
				</div>
			<?php }?>

		</div>
	<?php
	}
}

function decorate_form($position,$slotName,$patch){
	if($position == 'start'){
		echo '<div class="form-slot-debug-decorator" style="border:1px dashed #666; margin:5px; background-color:#eee">';
		echo '<div style="background-color:#F08043; padding:3px; font-size:11px; margin-bottom:5px">';
		echo '<b>element:</b> '.$patch;
		echo '<span style="float:right; color:#fff; margin-right:5px" class="glyphicon glyphicon-cog"></span>';
		echo '</div>';
	}
	if($position == 'end'){
		echo '</div>';
	}
}
?>

<!-- Modal -->
<div class="modal fade" id="debugModal" tabindex="-1" role="dialog" aria-labelledby="debugModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="debugModalLabel">UiGEN MESSAGE</h4>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" style="display:none" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div id="debug-manager">
</div>

<script>
var donateString = 'This feature not implemented yet.\n If You want donate this please contact me on\ndadmor@gmail.com or wath me on GitHub:\nhttps://github.com/dadmor/UiGEN-Core'
window.onload=function(){

	


	jQuery('#ui_grid_selector').mouseenter(function() {
		jQuery('#change-grid').find('span').css('color','#428bca');
	});
	jQuery('#ui_grid_selector').mouseleave(function() {
		jQuery('#change-grid').find('span').css('color','#A0CBEF');
	});

	jQuery('#add_pages').mouseenter(function() {
		jQuery('#add_pages').find('span').css('color','#428bca');
	});
	jQuery('#add_pages').mouseleave(function() {
		jQuery('#add_pages').find('span').css('color','#A0CBEF');
	});




/* HELP TUTORIALS SYSTEM */

/*	var helpHistory = [

		{
			'img_url':'help_drag_and_drop.png',
			'img_style':'float:right; margin-right:10px; margin-top:10px',
			'action_to_run':'dragSlots',
			'action_workspace':'#debug-manager',
			'action_prop':{
				'dragCounter':3
			}
		},
		{
			'img_url':'help_drag_and_drop.png',
			'img_style':'float:right; margin-right:10px; margin-top:10px',
			'action_to_run':'click',
			'action_workspace':'.save_slots_hierarchy',
			'action_prop':{
				'click':'.save_slots_hierarchy'
			}
		},
	];

	var help_html = '<div id="help_panel" class="help-panel"><img src="<?php echo plugins_url(); ?>/UiGEN-Core/img/help_drag_and_drop.png" style="float:right; margin-right:10px; margin-top:10px"></div>';

	jQuery('body').prepend( help_html );
	jQuery('#help_panel').click( "li.slotEdit", function() {
		jQuery('#help_panel').remove();
	});*/



	var tutorial1 = [
		{
			'action_name':'click on kurwa mać',
			'action_start':'click on madafaka',
			'action_type':'click',
			'action_workspace':'#nav-menu-header1 .debugInspect',
			'action_finish':'Oh you son of the fuck. Congrats'

		},
		{
			'tut_part_name':'create new posttype',
			'tut_part_actions':[
				{},
				{},
				{}
			]			
		}
	];

	ui_tutorial(tutorial1);

	function ui_tutorial(tut_data){

		// init tutorial object
		var tutorialObject = {
			'tutorial_name':'tutorial1',
			'tutorial_step':0,
			'tutorial_data':'' 
		}

		if(localStorage.ui_tutorial == undefined){
				
			// load fefault tutorial
				
			tutorialObject['tutorial_data'] = tut_data;
			localStorage.setItem("ui_tutorial", JSON.stringify(tutorialObject));
			

			// and run tutorial
			var tutorial_data = JSON.parse(localStorage.ui_tutorial);
			//alert(tutorial_data['tutorial_data'][0]['action_name']);


		}else{

			// only run tutorial
			var tutorial_data = JSON.parse(localStorage.ui_tutorial);
			
			if(tutorial_data['tutorial_data'][0]['action_type'] == 'click'){
				jQuery(document).on('click', tutorial_data['tutorial_data'][0]['action_workspace'] , function() {
					//alert('succes - you click on ');	
				});
			}			

		}		
		
	}
/* END HELP TUTORIALS SYSTEM */



	jQuery(document).on('click', "li.slotEdit", function() {
		alert(donateString);
	});

	jQuery(document).on('click', "li.formSlotEdit", function() {
		


		// disable sortable
		jQuery('.uigen-act-cell').sortable({ disabled: true });

		// add mask
		jQuery('#onHandler').prepend('<div id="properties-mask">&nbsp;</div>');

		// go form tnto top
		jQuery(this).closest('.debug-tplpart-decorator').css('z-index','2500');

		jQuery(this).parent().parent().parent().parent().addClass('slot-fade');

		jQuery('#debug-manager').css('z-index','2500');
		jQuery('#debug-manager').children().remove();
		jQuery(this).parent().parent().parent().parent().find('.btn-group').css('display','none');

		jQuery(this).parent().parent().parent().parent().find('.tplpart_decorator_options_panel').append('<button type="button" style="float:right; margin-top:-5px" class="back-slots-mode btn btn-default btn-sm"><span class="glyphicon glyphicon-step-backward"></span> Back to Slots Mode</button>');
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/get-forms-list.php",
			data: {  }
		})

		.done(function( msg ) {	 
			jQuery('#debug-manager').append(msg);
			loadFormsListHandler();
		});
	});

	jQuery(document).on('click', "li.deleteSlot", function() {
		jQuery(this).parent().parent().parent().parent().remove();
		jQuery('#saved_info_box').prepend('<p style="display:none">You deleted slot. You must save this action.</p>');
		jQuery('#saved_info_box').children('p').show('slow');
      	jQuery('#footer_save_info').fadeIn('slow');
	});


	/*
		SLOT PROPERTIES
	*/
	jQuery(document).on('click', "li.edit-slot-properties", function() {

		// SAVE DRAG AND DROP FIRST
		if(jQuery('#footer_save_info').css('display') == 'block'){

			jQuery(this).closest(".tplpart_decorator_options_panel").find(".dropdown-toggle").dropdown('toggle');
			
			jQuery('.save_slots_hierarchy').css('border','red solid 5px');
			jQuery('.save_slots_hierarchy').css('box-shadow','0px 0px 15px red');
			
			alert('SAVE your Drag and Drop changes first');
			//jQuery(this).closest(".tplpart_decorator_options_panel").find(".dropdown-toggle").css('border','3px solid red');
			return false;
		}


		jQuery('#alpaca_prop_form').remove();

		// disable sortable
		jQuery('.uigen-act-cell').sortable({ disabled: true });

		// clear opeded panels
		jQuery('.portlet-inspect').css('display','none');
		jQuery('.slot_properties_header').css('display','none');
		jQuery('#properties-mask').remove();

		// add mask
		jQuery('#onHandler').prepend('<div id="properties-mask">&nbsp;</div>');

		// header slot loader
		jQuery(this).closest('.debug-tplpart-decorator').find('.slot_properties_header').fadeIn();	

		//alert(jQuery(this).offset().top);
		// animete
		jQuery("html, body").delay(200).animate({scrollTop: jQuery(this).offset().top-120 }, 500);

		// remove slots borders
		//jQuery('.debug-tplpart-decorator').css('border','0');
		//jQuery('.uigen-act-cell').css('border','0');

		// get element defined YAML
		//var definedYAML = jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('.portlet-inspect-yaml').val();

		// get element defined JSON
		//var definedJSON = jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('.portlet-inspect-properties').val();

		

		// init properties forms
		_this = jQuery(this);
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/properties-manager.php",
			data: { 
				'callback':'init_properties_manager',
				'args':{
					//'definedYAML':definedYAML,
					//'definedJSON':definedJSON,
					//'printschema':'true',
					'ui_page_name': jQuery('#ui_page_name').text(),
			  		'ui_grid_name': jQuery('#ui_grid_name').text(),
					'slotname':jQuery(_this).closest('.debug-tplpart-decorator').find('.slot_name').text(),
					'post_id':'<?php global $post; echo $post->ID;?>',
					'post_type':jQuery(this).closest('.debug-tplpart-decorator').attr('data-posttype-name'),
				}
			}
	
		})
		.done(function( msg ) {

			//jQuery('.modal-content').children('.modal-body').children('div').remove();
			//jQuery('.modal-content').children('.modal-body').append(msg);

			_this.closest('.debug-tplpart-decorator').find('.portlet-inspect-properties-form').append(msg);

			// show alpaca area
			_this.closest('.debug-tplpart-decorator').find('.portlet-inspect').delay(300).slideDown();

			// render alpaca
			//jQuery(this).closest('.debug-tplpart-decorator').find('.portlet-inspect-properties-form').alpaca(msg);
			
		});

	});





	jQuery(document).on('click', ".prop_main", function() {
		
		jQuery('div[data-alpaca-item-container-item-key=args]').css('display','block');
		
		jQuery('div[data-alpaca-item-container-item-key=element_attr]').css('display','none');

		jQuery('div[data-alpaca-item-container-item-key=type]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=name]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_part]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_start]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_end]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=post_id]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=html]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=query_args]').css('display','none');

		jQuery('.active').removeClass('active');
		jQuery('.prop_main').addClass('active');

	});
	jQuery(document).on('click', ".prop_style", function() {
		jQuery('div[data-alpaca-item-container-item-key=args]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=element_attr]').css('display','block');

		jQuery('div[data-alpaca-item-container-item-key=type]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=name]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_part]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_start]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=tpl_end]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=post_id]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=html]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=query_args]').css('display','none');

		jQuery('.active').removeClass('active');
		jQuery('.prop_style').addClass('active');

	});
	jQuery(document).on('click', ".prop_slot", function() {
		jQuery('div[data-alpaca-item-container-item-key=args]').css('display','none');
		jQuery('div[data-alpaca-item-container-item-key=element_attr]').css('display','none');

		jQuery('div[data-alpaca-item-container-item-key=type]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=name]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=tpl_part]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=tpl_start]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=tpl_end]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=post_id]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=html]').css('display','block');
		jQuery('div[data-alpaca-item-container-item-key=query_args]').css('display','block');

		jQuery('.active').removeClass('active');
		jQuery('.prop_slot').addClass('active');

	});





	jQuery(document).on('click', ".debug-core-properties-hide", function() {		
		debug_core_properties_hide(this);
	});

	function debug_core_properties_hide(_this){
		jQuery('.uigen-act-cell').sortable({ disabled: false });
		jQuery('#properties-mask').remove();
		jQuery(_this).closest('.debug-tplpart-decorator').find('.portlet-inspect').slideUp();
		jQuery(_this).closest('.debug-tplpart-decorator').find('.slot_properties_header').fadeOut();
	}

	jQuery(document).on('click', "#footer_save_info .undoLast", function() {
		alert(donateString);
	});

	jQuery(document).on('click', "li.debugInspect", function() {
		

		// SAVE DRAG AND DROP FIRST
		if(jQuery('#footer_save_info').css('display') == 'block'){

			jQuery(this).closest(".tplpart_decorator_options_panel").find(".dropdown-toggle").dropdown('toggle');
			
			jQuery('.save_slots_hierarchy').css('border','red solid 5px');
			jQuery('.save_slots_hierarchy').css('box-shadow','0px 0px 15px red');
			
			alert('SAVE your Drag and Drop changes first');
			//jQuery(this).closest(".tplpart_decorator_options_panel").find(".dropdown-toggle").css('border','3px solid red');
			return false;
		}


		jQuery('.portlet-inspect').css('display','none');
		//alert('inspect');
		//var insprector_width = jQuery('.debug-grid-bar-decorator').css('width-200');

		var textareaVal = jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('textarea').val();
		//jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('min-width',insprector_width);

		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/inspector-add-inspector-form.php",
			data: { 'yaml': textareaVal}
		})
		.done(function( msg ) {	 
			jQuery('#new-inspector').append(msg);
			//loadSlotListHandler();
		});

		var offset = jQuery(this).parent().parent().parent().parent().offset();
		jQuery('#new-inspector').css('top',offset.top+30);
		jQuery('#new-inspector').css('z-index','1000');
		
		jQuery('#uigen_asset_list').children().remove();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-uigen-assets-list.php",
			data: {  }
		})
		.done(function( msg ) {	 
			jQuery('#uigen_asset_list').append(msg);
			//loadSlotListHandler();
		});

	 	if(jQuery(this).hasClass('open')==true){	 		


	 	}else{
			show_left_panel();
			hide_right_panel();
			jQuery('#new-inspector').fadeIn(1000);
			jQuery("html, body").delay(500).animate({scrollTop: jQuery('#new-inspector').offset().top-50 }, 500);
		}
	});

	jQuery(document).on('click', "button.debug-close", function() {	
		hide_left_panel()
		jQuery('#new-inspector').children().remove();

	});

	jQuery(document).on('click', "#asset_grid_close", function() {		
		jQuery('#uigen_asset_list').children().remove();
		hide_left_panel();
		
	});

	jQuery(document).on('click', "button.debug-save-yaml", function() {	
			jQuery(this).parent().css('display','none');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('open');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('btn-success');

			add_progressbar_to_modal();

			jQuery.ajax({
			  type: "POST",
			  url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/inspector-save-yaml.php",
			  data: { 
			  	yaml: jQuery(this).parent().children('textarea').val(),
			  	ui_page_name: jQuery('#ui_page_name').text(),
			  	ui_grid_name: jQuery('#ui_grid_name').text(),
			  	}
			})
			  .done(function( msg ) {
			  	jQuery('.modal-content').children('div').remove();
			  	jQuery('.modal-content').append(msg);
			    
			});
	});

	jQuery(document).on('click', ".debuger-all-options", function() {	
		
		refresh_right_panel();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-all-options.php",
			data: {  }
		})
		.done(function( msg ) {	
			jQuery('#debug-manager').children().remove();
			jQuery('#debug-manager').append( msg );
		});

	});
    jQuery( "div, button" ).disableSelection();


	/*
		ADD PAGES
	*/
	jQuery( "#add_pages" ).click(function() {
		display_pages_selector();
	});
	jQuery(document).on('mouseenter', "#add_pages", function() {
		jQuery('#all_pages_selector').css('background-color','#222 !important');	
	});
	jQuery(document).on('mouseleave', "#add_pages", function() {	
		jQuery('#all_pagesh_selector').css('background-color','#333 !important');	
	});
	jQuery(document).on('click', "#all_pagesh_selector", function() {	
		display_pages_selector();
	});	
	function display_pages_selector(){

			add_progressbar_to_top_pages();
			jQuery( "#pages_creator" ).slideDown(500);
			jQuery.ajax({
				type: "POST",
				url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel.php",
				data: { ui_page_name: jQuery('#ui_page_name').text() }
			})
			.done(function( msg ) {	
				//function show_popup(){
			      	jQuery('#pages_creator').children().remove();
					jQuery('#pages_creator').append(msg);					

					
							jQuery( "#pages_creator" ).slideDown(500);
						
				
			   	//};
			   	//window.setTimeout( show_popup, 500 ); // 5 seconds
				
			});
	
	}
	/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */

	/*
		ADD TAXONOMY
	*/
	jQuery( "#add_taxonomy" ).click(function() {		
		display_taxonomy_selector(this);
	});
	jQuery( "#add_taxonomy" ).mouseenter(function() {
		jQuery('#all_tax_selector').css('background-color','#222');	
	});
	jQuery( "#add_taxonomy" ).mouseleave(function() {
		jQuery('#all_tax_selector').css('background-color','none');	
	});
	function display_taxonomy_selector(_this){
		if(jQuery(_this).hasClass('open')==true){
			jQuery(_this).removeClass('open');
			jQuery( "#pages_creator" ).slideUp(300);		
		}else{
			jQuery.ajax({
				type: "POST",
				url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-taxonomy-panel.php",
				data: {  }
			})
			.done(function( msg ) {	 
				jQuery( "#pages_creator" ).slideUp(500); 
				jQuery('#pages_creator').children().remove();

				jQuery('#pages_creator').append(msg);
				jQuery(this).addClass('open');
				jQuery( "#pages_creator" ).slideDown(500);
				//loadSlotListHandler();
			});
		}
	}
	/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */

	/*
		GRID SELECTOR
	*/
	jQuery( "#ui_grid_selector" ).click(function() {
		display_grid_selector();
		jQuery('#pages_creator').css('display','none');		
	});
	jQuery( "#ui_grid_selector" ).mouseenter(function() {
		jQuery('#all_grid_selector').css('background-color','#222');	
	});
	jQuery( "#ui_grid_selector" ).mouseleave(function() {
		jQuery('#all_grid_selector').css('background-color','none');	
	});
	jQuery(document).on('click', "#all_grid_selector", function() {	
		display_grid_selector();
		jQuery('#pages_creator').css('display','none');
	});	
	function display_grid_selector(){
		jQuery('#uigen_asset_list').children().remove();
		show_left_panel();
		hide_right_panel();
		jQuery.ajax({
				type: "POST",
				url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-uigen-assets-grids.php",
				data: {
					ui_page_name: jQuery('#ui_page_name').text(),
			  		ui_grid_name: jQuery('#ui_grid_name').text(),
				}
			})
			.done(function( msg ) {	 
				jQuery('#uigen_asset_list').append(msg);
		});
	}
	/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */

	jQuery( ".debug-urlencode" ).click(function() {
		var YAML = jQuery(this).parent().children('textarea').val();
		jQuery('#debugModal .modal-body').text('?data='+encodeURI(YAML));
		
	});

	var hierarchyJSON = {};
	var reciveGuardian = 0;
	var newElement = 0;

	// -------------------------
	// SORTABLE TEMPLATE PARTS
	// -------------------------
	jQuery( ".uigen-act-cell" ).sortable({
		connectWith: ".uigen-act-cell",
      	cursor: 'pointer',
      	// if change sort handler
      	start: function( event, ui ) {
      		reciveGuardian = 0;
			if(jQuery(ui.item.context).attr('id') == undefined){
				newElement = 1;
			}else{
				newElement = 0;

				/* hide element content while drag it */
				jQuery(ui.item.context).children().css('display','none');
				jQuery(ui.item.context).children('.tplpart_decorator_options_panel ').css('display','block');
				jQuery(ui.item.context).css('height','36px');
				jQuery(ui.item.context).css('width','300px');
			}

      	},
      	receive: function( event, ui ) {
      		reciveGuardian = 1;      	
      	},
      	stop: function( event, ui ) {
      		var droped_name = jQuery(ui.item.context).find('.slot_name').text();
      		if(reciveGuardian == 0){
				jQuery('#saved_info_box').prepend('<p style="display:none">You sorted <b>'+droped_name+' slot</b> into grid handler. You must save this action.</p>');
      		
					/* show element content while drop it */
      				jQuery(ui.item.context).children().css('display','block');
      				jQuery(ui.item.context).children('.portlet-inspect').css('display','none');
      				jQuery(ui.item.context).children('.slot_properties_header').css('display','none');

      		}else{
      			if(newElement == 0){
      				jQuery('#saved_info_box').prepend('<p style="display:none">You replace <b>'+droped_name+' slot</b> into another handler. You must save this action.</p>');
      			
					/* show element content while drop it */
      				jQuery(ui.item.context).children().css('display','block');
      				jQuery(ui.item.context).children('.portlet-inspect').css('display','none');
      				jQuery(ui.item.context).children('.slot_properties_header').css('display','none');      				

      			}else{

      				jQuery('#saved_info_box').prepend('<p style="display:none">You added new element into grid. You must save this action.</p>');
     			}
      		}
      		jQuery('#saved_info_box').children('p').show('slow');
      		jQuery('#footer_save_info').fadeIn('slow');
      		
      		// add new param to added object
      		//jQuery(ui.item.context).css('border','2px solid green');

      	}
	});

	jQuery( ".uigen-act-cell" ).droppable({
      hoverClass: "ui-state-active" ,
    });
    jQuery( ".flow_set" ).droppable({
      hoverClass: "ui-state-active" ,
    });


    jQuery( ".flow_set" ).sortable({
		connectWith: ".form-slot-debug-decorator",
      	cursor: 'pointer'

    });



    jQuery( ".save_slots_hierarchy" ).click(function() {
		jQuery('#saved_info_box').children().remove();
		jQuery('#footer_save_info').slideUp('slow');

		var progressBar = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
		jQuery('.modal-content').children('div').remove();
		jQuery('.modal-content').append(progressBar);

		var get_slot_yaml = '';
		var get_slot_name = '';
		var get_slot_new_name = '';

		var output_saved_yaml = "";
	    jQuery( "#onHandler .debug-tplpart-decorator" ).each(function( index ) {
	    			get_slot_new_name = '';
	    			//jQuery( this ).find('.slot_name').css('border','1px solid red');
					get_slot_name = jQuery( this ).find('.slot_name').text();
					
	    			get_slot_yaml = jQuery( this ).find('textarea').val();
					
                   	// chck last char is number and remove it                  
                    if (get_slot_name[get_slot_name.length - 1].match(/[0-9]/, "g") ){                    	
                    	get_slot_new_name = get_slot_name.slice(0, -1);
                    }
                    // ad counter to last char
                    if(get_slot_new_name != ""){
						get_slot_yaml = get_slot_yaml.replace(get_slot_name, get_slot_new_name + index);
					}else{
						get_slot_yaml = get_slot_yaml.replace(get_slot_name, get_slot_name + index);
					}

					//get_slot_yaml = get_slot_yaml + "  - " + get_slot_name + index + "\n";

					get_slot_yaml = get_slot_yaml.replace('---\n', '');
					output_saved_yaml += get_slot_yaml;				
		});
		output_saved_yaml = "---\n" + output_saved_yaml;
		//alert(output_saved_yaml);
		
		var output_hierarchy_yaml = "";
		var hierarchy_counter = 0;
		jQuery( "#onHandler .uigen-act-cell" ).each(function( index ) {
			output_hierarchy_yaml = output_hierarchy_yaml + jQuery(this).attr('data-cell') +  ":\n";
			jQuery( jQuery(this).children('.debug-tplpart-decorator') ).each(function( index ) {
				//alert(jQuery(this).attr('id'));
				get_hierarchy_name = jQuery( this ).find('.slot_name').text();
				// chck last char is number and remove it                  
                if (get_hierarchy_name[get_hierarchy_name.length - 1].match(/[0-9]/, "g") ){                    	
                   	get_hierarchy_name = get_hierarchy_name.slice(0, -1);
                }

                    // ad counter to last char
				output_hierarchy_yaml = output_hierarchy_yaml + "  - " + get_hierarchy_name + hierarchy_counter + "\n";
				hierarchy_counter ++;	
			});	
			
			
		});
		output_hierarchy_yaml = "---\n" + output_hierarchy_yaml;
		
		//alert(output_hierarchy_yaml);
		
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/save-slot-history_and_properties.php",
			data: { 
				hierarchy_yaml: output_hierarchy_yaml ,
				prop_yaml: output_saved_yaml ,
				ui_page_name: jQuery('#ui_page_name').text(), 
				ui_grid_name: jQuery('#ui_grid_name').text(),
				ui_slot_list: jQuery('.debug-grid-bar-decorator').attr('data-slot-list-file')
			}
		})
		.done(function( msg ) {	
			location.reload();
			//jQuery('.modal-content').children('div').remove();
			//jQuery('.modal-content').append(msg);
		});
      		
	});

	function loadSlotList(_this){

		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/get-template-part-list.php?debug=true",
			data: {'yaml':jQuery('.debug-grid-bar-decorator .debug-tplpart-decorator .portlet-inspect .portlet-inspect-yaml').val()}
		})
		.done(function( msg ) {	
			jQuery('#debug-manager').append(msg);
			loadSlotListHandler();

			if(sessionStorage.startEffect == undefined){
				startEffect();
			}else{				
				jQuery( ".debug-grid-bar-decorator" ).css('display','block');
				jQuery( ".tplpart_decorator_options_panel" ).css('display','block');
				jQuery('#onHandler').css('margin-bottom','500px');
				jQuery( ".uigen-act-cell" ).css('border','2px solid #999');

				startEffect();
			}


		});
	}
	loadSlotList(this);	

	function loadSlotListHandler(){
		jQuery('#debug-manager').children('.debug-tplpart-decorator').children('.tplpart_decorator_options_panel').next().next().addClass('ui_slot_element');

		jQuery( "#debug-manager .debug-tplpart-decorator" ).draggable({
	      connectToSortable: ".uigen-act-cell",
	      helper: "clone",
	      containment:"document",
	      revert: "invalid",
	      
	    });
	}

	function loadFormsListHandler(){
		jQuery( "#debug-manager .form-slot-debug-decorator" ).draggable({
	      connectToSortable: ".flow_set",
	      helper: "clone",
	      containment:"document",
	      revert: "invalid",
	      
	    });
	}

	function startEffect(){

		 if(sessionStorage.startEffect = 'defined'){
		 	jQuery('#debug-manager').addClass('notransition ');
		 	jQuery('body').addClass('notransition ');
		 }

		sessionStorage.startEffect = 'defined';


		//jQuery( ".uigen-act-cell" ).fadeIn( "slow", function() {
		    //jQuery( ".tplpart_decorator_options_panel" ).slideDown(300);

		jQuery( ".debug-grid-bar-decorator" ).slideDown( "slow", function() {    
		    jQuery( ".tplpart_decorator_options_panel" ).slideDown( "slow", function() {
			    // Animation complete.
			    //jQuery('#debug-manager').css('display','block');
			    

			    show_right_panel();
			
				jQuery('#onHandler').css('margin-bottom','500px');
				jQuery("#debug-manager").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){ 
					jQuery('#help_panel').fadeIn('slow');
					jQuery( ".uigen-act-cell" ).css('border','2px solid #999');
				});
			});
		});

		<?php
		if($_GET['pages_creator'] == 'true'){
			?>
			display_pages_selector();
			<?php
		}
		?>


		jQuery('#debug-manager').removeClass('notransition ');
		jQuery('body').removeClass('notransition ');

		// });
	}


	function show_left_panel(){
		jQuery('body').addClass('left200');
		jQuery('#uigen_asset_list').css('left','200px');
	}

	function hide_left_panel(){
		jQuery('body').removeClass('left200');
		jQuery('#new-inspector').css('display','none');
		jQuery('body').addClass('right250');
		jQuery('#debug-manager').addClass('right0');
		jQuery('#debug-manager').removeClass('right-200');
		jQuery('#uigen_asset_list').css('left','0');

	}

	function show_right_panel(){
		jQuery('body').addClass('right250');
		jQuery('#debug-manager').removeClass('right-200');
		jQuery('#debug-manager').addClass('right0');
	}

	function hide_right_panel(){
		jQuery('#debug-manager').removeClass('right0');
		jQuery('#debug-manager').addClass('right-200');
		jQuery('body').removeClass('right250');	
	}

	function refresh_right_panel(){
		hide_right_panel();
		jQuery('#debug-manager').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',   
		    function(e) {
		   		show_right_panel();
		});
	}


	function add_progressbar_to_modal(){
			var progressBar = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
			jQuery('.modal-content').children('div').remove();
			jQuery('.modal-content').append(progressBar);
	}
	function add_progressbar_to_top_pages(){
			var progressBar2 = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
			jQuery('#pages_creator').children('div').remove();
			jQuery('#pages_creator').append(progressBar2);
	}
	/*jQuery( ".uigen-act-cell" ).droppable({
      accept: "debug-tplpart-decorator",
      activeClass: "ui-state-hover",
      hoverClass: "ui-state-active",
      drop: function( event, ui ) {
        jQuery( this ).addClass( "ui-state-highlight" )
        alert('asdasd'); 
      }      
    });*/

	jQuery( "a" ).each(function( index ) {
	  var debugerHref = jQuery( this ).attr('href') ;

	  if(debugerHref[0] != '#'){
	  	jQuery( this ).attr('href',debugerHref+'?debug=true');
	  }
	});	


	var listener = function() {
	  alert('once');
	  window.removeEventListener('scroll', listener, false);
	};

	window.addEventListener('scroll', listener, false);



/*    window.onscroll = function (event) {
			  alert('asdsad');
			}*/



};


</script>