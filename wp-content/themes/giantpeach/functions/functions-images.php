<?php
add_image_size('default-banner', 1920, 1225, true);
add_image_size('hero-banner', 1920, 1920, true);
add_image_size('news-list', 540, 445, true);
add_image_size('news-list-large', 810, 668, true);
add_image_size('placeholder', 100, 100, false);

add_image_size('feature', 800, 800, true);
add_image_size('feature_placeholder', 100, 100, true);

add_image_size('feature_portrait', 700, 800, true);
add_image_size('feature_portrait_placeholder', 88, 100, true);

add_image_size('feature_landscape', 800, 700, true);
add_image_size('feature_landscape_placeholder', 100, 88, true);

add_image_size('annotated_image', 866, 1300, true);
add_image_size('annotated_image_placeholder', 66, 100, true);

add_image_size('menu_background', 1920, 1080, true);

add_filter( 'jpeg_quality', function($arg) { return 100; } );

add_filter('image_resize_dimensions', 'image_crop_dimensions', 10, 6);
function image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop)
{

    // resize image up to at least as big as specified dimension, if smaller

    if (!$crop) {
        // let the wordpress default function handle this
        return null;
    }

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor(($orig_w - $crop_w) / 2);
    $s_y = floor(($orig_h - $crop_h) / 2);

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}

function the_image_alt($image_id, $echo = true)
{
    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

    if (!$alt) {
        $alt = '';
    }

    if ($echo) {
        echo $alt;
    } else {
        return $alt;
    }
}

function lazyload_image_by_id($args)
{

    if (!isset($args['image_id'])) {
        return;
    }
    $default_image_src = wp_get_attachment_image_src($args['image_id'], $args['default_size']);
    $placeholder_size = 'placeholder';
    if (isset($args['placeholder_size']) && !empty($args['placeholder_size'])) {
        $placeholder_size = $args['placeholder_size'];
    }
    $width = (isset($args['ratio_width'] ) )? $args['ratio_width'] : $default_image_src[1];
    $height = (isset($args['ratio_height'] )) ? $args['ratio_height'] : $default_image_src[2];

    $src_args = array(
        'default_src' => $default_image_src[0],
        'placeholder_src' => wp_get_attachment_image_src($args['image_id'], $placeholder_size)[0],
        'alt' => the_image_alt($args['image_id'], false),
        'ratio_width' => $width,
        'ratio_height' => $height,
        'container_open_tag' => isset($args['container_open_tag'] ) ? $args['container_open_tag'] : '<div class="lazyload__container">'
    );

    if (isset($args['responsive_sizes']) && !empty($args['responsive_sizes'])) {
        foreach ($args['responsive_sizes'] as $width => $size) {
            $src_args['responsive_sources'][$width] = wp_get_attachment_image_src($args['image_id'], $size)[0];
        }
    }

    lazyload_image_by_src($src_args);
}

function lazyload_image_by_src($args)
{
    // put in descending order
    $responsive_sources = array();
    $container_open_tag = isset($args['container_open_tag'] ) ? $args['container_open_tag'] : '<div class="lazyload__container">';
    if (isset($args['responsive_sources']) && !empty($args['responsive_sources'])) {
        $responsive_sources = array_reverse($args['responsive_sources'], true);
    }
    $ratio = 100;
    if ($args['ratio_height'] > 0 && $args['ratio_width'] > 0) {
        $ratio = $args['ratio_height'] / $args['ratio_width'] * 100;
    }
    ?>
    <?php echo $container_open_tag; ?>
        <picture style="padding-bottom: <?php echo $ratio ?>%;">
            <?php foreach ($responsive_sources as $width => $src) : ?>
                <source
                    data-srcset="<?php echo $src; ?>"
                    media="(min-width: <?php echo $width; ?>px)" />
            <?php endforeach; ?>
            <img
                class="lazyload"
                data-src="<?php echo $args['default_src']; ?>"
                <?php if (isset($args['placeholder_src']) && !empty($args['placeholder_src'])) : ?>
                    src="<?php echo $args['placeholder_src']; ?>"
                <?php endif; ?>
                alt="<?php echo $args['alt'] ?>" />
            <noscript>
                <img src="<?php echo $args['default_src']; ?>" alt="<?php echo $args['alt'] ?>" />
            </noscript>
        </picture>
    </div>
    <?php
}
