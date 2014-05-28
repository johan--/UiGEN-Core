<style>

@media only screen 
	and (min-width : 640px)
	and (max-width : 1500px) {

		.container{
			width:80% !important;

		}

}

#onHandler{
	border-right:5px solid #333;
}
#new-inspector{
	position:absolute;
	border:5px solid #333;
	margin:10px;
	padding:20px;
	background-color: #555;
	color:#eee;
	display:none;
	/* box-shadow: 0px 0px 20px #333; */
}
#debug-manager{
	position:fixed;
	width: 250px;
	height:100%;	
	background-color: #555;
	color:#eee;
	padding:0px 20px;
	right:-250px;
	z-index:2000;
	transition: right 0.5s ease-in-out;
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
	background-color: #555;
	font-size:12px;
	margin-left:-200px;

	transition: left 0.5s ease-in-out;

}

#uigen_asset_list .panel-title{
	font-size:14px !important;
}

.uigen-act-cell{
	border:2px solid #999; 
	padding:10px;
	margin-bottom:10px;
	/* display:none; */
	/* box-shadow: 0px 0px 10px #888888; */
	min-height:60px !important;
	background-color: rgb(255,255,255);

}
.ui-state-active{
	border:3px solid #64992C !important;
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
	background-color: #555;
	border-top:5px solid #333;
}
/* ------------------------*/
.debug-grid-bar-decorator{
	background-color:#333; 
	color:#aaa; 
	font-size:16px; 
	padding:10px; 
	margin-bottom:10px;
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
	font-weight: bold;
	/* text-shadow: 1px 1px white; */
	background-image: linear-gradient(to bottom, #ffffff 0%, #e0e0e0 100%);
	background-color:#ccc; 
	font-size:12px; 
	display:none; 
	padding:8px;
	cursor:move;

}
.tplpart_decorator_options_panel span{
	vertical-align:-1px; 
	margin-left:3px; 
	color:#666;	
}

.portlet-inspect{
	padding:10px; 
	display:none; 
	position:absolute; 
	width:100%; 
	z-index:1000; 
	background-color:#ccc; 
	border:5px solid #9E9E9E;
	margin-left:-10px;
	margin-top:10px;
	border-radius: 10px;
	/* box-shadow: 0px 0px 50px #333; */
	left:0;
}
.portlet-inspect textarea{
	float:left; width:50%; margin:0; padding:6px; font-family:courier; color:navy;
}

#pages_creator{
	display:none;
}
#add_pages,#ui_grid_selector{
	cursor:pointer;
}
.modal-dialog{
	margin:50px auto;
}

