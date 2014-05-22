<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" id="debugModalLabel">SUCCESS</h4>
  </div>
  <div class="modal-body">
  	<p>Your Slot CODE was SAVED!</p>
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



    $returnYAML = Spyc::YAMLDump(ui_merge_data_array($loaded_orginal_YAML,$loaded_saved_YAML));

  // if grid-name == first key then this is all properties array
  // if grid-name != first key then this is slot properties

    if($_POST['ui_page_name'] == $_POST['ui_grid_name']){
      echo '<pre>';
      echo 'change main properties not implemented YET';
      echo '</pre>';
    }else{
     
      file_put_contents( GLOBALDATA_PATH.'template-hierarchy/arguments/'.$_POST['ui_page_name'].'-slots-properties.yaml' , $returnYAML);
    }


	?>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close and dont previw saved changes</button> 
    <a href="<?php the_permalink(); ?>" type="button" class="btn btn-primary">Reload page to see changes<a>
  </div>
</div>