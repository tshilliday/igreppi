<?php get_header(); ?>

    <?php get_template_part('partials/content', 'banner'); ?>

    <div class="post__cats">
        <div class="c">
            <?php get_template_part('partials/post/categories'); ?>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <div class="content-block content-block--posts">
            <div class="c">
                <div class="r r--posts">
                    <?php
                    $count = 0;
                    while (have_posts()) : $count++;
                        the_post();
                        ?>
                        <div class="c-sm-6 content-block--post">
                            <?php get_template_part('partials/post/item') ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <div id="post_navigation" class="text--center">
                <div class="c">
                    <div class="r">
                        <div class="c-md-12">
                            <?php if (get_next_posts_link()): ?>
                                <?php next_posts_link( 'Load More' ); ?>
                                <i class="fal fa-long-arrow-down"></i>
                                <i class="fas fa-spinner fa-spin"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <?php $template_post = get_post(get_option('page_for_posts')); ?>
    <?php if ($template_post) setup_postdata( $GLOBALS['post'] = $template_post ); ?>

    <?php get_template_part('partials/content-blocks/render'); ?>

    <?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
