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
body{
	margin-right:250px !important;
}


.uigen-act-cell{
	border:2px dashed #999; 
	padding:10px 5px;
	margin-bottom:10px;
	display:none;
	box-shadow: 0px 0px 5px #888888;

}
.ui-state-hover,.ui-state-active,.ui-sortable-placeholder{
	border:2px dashed green !important;
}
.modal-title{padding:10px; font-size:16px;}
.container{
	transition: border-width 0.5s ease-in-out;
}
.row div{
	-webkit-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	-moz-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	-o-transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;
	transition: color 2s, outline-color .7s ease-out, margin 1s ease-in-out;

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
	border-top:2px solid #333; 
	margin:10px; 
	border:1px solid #9E9E9E; 
	margin-bottom:5px; 
}
.tplpart_decorator_options_panel{
	background-color:#ccc; 
	font-size:14px; 
	display:none; 
	padding:10px
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
	margin-left:-20px;
	margin-top:10px;
	border-radius: 10px;
	box-shadow: 0px 0px 50px #333;
}
.portlet-inspect textarea{
	float:left; width:50%; margin:0; padding:6px; font-family:courier; color:navy;
}

</style>

<div id="debug-manager">
	<h2>Slot list</h2>
</div>

<?php
function decorate_debuged_page_header($gridName,$args){
	?>
	<div class="debug-grid-bar-decorator">
		<span class="glyphicon glyphicon-th-large"></span> 
		Grid name: <?php echo $gridName; ?>
		<?
		decorate_slot('start',$gridName,$args);
		decorate_slot('end',$gridName,$args);
		?>			
	</div>
	
	<?php
}

function __decorate_slot($position,$slotName,$slot){
	if($position=='start'){
		?>
			<div style="position:absolute; display:inline; border:2px solid red; background-color:yellow">
		<?php
	}
	if($position=='end'){
		?>
			</div>
		<?php
	}
}
function decorate_slot($position,$slotName,$slot){
	if($position=='start'){
	?>
		<div class="debug-tplpart-decorator">
			<div class="tplpart_decorator_options_panel">
				<span class="glyphicon glyphicon-pushpin"></span> 
				Slot name: <?php echo $slotName; ?>
				
				<button style="float:right;" type="button" class="debug-inspect btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> Inspect</button>
				<!-- <button style="float:right;" type="button" class="debug-edit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</button> -->
				
			</div>
			<div class="portlet-inspect">
				<button type="button" class="debug-urlencode btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon glyphicon-link"></span> Encode to URL</button>
				<button type="button" class="debug-save btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save changes</button>
				<br/>
				
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
		<br style="clear:both"/>
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

<script>
window.onload=function(){
	jQuery( ".uigen-act-cell" ).fadeIn( "slow", function() {
	    jQuery( ".tplpart_decorator_options_panel" ).slideDown('slow');
	 });
	
	jQuery( ".debug-inspect" ).click(function() {

		jQuery(this).parent().parent().children('.portlet-inspect').css('left','10');
		jQuery(this).parent().parent().children('.portlet-inspect').css('min-width',jQuery(window).width()-500);

	 	if(jQuery(this).hasClass('open')==true){
	 		

	 		jQuery(this).parent().parent().children('.portlet-inspect').css('display','none');
	  		jQuery(this).removeClass('open');
	  		jQuery(this).removeClass('btn-success');

	 	}else{
 			jQuery(this).parent().parent().children('.portlet-inspect').children('textarea').addClass('form-control');
	  		jQuery(this).parent().parent().children('.portlet-inspect').css('display','block');
	  		jQuery(this).addClass('open');
	  		jQuery(this).addClass('btn-success');

	  		
  			var height = jQuery(this).parent().parent().children('.portlet-inspect').children('pre').height();	  	
 			jQuery(this).parent().parent().children('.portlet-inspect').children('textarea').css('height',height+22);

	  		
		}
	});

	jQuery( ".colored-grid" ).click(function() {
		if(jQuery(this).hasClass('open')==true){
			jQuery(this).removeClass('open');
			jQuery(".container").css('background-color','rgba(72,136,239,0)');
			jQuery(".container").css('border','0');

			jQuery(".row div").css('outline','0');

			jQuery(".debug-tplpart-decorator").css('-moz-box-shadow','none');
			jQuery(".debug-tplpart-decorator").css('-webkit-box-shadow','none');
			jQuery(".debug-tplpart-decorator").css('box-shadow','none');
			
		}else{
			jQuery(this).addClass('open');
			jQuery(".container").css('background-color','rgba(72,136,239,0.08)');
			jQuery(".container").css('border','10px solid rgba(72,136,239,0.1)');

			jQuery(".row div").css('outline','rgba(255,218,17,0.5) solid 1px');
			jQuery(".row div").css('margin','10px');

			jQuery(".debug-tplpart-decorator").css('-moz-box-shadow','1px 1px 5px #888');
			jQuery(".debug-tplpart-decorator").css('-webkit-box-shadow','1px 1px 5px #888');
			jQuery(".debug-tplpart-decorator").css('box-shadow','1px 1px 5px #888');
		}

	});
	jQuery( ".debug-urlencode" ).click(function() {
		var YAML = jQuery(this).parent().children('textarea').val();
		jQuery('#debugModal .modal-body').text('?data='+encodeURI(YAML));
		
	});


	jQuery( ".uigen-act-cell" ).sortable({
				connectWith: ".uigen-act-cell",
      			cursor: 'pointer',
			}
		);
	jQuery( ".uigen-act-cell" ).droppable({
      accept: "debug-tplpart-decorator",
      activeClass: "ui-state-hover",
      hoverClass: "ui-state-active",
      drop: function( event, ui ) {
        jQuery( this )
          .addClass( "ui-state-highlight" )
         
      }      
    });
};

</script>

