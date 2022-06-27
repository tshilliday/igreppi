<?php
$image = get_field('main_image');
?>

<div class="content-block content-block--product-notes">
    <div class="c">
        <div class="product__notes-wrapper" style="position:relative">
            <div class="scroll-trigger fromBottom">
                <div class="product__image moveit">
                    <?php lazyload_image_by_id(
                        array(
                            'image_id' => $image,
                            'default_size' => 'large',
                            'responsive_sizes' => array(
                                '501' => 'full'
                            )
                        )
                    ); ?>
                </div>
            </div>
            <div class="product__notes">
            <?php if (get_field('tasting_notes')) : ?>
                <div class="product__note product__note--tasting scroll-trigger">
                    <div class="fromLeft">
                        <h3 class="display product__note-heading">Tasting notes</h3>
                        <?php the_field('tasting_notes'); ?>
                    </div>
                    <div class="line sweep-forward"></div>
                </div>
            <?php endif; ?>
            <?php if (get_field('aging')) : ?>
                <div class="product__note product__note--aging scroll-trigger">
                    <div class="fromRight">
                        <h3 class="display product__note-heading">Aging</h3>
                        <?php the_field('aging'); ?>
                    </div>
                    <div class="line sweep-backward"></div>
                </div>
            <?php endif; ?>
            <?php if (get_field('composition')) : ?>
                <div class="product__note product__note--composition scroll-trigger">
                    <div class="fromLeft">
                        <h3 class="display product__note-heading">Composition</h3>
                        <?php the_field('composition'); ?>
                    </div>
                    <div class="line sweep-forward"></div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
