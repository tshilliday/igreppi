<?php
//wp_reset_postdata();
if (function_exists('get_field')) {
    $id = get_the_ID();
    if (is_home() || is_category()) {
        $id = get_option('page_for_posts');
    }

    $banners = get_field('banners', $id);
    $banners_count = count($banners);
    $banner_count = 0;
    $video_overlays = array();

    $shape = get_field('banner_shape',$id);
    $text_color = get_field('banner_text_color',$id);
    $overlay_color = get_field('banner_overlay_color',$id);

    $banner_class = "banner--$shape banner--$overlay_color banner--text-$text_color";

    if (is_front_page()) {
        $banner_class .= " banner--home";
    }

    if (have_rows('banners', $id)) { ?>
        <div class="banner scroll-trigger
            <?php if ($banners_count > 1) {
                echo 'js';
            } ?>
            <?php echo $banner_class; ?>
            ">
                <?php
                while (have_rows('banners', $id)) {
                    the_row();
                    $banner_image_src = false;
                    $banner_count++;
                    $banner_image = get_sub_field('background_image');
                    $banner_video = get_sub_field('background_video');
                    $target = "";
                    $link = get_sub_field('link');

                    if ($videoUrl = get_sub_field('video_url')) {
                        $videoEncodedUrl = get_video_url($videoUrl);
                        $videoId = get_video_id($videoUrl);
                        $video_overlays[$videoId] = $videoEncodedUrl;
                    }

                    if ($banner_image) {
                        $banner_image_src = wp_get_attachment_image_src($banner_image, 'default-banner');
                    }

                    ?>
                    <div class="banner__item">

                        <div class="banner__inner">

                            <?php if ($banner_image_src) : ?>
                                <div class="banner__image">
                                    <picture>
                                        <img src="<?php echo $banner_image_src[0]; ?>" data-src="<?php echo $banner_image_src[0]; ?>" alt="<?php the_image_alt($banner_image['id']); ?>" />
                                    </picture>
                                </div>
                            <?php endif; ?>

                            <?php if ($banner_video) : ?>
                                <div class="banner__video">
                                    <video id="player" muted="muted" loop="loop" autoplay playsinline data-object-fit="cover">
                                        <source src="<?php echo $banner_video; ?>" type="video/mp4" srcset="(min-width: 800px)" />
                                        <img src="<?php echo $banner_image_src[0]; ?>" data-src="<?php echo $banner_image_src[0]; ?>" alt="<?php the_image_alt($banner_image['id']); ?>" />
                                    </video>
                                </div>
                            <?php endif; ?>

                            <div class="banner__text">
                                <div class="banner__content moveit" data-moveit-mode="after-scroll">
                                    <div class="c">
                                        <div class="r">
                                            <?php if (!empty($videoUrl)) : ?>
                                                <?php if (get_sub_field('title') || get_sub_field('caption')) : ?>
                                                    <div class="c-xs-9
                                                                c-sm-8
                                                                l-c-md-o-2 c-md-6
                                                                c-lg-5
                                                                l-c-xl-o-2 c-xl-6
                                                                l-c-xxl-o-1
                                                                ">
                                                <?php else : ?>
                                                    <div class="">
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (is_singular('product')) : ?>
                                                    <div class="c-xs-6
                                                                l-c-md-o-1 c-md-5
                                                                ">
                                                <?php else : ?>
                                                    <div class="c-xs-9
                                                                c-sm-8
                                                                l-c-md-o-2 c-md-7
                                                                c-lg-7
                                                                l-c-xl-o-2 c-xl-8
                                                                l-c-xxl-o-1 c-xxl-6
                                                                ">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                                    <?php if (get_sub_field('title')) : ?>
                                                        <?php if ($banner_count == 1) : ?>
                                                            <h1><?php the_sub_field('title'); ?></h1>
                                                        <?php else : ?>
                                                            <div class="h1"><?php the_sub_field('title'); ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if (get_sub_field('caption') || $link) : ?>
                                                        <div class="banner__caption">
                                                            <?php the_sub_field('caption'); ?>
                                                            <?php if ($link) : ?>
                                                                <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button button--md'); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                            <?php if (!empty($videoUrl)) : ?>
                                                <?php if (get_sub_field('title') || get_sub_field('caption')) : ?>
                                                    <div class="c-xs-3
                                                            c-sm-4
                                                            c-xl-3
                                                            c-xxl-2
                                                            c-vertical-center">
                                                <?php else : ?>
                                                    <div class="c-md-12 c-vertical-center c-horizontal-center">
                                                <?php endif; ?>
                                                        <a class="button--video overlay__button" href="#" data-target="#overlay-video-<?php echo $videoId; ?>">
                                                            Play Video
                                                        </a>
                                                    </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <?php
                } // while
                ?>
        </div>

        <?php
    } // have_rows
}
?>

<?php foreach ($video_overlays as $videoId => $videoEncodedUrl) : ?>
    <div class='overlay overlay--video' id='overlay-video-<?php echo $videoId; ?>'>
        <div class='overlay__inner'>
            <div class='overlay__close'></div>
            <div class="overlay__content">
                <iframe src="<?php echo $videoEncodedUrl; ?>" allow="autoplay; encrypted-media" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endforeach; ?>
