<?php

define( 'EMAIL_SALT' , ';Lp/10>2yp*-SP-=6,[7&N[XZfVUn!EKP{][MvyOni|/i]B.@=/$|XL|OOP(;Q!a^-<I}Q&b4>BV' );
define( 'PLUGIN_DIR', ABSPATH.'/wp-content/plugins/UiGEN-Core/');

define( 'COREFILES_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/' );
//define( 'GLOBALDATA_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/' );

$wp_upload = wp_upload_dir();
define( 'GLOBALDATA_PATH' , $wp_upload['basedir'].'/global-data/' );
define( 'GLOBALDATA_URI' , $wp_upload['baseurl'].'/global-data/' );
define( 'GFX_URL' , $wp_upload['baseurl'].'/gfx/' );
define( 'GFX_DIR' , $wp_upload['basedir'].'/gfx/' );

define( 'UIGENCLASS_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/class/' );

require_once UIGENCLASS_PATH . 'Spyc.php';
$uigen_main_prop = Spyc::YAMLLoad( GLOBALDATA_PATH . 'uigen-main-prop/arguments/main-prop.yaml' ); 

define( 'SKIN_NAME' , $uigen_main_prop['skin']);

