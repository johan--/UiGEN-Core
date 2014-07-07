<?php
/*
Plugin Name: UiGEN core
Plugin URI: http://uigen.org
Description: UiGEN open source classes and libraries - core functions to realize UiGEN display and process modeler
Authors: UiGEN Team: dadmor | minimal | sirmacik | marsianin 
Authors URI: dadmor@gmail.com
*/

/**
  * UiGEN Core main plugin file. This plugin add UiGEN classes to yuour plugin directory 
  * @filesource fdsfdsfdsfds
  */

/* @Minimal Extentions */
// Check after devel
//include('custom_admin_pages.php');
//include('hooks.php');


/**
* UiGEN Constans to chech plugin Version with UiGEN MVC Theme
*
* @filesource /UiGEN-Core/uigen-core.php
*/
define( 'UiGEN_CORE_VER' , '0.1.3' );
define( 'EMAIL_SALT' , ';Lp/10>2yp*-SP-=6,[7&N[XZfVUn!EKP{][MvyOni|/i]B.@=/$|XL|OOP(;Q!a^-<I}Q&b4>BV' );
define( 'PLUGIN_DIR', ABSPATH.'/wp-content/plugins/UiGEN-Core/');

define( 'COREFILES_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/' );
define( 'GLOBALDATA_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/' );
define( 'UIGENCLASS_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/class/' );

$filename = __FILE__;
register_activation_hook($filename,'my_first_install');
register_deactivation_hook($filename, 'my_first_reinstall');


/* short functions document */
require_once( ABSPATH . 'wp-content/plugins/UiGEN-Core/short-functions/short-functions.php' );

/* pluggables */
/* @Minimal Extentions */
// Check after devel
// require_once( ABSPATH . '/wp-content/plugins/UiGEN-Core/pluggables.php');

/* tables creation */
/* @Minimal Extentions */
// Check after devel
/*if(!class_exists('Custom_Types_Creator')) {
  include_once( ABSPATH . '/wp-content/plugins/UiGEN-Core/mpf_specyfic.php');
}*/

/*$mpf_roles = array(
	'doctor' => array('read' => false),
	'payer' => array('publish_posts' => true),
	'coordinator' => array(
		'publish_wizyty' => true,
		'edit_published_wizyty' => true
		//delete also
	),
	'worker' => array(
		'publish_wizyty' => true,
		'edit_published_wizyty' => true
	),
	'operator' => array(
		'edit_dashboard' => true,
		'edit_wizyty' => true,
		'read_wizyty' => true,
		'publish_wizyty' => true,
		'edit_published_wizyty' => true,
		// 'edit_others_posts' => true,
		// 'edit_pages' => true,
		// 'edit_others_pages' => true,
		// 'edit_published_pages' => true,
		// 'publish_pages' => true,
		// 'delete_pages' => true,
		// 'delete_others_pages' => true,
		// 'delete_published_pages' => true,
		// 'delete_others_posts' => true,
		// 'delete_private_posts' => true,
		// 'edit_private_posts' => true,
		// 'read_private_posts' => true,
		// 'delete_private_pages' => true,
		// 'edit_private_pages' => true,
		// 'read_private_pages' => true,
		// 'edit_published_posts' => true,
		'upload_files' => true,
		// 'publish_posts' => true,
		// 'delete_published_posts' => true,
		// 'edit_posts' => true,
		// 'delete_posts' => true,
		'read' => true
	),
);*/

/**
  * Plugin install hook
  * @filesource
  */
