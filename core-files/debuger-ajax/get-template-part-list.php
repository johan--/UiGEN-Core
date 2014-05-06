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
<h2>Slot List</h2>
<?php


		require_once("../../../../../wp-load.php");
		require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
		$slotList = Spyc::YAMLLoad(TEMPLATEPATH . '/theme-template-parts/template-hierarchy/slot-list.yaml');		
		
		global $DTDC;
		require_once(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/display-controller.class.php');	
		@$DTDC = new ThemeDisplayController( $post->ID ); 
 		$DTDC -> args = $slotList;
		require_once  TEMPLATEPATH.'/theme-template-parts/flow/basic-test-flow.php'; 
		@require_once(ABSPATH . 'wp-content/plugins/UiGEN-Core/class/send-post-data_eachwalker.class.php');
		global $SPD; 
		$SPD = new SendPostData( $data_arg ); 
		$DTDC -> postFormObject = $SPD;


		foreach ($slotList as $key => $value) {

			$DTDC -> tdc_get_slot($key);
			//decorate_slot('start',$key,$slotList[$key]);
			//decorate_slot('end',$slotName,$slot);
		}




function decorate_slot($position,$slotName,$slot){
	if($position=='start'){
	?>
		<div class="debug-tplpart-decorator">
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
				<button type="button" class="debug-save-yaml btn btn-success" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save changes</button>
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

		
?>