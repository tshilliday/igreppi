<?php

$image = get_sub_field('image');
$link = get_sub_field('link');
$text_col_class="c-md-12";
$content_class="fromLeft";
$default_image_size = "feature_landscape";
$placeholder_size = "feature_landscape_placeholder";
$show_map = false;
$image_crop = get_sub_field('image_crop');;

if ($image) {
    $text_col_class="fromLeft c-md-5 c-vertical-center";
    $image_col_class="l-c-md-o-1 c-md-6 c-vertical-center";
    $image_position = get_sub_field('image_position');
    if ($image_position == 'left') {
        $content_class="fromRight";
        $text_col_class = "l-c-md-o-1 c-md-5 c-vertical-center";
        $image_col_class = "c-md-6 c-md-or-1 c-vertical-center";
    }
    if ($image_crop == 'landscape') {
        $default_image_size = "feature_landscape";
        $placeholder_size = "feature_landscape_placeholder";
        $image_col_class .= " landscape";
    }
    if ($image_crop == 'portrait') {
        $default_image_size = "feature_portrait";
        $placeholder_size = "feature_portrait_placeholder";
        $image_col_class .= " portrait";
    }
    if ($image_crop == 'square') {
        $default_image_size = "feature";
        $placeholder_size = "feature_placeholder";
        $image_col_class .= " square";
    }
}

// map background, hardcoded to Terroir page
if (is_page(114) && $image_position == 'left' && $GLOBALS['content_block_count'] > 1) {
    $show_map = true;
}

?>

<div class="content-block content-block--feature <?php if ($show_map) : ?>content-block--map-bg<?php endif; ?> scroll-trigger">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <div class="content-block__content <?php echo $content_class; ?>">
                    <?php the_sub_field('content'); ?>
                    <?php if ($link && !empty($link['url'])) : ?>
                        <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button content-block__link'); ?>
                    <?php endif; ?>
                </div>
                <?php if ($show_map) : ?>
                    <div class="map__bg">
                        <div class="map map--vineyard">
                            <?php get_template_part('partials/map/vineyard'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($image) : ?>
                <div class="<?php echo $image_col_class; ?> moveit fade scroll-trigger"
                    <?php if ($GLOBALS['content_block_count'] == 1) : ?>
                        data-moveit-mode="before-scroll"
                    <?php endif; ?>
                    >
                    <?php lazyload_image_by_id(
                        array(
                            'image_id' => $image,
                            'default_size' => $default_image_size,
                            'placeholder_size' => $placeholder_size
                        )
                    ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
