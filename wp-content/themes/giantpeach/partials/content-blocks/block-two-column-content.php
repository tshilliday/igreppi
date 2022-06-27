<?php $heading = get_sub_field('heading'); ?>

<section class="content-block content-block--two-column-content">
    <div class="c">
        <div class="r">
            <?php if ($heading) : ?>
                <div class="c-md-8">
                    <h2><?php the_sub_field('heading'); ?></h2>
                </div>
            <?php endif; ?>
            <div class="c-md-6">
                <?php the_sub_field('content'); ?>
            </div>
            <div class="c-md-6">
                <?php the_sub_field('content_2'); ?>
            </div>
        </div>
    </div>
</section>
