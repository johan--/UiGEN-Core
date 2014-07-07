<?php
require_once("../../../../../wp-load.php");
?>
<div class="panel-group" id="accordion">
		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <p class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		          Grids
		        </a>
		      </p>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in">
		      <div class="panel-body">
		        <?php
					if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/grids')) {
					        while (false !== ($entry = readdir($handle))) {
					            if ($entry != "." && $entry != "..") {
					                echo '<div>'.substr($entry, 5, -4).'</div>';
					            }
					        }
					        closedir($handle);
					   }
		        ?>
		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <p class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
		          Content-parts
		        </a>
		      </p>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse">
		      <div class="panel-body">
		         <?php
					if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/content')) {
					        while (false !== ($entry = readdir($handle))) {
					            if ($entry != "." && $entry != "..") {
					                echo '<div>'.substr($entry, 8, -4).'</div>';
					            }
					        }
					        closedir($handle);
					   }
		        ?>
		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <p class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
		          Form parts
		        </a>
		      </p>
		    </div>
		    <div id="collapseThree" class="panel-collapse collapse">
		      <div class="panel-body">
		         <?php
					if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/forms')) {
					        while (false !== ($entry = readdir($handle))) {
					            if ($entry != "." && $entry != "..") {
					                echo '<div>'.substr($entry, 5, -4).'</div>';
					            }
					        }
					        closedir($handle);
					   }
		        ?>
		      </div>
		    </div>
		  </div>

		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <p class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
		          Flow
		        </a>
		      </p>
		    </div>
		    <div id="collapseFour" class="panel-collapse collapse">
		      <div class="panel-body">
		         <?php
					if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/flow')) {
					        while (false !== ($entry = readdir($handle))) {
					            if ($entry != "." && $entry != "..") {
					                echo '<div>'.substr($entry, 0, -4).'</div>';
					            }
					        }
					        closedir($handle);
					   }
		        ?>
		      </div>
		    </div>
		  </div>

		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <p class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
		          Walkers
		        </a>
		      </p>
		    </div>
		    <div id="collapseFive" class="panel-collapse collapse">
		      <div class="panel-body">
		         <?php
					if ($handle = opendir(TEMPLATEPATH.'/theme-template-parts/walkers')) {
					        while (false !== ($entry = readdir($handle))) {
					            if ($entry != "." && $entry != "..") {
					                echo '<div>'.substr($entry, 0, -4).'</div>';
					            }
					        }
					        closedir($handle);
					   }
		        ?>
		      </div>
		    </div>
		  </div>

		</div>

		<script>

	jQuery('#uigen_asset_list .panel-body div').mouseenter(function() {
		jQuery(this).css('color','#428bca');
		jQuery(this).css('background-color','#333');
		jQuery(this).css('outline','#333 solid thick');

	});
	jQuery('#uigen_asset_list .panel-body div').mouseleave(function() {
		jQuery(this).css('color','#333');
		jQuery(this).css('background-color','initial');
		jQuery(this).css('outline','initial');
	});
	jQuery('#uigen_asset_list .panel-body div').click(function() {
		var donateString = 'Copy asset name to CLIPBOARD.\n\nThis feature not implemented yet.\n If You want donate this please contact me on\ndadmor@gmail.com or wath me on GitHub:\nhttps://github.com/dadmor/UiGEN-Core'
		alert(donateString)
	});


/*jQuery('body').bind('paste', function(e) {
	var data = e.originalEvent.clipboardData.getData('Text');
	if (data.length > 10) {
		return false;
	} else {
		return true;
	}
});*/
		</script>