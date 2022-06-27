<?php

$link = get_sub_field('link');
$map_text = get_sub_field('map_text');

$text_col_class = "fromRight l-c-md-o-1 c-md-4 c-vertical-center";
$map_col_class = "c-md-7 c-md-or-1 c-vertical-center";

?>

<div class="content-block content-block--text-satellite scroll-trigger">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <?php the_sub_field('content'); ?>
                <?php if ($link && !empty($link['url'])) : ?>
                    <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button content-block__link'); ?>
                <?php endif; ?>
            </div>
            <div class="<?php echo $map_col_class; ?>">
                <div class="satellite__container">

                    <div class="satellite">
                        <?php lazyload_image_by_src(
                            array(
                                'default_src' => get_template_directory_uri().'/dist/images/satellite.jpg',
                                'ratio_width' => 1041,
                                'ratio_height' => 1060,
                                'alt' => ''
                            )
                        ); ?>
                    </div>

                    <div class="map__satellite">
                        <div class="map map--vineyard">
                            <?php get_template_part('partials/map/vineyard'); ?>
                        </div>
                    </div>

                    <?php if ($map_text) : ?>
                        <div class="map__text"><?php the_sub_field('map_text'); ?></div>
                        <div class="map__line sweep-forward"></div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
