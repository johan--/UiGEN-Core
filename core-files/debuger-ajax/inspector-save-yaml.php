
    <?php
    
    //echo $_POST['ui_page_name'].'</br>';
    //echo $_POST['ui_grid_name'].'</br>';
		//echo $_POST['yaml'];
    require_once("../../../../../wp-load.php");
   


if ( current_user_can( 'manage_options' ) ) { 

?>

<div class="modal-content">
  <div class="modal-header modal-success">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-up"></span> SUCCESS</h2>
  </div>
  <div class="modal-body">
    <h1>Your Slot CODE was SAVED !!!</h1>
<?php


    require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
    require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/init-uigen-yaml-get-merge.php';
    //$loadedYAML = Spyc::YAMLLoadString(GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml');
   
    $loaded_orginal_YAML = Spyc::YAMLLoad(GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml');
    


    $loaded_saved_YAML = Spyc::YAMLLoadString($_POST['yaml']);
    
    //$YAMLParsedArray = Spyc::YAMLDump($loadedYAML);


    // if grid-name == first key then this is all properties array
    // if grid-name != first key then this is slot properties
    $first_key = key($loaded_saved_YAML);

    if($first_key == $_POST['ui_grid_name']){
      //var_dump($loaded_saved_YAML[$_POST['ui_grid_name']]);
      $returnYAML = Spyc::YAMLDump(ui_merge_data_array($loaded_orginal_YAML,$loaded_saved_YAML[$_POST['ui_grid_name']]));

      /* WARNING - Stripshlashes post data - but only to admin or high level users */
      $returnYAML = str_replace("'","",$returnYAML);
      $returnYAML = stripslashes($returnYAML);
      file_put_contents( GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , $returnYAML);

    }else{
      $returnYAML = Spyc::YAMLDump(ui_merge_data_array($loaded_orginal_YAML,$loaded_saved_YAML));
      
      /* WARNING - Stripshlashes post data - but only to admin or high level users */
      $returnYAML = str_replace("'","",$returnYAML);
      $returnYAML = stripslashes($returnYAML);
      file_put_contents( GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , $returnYAML);
    }

?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close and dont previw saved changes</button> 
      <a href="<?php the_permalink(); ?>" type="button" class="btn btn-primary">Reload page to see changes<a>
    </div>
  </div>
<?php

}else{

?>
  <div class="modal-content">
    <div class="modal-header modal-wrong">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-down"></span> WARNING</h2>
    </div>
    <div class="modal-body">
      <h1>To Save code you must be login as Admin</h1>
     </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close warning box</button> 
      <a href="<?php echo wp_login_url( home_url() ); ?>/?debug=true" type="button" class="btn btn-primary" title="Login">Login</a>
    </div>
  </div>



<?php

}

	?>