function my_first_install() {


	/* Minimal roles solution */
	/*  	
	if(class_exists('Custom_Types_Creator')) {
	
	$mpf = new Custom_Types_Creator();
	global $mpf_roles;
	$mpf->roles=$mpf_roles;
		$mpf->add_roles();
	} else {
		echo 'error, password wrong!';
		die();
	}*/

	/* ---------------------- */
	/* CREATE DATABASE TABLES */
	global $wpdb;	

    require_once UIGENCLASS_PATH . 'Spyc.php';
	$debuger_db = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-database/arguments/database-arguments.yaml' );        
	foreach ($debuger_db as $db_tb_name => $db_props) {

		$db_create_table_string = '';
		$db_create_table_string .= "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}".$db_tb_name."` ( \n";
		$db_create_table_string .= "`ID` int(5) NOT NULL AUTO_INCREMENT, \n";
			
		foreach ($db_props['db_table_columns'] as $db_col_props) {
			$db_create_table_string .= "`".$db_col_props['db_column_name']."` ".$db_col_props['db_column_type']." NOT NULL, \n";
			//var_dump('db>' , $db_col_props['db_column_name']);
			//var_dump('db>' , $db_col_props['db_column_type']);
		}

		$db_create_table_string .= " PRIMARY KEY (`ID`) \n";
		//$db_create_table_string .= " CHARACTER SET utf8 COLLATE utf8_general_ci \n";
		$db_create_table_string .= " )  \n";
		$db_tables_array[$db_tb_name] = $db_create_table_string;
	}
	//var_dump($db_tables_array);

	// Create tables
	echo '<pre>';
	foreach ($db_tables_array as $db_tb => $db_sql_synax) {
		echo '<br/>----------------<br/>create '.$db_tb.'<br/>----------------<br/>';
		echo $db_sql_synax;
		$wpdb->query($db_sql_synax);
	
	}
	echo '</pre>';
	/* ---------------------- */

}

function my_first_reinstall(){
  if(class_exists('Custom_Types_Creator')) {
	  $mpf = new Custom_Types_Creator();
	  global $mpf_roles;
  $mpf->roles=$mpf_roles;
	$mpf->remove_roles();
  }

}



// ################################################################################
// UiGEN alpaca lib init - native plugin libraries
// https://github.com/gitana/alpaca
// -------------------------------------------------------------------------------- 

add_action('admin_enqueue_scripts', 'alpaca_lib_init');
if(@$_GET['debug']=='true'){
	alpaca_lib_init();
}

