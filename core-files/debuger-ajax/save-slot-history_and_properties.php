<?php
require_once("../../../../../wp-load.php");
require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	

if ( current_user_can( 'manage_options' ) ) {
	
	$prop_data = Spyc::YAMLLoadString($_POST['prop_yaml']);
	
	$prop_data['grid'] = $_POST['ui_grid_name'];
	$prop_data['ui_page_name'] = $_POST['ui_page_name'];

	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/';
	file_put_contents( $prop_path . 'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , Spyc::YAMLDump( $prop_data ));

	$hierarchy_data = Spyc::YAMLLoadString($_POST['hierarchy_yaml']);
	file_put_contents( $prop_path . 'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-hierarchy.yaml' , Spyc::YAMLDump( $hierarchy_data ));


} else {
?>
	<pre class="alert alert-danger">To Save hierarchy you must be logged in as Admin</pre>
	<h1>Local storage save to not admin users</h1>
		
<?php
_e('This feature not implemented yet.<br/>If You want donate this please contact me on</br>dadmor@gmail.com or wath me on GitHub:</br>https://github.com/dadmor/UiGEN-Core','basic');
	
}


echo '<div style="padding:20px">';
echo '<h1>Page:'.$_POST['ui_page_name'].'</h1>';
echo '<h2>Grid:'.$_POST['ui_grid_name'].'</h2>';
echo '<h2>Properties:</h2>';
echo '<pre style="font-size:11px;">';
var_dump($_POST['prop_yaml']);
echo '</pre>';
echo '<h2>hierarchy:</h2>';
echo '<pre  style="font-size:11px;">';
var_dump($_POST['hierarchy_yaml']);
echo '</pre>';
echo '</div>';
?>