<?php
require_once("../../../../../wp-load.php");
        echo '<div style="color:#aaa">'.$_POST['ui_grid_name'].'</div>';
?>
<style>
.all-options-buttons{
	margin:0 -25px; padding:10px 25px; border-bottom:1px solid #222; cursor:pointer;
}
.all-options-buttons:hover{
	background-color:#222;
}
.all-options-buttons span{
	color:rgb(160, 203, 239);
}

</style>
<div style="float:left;">
<h2>All Options</h2> 
</div>
<div style="float:right; margin-top:16px">
<span style="font-size:20px" class="debuger-all-options glyphicon glyphicon-align-justify"></span>
</div>
<br style="clear:both">

<div class="all-options-buttons" style="border-top:1px solid #222;" id="all_pages_selector">
	<span class="glyphicon glyphicon-file"></span> &nbsp; Add/edit pages
</div>
<div class="all-options-buttons" id="all_tax_selector">
	<span class="glyphicon glyphicon-tag"></span> &nbsp; Add/edit texonomies
</div>
<div class="all-options-buttons" id="xxall_grid_selector">
	<span class="glyphicon glyphicon-globe"></span> &nbsp; LandingPage content map
</div>
<div class="all-options-buttons" id="xxall_grid_selector">
	<span class="glyphicon glyphicon-tint"></span> &nbsp; Change skin
</div>
<div class="all-options-buttons" id="all_grid_selector">
	<span class="glyphicon glyphicon-th"></span> &nbsp; Change grid
</div>
<div class="all-options-buttons" id="xxall_grid_selector">
	<span class="glyphicon glyphicon-retweet"></span> &nbsp; Rebuild slots
</div>
<div class="all-options-buttons" id="xxall_grid_selector">
	<span class="glyphicon glyphicon-bullhorn"></span> &nbsp; Tutorials set
</div>

