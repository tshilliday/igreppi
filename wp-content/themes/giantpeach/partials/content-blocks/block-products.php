<?php
$products = get_sub_field('products');
$link = get_sub_field('link');
$text_col_class="c-md-12";

if ($products) {
    $text_col_class="c-md-5 c-vertical-center";
    $products_col_class="l-c-sm-o-2 c-sm-8 l-c-md-o-1 c-md-6 c-vertical-center";
}

?>

<div class="content-block content-block--products">

    <div class="c">
        <div class="r">
            <div class="<?php echo $text_col_class; ?>">
                <?php the_sub_field('content'); ?>
                <?php if ($link && !empty($link['url'])) : ?>
                    <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button content-block__link'); ?>
                <?php endif; ?>
            </div>
            <?php if ($products) : ?>
                <div class="<?php echo $products_col_class; ?>">
                    <div class="r">
                        <?php
                        $speed = 2.5;
                        foreach ($products as $product) : ?>
                            <div class="c-xxs-6">
                                <div class="content-block--products__image moveit" data-moveit-speed="<?php echo $speed; ?>">
                                <?php lazyload_image_by_id(
                                    array(
                                        'image_id' => get_field('main_image', $product->ID),
                                        'default_size' => 'large'
                                    )
                                ); ?>
                                </div>
                            </div>
                            <?php
                            $speed = 5;
                        endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
