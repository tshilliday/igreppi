<?php

$image = get_sub_field('image');
$link = get_sub_field('link');

if ($image) {
    $content_class="fromRight";
    $text_col_class = "l-c-md-o-1 c-md-5 c-vertical-center";
    $image_col_class = "c-md-6 c-md-or-1 c-vertical-center";
}
?>

<div class="content-block content-block--feature content-block--feature-intro scroll-trigger">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <div class="content-block__content <?php echo $content_class; ?>">
                    <?php the_sub_field('content'); ?>
                    <?php if ($link && !empty($link['url'])) : ?>
                        <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button content-block__link'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($image) : ?>
                <div class="<?php echo $image_col_class; ?> moveit fade scroll-trigger fromLeft" style="position: relative; overflow: visible;"
                    <?php if ($GLOBALS['content_block_count'] == 1) : ?>
                        data-moveit-mode="before-scroll"
                    <?php endif; ?>
                    >
                    <?php lazyload_image_by_id(
                        array(
                            'image_id' => $image,
                            'default_size' => 'feature',
                            'placeholder_size' => 'feature_placeholder'
                        )
                    ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
