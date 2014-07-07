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
<div style="float:left;">
<h2>Slot List</h2> 
</div>
<div style="float:right; margin-top:16px">
<span style="font-size:20px" class="debuger-all-options glyphicon glyphicon-align-justify"></span>
</div>
<br style="clear:both">
<?php

	require_once("../../../../../wp-load.php");


	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$all_properties = Spyc::YAMLLoadString($_POST['yaml']);
	$listYaml = $all_properties[key($all_properties)]['ui_slot_list_name'];
	if($listYaml == ''){
		$listYaml = 'slot-list';
	}
	$slotList = Spyc::YAMLLoad(ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/schemas/'.$listYaml.'.yaml');		
	

	

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
	}
	
	
?>