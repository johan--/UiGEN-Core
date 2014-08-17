<?php
$uigen_posttypes_creator_schema = array(
    //----------------------------------------------------------------
    'example_posttype' => array(
        'label' => 'example_label',
        'labels' => array(
            'name' => 'example_label',
            'singular_name' => 'example_label',
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
    )
);
?>