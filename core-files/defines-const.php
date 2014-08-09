<?php
define( 'SKIN_NAME' , 'modern-breslau-uigenbootstrap' );
define( 'EMAIL_SALT' , ';Lp/10>2yp*-SP-=6,[7&N[XZfVUn!EKP{][MvyOni|/i]B.@=/$|XL|OOP(;Q!a^-<I}Q&b4>BV' );
define( 'PLUGIN_DIR', ABSPATH.'/wp-content/plugins/UiGEN-Core/');

define( 'COREFILES_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/core-files/' );
// ------- Single vs multi --------
//define( 'GLOBALDATA_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/' );
$wp_upload = wp_upload_dir();
define( 'GLOBALDATA_PATH' , $wp_upload['basedir'].'/global-data/' );
// --------------------------------
define( 'UIGENCLASS_PATH' , ABSPATH . 'wp-content/plugins/UiGEN-Core/class/' );
?>