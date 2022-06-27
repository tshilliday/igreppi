<?php
$category = get_category( get_query_var( 'cat' ) );
$image_src = false;

if ($category) {
    $id = $category->cat_ID;
    $image = get_field('image', 'category_' . $id);
    $image_src = wp_get_attachment_image_src($image, 'default-banner');
}
?>

<?php if ($image_src): ?>
    <?php
    $shape = get_field('banner_shape', 'category_' . $id);
    $overlay_color = get_field('banner_overlay_colour', 'category_' . $id);
    $banner_class = "banner--$shape banner--$overlay_color";
    ?>
    <div class="banner scroll-trigger <?php echo $banner_class; ?>">
        <div class="banner__item">
            <div class="banner__inner">
                <?php if ($image_src) : ?>
                    <div class="banner__image">
                        <picture>
                            <img src="<?php echo $image_src[0]; ?>" data-src="<?php echo $image_src[0]; ?>" alt="<?php the_image_alt($banner_image['id']); ?>" />
                        </picture>
                    </div>
                <?php endif; ?>

                <div class="banner__text moveit" data-moveit-mode="after-scroll">
                    <div class="banner__content">
                        <div class="c">
                            <div class="r">
                                <div class="c-xs-9
                                            c-sm-8
                                            l-c-md-o-2 c-md-7
                                            c-lg-6
                                            c-xl-8
                                            l-c-xl-o-2
                                            l-c-xxl-o-1
                                            ">

                                    <h1><?php echo $category->name; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else :?>
    <div class="c c--cat">
        <div class="r">
            <div class="c-md-12">
                <h1 class="h1">
                    <?php echo $category->name; ?>
                </h1>
            </div>
        </div>
    </div>
<?php endif;?>
