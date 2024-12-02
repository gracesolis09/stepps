<?php
function cv_create_post_type(
    string $post_type_name,
    string $singular = 'Custom Post', 
    string $plural = 'Custom Posts', 
    string $menu_icon = 'dashicons-admin-post',
    bool $hierarchical = false, 
    bool $has_archive = true, 
    string $description = '' ) {


    register_post_type( $post_type_name, array(
        'label'             => __( $singular, 'cv' ),
        'description'       => $description,
        'menu_icon'         => $menu_icon,
        'hierarchical'      => $hierarchical,
        'has_archive'       => $has_archive,
        'supports'          => array('title', 'editor', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'comments'),
        'labels'            => array(
            'name'                => _x( $plural, 'Post Type General Name', 'cv' ),
            'singular_name'       => _x( $singular, 'Post Type Singular Name', 'cv' ),
            'menu_name'           => __( $plural, 'cv' ),
            'parent_item_colon'   => __( 'Parent '.$singular, 'cv' ),
            'all_items'           => __( 'All '.$plural, 'cv' ),
            'view_item'           => __( 'View '.$singular, 'cv' ),
            'add_new_item'        => __( 'Add New '.$singular, 'cv' ),
            'add_new'             => __( 'Add New', 'cv' ),
            'edit_item'           => __( 'Edit '.$singular, 'cv' ),
            'update_item'         => __( 'Update '.$singular, 'cv' ),
            'search_items'        => __( 'Search '.$singular, 'cv' ),
            'not_found'           => __( 'Not Found', 'cv' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'cv' ),
        ),
        'capability_type'   => 'post',
        'public'            => true,
        'show_in_rest'      => true,
        'can_export'        => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        // 'taxonomies'          => array( 'category' ),
    ));

}
add_action( 'init', 'cv_custom_cpts' );
function cv_custom_cpts() {
    cv_create_post_type( 'careers', 'Careers', 'Careers', 'dashicons-businessperson' );
    cv_create_post_type( 'jobs', 'Jobs', 'Jobs', 'dashicons-businessperson' );
    cv_create_post_type( 'public-health-topic', 'Public Health Topic', 'Public Health Topics', 'dashicons-welcome-learn-more' );
}

// Register taxonomy for public-healt-topic
function public_health_topic_taxonomy() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Public Health Topics', 'public-health-topics', 'cv' ),
        'singular_name'     => _x( 'Public Health Topic', 'public-health-topic', 'cv' ),
        'edit_item'         => __( 'Edit Public Health Topic', 'cv' ),
        'update_item'       => __( 'Update Public Health Topic', 'cv' ),
        'add_new_item'      => __( 'Add New Public Health Topic', 'cv' ),
        'new_item_name'     => __( 'New Public Health Topic', 'cv' ),
        'menu_name'         => __( 'Public Health Topic', 'cv' ),
        'parent_item'       => __( 'Parent Category', 'cv' ),
		'parent_item_colon' => __( 'Parent Category:', 'cv' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'public-health-topic' ),
        'show_in_rest'      => true,
    );
    register_taxonomy( 'public-health-topic', array( 'public-health-topic' ), $args );
    // register_taxonomy( 'public-health-topic', array( 'clinic', 'class' ), $args );
}

//To rename posts to Custom name
add_action( 'init', 'cv_change_post_object' );
function cv_change_post_object() {
    $get_post_type = get_post_type_object( 'post' );
    $labels = $get_post_type->labels;
        $labels->name = __( 'Custom Name', 'cv' );
        $labels->singular_name = __( 'Custom Name', 'cv' );
        $labels->add_new = __( 'Add Custom Name', 'cv' );
        $labels->add_new_item = __( 'Add Custom Name', 'cv' );
        $labels->edit_item = __( 'Edit Custom Name', 'cv' );
        $labels->new_item = __( 'Custom Name', 'cv' );
        $labels->view_item = __( 'View Custom Name', 'cv' );
        $labels->search_items = __( 'Search Custom Name', 'cv' );
        $labels->not_found = __( 'No Custom Name found', 'cv' );
        $labels->not_found_in_trash = __( 'No Custom Name found in Trash', 'cv' );
        $labels->all_items = __( 'All Custom Name', 'cv' );
        $labels->menu_name = __( 'Custom Name', 'cv' );
        $labels->name_admin_bar = __( 'Custom Name', 'cv' );
}


// Remove tags support from posts
function cv_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'cv_unregister_tags');