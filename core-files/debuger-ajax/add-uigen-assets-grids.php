<?php
require_once("../../../../../wp-load.php");
        echo '<div style="color:#aaa">'.$_POST['ui_grid_name'].'</div>';
?>
<style>

.uigen-act-cell{
/* 	border:0 !important;
outline:#333 solid 1px; */
	min-height:20px !important;
	margin-bottom:4px !important;
}
.panel-body{
	padding:10px 0px !important;
}
.content-container .uigen-act-cell{min-height:35px !important; }

</style>
<div style="padding:0px 5px">
<h2 style="color:#ccc; margin-top:10px"><span class="glyphicon glyphicon-th"></span> Select GRID <span id="asset_grid_close" style="float:right" class="glyphicon glyphicon-remove-sign"></span></h2>
</div>
<div class="panel-group" id="accordion">
  
        <?php

			if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/grids')) {
		        $counter = 0;
		        while (false !== ($entry = readdir($handle))) {
		           $grid = $entry;
		           $counter++;

		           if( substr($entry, 5, -4) == $_POST['ui_grid_name'] ){
						$current = 'background-image:linear-gradient(to bottom,#428bca 0,#357ebd 100%); border:1px solid #999 !important; outline: 2px solid #111 !important;';
		           }else{
						$current = '';
		           }
		           ?>
					<div class="panel panel-default active">
					    <div class="panel-heading" style="<?php echo $current; ?>">
					      <p class="panel-title">
					        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $counter; ?>">
					          <?php
					            	if ($entry != "." && $entry != "..") {
					                	echo substr($entry, 5, -4);
					            	}
			            		?>
					        </a>
					      </p>
					    </div>
					    <div id="collapse<?php echo $counter; ?>" class="panel-collapse collapse">
					      <div class="panel-body">

				           <?php

							$display_mode = true;
							include TEMPLATEPATH.'/theme-template-parts/grids/'.$grid; 

			
				            
				           ?>
					      </div>
					       <div class="panel-footer">
								<a class="set_this_grid" href="" style="float:right"><span class="glyphicon glyphicon-ok-circle"></span> Set this grid</a>
								<br style="clear:both"/>
					       </div>
					    </div>
					  </div>

		            <?php

		        }
		        closedir($handle);
			}
        ?>

 
</div>
<script>
jQuery(document).on('click', "button.debug-save-yaml", function() {	
	jQuery.ajax({
		type: "POST",
		url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/inspector-save-yaml.php",
		data: { 
			yaml: 'grid:xshit',
			ui_page_name: jQuery('#ui_page_name').text(),
			ui_grid_name: jQuery('#ui_grid_name').text(),
		}
	})
	  .done(function( msg ) {
	  	jQuery('.modal-content').children('div').remove();
	  	jQuery('.modal-content').append(msg);
	    
	});
});
</script>