function alpaca_lib_init() {


  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.datepicker.css' );
  wp_register_style('jquery-ui-datepicker', plugins_url().'/UiGEN-Core/js-lib/datepicker.css' );
  wp_enqueue_style( 'jquery-ui-datepicker');

  wp_register_script( 'jquery-tmpl',  plugins_url().'/UiGEN-Core/js-lib/jquery.tmpl.js');
  wp_enqueue_script( 'jquery-tmpl' );

  //wp_register_script( 'alpaca-js', 'http://www.alpacajs.org/js/alpaca.min.js');
  wp_register_script( 'alpaca-js',  plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca.js');
  wp_enqueue_script( 'alpaca-js' );

  wp_register_style( 'alpaca-css', plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca.css' );
  wp_enqueue_style('alpaca-css');

  wp_register_style( 'alpaca-uigen-css', plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca-uigen.css' );
  wp_enqueue_style('alpaca-uigen-css');

}

// ################################################################################
// UiGEN posttype creator - native plugin methods
// -------------------------------------------------------------------------------- 

/**
 * register posttypes - from definition file. 
 *
 * @filesource /UiGEN-Core/uigen-core.php
 */
add_action('init', 'uigen_posttypes');
function uigen_posttypes() {

	//echo '<pre>'.$db_create_table_string.'</pre>';

	// -------------------------
	// Posttypes definitions
	// -------------------------
	
	// include arguments array - depreciated Model !!!!!
	include 'global-data/uigen-posttype/arguments/uigen-posttype-arguments.php';

	// register posttypes from arguments array
	foreach ($uigen_posttypes as $posttype => $props) {
	  register_post_type($posttype, $props);
	}
	// --------------------------------------------------

	/* register posttypes createt form user with debuger !!! */
	require_once UIGENCLASS_PATH . 'Spyc.php';
	$debuger_custom_posttype = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' );        
	foreach ($debuger_custom_posttype as $posttype => $props) {
	  register_post_type($posttype, $props);
	}

	/* rewrite user roles (bad way) */
	/* @Minimal roles solution */

	/*	if(class_exists('Custom_Types_Creator')) {
		$mpf = new Custom_Types_Creator();
		global $mpf_roles;
		$mpf->roles=$mpf_roles;
			// $mpf->add_cap();
	} else {
		echo 'error, password wrong!';
		die();
	}*/




}


// ################################################################################
// UiGEN taxonomy creator - native plugin methods
// -------------------------------------------------------------------------------- 

/**
 * register posttypes - from definition file.
 *
 * @filesource /UiGEN-Core/uigen-core.php
 */
add_action('init', 'uigen_taxonomies');
function uigen_taxonomies() {
	// -------------------------
	// Taxonomies definitions
	// -------------------------
	
	/* register posttypes createt form user with debuger !!! */
	require_once UIGENCLASS_PATH . 'Spyc.php';
	$debuger_custom_taxonomies = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-taxonomy/arguments/uigen-taxonomy-creator-arguments.yaml' );        
	foreach ($debuger_custom_taxonomies as $ui_taxonomy => $props) {
		register_taxonomy( $ui_taxonomy, $props['post_type'], $props['tax_args'] );
	}


	add_action( 'init', 'create_book_tax' );

	
	// register landingPage content map	
	register_taxonomy(
		'landing_content_hierarchy',
		array( 'landing_content' ),
		array(
			'label' => __( 'Landing Content Hierarchy' ),
			'rewrite' => array( 'slug' => 'landing-content-hierarchy' ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
	
}


// ================================================================================


/**
 * register metaboxes - from definition file.
 *
 * @filesource /UiGEN-Core/uigen-core.php
 */
add_action('admin_init', 'uigen_metaboxes');
function uigen_metaboxes() {
  // -------------------------
  // Metaboxes definitions
  // -------------------------

  // include arguments array
  include 'global-data/uigen-metaboxes/arguments/uigen-metaboxes-arguments.php';

  // register posttypes from arguments array
  foreach ($uigen_metaboxes as $metabox) {
	  add_meta_box($metabox[0],$metabox[1],$metabox[2],$metabox[3],$metabox[4],$metabox[5],$metabox[6]);
  }


	foreach (array('page') as $type) 
	{
	        add_meta_box('my_all_meta', 'Landing page options', 'my_meta_setup', $type, 'normal', 'high');
	}
	add_action('save_post','my_meta_save');
	function my_meta_setup()
	{
	    global $post;
		echo 'sadsad';
	}
	function my_meta_save($post_id) 
	{
		//echo 'sadsad';
	}




}




/**
 * register sidebars - from definition file.
 *
 * @filesource /UiGEN-Core/uigen-core.php
 */
add_action( 'widgets_init', 'ui_register_sidebars' );
function ui_register_sidebars() {
	// -------------------------
	// Metaboxes definitions
	// -------------------------
	include 'global-data/uigen-sidebars/arguments/uigen-sidebars-arguments.php';
	foreach ($uigen_sidebars as $sidebar) {
		register_sidebar( $sidebar);
	}
}




// #################################################################################
// CORE FILES
// include alpacaform box
include 'core-files/uigen-alpacaform-box.php';
// include save as file box
include 'core-files/uigen-saveasfile-box.php';

// create native plugin widgets
include 'core-files/uigen-widgets.php';

// create native plugin widgets
include 'core-files/uigen-shortcodes.php';

//add_action('init', 'check_debuger');

/**
 * Check debugger
 *
 * @filesource /UiGEN-Core/uigen-core.php
 * @deprecated 
 */
add_action('wp_enqueue_scripts', 'check_debuger');
function check_debuger() {
 
}


// #################################################################################

/* Dadmor - redirect non admin usres from backend to frontend */
// add_action( 'admin_head', 'admin_panel' ); 
// function admin_panel() {
//   if ( current_user_can( 'publish_posts' ) ) {
//       // If you are Admin to: ...
		
//   } else {
//       // You don't admin - admin panel is not to you.
//       echo '<div style="margin:0px 20px;">';
//       echo 'Sorry man!!!<br/>Admin area is closed to non administrator users!<br/>check me in: ../UiGEN-Core.php';
//       echo '</div>';
//       wp_redirect( home_url() ); exit; 
//       die();

//   }
// }

// #################################################################################
// UiGEN Admin Menu

add_action('admin_menu', 'UiGEN_menu');

function UiGEN_menu()
{   
  // editor + administrator = moderate_comments;
  add_menu_page('UiGEN Core', 'UiGEN Core', 'administrator', 'url_uigen_core', 'uigen_core');
  
  // submenu with calbac
  //add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'administrator', 'url_uigen_hierarchy', 'UiGEN_hierarchy_callback');
  
  // submenu from defined posttype
  add_submenu_page('url_uigen_core', 'UiGEN Content parts', 'UiGEN Content parts', 'manage_options', 'edit.php?post_type=content_parts');  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  

} 

// main plugin menu callback
function uigen_core(){
  echo '<div class="wrap">';
  echo '<h2>Welcome to UiGEN CORE plugin.</h2>';
  echo '<p>UiGEN CORE plugin is full open source pack of classes and libraries - core functions to realize UiGEN display and process modeler.</p>';
  
  // check theme version
  if(@constant('UiGEN_THEME_VER') != ''){
	echo '<div id="message" class="updated"><p>UiGEN Theme <b>compatibility</b> check: <span style="color:#7ad03a"> is CORRECT</span>';
	echo '<br/>Your theme is: '.constant('UiGEN_THEME_VER').' </p></div>';
  }else{
	echo '<div id="message" class="error"><p>UiGEN Theme <b>compatibility</b> check: <span style="color:red">You dont have UiGEN Theme consistent.</span> <br/>Download and install UiGEN BASIC Theme form https://github.com/dadmor/UiGEN-MVC-Basic-Theme</p></div>';
  }

  echo '</div>';

?>




<div class="wrap">
<div id="message" class="error below-h2"><p>Warning !!!</p><p>UiGEN Core is not stable yet !!!<br/>First beta version will be published on dedicated repo github/uigen soon.</p></div>

<!--                   WTF!!!!!????? -->
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> 
<!--
srsly, dadmor, please do it like a man, not like a pussy.

dadmor: Who write this childish comment should set solution or go away !!!! 
-->

  
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
  <script>
  
  </script>
  <!--
  <h1>Grid creator</h1>
  <h3>Design your site layout</h3>
  <h4>Or select from custom <a href="#">layouts library</a></h4>
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
  -->
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


  $(function() {
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



$("#layout_creator").on( "click",'.add-span', function(event) {
	$(this).parent().parent().children('.sortable-helper').children('ul').append(span);
	$(this).parent().parent().children('.sortable-helper').children('ul').children('li:last-child').resizable(resizable_val);
});


$("#layout_creator").on( "click",'.add-container', function(event) {
	$(this).parent().parent().children('#grid').append(container);
	$(this).parent().parent().children('#grid').children('.container:last-child').children('.sortable-helper').children('ul').sortable(sortable_val);
	$(this).parent().parent().children('#grid').children('.container:last-child').children('.sortable-helper').resizable(resizable_container);
});


$("#layout_creator").on( "click",'.delete-span', function(event) {
	event.preventDefault();
	$(this).parent().parent().parent().remove();
});

</script>

<?php

}  

// submenu calback function
function UiGEN_hierarchy_callback(){

}

/* @Minimal
 * 
 * get_hash
 * 
 * Creates hash for specyfic user
 * 
 * @param $user_id (int) User ID
 * @return $hash (string) hash that can be werified by validate_hash function
 **/
 function get_hash($user_id) {
	$hash = hash_hmac('sha256', uniqid().$user_id.uniqid(), EMAIL_SALT);
	update_user_meta( $user_id, 'ui_confirm_status', $hash );
	return($hash);
 }

 /**
  * validate_hash
  * 
  * Validates given hash against stored for user in database
  * 
  * @param $user_id(int)User ID
  * @param $hash (string) Hash
  * @return boolean true if hash maches given user; false if it does not
  **/
 function validate_hash($user_id, $hash, $remove = false) {
	$users_hash = get_user_meta( $user_id, 'ui_confirm_status', true );
	if ($hash == $users_hash) {
	  if ($remove) {
		delete_user_meta($user_id, 'ui_confirm_status');
	  }
	  return(true);
	} else {
	  return(false);
	}
 }
