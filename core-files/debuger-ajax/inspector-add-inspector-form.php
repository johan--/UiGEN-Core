
<button type="button" class="debug-urlencode btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon glyphicon-link"></span> Encode to URL</button>
<button type="button" class="debug-save-yaml btn btn-success" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save code</button>
<button type="button" class="debug-close btn btn-danger" style="float:right"><span class="glyphicon glyphicon-remove-circle"></span> Close</button>

<h2>Programmers Mode::Object properties</h2>
<p>
Data editor usage YAML syntax (<a href="http://wikipedia.org/wiki/YAML" target="_blank">about YAML on Wiki</a>)	
<br/>	
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, voluptatibus, enim, animi, voluptas ad perferendis adipisci assumenda libero porro voluptate suscipit nihil laborum unde distinctio ipsum atque eveniet quasi molestiae.
</p>
	
<textarea  class="" rows="5"><?php
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	
	$fullSlot = array($slotName => $slot);
	$Data = Spyc::YAMLDump($fullSlot);
	echo $Data;
	
?></textarea>
<pre style="float:left; width:50%; margin:0; padding:10px;"><?php echo $slotName.":"; print_r($slot); ?></pre>