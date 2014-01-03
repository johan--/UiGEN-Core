<?php
$uigen_posttypes = array(
    //----------------------------------------------------------------
    'template_hierarchy' => array(
        'label' => 'Template Hierarchy',
        'labels' => array(
            'name' => 'Template Hierarchy',
            'singular_name' => 'Template Hierarchy',
        ),
        'supports' => array(
            'title',
            //'editor',
            'thumbnail',
            'excerpt',                    
            'author'
        ),
        'public' => true,
        'show_in_menu' => 'edit.php?post_type=entertainment',
        //'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
);
?>