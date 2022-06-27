<?php

$link = get_sub_field('link');
$map_text = get_sub_field('map_text');
$text_col_class="c-md-12";

$text_col_class="fromLeft c-md-4 c-vertical-center";
$map_col_class="l-c-sm-o-2 c-sm-8 l-c-md-o-1 c-md-7 c-vertical-center";
$map_position = get_sub_field('map_position');
if ($map_position == 'left') {
    $text_col_class = "fromRight l-c-md-o-1 c-md-4 c-vertical-center";
    $map_col_class = "l-c-sm-o-2 c-sm-8 c-md-7 c-md-or-1 c-vertical-center";
}

?>

<div class="content-block content-block--text-map scroll-trigger">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <?php the_sub_field('content'); ?>
                <?php if ($link && !empty($link['url'])) : ?>
                    <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button content-block__link'); ?>
                <?php endif; ?>
            </div>
            <div class="<?php echo $map_col_class; ?>">
                <div class="map map--vineyard">

                    <?php get_template_part('partials/map/vineyard'); ?>

                    <?php if ($map_text) : ?>
                        <div class="map__text">
                            <?php the_sub_field('map_text'); ?>
                        </div>
                        <div class="map__line">
                            <div class="map__line-inner"></div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
