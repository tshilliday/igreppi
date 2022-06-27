<?php
$stockists = get_field('stockists');
?>

<div class="content-block content-block--product-profile" id="wine-profile">
    <div class="c">
        <div class="r">

            <div class="c-md-12">
                <header class="product__profile-header">
                    <h2 class="h4">Wine Profile</h2>
                    <?php if (count($stockists) >= 1) : ?>
                        <a class="button product__stockists-find overlay__button" data-target="#overlay-stockists" href="#">Find Stockists</a>
                    <?php endif; ?>
                </header>
            </div>

            <?php if (get_field('wine_profile')) : ?>
                <div class="c-md-4">
                    <div class="product__profile-block">
                        <?php the_field('wine_profile'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="c-md-3 l-c-md-o-1 moveit" data-moveit-mode="before-scroll" data-moveit-speed="5">
                <div class="r">
                    <?php if (get_field('first_vintage')) : ?>
                        <div class="c-xs-6 c-md-12">
                            <div class="product__profile-block">
                                <h3 class="h5">First Vintage</h3>
                                <p><?php the_field('first_vintage'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (get_field('annual_production')) : ?>
                        <div class="c-xs-6 c-md-12">
                            <div class="product__profile-block">
                                <h3 class="h5">Annual</h3>
                                <p><?php the_field('annual_production'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>


            </div>
            <?php if (get_field('vinification')) : ?>
                <div class="c-md-4 moveit" data-moveit-mode="before-scroll" data-moveit-speed="2.5">
                    <div class="product__profile-block">
                        <h3 class="h5">Vinification</h3>
                        <?php the_field('vinification'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="overlay overlay--stockists" id="overlay-stockists">
    <div class="overlay__inner">
        <div class="overlay__close"></div>
        <div class="overlay__content">
            <h4 class="fg-blue">Stockists</h4>
            <ul class="product__stockists">
                <?php foreach ($stockists as $stockist) : ?>
                    <li><?php printf('<a target="_blank" rel="noopener noreferrer" class="button product__stockists-link h4 fg-black" href="%s">%s</a>', $stockist['url'], $stockist['name']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
