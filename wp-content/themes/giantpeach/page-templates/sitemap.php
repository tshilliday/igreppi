<?php
    /*
        Template Name: Sitemap
    */
?>
<?php get_header(); ?>

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <?php get_template_part('partials/content', 'banner'); ?>

            <div class="c">

                    <div class="r">
                        <div class="c-md-12">
                            <div class="content">
                                <?php if (!get_field('banners')) : ?>
                                    <h1><?php the_title(); ?></h1>
                                <?php endif; ?>
                                <?php the_content(); ?>
                                <ul>
                                    <?php
                                        wp_list_pages(array(
                                            'title_li' => '',
                                        ));
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

            </div>
            <?php
        }
    }
    ?>

<?php get_footer(); ?>
