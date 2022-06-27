<?php
    /*
        Template Name: 404 Page
    */
?>
<?php get_header(); ?>

    <?php
    $template_post = get_page_id_by_template('404.php');
    if ($template_post) {
        setup_postdata($GLOBALS['post'] = $template_post);
    }
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

    <?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
