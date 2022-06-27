<?php get_header(); ?>

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <?php get_template_part('partials/content', 'banner'); ?>

            <?php if (!get_field('banners') || get_the_content()) : ?>
                <div class="c">
                    <div class="r">
                        <div class="c-md-12">
                            <div class="content">
                                <?php if (!get_field('banners')) : ?>
                                    <h1><?php the_title(); ?></h1>
                                <?php endif; ?>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php get_template_part('partials/content-blocks/render'); ?>

            <?php
        }
    }
    ?>

<?php get_footer(); ?>
