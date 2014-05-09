<?php
require_once("../../../../../wp-load.php");
?>
<style>
#pages-panel-add-form{
	display:none;
}
#pages-panel-add-buttons button{
	color:#333;
}
#pages-panel-add-buttons span{
	color:#428BCA;
}
</style>




<h1>Pages Creator</h1>

<?php
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$prop_path = ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/uigen-posttype';
	$posttypes_array = Spyc::YAMLLoad( $prop_path . '/arguments/uigen-posttype-creator-arguments.yaml' );
	foreach ($posttypes_array as $key => $value) {
		?>		
			<div class="panel panel-primary" style="width:200px; float:left; margin-right:10px;">
				<div class="panel-heading"> 
			  		<span class="glyphicon glyphicon-briefcase"></span>
			  		<?php echo $value['template_hierarchy']['label']; ?>
				</div>
				<!-- <div class="panel-body"></div> -->
				<ul class="list-group">
				    <li class="list-group-item"><span class="glyphicon glyphicon-file"></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-view/?debug=true'; ?>">View</a></li>	    
				    <li class="list-group-item"><span class="glyphicon glyphicon-file"></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-form/?debug=true'; ?>">Form</a></li>
				    <li class="list-group-item"><span class="glyphicon glyphicon-file"></span> <a href="<?php echo get_bloginfo('home') . '/' . $key . '-list/?debug=true'; ?>">List</a></li>
				</ul>
				<div class="panel-footer"><a href="#">More options</a></div>
			</div>
		<?
	}
?>







<br style="clear:both"/>
<div id="pages-panel-add-buttons">	
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="page">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> Add new page
	</button>
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="posttype">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-briefcase"></span> Add new posttype
	</button>
	<button type="button" class="add-new-page-button btn btn-lg" style="" data-object-type="user">
		<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-user"></span> Add new users
	</button>
</div>
<br style="clear:both"/>	

<div id="pages-panel-add-form" data-object-type="" class="panel panel-primary" style="">
	<div class="panel-heading"> 
  		<span class="glyphicon glyphicon-briefcase"></span>
  		Add new object
	</div>
	<div class="panel-body">
		<div class="form-group">
		    <label for="exampleInputEmail1">Object name</label>
		    <input  type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter object name">
		  </div>
	</div>		
	<div class="panel-footer">
		<button id="pages-panel-add-new" type="button" class="btn btn-success" style="float:right">
			<span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span> Add new object
		</button>
		<br style="clear:both"/>	
	</div>
</div>

<br style="clear:both"/>


<script>

jQuery( ".add-new-page-button" ).click(function() {
	jQuery('#pages-panel-add-form').slideDown(300);

	jQuery('#pages-panel-add-new').attr('data-object-type',jQuery(this).attr('data-object-type'));
});
jQuery( "#pages-panel-add-new" ).click(function() {
	
	jQuery('#pages-panel-add-form').slideUp(300);
	jQuery('#debugModal').modal('show');

	jQuery.ajax({
		type: "POST",
		url: "<?php echo plugins_url();?>/UiGEN-Core/core-files/debuger-ajax/add-object-from-pages-panel.php",
		data: { objecttype: jQuery('#pages-panel-add-new').attr('data-object-type'), objectname: jQuery('#pages-panel-add-form input').val()}
	})
	.done(function( msg ) {	
		jQuery('.modal-content').children('div').remove();
		jQuery('.modal-content').append(msg);
	});
	
});
	 
	

</script>