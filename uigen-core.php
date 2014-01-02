<?php
/*
Plugin Name: UiGEN core
Plugin URI: http://uigen.org
Description: UiGEN classes - core functions to realize UiGEN process modeler
Authors: UiGEN Team: dadmor | bastetmilo | minimal
Authors URI: dadmor@gmail.com
*/

/* This plugin add UiGEN classes to uour plugin directory */

$filename = __FILE__;
register_activation_hook($filename,'my_first_install');
register_deactivation_hook($filename, 'my_first_reinstall');


/* skort functions document */
require_once( ABSPATH . '/wp-content/plugins/uigen-core/short-functions/short-functions.php' );



/* tables creation */
function my_first_install() {
}

function my_first_reinstall(){
 
}



// ################################################################################
// UiGEN alpaca lib init - native plugin libraries
// https://github.com/gitana/alpaca
// -------------------------------------------------------------------------------- 

add_action('admin_enqueue_scripts', 'alpaca_lib_init');
function alpaca_lib_init() {
  wp_register_script( 'alpaca-js', 'http://www.alpacajs.org/js/alpaca.min.js');
  wp_enqueue_script( 'alpaca-js' );

  wp_register_style( 'alpaca-css', plugins_url().'/uigen-core/js-lib/alpaca-component/alpaca.css' );
  wp_enqueue_style('alpaca-css');

  wp_register_style( 'alpaca-uigen-css', plugins_url().'/uigen-core/js-lib/alpaca-component/alpaca-uigen.css' );
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

// #################################################################################

// include alpacaform box
include 'core-files/uigen-alpacaform-box.php';
// include save as file box
include 'core-files/uigen-saveasfile-box.php';

// #################################################################################

add_action( 'admin_head', 'admin_panel' ); 
function admin_panel() {
  if ( current_user_can( 'publish_posts' ) ) {
      // If you are Admin to: ...
        
  } else {
      // You don't admin - admin panel is not to you.
      echo '<div style="margin:0px 20px;">';
      echo 'Sorry man!!!<br/>Admin area is closed to non administrator users!<br/>check me in: ../uigen-core.php';
      echo '</div>';
      wp_redirect( home_url() ); exit; 
      die();

  }
}

// #################################################################################
// UiGEN Admin Menu

add_action('admin_menu', 'UiGEN_menu');
function UiGEN_menu()
{   
  // editor + administrator = moderate_comments;
  add_menu_page('UiGEN Core', 'UiGEN Core', 'administrator', 'url_uigen_core', 'uigen_core');
  add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'administrator', 'url_uigen_hierarchy', 'UiGEN_hierarchy_callback');
  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  
}     
function UiGEN_hierarchy_callback(){
  //wp_register_script( 'alpaca-js', plugins_url().'/uigen-core/js-lib/alpaca-component/alpaca.js');
  //wp_enqueue_script( 'alpaca-js' );

  //wp_register_style( 'alpaca-css', plugins_url().'/uigen-core/js-lib/alpaca-component/alpaca.css' );
  //wp_enqueue_style('alpaca-css');
  //include 'core-menu-files/uigen-template-hierarchy.php';
}

?>
