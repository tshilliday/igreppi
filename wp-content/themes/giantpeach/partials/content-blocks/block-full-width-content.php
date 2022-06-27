<?php
$width = get_sub_field('width');
?>
<section class="content-block content-block--full-width-content">
    <div class="c">
        <div class="r">
            <?php if ($width == 'full') : ?>
                <div class="c-md-10">
            <?php else : ?>
                <div class="c-md-6 l-c-md-o-2">
            <?php endif; ?>
                    <?php the_sub_field('content'); ?>
                </div>
        </div>
    </div>
</section>
