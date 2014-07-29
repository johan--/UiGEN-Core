<?php
$uigen_posttypes = array(
    //----------------------------------------------------------------
    'landing_content' => array(
        'label' => 'Landing Content',
        'labels' => array(
            'name' => 'Landing Content',
            'singular_name' => 'Landing Content',
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',                    
            'author'
        ),
        'public' => true,
        'show_in_menu' => true,  // plugin menu structure to this posttype is in uigen-core.php with comment line // UiGEN Admin Menu
        //'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
    'content_parts' => array(
        'label' => 'Content Parts',
        'labels' => array(
            'name' => 'Content Parts',
            'singular_name' => 'Content Parts',
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',                    
            'author'
        ),
        'public' => true,
        'show_in_menu' => false, 
        //'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
    'flows' => array(
        'label' => 'Flows',
        'labels' => array(
            'name' => 'Flows',
            'singular_name' => 'Flows',
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',                    
            'author'
        ),
        'public' => true,
        'show_in_menu' => false, 
        //'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
);