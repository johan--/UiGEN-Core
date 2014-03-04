
<?php
/*
Plugin Name: UiGEN core
Plugin URI: http://uigen.org
Description: UiGEN classes and libraries - core functions to realize UiGEN display and process modeler
Authors: UiGEN Team: dadmor | minimal
Authors URI: dadmor@gmail.com
*/

/* This plugin add UiGEN classes to uour plugin directory */

// Plugin VERSION
define("UiGEN_CORE_VER", "0.1.1");

$filename = __FILE__;
register_activation_hook($filename,'my_first_install');
register_deactivation_hook($filename, 'my_first_reinstall');


/* skort functions document */
require_once( ABSPATH . 'wp-content/plugins/UiGEN-Core/short-functions/short-functions.php' );



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


// #################################################################################

add_action( 'admin_head', 'admin_panel' ); 
function admin_panel() {
  if ( current_user_can( 'publish_posts' ) ) {
      // If you are Admin to: ...
        
  } else {
      // You don't admin - admin panel is not to you.
      echo '<div style="margin:0px 20px;">';
      echo 'Sorry man!!!<br/>Admin area is closed to non administrator users!<br/>check me in: ../UiGEN-Core.php';
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
  // submenu with calbac
  //add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'administrator', 'url_uigen_hierarchy', 'UiGEN_hierarchy_callback');
  // submenu from defined posttype
  add_submenu_page('url_uigen_core', 'UiGEN hierarchy', 'UiGEN hierarchy', 'manage_options', 'edit.php?post_type=template_hierarchy');  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  
  add_submenu_page('url_uigen_core', 'UiGEN Content parts', 'UiGEN Content parts', 'manage_options', 'edit.php?post_type=content_parts');  //add_submenu_page('url_uigencore', 'Dodaj', 'Dodaj', 'administrator', 'url_add_mod', 'moderator_ADD');  

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
  .container{margin-top:20px; position:relative;}
  #grid-panel {margin-top:10px;}
  
  /* SPAN element */
  .sortable-helper{position:relative; width:840px; height:140px;}
  .sortable { width:100%; height:100%; position:relative; list-style-type: none; margin: 0; padding: 0;  border:1px dashed #ccc;  background:#fff url('<?php echo plugins_url();?>/UiGEN-Core/img/grid_bg.png'); box-shadow: inset 3px 3px 5px rgba(0,0,0,0.1);}
  .sortable .ui-state-default { background-image:none; background-color:#77C0DD; height: 70px; border:0; box-shadow: inset -1px -1px 1px rgba(0,0,0,0.3); margin:0; opacity:0.7;}
  .sortable .ui-state-default:hover{opacity:0.9;}
  .sortable .ui-state-default span { position: absolute; }
  .ui-state-default{display:inline; float:left; width:280px;}

  .span-header{ width:100%; background-color:#333; color:#fff; height:20px; margin-top:-20px; padding:3px 0px; }
  .span-panel{position:absolute; left:845px; top:0;}
  
  /* SPAN add button */
  .ico{border:1px solid #ccc; width:100px; height:20px; padding:3px; text-align: center;}
  .delete-span{z-index: 2000;}
  
  /* BLOCKS  */
  .blocks-repo{border:1px solid #ccc; background:#ddd;}
  .block-container{width:100%; height:100%;}
  .block{margin:0; padding:5px; background-color: rgba(255,255,255,0.3); box-shadow: inset -1px -1px 1px rgba(255,255,255,1);}
  .block-body{background-color:#999;border:1px solid #888;}
  .block-highlight{border-top:5px solid green;}

  /* BLOCKS SPECYFIC */
  .b_logo .block-body{  padding:19px 10px;}
  .b_menu .block-body{ padding:2px 10px;}
  
  .b_excerpt .block-title{ padding:2px 10px 2px 10px; background-color:#999;border:1px solid #888;}
  .b_excerpt .block-body{ padding:2px 10px 2px 10px; margin-top:1px;}




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
        <!-- GRID -->
        <td width="950">
          <div id="layout_creator">
          <div id="grid">


          </div>
          <div id="grid-panel">
            <div class="button add-container">Add Container [+]</div>
          </div>
          </div>
        </td>
         <!-- GRID -->
        <td>
          <ul class="blocks-repo">
            <li class="block b_logo"><div class="block-body">LOGO</div></li>
            <li class="block b_menu"><div class="block-body">MENU: menu1 | menu2 | menu3</div></li>
            <li class="block b_excerpt">
               <div class="block-title">Excerpt title</div>
              <div class="block-body">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
            </li>
          </ul>

        </td>
      </tr>    
    </tbody>  
  </table>

</div>

<script>
    var zindex = 10000;
    var resizable_val = {
      grid: 70,     
      containment: ".sortable",
      handles: "e, s",
      cancel:false
    };
    var sortable_val = {
      connectWith: ".sortable",
      //cursor: 'pointer',
    };

    var block_into_repo = {
      connectToSortable: ".block-container",
      helper: "clone",
      start: function() {
        //$(this).css('background-color','#666');
      },
      stop: function() {
        //$(this).css('background-color','#999');
      },
      //revert: "invalid"
    }

    var block_container = {
      connectWith:'.block-container',
      placeholder: "block-highlight"
      //revert: true
    }

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
  span += '<ul class="block-container"></ul> ';
  span += '</li>   ';         


$('.blocks-repo').children('.block').draggable(block_into_repo);

/* ADD SPAN ELEMENT */
$("#layout_creator").on( "click",'.add-span', function(event) {
    element =  $(this).parent().parent().children('.sortable-helper').children('ul');
    add_span_element(element);
});
function add_span_element(element){
    element.append(span);
    element.children('li:last-child').resizable(resizable_val);
    element.children('li:last-child').children('ul').sortable(block_container);
}
/* ^^^^^^^^^^^^^^^^^ */

/* ADD CONTAINER ELEMENT */
$("#layout_creator").on( "click",'.add-container', function(event) {
    element =  $(this).parent().parent().children('#grid');
    add_container_element(element);
    
});
function add_container_element(element){
    element.append(container);
    element.children('.container:last-child').children('.sortable-helper').children('ul').sortable(sortable_val);
    element.children('.container:last-child').children('.sortable-helper').resizable(resizable_container);
}
/* ^^^^^^^^^^^^^^^^^ */
add_container_element( $("#grid") );


$("#layout_creator").on( "click",'.delete-span', function(event) {
    event.preventDefault();
    $(this).parent().parent().parent().remove();
});


$("#layout_creator").on( "click",'.ui-state-default', function(event) {
    var display = $( this ).children('.span-header').css( "display" );

    if(display == 'block'){
      $(this).children('.span-header').css('display','none');
    }else{
      $(this).children('.span-header').css('display','block');
    }
});



</script>

<?php

}  

// submenu calback function
function UiGEN_hierarchy_callback(){

}
?>