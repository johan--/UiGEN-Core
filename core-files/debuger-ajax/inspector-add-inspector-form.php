

<button type="button" class="debug-close btn btn-danger" style="float:right"><span class="glyphicon glyphicon-remove-circle"></span> Close</button>

<h2>Programmers Mode::Object properties</h2>
<p style="font-size:10px">
Data editor usage YAML syntax (<a href="http://wikipedia.org/wiki/YAML" target="_blank">about YAML on Wiki</a>)	
<br/>	
 Human-readable data serialization format that takes concepts from programming languages such as C, Perl, and Python, and ideas from XML and the data format of electronic mail (RFC 2822). YAML was first proposed by Clark Evans in 2001, who designed it together with Ingy döt Net and Oren Ben-Kiki.[2] It is available for several programming languages.
</p>
	
<textarea  style="width:100%" rows="15"><?php
	$returnYAML = $_POST['yaml'];
	$returnYAML = str_replace("'","",$returnYAML);
    $returnYAML = stripslashes($returnYAML);
	echo $returnYAML;
	
?></textarea>
<button type="button" class="debug-urlencode btn btn-primary" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon glyphicon-link"></span> Encode to URL</button>
<button type="button" class="debug-save-yaml btn btn-success" data-toggle="modal" data-target="#debugModal"><span class="glyphicon glyphicon-floppy-disk"></span> Save code</button>
