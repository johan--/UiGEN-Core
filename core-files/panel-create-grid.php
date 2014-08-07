
<style>
	.container{margin-bottom:20px; position:relative;}
	.sortable-helper{position:relative; width:840px; height:140px;}
	.sortable { width:100%; height:100%; position:relative; list-style-type: none; margin: 0; padding: 0;  border:1px dashed #ccc;  background-color:#fff; box-shadow: inset 3px 3px 5px rgba(0,0,0,0.1);}
	.sortable li { background-image:none; background-color:#efefef; height: 70px; border:0; box-shadow: inset -1px -1px 1px rgba(0,0,0,0.2); margin:0; opacity:0.8;}
	.sortable li span { position: absolute; }
	.ui-state-default{display:inline; float:left; width:280px;}
	.span-header{ width:100%; background-color:#333; color:#fff; }
	.span-panel{position:absolute; left:845px; top:0;}
	.ico{border:1px solid #ccc; width:100px; height:20px; padding:3px; text-align: center;}
	.delete-span{z-index: 2000;}
</style>

<div class="wrap">
  	<h2>UiGEN CORE Grid Creator.</h2>
  	<p>Design your site layout or select custom <a href="#">layouts library</a></p>

	<table class="wp-list-table widefat plugins">
		<thead>
			<tr>
				<th>Grid</th><th>Blocks</th>
			</tr>
		</thead>
		<tbody id="the-list">
			<tr class="active">
				<td>
					<div id="layout_creator">
					<div id="grid">


					</div>
					<div id="grid-panel">
					<div class="button add-container">Add Container [+]</div>
					</div>
					</div>
				</td>
				<td>Blocks</td>
			</tr>    
		</tbody>  
	</table>
</div>

<script>
  var resizable_val = {
	  grid: 70,     
	  containment: ".sortable",
	  handles: "e, s",
	  cancel:false
	};
	var sortable_val = {
	  connectWith: ".sortable",
	  cursor: 'pointer',
	};

  var resizable_container = {
	grid: 70, 
	handles: "s",   
  }


  jQuery(function() {
	//$( ".sortable" ).sortable(sortable_val);
	// $( ".sortable" ).disableSelection();
	//$( ".ui-state-default" ).resizable(resizable_val);

  });


  var container = '<div class="container">';
  container += '<div class="sortable-helper">';
  container += '<ul class="sortable">';

  container += '</ul>';
  container += '</div>';

  container += '<div class="span-panel">';
  container += '<div class="ico button add-span">Add Span [+]</div>';
  container += '</div>';
  container += '</div>';


  var span = '<li class="ui-state-default">';
  span += '<div class="span-header">';
  span += '<div style="float:left">Span</div>';
  span += '<div style="float:right"><a class="delete-span" href="#">Remove [X]</a></div>';
  span += '<br style="clear:both"/>';
  span += '</div>  ';
  span += '</li>   ';         



jQuery("#layout_creator").on( "click",'.add-span', function(event) {
	jQuery(this).parent().parent().children('.sortable-helper').children('ul').append(span);
	jQuery(this).parent().parent().children('.sortable-helper').children('ul').children('li:last-child').resizable(resizable_val);
});


jQuery("#layout_creator").on( "click",'.add-container', function(event) {
	jQuery(this).parent().parent().children('#grid').append(container);
	jQuery(this).parent().parent().children('#grid').children('.container:last-child').children('.sortable-helper').children('ul').sortable(sortable_val);
	jQuery(this).parent().parent().children('#grid').children('.container:last-child').children('.sortable-helper').resizable(resizable_container);
});


jQuery("#layout_creator").on( "click",'.delete-span', function(event) {
	event.preventDefault();
	jQuery(this).parent().parent().parent().remove();
});

</script>