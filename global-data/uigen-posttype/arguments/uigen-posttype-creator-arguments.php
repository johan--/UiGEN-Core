<?php
$uigen_posttypes_creator = array(
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
        'show_in_menu' => false,  // plugin menu structure to this posttype is in uigen-core.php with comment line // UiGEN Admin Menu
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
    'logotypes' => array(
        'label' => 'Logotypy',
        'labels' => array(
            'name' => 'Logotypy',
            'singular_name' => 'Logotypy',
        ),
        'supports' => array(
            'title',
            //'editor',
            'thumbnail',
            //'excerpt',                    
            //'author'
        ),
        'public' => true,
        'show_in_menu' => true, 
        //'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
    'list_article' => array(
        'label' => 'Listy',
        'labels' => array(
            'name' => 'Listy',
            'singular_name' => 'Listy',
        ),
        'supports' => array(
            'title',
            'editor',
            //'thumbnail',
            //'excerpt',                    
            //'author'
        ),
        'public' => true,
        'show_in_menu' => true, 
        'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------
    'short_content' => array(
        'label' => 'Wlepki',
        'labels' => array(
            'name' => 'Wlepki',
            'singular_name' => 'Wlepki',
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',                    
            'author'
        ),
        'public' => true,
        'show_in_menu' => true, 
        'taxonomies' => array('category'),
        //'register_meta_box_cb' =>  'template_hierarchy_box',
    ),
    //----------------------------------------------------------------


);
?>