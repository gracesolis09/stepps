<?php

/**
 * Slider Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'custom-theme-slider js-custom-theme-slider'
    ]
);
?>
<?php
if ( isset($block['data']['preview_image_slider']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/images/blocks-preview/slider.png" style="width:100%; height:auto;">';
else :
?>
    <!-- Slider code here -->
    <?php
endif;    
?>