<div class="modal-content">
  <div class="modal-header modal-success">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2 class="modal-title" id="debugModalLabel"><span class="glyphicon glyphicon-thumbs-up"></span> SUCCESS</h2>
  </div>
  <div class="modal-body">
  	<h1>Your Slot CODE was SAVED !!!</h1>
    <?php
    
    //echo $_POST['ui_page_name'].'</br>';
    //echo $_POST['ui_grid_name'].'</br>';
		//echo $_POST['yaml'];
    require_once("../../../../../wp-load.php");
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
      file_put_contents( GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , $returnYAML);

    }else{
      $returnYAML = Spyc::YAMLDump(ui_merge_data_array($loaded_orginal_YAML,$loaded_saved_YAML));
      file_put_contents( GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , $returnYAML);
    }


	?>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close and dont previw saved changes</button> 
    <a href="<?php the_permalink(); ?>" type="button" class="btn btn-primary">Reload page to see changes<a>
  </div>
</div>