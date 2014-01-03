<?php
class TemplateSwitcher{
	
	public $query_vars;	
	public $cat_id;
	public $post_type;
	
	public $cat_obj;
	public $parent_catslug;
	public $parent_catName;
	public $device_name;

	
	// -----------------------------------------------------------------------------------------------------------------	
	public function __construct($query_vars){		
		//var_dump($query_vars);
		
		$cat_id = $query_vars['cat'];
		$this -> cat_id = $cat_id;
		$post_type = $query_vars['post_type'];
		$this -> post_type = $post_type;

		
		if( $cat_id != ''){
			$this -> check_parent_cat($cat_id);
		}else{
			
			// jeśli nie ma określonego id kategorii to prawdopodobnie jestem singlem - sprawdz czy mam kategorię
			global $post;
			$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
			$cat_obj = wp_get_object_terms( $post->ID,'category', $args );
			$this -> cat_obj = $cat_obj;
			
			// nadal niewiemy co jeśli jest kilka kategorii
			if(@$cat_obj[0]->term_id != ''){

				$this -> check_parent_cat($cat_obj[0]->term_id);
			}
		}
	}
	// -----------------------------------------------------------------------------------------------------------------	
	// init SVG parser libraries
	// 1. SVG basic library
	// 2. SVGdom -> jquery svg parser library
	// -----------------------------------------------------------------------------------------------------------------
	public function check_parent_cat($cat_id){
		
			$curr_cat = get_category_parents( $cat_id, false, '/' ,true);
			$curr_cat = @explode('/',$curr_cat);
			$this -> parent_catslug = get_category_by_slug($curr_cat[0])->slug;
			//echo	$this -> parent_catslug;
			return get_category_by_slug($curr_cat[0])->term_id;	
	}

	public function check_parent_cat_l2($cat_id){
		
			$curr_cat = get_category_parents( $cat_id, false, '/' ,true);
			//var_dump($curr_cat);
			$curr_cat = @explode('/',$curr_cat);

			return get_category_by_slug($curr_cat[1])->slug;
			//echo	$this -> parent_catslug;	
	}
	public function check_parent_name($cat_id){
		
			$curr_cat = get_category_parents( $cat_id, false, '/' ,true);
			//echo "curr_cat";
			//var_dump($curr_cat);
			$curr_cat = explode('/',$curr_cat);
			$this -> parent_catName = get_category_by_slug($curr_cat[0])->cat_name;
			return get_category_by_slug($curr_cat[0])->cat_name;
			//echo	$this -> parent_catslug;	
	}
	
	//------------------------------------------------------------- 

	// device swither
	public function device_swith_by_cat($cat_id_slug){
		if($cat_id_slug == 'hala-stulecia'){
				return 'hala-stulecia';
		}
		if($cat_id_slug == 'centennial-hall'){
				return 'hala-stulecia';
		}
		if($cat_id_slug == 'jahrhunderthalle'){
				return 'hala-stulecia';
		}
		if($cat_id_slug == 'centrum-poznawcze'){
				return 'centrum-poznawcze';
		}
		if($cat_id_slug == 'discovery-center'){
				return 'centrum-poznawcze';
		}
		if($cat_id_slug == 'entdeckungszentrum'){
				return 'centrum-poznawcze';
		}
		if($cat_id_slug == 'iglica-totem'){
				return 'iglica-totem';
		}
		if($cat_id_slug == 'spire-en'){
				return 'iglica-totem';
		}
		if($cat_id_slug == 'helm-de'){
				return 'iglica-totem';
		}
 	   if ($cat_id_slug == 'totem-mobilny-2') {
			    return 'totem-mobilny-2';
	    }
	    if ($cat_id_slug == 'totem-mobilny-2-en') {
      			return 'totem-mobilny-2';
    	}
	    if ($cat_id_slug == 'totem-mobilny-2-de') {
    		  	return 'totem-mobilny-2';
 	   }
	    if ($cat_id_slug == 'totem-mobilny-1') {
 		     	return 'totem-mobilny-1';
	    }
	    if ($cat_id_slug == 'totem-mobilny-1-en') {
	      		return 'totem-mobilny-1';
	    }
	    if ($cat_id_slug == 'totem-mobilny-1-de') {
	      		return 'totem-mobilny-1';
    	}
    	if ($cat_id_slug == 'fontanna-pl-totem') {
    			return 'fontanna-pl-totem';
    	}
    	if ($cat_id_slug == 'fountain') {
    			return 'fontanna-pl-totem';
    	}
    	if ($cat_id_slug == 'brunnen') {
    			return 'fontanna-pl-totem';
    	}


		return 'hala-stulecia';
	}

	
	//
}
?>
