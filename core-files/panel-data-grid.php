<?php
	wp_register_script( 'data-grid',  plugins_url().'/UiGEN-Core/js-lib/handsontable/jquery.handsontable.full.js');
	wp_enqueue_script( 'data-grid' );

	wp_register_style( 'data-grid-css', plugins_url().'/UiGEN-Core/js-lib/handsontable/jquery.handsontable.full.css' );
	wp_enqueue_style('data-grid-css');

	$selected_grid = $_GET['grid'];
?>


<div class="wrap">
  	<h2>UiGEN CORE Data Grid Creator.</h2>
  	<p>Create data sheat to your web application</p>
	
	<div style="float:left">
		<div>
			<h3><?php echo $selected_grid; ?></h3>
			<button class="button button-large" id="new_data_grid" style="float:right; margin-top:-42px;">New data grid</button>
		</div>
		<div id="my_grid"></div>
		<button class="button button-primary button-large" id="handson_save" style="float:right; margin-top:5px;">Save data grid</button>
	</div>
	<div style="float:right">


<table class="wp-list-table widefat plugins" style="min-width:200px">
	<thead>

		<th scope="col" id="name" class="manage-column column-name" style="">Data grids list</th>	</tr>	</thead>

	

	<tbody id="the-list">
		<?php
			if ($handle = opendir(GLOBALDATA_PATH . 'uigen-data-grids')) {
			        while (false !== ($entry = readdir($handle))) {
			            if ($entry != "." && $entry != "..") {
			            	?>
								<tr id="contact-form-7" class="active update">
									<td class="column-description desc">
										<a href="<?php echo get_bloginfo('home');?>/wp-admin/admin.php?page=url_uigen_data_grid&grid=<?php echo $entry; ?>" ><?php echo $entry ?> </a>		
									</td>
								</tr>
			            	<?php
			            }
			        }
			        closedir($handle);
			   }
		?>
	</tbody>
	</table>

	</div>

</div>


<?php	
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$data_grid = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-data-grids/'.$selected_grid );
	
/*	echo '<pre>';
	var_dump($data_grid);
	echo json_encode($data_grid);
	echo '</pre>';*/
	//file_put_contents( $prop_path . 'uigen-landing-pages/arguments/landingpages-arguments.yaml' , Spyc::YAMLDump( $posttype_array ));
?>

<script>

jQuery( document ).ready(function() {
  	function getData() {	
		return <?php echo json_encode($data_grid); ?>;
	}
	jQuery("#my_grid").handsontable({
		data: getData(),
		startRows: 5,
		startCols: 5,
		minRows: 7,
		minCols: 10,
		maxRows: 20,
		maxCols: 20,
		rowHeaders: true,
		colHeaders: true,
		minSpareRows: 1,
		contextMenu: true,
		comments: true,
		cell: [
		{row: 1, col: 1, comment: "Test comment"},
		{row: 2, col: 2, comment: "Sample"}
		]
	});

	jQuery('#handson_save').on('click',function(){
		var data = jQuery("#my_grid").data('handsontable');
		console.log(data.getData());

	});



});
	
</script>