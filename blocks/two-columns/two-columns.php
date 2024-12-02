<?php
/**
 * Two columns Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/
$id = 'block-' . $block['id'];

$option = get_field( 'custom_theme_two_columns_option' );
$image = get_field( 'custom_theme_two_columns_image' );
$imageSize = get_field( 'custom_theme_two_columns_image_size' );
$position = get_field( 'custom_theme_two_columns_position' );
$contentPosition =  ( 'left' === $position ) ? 'right' : 'left';
$isReverse = get_field( 'custom_theme_two_columns_reverse' ) ? 'reverse-mobile' : '';
$minHeight =  get_field( 'custom_theme_two_columns_min_height' ) ? 'min-height:' . get_field( 'custom_theme_two_columns_min_height' ) . 'px' : '';
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'custom_theme-two-columns ' . $isReverse . ' ' . $position,
    ]
);

?>
<?php
if ( isset( $block['data']['preview_image_two_columns'] ) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/images/blocks-preview/two-columns.png" style="width:100%; height:auto;">';
else :
?>
    <div <?php echo $wrapper_attributes; ?>>
        <?php if ( 'left' === $position ) : ?>
            <div class="custom_theme-two-columns__col custom_theme-two-columns__col--bg <?php echo $imageSize; ?>" style="<?php echo $minHeight; ?>">
                <div class="mask-wrapper"></div>
                <?php if ( 'image' === $option ) : ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image['ID'], 'large', "", ["class" => "custom_theme-two-columns__col--bg-image"]); ?>
                    <?php endif; ?>
                    <?php elseif ( 'video' === $option ) : 
                        $video = get_field( 'custom_theme_two_columns_video_iframe' );
                    ?>
                    <div class="video-wrapper">
                        <video autoplay="" muted="" playsinline="" loop="" data-wf-ignore="true" data-object-fit="cover" poster="https://cdn.indiawealth.in/public/images/transparent-background-mini.png">
                            <source src="<?php echo $video; ?>" type="video/mp4" data-wf-ignore="true" />
                            Test Video
                        </video>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="custom_theme-two-columns__col custom_theme-two-columns__col--content <?php echo $contentPosition . " " . $imageSize . "-offset"; ?>">
            <InnerBlocks />
        </div>
        <?php if ( 'right' === $position ) : ?>
            <div class="custom_theme-two-columns__col custom_theme-two-columns__col--bg <?php echo $imageSize; ?>" style="<?php echo $minHeight; ?>">
                <div class="mask-wrapper"></div>
                <?php if ( 'image' === $option ) : ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image['ID'], 'large', "", ["class" => "custom_theme-two-columns__col--bg-image"]); ?>
                    <?php endif; ?>
                    <?php elseif ( 'video' === $option ) : 
                        $video = get_field( 'custom_theme_two_columns_video_iframe' );
                    ?>
                    <div class="video-wrapper">
                        <video autoplay="" muted="" playsinline="" loop="" data-wf-ignore="true" data-object-fit="cover" poster="https://cdn.indiawealth.in/public/images/transparent-background-mini.png">
                            <source src="<?php echo $video; ?>" type="video/mp4" data-wf-ignore="true" />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>