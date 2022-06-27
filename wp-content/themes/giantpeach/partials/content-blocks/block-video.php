<?php
$video = get_sub_field('video');
$link = get_sub_field('link');
$text_col_class="c-md-12";

if ($video) {
    $text_col_class="c-md-5 c-vertical-center";
    $video_col_class="l-c-md-o-1 c-md-6 c-vertical-center";

    if (get_sub_field('text_position') == 'right') {
        $text_col_class="c-md-5 l-c-sm-o-1 l-c-md-o-1 c-vertical-center";
        $video_col_class="c-md-6 l-c-md-o-0 c-md-or-1 c-vertical-center";
    }
}

?>

<div class="content-block content-block--video">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <?php the_sub_field('content'); ?>
                <?php if ($link && !empty($link['url'])) : ?>
                    <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button'); ?>
                <?php endif; ?>
            </div>
            <?php if ($video) : ?>
                <div class="<?php echo $video_col_class; ?>">
                    <div class="video-player">
                        <video src="<?php echo $video['url']; ?>" preload="auto" loop="loop" playsinline="" muted="muted"></video>
                        <button type="button" aria-label="Play video" class="video-player__play"></button>
                        <!-- <button type="button" aria-label="Pause video" class="video-player__pause"></button> -->
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
