<?php
class SvgParserController{
		
	public $svg_prop = array(
		'ststus_posttype_meta_name' => 'controller',
		'status_normal' => '',
		'status_reserved' => '',
		'status_occuped' => '',
		'maping_class' => '.entry'
	);
	
	// -----------------------------------------------------------------------------------------------------------------	
	public function __construct(){		
		// empty constructor yet
	}
	// -----------------------------------------------------------------------------------------------------------------	
	// init SVG parser libraries
	// 1. SVG basic library
	// 2. SVGdom -> jquery svg parser library
	// -----------------------------------------------------------------------------------------------------------------
	public function init_JS_lib($libPath){
		
		//SVG
		wp_register_script( 'svg', $libPath . '/jquery.svg.min.js');
		wp_enqueue_script('svg');
		//SVG DOM
		wp_register_script( 'svgDOM', $libPath . '/jquery.svgdom.min.js');
		wp_enqueue_script('svgDOM');
	}

	// -----------------------------------------------------------------------------------------------------------------	
	public function loadSvg($htmlNode,$filePath){
		$loadSvgScript  ="
			<script>
			jQuery(function() {
				jQuery('#layout').svg({});

				var svg = jQuery('".$htmlNode."').svg('get');
				svg.load('".$filePath."', { 
					addTo: false,
					changeSize: false,
					onLoad: loadDone

				});
			}); 
			
			</script>  
		"; 
		echo $loadSvgScript;		
	}	
	// -------------------------------------------------------------------------------------------------------------------
	public function svgInit_jsObject($entry_id){
		$jsEntryObject  ="
			<script>
				var jsEntryObject = array();
			</script>  
		";
		echo $jsEntryObject;	
	}

	public function svgInit_rebuilder($script){
		$loadSvgScript = $script;
			
		echo $loadSvgScript;	
	}	
	//
}
?>
