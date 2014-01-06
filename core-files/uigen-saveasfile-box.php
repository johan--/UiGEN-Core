<?php
// ###############################################################################

function saveasfile_box($post, $metabox){
	echo 'savefileBox';

}
// ================================================================================

// save post function
function save_saveasfile_box( $post_id ) {

	include ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-metaboxes/arguments/uigen-metaboxes-arguments.php';
	
	foreach ($uigen_metaboxes as $metabox) {
		// check boxes into current posttype
		if ( $_POST['post_type'] == $metabox[3]) {
			if($metabox[2] == 'alpacaform_box'){

				/*	
				echo '<pre>';
					var_dump($metabox);
				echo '</pre>';
				*/
				
				// Open the file to get existing content
				//$current_content = file_get_contents($file);

				// create file path to save
				$file = $metabox[6]['file_save_url'].get_the_title($post_id).'.'.$metabox[6]['save_data_type'];

				// get file output content
				$current_content = urldecode($_POST[$metabox[0].'_output_field']);

				// change json to php array with output type is php
				if($metabox[6]['save_data_type'] == 'php'){
					//change json content to printed assotiate array
					//$current_content = print_r(json_decode($current_content,true));	
					//$current_content = print_r(json_decode($current_content,true),true);
					//$convertArray = json_decode($current_content,true);
					//echo  key($convertArray);
					//$arr[$newkey] = $arr[$oldkey];
					//unset($arr[$oldkey]);

					$current_content = outArray(json_decode($current_content,true));
					//echo $current_content;			
				}

				// Write the contents back to the file
				if (!is_dir($metabox[6]['file_save_url'])) {
				  // dir doesn't exist, make it
				  mkdir($metabox[6]['file_save_url']);
				}

				// create file
				file_put_contents($file, $current_content);
			}

			
		}  
	} 
	//die();   

}
add_action( 'save_post', 'save_saveasfile_box' );

// ###############################################################################

// CONVERT PHP ARRAY TO STRING

function outArray($array, $lvl=0){
    $sub = $lvl+1;
    $return = "";
    if($lvl==null){
      $return = "\t\$var = array(\n";  
    }
      foreach($array as $key => $mixed){
        $key = trim($key);
        if(!is_array($mixed)){
          $mixed = trim($mixed);
        }
        if(empty($key) && empty($mixed)){continue;}
        if(!is_numeric($key) && !empty($key)){
          if($key == "[]"){
            $key = null;
          } else {
            $key = "'".addslashes($key)."'";
          }
        }

        if($mixed === null){
          $mixed = 'null';
        } elseif($mixed === false){
          $mixed = 'false';
        } elseif($mixed === true){
          $mixed = 'true';
        } elseif($mixed === ""){
          $mixed = "''";
        } 

        //CONVERT STRINGS 'true', 'false' and 'null' TO true, false and null
        //uncomment if needed
        //elseif(!is_numeric($mixed) && !is_array($mixed) && !empty($mixed)){
        //  if($mixed != 'false' && $mixed != 'true' && $mixed != 'null'){
        //    $mixed = "'".addslashes($mixed)."'";
        //  }
        //}


        if(is_array($mixed)){
          if($key !== null){
            $return .= "\t".str_repeat("\t", $sub)."$key => array(\n";
            $return .= outArray($mixed, $sub);
            $return .= "\t".str_repeat("\t", $sub)."),\n";
          } else {
            $return .= "\t".str_repeat("\t", $sub)."array(\n";
            $return .= outArray($mixed, $sub);
            $return .= "\t".str_repeat("\t", $sub)."),\n";            
          }
        } else {
          if($key !== null){
            $return .= "\t".str_repeat("\t", $sub)."$key => $mixed,\n";
          } else {
            $return .= "\t".str_repeat("\t", $sub).$mixed.",\n";
          }
        }
    }
    if($lvl==null){
      $return .= "\t);\n";
    }
    return $return;
  }

?>