.purple{
	background-image: linear-gradient(to bottom, #E5D6EC 0%, #C297D3 100%);
}
.light-green{
	background-image: linear-gradient(to bottom, #D8ECD6 0%, #6CB46F 100%)
}
.slot-fade{
	outline:#FFD76E solid 6px;
	box-shadow: 0px 0px 1100px 1180px #fff;
}
.help-panel{
	position:fixed;
	width:100%;
	height:100%;
	background-color:rgba(0,0,0,0.7);
	z-index:3000;
	display:none;
}

</style>
<?php
function decorate_debuged_page_header($gridName,$args){

	?>
	<div id="help_panel" class="help-panel">
		<img src="<?php echo plugins_url(); ?>/UiGEN-Core/img/help_drag_and_drop.png" style="float:right; margin-right:10px; margin-top:10px">
	</div>


	<div class="debug-grid-bar-decorator" data-page-name="<?php echo $args['ui_page_name']; ?>">

		<div id="pages_creator">
		</div>

		<div>
			<span style="font-size:24px" class="glyphicon glyphicon-file"></span>
			<span style="font-size:20px">Page:</span> <span id="ui_page_name" style="font-size:22px"><?php echo $args['ui_page_name']; ?></span>

			<div id="add_pages" style="float:right; margin-right:10px; margin-top:3px; font-size:16px">
				<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span><span>Add more Pages</span>
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
					<div id="saved_info_box" style="font-size:12px" class="alert alert-success">

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

function decorate_slot($position,$slotName,$slot){
	if($position=='start'){
	?>
		<div id="<?php echo $slotName; ?>" class="debug-tplpart-decorator">
			<div class="tplpart_decorator_options_panel <?php
			 	if($slot['debug_type'] == 'form'){ echo 'purple'; }
			 	if($slot['debug_type'] == 'list'){ echo 'light-green'; }
			 ?>">
				<span class="glyphicon glyphicon-pushpin"></span> &nbsp; &nbsp; 
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
				  	<li class="slotEdit  disabled">
				  		<a href="Javascript: void(0);" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit Slot</a>
				  	</li>
				  	<?php } ?>

				    <li class="slotProperties disabled">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp; Properties</a>
				    </li>
				    <li class="debugInspect">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp; Script</a>
				    </li>
				    <li class="divider"></li>
				    <li class="deleteSlot">
				    	<a href="Javascript: void(0);"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp; Delete slot</a>
				    </li>
				  </ul>
				</div>


				<!-- <button style="float:right;" type="button" class="debug-edit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</button> -->
				
			</div>

			<div class="portlet-inspect">				
				<textarea  class="" rows="5"><?php
					require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
					
					$fullSlot = array($slotName => $slot);
					$Data = Spyc::YAMLDump($fullSlot);
					echo $Data;
					
				?></textarea>
			</div>	
	<?php
	}
	if($position=='end'){
	?>
		<div style="clear:both; height:0px; font-size:0px">&nbsp;</div>
		</div>
	<?php
	}
}
?>

<!-- Modal -->
<div class="modal fade" id="debugModal" tabindex="-1" role="dialog" aria-labelledby="debugModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="debugModalLabel">Debuger MESSAGE</h4>
      </div>
      <div class="modal-body">
        Not implemented YET
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div id="debug-manager">
</div>

<script>
var donateString = 'This feature not implemented yet.\n If You want donate this please contact me on\ndadmor@gmail.com or wath me on GitHub:\nhttps://github.com/dadmor/UiGEN-Core'
window.onload=function(){

	function startEffect(){
		//jQuery( ".uigen-act-cell" ).fadeIn( "slow", function() {
		    //jQuery( ".tplpart_decorator_options_panel" ).slideDown(300);
		    jQuery( ".tplpart_decorator_options_panel" ).slideDown( "slow", function() {
			    // Animation complete.
			    //jQuery('#debug-manager').css('display','block');
			    jQuery('body').addClass('right250');
				jQuery('#debug-manager').addClass('right0');
			
				jQuery('#onHandler').css('margin-bottom','500px');
				jQuery("#debug-manager").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){ 
					jQuery('#help_panel').fadeIn('slow');
				});
			});
		// });
	}


	jQuery('#ui_grid_selector').mouseenter(function() {
		jQuery('#change-grid').find('span').css('color','#428bca');
	});
	jQuery('#ui_grid_selector').mouseleave(function() {
		jQuery('#change-grid').find('span').css('color','#ccc');
	});



	jQuery('#help_panel').click( "li.slotEdit", function() {
		jQuery('#help_panel').remove();
	});

	jQuery(document).on('click', "li.slotEdit", function() {
		alert(donateString);
	});

	jQuery(document).on('click', "li.formSlotEdit", function() {
		jQuery(this).parent().parent().parent().parent().addClass('slot-fade');
		jQuery(this).parent().parent().parent().parent().css('z-index','100');
		jQuery('#debug-manager').css('z-index','101');
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
			//loadSlotListHandler();
		});
	});


	jQuery(document).on('click', "li.deleteSlot", function() {
		jQuery(this).parent().parent().parent().parent().remove();
		jQuery('#saved_info_box').prepend('<p style="display:none">You deleted slot. You must save this action.</p>');
		jQuery('#saved_info_box').children('p').show('slow');
      	jQuery('#footer_save_info').fadeIn('slow');
	});

	jQuery(document).on('click', "li.slotProperties", function() {
		alert(donateString);
	});

	jQuery(document).on('click', "#footer_save_info .undoLast", function() {
		alert(donateString)
	});

	jQuery(document).on('click', "li.debugInspect", function() {
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

	 	if(jQuery(this).hasClass('open')==true){	 		

	 		//jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('display','none');
	  		//jQuery(this).removeClass('open');
	  		//jQuery(this).removeClass('btn-success');

	 	}else{

 			//jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('textarea').addClass('form-control');
	  		//jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('display','block');
	  		//jQuery(this).addClass('open');
	  		//jQuery(this).addClass('btn-success');
			jQuery('body').addClass('left200');

			//jQuery('#uigen_asset_list').css('display','block');
			jQuery('#uigen_asset_list').css('left','200px');
	  		
  			//var height = jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('pre').height();	  	
 			//jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('textarea').css('height',height+22);
			jQuery('#new-inspector').fadeIn(1000);
			jQuery("html, body").delay(500).animate({scrollTop: jQuery('#new-inspector').offset().top-50 }, 500);

			jQuery('#debug-manager').removeClass('right0');
			jQuery('#debug-manager').addClass('right-200');
			jQuery('body').removeClass('right250');
	  		
		}
	});
	jQuery(document).on('click', "button.debug-close", function() {	
			//jQuery(this).parent().css('display','none');
	  		//jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('open');
	  		//jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('btn-success');
			jQuery('body').removeClass('left200');
			jQuery('#new-inspector').css('display','none');

			jQuery('#new-inspector').children().remove();
			
			jQuery('body').addClass('right250');

			jQuery('#debug-manager').addClass('right0');
			jQuery('#debug-manager').removeClass('right-200');

			//jQuery('#uigen_asset_list').css('display','none');
			jQuery('#uigen_asset_list').css('left','0');
	});

	jQuery(document).on('click', "button.debug-save-yaml", function() {	
			
			jQuery(this).parent().css('display','none');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('open');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('btn-success');

			var progressBar = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
			jQuery('.modal-content').children('div').remove();
			jQuery('.modal-content').append(progressBar);

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

/*	jQuery( ".add_slot" ).mousedown(function() {
		//alert('asdsa');

	});*/



    jQuery( "div, button" ).disableSelection();

	jQuery( "#add_pages" ).click(function() {
		if(jQuery(this).hasClass('open')==true){
			jQuery(this).removeClass('open');
			jQuery( "#pages_creator" ).slideUp(300);
		}else{
			jQuery(this).addClass('open');
			jQuery( "#pages_creator" ).slideDown(500);
		}

	});

	jQuery( "#ui_grid_selector" ).click(function() {
		alert(donateString);
	});

	jQuery( ".debug-urlencode" ).click(function() {
		var YAML = jQuery(this).parent().children('textarea').val();
		jQuery('#debugModal .modal-body').text('?data='+encodeURI(YAML));
		
	});

	var hierarchyJSON = {};
	var reciveGuardian = 0;
	var newElement = 0;

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
			}

      	},
      	receive: function( event, ui ) {
      		reciveGuardian = 1;      	
      	},
      	stop: function( event, ui ) {
      		var droped_name = jQuery(ui.item.context).find('.slot_name').text();
      		if(reciveGuardian == 0){
				jQuery('#saved_info_box').prepend('<p style="display:none">You sorted <b>'+droped_name+' slot</b> into grid handler. You must save this action.</p>');
      		}else{
      			if(newElement == 0){
      				jQuery('#saved_info_box').prepend('<p style="display:none">You replace <b>'+droped_name+' slot</b> into another handler. You must save this action.</p>');
      			}else{
      				jQuery('#saved_info_box').prepend('<p style="display:none">You added new element into grid. You must save this action.</p>');
     			}
      		}
      		jQuery('#saved_info_box').children('p').show('slow');
      		jQuery('#footer_save_info').fadeIn('slow');

      		
      		// add new param to added object
      		jQuery(ui.item.context).css('border','2px solid green');

      	}
	});
	jQuery( ".uigen-act-cell" ).droppable({
      hoverClass: "ui-state-active" ,
    });

    jQuery( ".save_slots_hierarchy" ).click(function() {
		jQuery('#saved_info_box').children().remove();
		jQuery('#footer_save_info').slideUp('slow');

		var progressBar = '<div style="padding:20px;"><div style="margin-top:20px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div>';
		jQuery('.modal-content').children('div').remove();
		jQuery('.modal-content').append(progressBar);

		var get_slot_yaml = '';
		var get_slot_name = '';

		var output_saved_yaml = '';
	    jQuery( "#onHandler .debug-tplpart-decorator" ).each(function( index ) {
					get_slot_name = jQuery( this ).find('.slot_name').text();
	    			get_slot_yaml = jQuery( this ).find('textarea').val();
					
					get_slot_yaml = get_slot_yaml.replace(get_slot_name, get_slot_name + index);
					get_slot_yaml = get_slot_yaml.replace('---\n', '');
					output_saved_yaml += get_slot_yaml;				
		});
		output_saved_yaml = "---\n" + output_saved_yaml;
		
		var output_hierarchy_yaml = "";
		var hierarchy_counter = 0;
		jQuery( "#onHandler .uigen-act-cell" ).each(function( index ) {
			output_hierarchy_yaml = output_hierarchy_yaml + jQuery(this).attr('data-cell') +  ":\n";
			jQuery( jQuery(this).children('.debug-tplpart-decorator') ).each(function( index ) {
				//alert(jQuery(this).attr('id'));
				output_hierarchy_yaml = output_hierarchy_yaml + "  - " + jQuery( this ).find('.slot_name').text() + hierarchy_counter + "\n";
				hierarchy_counter ++;	
			});	
			
			
		});
		output_hierarchy_yaml = "---\n" + output_hierarchy_yaml;
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/save-slot-history_and_properties.php",
			data: { hierarchy_yaml: output_hierarchy_yaml , prop_yaml: output_saved_yaml ,ui_page_name: jQuery('#ui_page_name').text(), ui_grid_name: jQuery('#ui_grid_name').text()}
		})
		.done(function( msg ) {	
			jQuery('.modal-content').children('div').remove();
			jQuery('.modal-content').append(msg);
		});
      		
	});

	function loadSlotList(){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/get-template-part-list.php?debug=true",
			data: { yaml: jQuery(this).parent().children('textarea').val(),ui_page_name: jQuery('#ui_page_name').text() }
		})
		.done(function( msg ) {	
			jQuery('#debug-manager').append(msg);
			loadSlotListHandler();
			startEffect();	
		});
	}
	loadSlotList();	

	function loadSlotListHandler(){

		jQuery('#debug-manager').children('.debug-tplpart-decorator').children('.tplpart_decorator_options_panel').next().next().addClass('ui_slot_element');
		

		jQuery( "#debug-manager .debug-tplpart-decorator" ).draggable({
	      connectToSortable: ".uigen-act-cell",
	      helper: "clone",
	      containment:"document",
	      revert: "invalid"
	    });
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


	jQuery.ajax({
		type: "POST",
		url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-pages-panel.php",
		data: {  }
	})
	.done(function( msg ) {	 
		jQuery('#pages_creator').append(msg);
		//loadSlotListHandler();
	});


	jQuery.ajax({
		type: "POST",
		url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-uigen-assets-list.php",
		data: {  }
	})
	.done(function( msg ) {	 
		jQuery('#uigen_asset_list').append(msg);
		//loadSlotListHandler();
	});


};

</script>