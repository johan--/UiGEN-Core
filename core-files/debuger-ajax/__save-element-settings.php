<?php
//echo $_POST['objecttype'].'<br>';
//echo $_POST['page_name'].'<br>';
//var_dump($_POST['object_data']);

require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
require_once( ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/defines-const.php' );
if ( current_user_can( 'manage_options' ) ) {

	$prop_path = GLOBALDATA_PATH . 'template-hierarchy';
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/'.$_POST['page_name'].'-slots-properties.yaml' );

	//var_dump($posttypes_array[$_POST['objecttype']]);
	//echo '<br>---<br>';
    //var_dump($_POST['object_data']);

    $execute_array = array_merge($posttypes_array[$_POST['objecttype']],$_POST['object_data']);
	
	//echo '<br>---<br>';
    //var_dump($execute_array);
    $posttypes_array[$_POST['objecttype']] = $execute_array;

	//var_dump($posttypes_array);
	file_put_contents( $prop_path . '/arguments/'.$_POST['page_name'].'-slots-properties.yaml' , Spyc::YAMLDump( $posttypes_array ));
	?>
	<div class="modal-content">
	  <div class="modal-header modal-success">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-up"></span> SUCCESS</h2>
	  </div>
	  <div class="modal-body">
			<h1>Your settings was saved !!!</h1>
		 </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close message window</button> 
	    <a href="" type="button" class="btn btn-primary">Reload page to see changes</a>
	  </div>
	</div>


	<?php
	} else {
?>
	<div class="modal-content">
	  <div class="modal-header modal-wrong">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-down"></span> WARNING</h2>
	  </div>
	  <div class="modal-body">
			<h1>To Save settings you must be login as Admin</h1>
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
