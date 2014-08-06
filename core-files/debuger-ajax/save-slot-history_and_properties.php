<?php
require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	

if ( current_user_can( 'manage_options' ) ) {
	
	/* WARNING - Stripshlashes post data - but only to admin or high level users */
	$prop_data = str_replace("'","",$_POST['prop_yaml']);
	$prop_data = Spyc::YAMLLoadString(stripslashes($prop_data));

	
	
	$prop_data['grid'] = $_POST['ui_grid_name'];
	$prop_data['ui_page_name'] = $_POST['ui_page_name'];
	$prop_data['ui_slot_list_name'] = $_POST['ui_slot_list'];
	

	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';

	file_put_contents( $prop_path . 'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , Spyc::YAMLDump( $prop_data ));

	$hierarchy_data = Spyc::YAMLLoadString($_POST['hierarchy_yaml']);
	file_put_contents( $prop_path . 'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-hierarchy.yaml' , Spyc::YAMLDump( $hierarchy_data ));
	

	?>
	<div class="modal-content">
	  <div class="modal-header modal-success">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-up"></span> SUCCESS</h2>
	  </div>
	  <div class="modal-body">
			<h1>Your hierarchy was saved !!!</h1>
		 </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close message window</button> 
	    <a href="" type="button" class="btn btn-primary">Reload page to see changes</a>
	  </div>
	</div>


	<?php

/*	echo '<div style="padding:20px">';
	echo '<h3>Page:'.$_POST['ui_page_name'].'</h3>';
	echo '<h4>Grid:'.$_POST['ui_grid_name'].'</h4>';
	echo '<h4>Properties:</h4>';
	echo '<pre style="font-size:11px;">';
	var_dump($_POST['prop_yaml']);
	echo '</pre>';
	echo '<h4>hierarchy:</h4>';
	echo '<pre  style="font-size:11px;">';
	var_dump($_POST['hierarchy_yaml']);
	echo '</pre>';
	echo '</div>';*/

} else {
?>
	<div class="modal-content">
	  <div class="modal-header modal-wrong">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-down"></span> WARNING</h2>
	  </div>
	  <div class="modal-body">
			<h1>To Save hierarchy you must be login as Admin</h1>
		 </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close warning box</button> 
	    <a href="<?php echo wp_login_url( home_url() ); ?>/?debug=true" type="button" class="btn btn-primary" title="Login">Login</a>
	  </div>
	</div>
	
		
<?php
	/*_e('This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core','basic');*/

}



?>
