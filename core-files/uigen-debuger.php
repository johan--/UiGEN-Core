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
#add_pages{
	cursor:pointer;
}

</style>



<?php
function decorate_debuged_page_header($gridName,$args){
	?>
	<div class="debug-grid-bar-decorator">

		<div id="pages_creator">
			<h1>Pages Creator (not available yet)</h1>
			<div style="margin-top:20px; margin-bottom:60px; padding-bottom:40px; border-bottom:1px solid #ccc;">

				<a class="btn btn-primary btn-lg" role="button">
					<div style="float:left; text-align:center; margin-top:10px;">
						<span class="glyphicon glyphicon-file" style="font-size:90px"></span><br/>
						<p>Page1</p>
					</div>
				</a>
				<a class="btn btn-primary btn-lg" role="button">
					<div style="float:left; text-align:center; margin-top:10px;">
						<span class="glyphicon glyphicon-file" style="font-size:90px"></span><br/>
						<p>Page2</p>
					</div>
				</a>
				<a class="btn btn-primary btn-lg" role="button">
					<div style="float:left; text-align:center; margin-top:10px;">
						<span class="glyphicon glyphicon-file" style="font-size:90px"></span><br/>
						<p>Page3</p>
					</div>
				</a>				
				<br style="clear:both"/>
			</div>
		</div>

		<span class="glyphicon glyphicon-th-large"></span> 
		<span>Grid name: <?php echo $gridName; ?></span>

		<div id="add_pages" style="float:right; margin-right:10px">
			<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span><span>Add more Pages</span>
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
					<div id="saved_info_box" class="alert alert-success">

					</div>
				</td>
				<td valign="top" style="padding-left:20px">
					<button type="button" class="btn btn-default btn-success" style="width:210px; margin-bottom:10px">
						<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
					</button>
					<button type="button" class="btn btn-default" style="width:210px; margin-bottom:10px">
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
		<div class="debug-tplpart-decorator">
			<div class="tplpart_decorator_options_panel">
				<span class="glyphicon glyphicon-pushpin"></span> &nbsp; &nbsp; 
				<!--Slot name: --><span class="slot_name"><?php echo $slotName; ?></span>
				
				<div class="btn-group" style="float:right; margin-top:-5px; margin-right:-5px">
				  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				    <span class="glyphicon glyphicon-cog"></span>  <span class="caret" style="vertical-align:2px !important"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="Javascript: void(0);">Edit</a></li>
				    <li class="debugInspect"><a href="Javascript: void(0);">Code</a></li>
				    <li class="divider"></li>
				    <li><a href="Javascript: void(0);">Delete slot</a></li>
				  </ul>
				</div>


				<!-- <button style="float:right;" type="button" class="debug-edit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</button> -->
				
			</div>
			<div class="portlet-inspect">

				<button type="button" class="debug-urlencode btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon glyphicon-link"></span> Encode to URL</button>
				<button type="button" class="debug-save btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save changes</button>
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
	<h2>Slot list</h2>
	<!--
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Simple Logo</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Nav menu</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Single Post</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Post List</button><br/>	
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Promo Slider</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Clients Slider</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Shoping Cart</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Pagination</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Flow Form</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Form Filters</button><br/>
	<button type="button" class="btn btn-default btn-sm" style="width:100%; margin-bottom:5px">Data Grid</button><br/>
-->

	<?php
		require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
			$slotList = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/slot-list.yaml');		
			
			global $DTDC;
			//require_once(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/display-controller.class.php');	
			@$DTDC = new ThemeDisplayController( $post->ID ); 
	 		$DTDC -> args = $slotList;

		foreach ($slotList as $key => $value) {
			
			//var_dump($TDC);
			$DTDC -> tdc_get_slot($key);
			//decorate_slot('start',$key,$slotList[$key]);
			//decorate_slot('end',$slotName,$slot);
		}


	?>

</div>

<script>
window.onload=function(){
	jQuery( ".uigen-act-cell" ).fadeIn( "slow", function() {
	    jQuery( ".tplpart_decorator_options_panel" ).slideDown(300);
	 });
	jQuery('#debug-manager').children('.debug-tplpart-decorator').children('.tplpart_decorator_options_panel').next().next().addClass('ui_slot_element');
	


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

	

/*	jQuery( ".add_slot" ).mousedown(function() {
		//alert('asdsa');

	});*/
	jQuery( "#debug-manager .debug-tplpart-decorator" ).draggable({
      connectToSortable: ".uigen-act-cell",
      helper: "clone",
      containment:"document",
      revert: "invalid"
    });
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


	jQuery( ".debug-urlencode" ).click(function() {
		var YAML = jQuery(this).parent().children('textarea').val();
		jQuery('#debugModal .modal-body').text('?data='+encodeURI(YAML));
		
	});

	

	var reciveGuardian = 0;
	jQuery( ".uigen-act-cell" ).sortable({
		connectWith: ".uigen-act-cell",
      	cursor: 'pointer',
      	// if change sort handler
      	start: function( event, ui ) {
      		reciveGuardian = 0;
      	},
      	receive: function( event, ui ) {
      		reciveGuardian = 1;
      	
      	},
      	stop: function( event, ui ) {
      		if(reciveGuardian == 0){
				jQuery('#saved_info_box').prepend('<p style="display:none">You sorted slots into grid handler. You must save this action.</p>');
      		}else{
      			jQuery('#saved_info_box').prepend('<p style="display:none">You remove slot into another handler. You must save this action.</p>');
      		}
      		jQuery('#saved_info_box').children('p').show('slow');
      		jQuery('#footer_save_info').fadeIn('slow');

      		

      	}
	});
	jQuery( ".uigen-act-cell" ).droppable({
      hoverClass: "ui-state-active" ,
    });

  


	/*jQuery( ".uigen-act-cell" ).droppable({
      accept: "debug-tplpart-decorator",
      activeClass: "ui-state-hover",
      hoverClass: "ui-state-active",
      drop: function( event, ui ) {
        jQuery( this ).addClass( "ui-state-highlight" )
        alert('asdasd'); 
      }      
    });*/
};

</script>

