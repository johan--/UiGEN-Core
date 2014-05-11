<style>

@media only screen 
	and (min-width : 640px)
	and (max-width : 1500px) {

		.container{
			width:80% !important;

		}

}
#debug-manager{
	position:fixed;
	width: 250px;
	height:100%;
	right:0;
	border-left:5px solid #333;
	background-color: #555;
	color:#eee;
	padding:0px 20px;
}
#debug-manager .ui_slot_element{
	display:none;
}
#debug-manager .btn-group{
	display:none;
}
body{
	margin-right:250px !important;
}


.uigen-act-cell{
	border:2px solid #999; 
	padding:10px;
	margin-bottom:10px;
	display:none;
	box-shadow: 0px 0px 10px #888888;
	min-height:60px !important;

}
.ui-state-active{
	border:3px solid #64992C !important;
	box-shadow: 0px 0px 10px green;
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
	background-image: linear-gradient(to bottom, #ffffff 0%, #e0e0e0 100%);
	background-color:#ccc; 
	font-size:14px; 
	display:none; 
	padding:10px;
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
	box-shadow: 0px 0px 50px #333;
}
.portlet-inspect textarea{
	float:left; width:50%; margin:0; padding:6px; font-family:courier; color:navy;
}

#pages_creator{
	display:none;
}
#add_pages,#change-grid{
	cursor:pointer;
}
.modal-dialog{
	margin:50px auto;
}

.purple{
	background-image: linear-gradient(to bottom, #DFC2D0 0%, #95697F 100%)
}
.slot-fade{
	outline:#FFD76E solid 6px;
	box-shadow: 0px 0px 1100px 1180px #fff;
}
.help-panel{
	position:fixed; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000; 
}
</style>
<?php
function decorate_debuged_page_header($gridName,$args){

	?>

	<!--
	 	<div id="help_panel" class="help-panel">
			<img src="<?php echo plugins_url();?>/UiGEN-Core/img/help_drag_and_drop.png" style="float:right; margin-right:100px">
		</div>
	 -->

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
		<div style="margin-top:5px; margin-left:5px; margin-bottom:10px">
			<span class="glyphicon glyphicon-th-large"></span> Grid name:
			<span id="ui_grid_name"><?php echo $gridName; ?></span>
			<div id="change-grid" style="float:right; margin-right:10px; margin-top:3px; font-size:12px">
				<span class="glyphicon glyphicon-refresh"></span><span class="glyphicon glyphicon-th-large"></span><span>Change grid</span>
			</div>
		</div>
		


		<?
			decorate_slot('start',$gridName,$args);
			decorate_slot('end',$gridName,$args);
		?>			
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
	
	<?php
}

function decorate_slot($position,$slotName,$slot){
	if($position=='start'){
	?>
		<div id="<?php echo $slotName; ?>" class="debug-tplpart-decorator">
			<div class="tplpart_decorator_options_panel <?php if($slot['debug_type'] == 'form'){ echo 'purple'; }?>">
				<span class="glyphicon glyphicon-pushpin"></span> &nbsp; &nbsp; 
				<!--Slot name: --><span class="slot_name"><?php echo $slotName; ?></span>
				
				<div class="btn-group" style="float:right; margin-top:-5px; margin-right:-5px">
				  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				    <span class="glyphicon glyphicon-cog"></span>  <span class="caret" style="vertical-align:2px !important"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				  	<?php if($slot['debug_type'] == 'form'){ ?>
				  	<li class="formSlotEdit">
				  		<a href="Javascript: void(0);"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit Form </a>
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
			
				<button type="button" class="debug-urlencode btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon glyphicon-link"></span> Encode to URL</button>
				<button type="button" class="debug-save-yaml btn btn-success" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save code</button>
				<button type="button" class="debug-close btn btn-danger" style="float:right"><span class="glyphicon glyphicon-remove-circle"></span> Close</button>
				
				<h2>Programmers Mode::Object properties</h2>
				
				Data editor usage YAML syntax (<a href="http://wikipedia.org/wiki/YAML" target="_blank">about YAML on Wiki</a>)	
				<br/>	
				<br/>			
				<textarea  class="" rows="5"><?php
					require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
					
					$fullSlot = array($slotName => $slot);
					$Data = Spyc::YAMLDump($fullSlot);
					echo $Data;
					
			?></textarea>
			<pre style="float:left; width:50%; margin:0; padding:10px;"><?php echo $slotName.":"; print_r($slot); ?></pre>
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


function decorate_template_parts($position){
	/*if($position=='start'){
	?>
		<div style="outline:#9E9E9E dashed 1px; margin-top:2px">
	<?php
	}
	if($position=='end'){
	?>
		<br style="clear:both"/>
		</div>
	<?php
	}*/
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

	jQuery( ".uigen-act-cell" ).fadeIn( "slow", function() {
	    jQuery( ".tplpart_decorator_options_panel" ).slideDown(300);
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

		jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('left','10');
		jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('min-width',jQuery(window).width()-500);

	 	if(jQuery(this).hasClass('open')==true){
	 		

	 		jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('display','none');
	  		jQuery(this).removeClass('open');
	  		jQuery(this).removeClass('btn-success');

	 	}else{
 			jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('textarea').addClass('form-control');
	  		jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').css('display','block');
	  		jQuery(this).addClass('open');
	  		jQuery(this).addClass('btn-success');

	  		
  			var height = jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('pre').height();	  	
 			jQuery(this).parent().parent().parent().parent().children('.portlet-inspect').children('textarea').css('height',height+22);

	  		
		}
	});
	jQuery(document).on('click', "button.debug-close", function() {	
			jQuery(this).parent().css('display','none');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('open');
	  		jQuery(this).parent().prev().children('.btn-group').children('.dropdown-menu').children('.debugInspect').removeClass('btn-success');
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
			  url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/save-yaml.php",
			  data: { yaml: jQuery(this).parent().children('textarea').val(),ui_page_name: '<?php echo $ui_page_name; ?>' }
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

	jQuery( "#change-grid" ).click(function() {
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
			data: { yaml: jQuery(this).parent().children('textarea').val(),ui_page_name: '<?php echo $ui_page_name; ?>' }
		})
		.done(function( msg ) {	
			jQuery('#debug-manager').append(msg);
			loadSlotListHandler();
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
	  if(debugerHref != '#'){
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

};

</script>