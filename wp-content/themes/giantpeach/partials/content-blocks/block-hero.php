<?php

$image = get_sub_field('image');
$link = get_sub_field('link');
$style = get_sub_field('style');
$text_color = get_sub_field('text_color');

?>

<?php if ($image) : ?>
<div class="content-block content-block--hero hero--<?php echo $style;?> hero--text-<?php echo $text_color[0];?> scroll-trigger">
    <div class="hero__image">
        <?php lazyload_image_by_id(
            array(
                'image_id' => $image,
                'default_size' => 'hero-banner',
                'ratio_width' => '1920',
                'ratio_height' => '1920',
                'container_open_tag' => '<div class="lazyload__container moveit" data-moveit-speed="10">'
            )
        ); ?>
    </div>
    <div class="hero__text text--center">
        <div class="c">
            <div class="r">
                <div class="c-sm-10 l-c-sm-o-1 c-md-8 l-c-md-o-2">
                    <div class="content-block__content fromBottom">
                        <?php the_sub_field('content'); ?>
                        <?php if ($link && !empty($link['url'])) : ?>
                            <div class="hero__link">
                                <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button button--white text--center content-block__link'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
