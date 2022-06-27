<?php

$image = get_sub_field('image');
$link = get_sub_field('link');

?>

<?php if ($image) : ?>
<div class="content-block content-block--annotated-image">

    <div class="c">
        <div class="r" style="position: relative;">

            <div class="l-c-md-o-3 c-md-6 c--image">
                <div class="moveit fade scroll-trigger" data-moveit-mode="before-scroll">
                    <?php lazyload_image_by_id(
                        array(
                            'image_id' => $image,
                            'default_size' => 'annotated_image',
                            'placeholder_size' => 'annotated_image_placeholder'
                        )
                    ); ?>
                    <?php if ($link && !empty($link['url'])) : ?>
                        <div class="annotated__link text--right">
                            <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button text--center'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
                <div class="c-md-3 c--left-caption">
                    <div class="annotated__caption annotated__caption--left  scroll-trigger">
                        <div class="fromLeft">
                            <?php the_sub_field('left_caption'); ?>
                        </div>
                        <div class="line sweep-forward"></div>
                    </div>
                </div>
                <div class="c-md-3 c--right-caption">
                    <div class="annotated__caption annotated__caption--right  scroll-trigger">
                        <div class="fromRight">
                            <?php the_sub_field('right_caption'); ?>
                        </div>
                        <div class="line sweep-backward"></div>
                    </div>
                </div>

        </div>
    </div>
</div>
<?php endif; ?>
