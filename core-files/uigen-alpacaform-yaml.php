<?php
  function add_ui_alpaca($htmlNodeID,$schemaSource,$options){
?>
  <script type="text/javascript">
      jQuery(document).ready(function($) {
        window.alpacaGlobalObj = new Array();       
        $("#<?php echo $htmlNodeID; ?>").alpaca({  
            // ----------------------------------------------
            // read data json from postmeta
            <?php
            if(strlen($data)>0){
              echo '"data":'.$data.','; 
            }
            ?>
            // ----------------------------------------------
            //"optionsSource": "<?php //echo $metabox['args']['data_path'].$metabox['args']['options_file'];?>",
            "schemaSource": "<?php echo $schemaSource;?>",
            "options": "<?php echo $options;?>",
            // ----------------------------------------------
            // add form methods
            "postRender": function(renderedForm) {          
              $('select, input, textarea').live('change',function() {    
                //if (renderedForm.isValid(true)) {
                  var val = renderedForm.getValue();
                  $('#<?php echo $metabox["id"]."_output_field"; ?>').val(encodeURIComponent(JSON.stringify(val))); 
                //}
              });
            } 
            // ----------------------------------------------      
          }
          );
  });
  </script>
<?php
}
?>