<?php
class MyPlugin {
     function listblock_shortcode( $atts, $content="" ) {
            extract( shortcode_atts( array(
				'ico' => 'listblock',
			), $atts ) );

            $output = '<div class="col-md-6 col-xs-12">';
            $output .= '<div class="row">';
            $output .=  '<div class="col-md-1 col-xs-1"><img src="'.get_template_directory_uri().'/images/'.esc_attr($ico).'_ico.png"></div>';
            $output .=  '<div class="col-md-11 col-xs-11" style="margin-bottom:20px">' . $content . '</div>';
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        
     }
     function add_shortpost( $atts, $id="" ) {
            extract( shortcode_atts( array(
				'id' => '',
			), $atts ) );
            global $post;
            $my_post = get_post(esc_attr($id));
            return  $my_post -> post_content;
     }
}
add_shortcode( 'listblock', array( 'MyPlugin', 'listblock_shortcode' ));
add_shortcode( 'poststick', array( 'MyPlugin', 'add_shortpost' ));