<?php
/*
Plugin Name: UiGEN core
Plugin URI: http://uigen.org
Description: UiGEN classes and libraries - core functions to realize UiGEN display and process modeler
Authors: UiGEN Team: dadmor | minimal
Authors URI: dadmor@gmail.com
*/

include('custom_admin_pages.php');

/* This plugin add UiGEN classes to uour plugin directory */

// Plugin VERSION
define( 'UiGEN_CORE_VER' , '0.1.2' );
define( 'EMAIL_SALT' , ';Lp/10>2yp*-SP-=6,[7&N[XZfVUn!EKP{][MvyOni|/i]B.@=/$|XL|OOP(;Q!a^-<I}Q&b4>BV' );
define('PLUGIN_DIR', ABSPATH.'/wp-content/plugins/UiGEN-Core');

define( 'COREFILES_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/' );
define( 'GLOBALDATA_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/' );
define( 'UIGENCLASS_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/class/' );

$filename = __FILE__;
register_activation_hook($filename,'my_first_install');
register_deactivation_hook($filename, 'my_first_reinstall');


/* skort functions document */
require_once( ABSPATH . 'wp-content/plugins/UiGEN-Core/short-functions/short-functions.php' );

/* pluggables */
require_once( ABSPATH . '/wp-content/plugins/UiGEN-Core/pluggables.php');

/* tables creation */

if(!class_exists('Custom_Types_Creator')) {
  include_once(PLUGIN_DIR.'/mpf_specyfic.php');
}

function my_first_install() {

  if(class_exists('Custom_Types_Creator')) {
	$mpf = new Custom_Types_Creator();
	$mpf_roles = array(
		'doctor' => array('read' => false),
		'payer' => array('publish_posts' => true),
		'coordinator' => array(
			'publish_wizyta' => true,
			'edit_published_wizyta' => true
		),
		'operator' => array(
			'edit_dashboard' => true,
			'edit_wizyta' => true,
			'read_wizyta' => true,
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
			// 'upload_files' => true,
			// 'publish_posts' => true,
			// 'delete_published_posts' => true,
			// 'edit_posts' => true,
			// 'delete_posts' => true,
			'read' => true
		),
	);
	$mpf->roles=$mpf_roles;
		$mpf->add_roles();
	} else {
		echo 'error, password wrong!';
		die();
	}
}

function my_first_reinstall(){
  if(class_exists('Custom_Types_Creator')) {
	  $mpf = new Custom_Types_Creator();
  $mpf_roles = array(
	  'doctor' => array('read' => false),
	  'payer' => array('publish_posts' => true),
	  'coordinator' => array('publish_pages' => true, 'edit_published_pages' => true),
	  'operator' => array('edit_dashboard' => true,
	  'edit_others_posts' => true,
	  'edit_pages' => true,
	  'edit_others_pages' => true,
	  'edit_published_pages' => true,
	  'publish_pages' => true,
	  'delete_pages' => true,
	  'delete_others_pages' => true,
	  'delete_published_pages' => true,
	  'delete_others_posts' => true,
	  'delete_private_posts' => true,
	  'edit_private_posts' => true,
	  'read_private_posts' => true,
	  'delete_private_pages' => true,
	  'edit_private_pages' => true,
	  'read_private_pages' => true,
	  'edit_published_posts' => true,
	  'upload_files' => true,
	  'publish_posts' => true,
	  'delete_published_posts' => true,
	  'edit_posts' => true,
	  'delete_posts' => true,
	  'read' => true,
	  ),
	);
  $mpf->roles=$mpf_roles;
	$mpf->remove_roles();
  }
}



// ################################################################################
// UiGEN alpaca lib init - native plugin libraries
// https://github.com/gitana/alpaca
// -------------------------------------------------------------------------------- 

add_action('admin_enqueue_scripts', 'alpaca_lib_init');
function alpaca_lib_init() {

  wp_register_script( 'jquery-tmpl',  plugins_url().'/UiGEN-Core/js-lib/jquery.tmpl.js');
  wp_enqueue_script( 'jquery-tmpl' );

  //wp_register_script( 'alpaca-js', 'http://www.alpacajs.org/js/alpaca.min.js');
  wp_register_script( 'alpaca-js',  plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca.js', array('jquery-ui-datepicker'));
  wp_enqueue_script( 'alpaca-js' );

  wp_register_style( 'alpaca-css', plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca.css' );
  wp_enqueue_style('alpaca-css');

  wp_register_style( 'alpaca-uigen-css', plugins_url().'/UiGEN-Core/js-lib/alpaca-component/alpaca-uigen.css' );
  wp_enqueue_style('alpaca-uigen-css');

}

// ################################################################################
// UiGEN posttype creator - native plugin methods
// -------------------------------------------------------------------------------- 

/* register posttypes - from definition file. */
add_action('init', 'uigen_posttypes');
function uigen_posttypes() {
	// -------------------------
	// Posttypes definitions
	// -------------------------
	
	// include arguments array
	include 'global-data/uigen-posttype/arguments/uigen-posttype-arguments.php';

	// register posttypes from arguments array
	foreach ($uigen_posttypes as $posttype => $props) {
	  register_post_type($posttype, $props);
	}

	/* register posttypes createt form user with debuger !!! */
	require_once UIGENCLASS_PATH . 'Spyc.php';
	$debuger_custom_posttype = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-posttype/arguments/uigen-posttype-creator-arguments.yaml' );        
	foreach ($debuger_custom_posttype as $posttype => $props) {
	  register_post_type($posttype, $props);
	}
}


// ================================================================================

/* register metaboxes - from definition file. */
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
}

/* register sidebars - from definition file. */
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
add_action('wp_enqueue_scripts', 'check_debuger');
function check_debuger() {
 
}


// #################################################################################

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
  // add_menu_page('UiGEN Core', 'UiGEN Core', 'administrator', 'url_uigen_core', 'uigen_core');
  // submenu with calbac
  //add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'administrator', 'url_uigen_hierarchy', 'UiGEN_hierarchy_callback');
  // submenu from defined posttype
  // add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'manage_options', 'edit.php?post_type=template_hierarchy');  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  
  // add_submenu_page('url_uigen_core', 'UiGEN Content parts', 'UiGEN Content parts', 'manage_options', 'edit.php?post_type=content_parts');  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  

} 

// main plugin menu callback
function uigen_core(){
  echo '<div class="wrap">';
  echo '<h2>Welcome to UiGEN CORE plugin.</h2>';
  echo '<p>UiGEN CORE plugin is pack of classes and libraries - core functions to realize UiGEN display and process modeler.</p>';
  
  // check theme version
  if(@constant('UiGEN_THEME_VER') != ''){
	echo '<div id="message" class="updated"><p>UiGEN Theme <b>compatibility</b> check: <span style="color:#7ad03a"> is CORRECT</span>';
	echo '<br/>Your theme is: '.constant('UiGEN_THEME_VER').' </p></div>';
  }else{
	echo '<div id="message" class="error"><p>UiGEN Theme <b>compatibility</b> check: <span style="color:red">You dont have UiGEN Theme consistent.</span> <br/>Download and install UiGEN BASIC Theme form https://github.com/dadmor/UiGEN-MVC-Basic-Theme</p></div>';
  }

  echo '</div>';

?>
<br>
<div class="wrap">







<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

  




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

/**
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
