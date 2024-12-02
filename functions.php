<?php 
/*
* Include all files in inc folder
*/
foreach ( glob( plugin_dir_path( __FILE__ ) . 'inc/*.php' ) as $filename ) {
	require_once $filename;
}

/* Create Custom Endpoint */
add_action('rest_api_init', 'register_custom_endpoint');

function register_custom_endpoint() {
    register_rest_route('my-custom-api/v1', '/my-endpoint/', array(
        'methods' => 'GET',
        'callback' => 'get_post_by_slug',
    ));
}

function get_post_by_slug($data) {
    $args = array(
        'name' => $data['slug'], // Retrieve slug from request
        'post_type' => 'jobs', // Adjust post type if necessary
        'post_status' => 'publish',
        'numberposts' => 1,
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('not_found', 'Post not found', array('status' => 404));
    }

    // Prepare and return response
    $post = $posts[0];
    $response = array(
        'id' => $post->ID,
        'title' => $post->post_title,
        'content' => apply_filters('the_content', $post->post_content),
        'permalink' => get_permalink($post->ID),
    );

    return rest_ensure_response($response);
    
    // $response = array(
    //     'message' => 'Hello, this is my custom endpoint!',
    //     'data_received' => $data,
    // );
    // return rest_ensure_response($response);
}