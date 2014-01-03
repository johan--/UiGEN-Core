<?php
class ThemeSwitcher {
	

	
	public function __construct(){

		
	}
	
	public function ts_check_parent_cat( $cat_id ){
		
	}
	public function ts_check_cat( $cat_id ){
		
	}
	public function ts_swith_theme( $cat_id ){
		
			add_filter('template', 'change_theme');
			add_filter('option_template', 'change_theme');
			add_filter('option_stylesheet', 'change_theme');

		
	}

}
?>
add_action('init', 'process_post');

function process_post(){
	global $wp_query;
	global $post;
	$curr_cat = get_category_parents($wp_query->query_vars['cat'], false, '/' ,true);
	//$idObj = get_category_by_slug($curr_cat[0]);
	var_dump($wp_query);
}

// Extra lines to change the theme's root.



function change_theme() 
{
    // Display Alternate theme
    return 'hala100';
}
