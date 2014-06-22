<?php
// -------------------------------------------------------------------------------------------------- //
// -----     main callbacks functions                                                          ------ //
// -------------------------------------------------------------------------------------------------- //

function parse_svg($args){

	$form_area_name  = key($args['form_data']['data']);
	$svg_path = $args['form_data']['data'][$form_area_name]['file_to_import']['value'];

	wp_register_script( 'svg', plugins_url().'/UiGEN-Core/js-lib/parse-svg/jquery.svg.min.js');
	wp_enqueue_script('svg');

	wp_register_script( 'svg-DOM', plugins_url().'/UiGEN-Core/js-lib/parse-svg/jquery.svgdom.min.js');
	wp_enqueue_script('svg-DOM');



	?>
	<div id="svgintro"></div>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		$('#svgintro').svg();
		var svg = $('#svgintro').svg('get'); 
		svg.load(
			'<?php echo $svg_path; ?>', { 
				changeSize: true,
				onLoad: loadDone,    
			}
		);
		function loadDone(svg, error) {  

			$('#data_arg g[name=form-element]').each(function (index,val) {
				console.log(val);
				alert($(this).attr('value'));
			});
			             
			



			/*var activeRegionWidth = 800;
			$('rect[type=flowstep]').each(function () {

				if( $(this).attr('x') < activeRegionWidth){
					alert('i found flowstep: '+$(this).attr('x')+':'+$(this).attr('y'));
					$(this).css('stroke','#000000');
					$(this).css('stroke-opacity','1');

					//
					$('g[type=flowstepname]').each(function () {
						$(this).children('rect').each(function () {
							if($(this).attr('type')=='bg'){
								
								var transform = $(this).parent().attr('transform');
								transform = transform.slice(10,-1).split(",");
								
								var bgX = parseInt($(this).attr('x'))+parseInt(transform[0]);
								var bgY = parseInt($(this).attr('y'))+parseInt(transform[1]);



								//$(this).css('stroke','red');
							}
						});	
					});
                    
				}				

			});		*/

		/* ---------------------------------------*/
		} 
	});

	</script>
	<?php

}

?>