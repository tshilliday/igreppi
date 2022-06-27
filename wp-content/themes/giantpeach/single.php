<?php get_header(); ?>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>

            <?php
            $images = array();
            $id = get_the_ID();
            while (have_rows('banners')) {
                the_row();
                $banner_image = get_sub_field('background_image');
                if ($banner_image) {
                    $images[] = wp_get_attachment_image_src($banner_image, 'default-banner');
                }
            }

            $count = count($images);
            ?>

            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "NewsArticle",
                "headline": "<?php the_title(); ?>",
                "author": {
                    "@type": "Organization",
                    "name": "I Greppi"
                },
                "datePublished": "<?php echo get_the_date('Y-m-d');?>",
                "dateModified": "<?php echo get_the_modified_date('Y-m-d');?>",
                "image": [
                    <?php foreach ($images as $key => $image) :?>
                        "<?php echo $image[0];?>"<?php if (($key + 1) != $count):?>,<?php endif;?>
                    <?php endforeach;?>
                ],
                "publisher": {
                    "@type": "Organization",
                    "name": "I Greppi",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "<?php echo get_home_url();?>/app/themes/giantpeach/dist/logo.png"
                    }
                },
            }
            </script>

            <?php get_template_part('partials/content', 'banner'); ?>

            <div class="c">
                <div class="r">
                    <div class="c-md-10 l-c-md-o-1">
                        <div class="post__date">
                            <?php echo get_the_date(); ?>
                        </div>
                        <?php
                        $terms = get_the_terms( $post->ID, 'category' );
                        if ($terms && ! is_wp_error($terms)): ?>
                            <ul class="post__item-categories small-caps">
                                <?php foreach($terms as $term): ?>
                                    <li><a class="ajax" href="<?php echo get_term_link( $term->slug, 'category'); ?>" rel="tag"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (!get_field('banners') || get_the_content()) : ?>
                <div class="c">
                    <div class="r">
                        <div class="c-md-10 l-c-md-o-1">
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

            <?php get_template_part('partials/post/share'); ?>

            <?php get_template_part('partials/post/signup'); ?>

            <div class="post__related">
                <?php get_template_part('partials/content-blocks/block-latest-news'); ?>
            </div>



            <?php
        }
    }
    ?>

<?php get_footer(); ?>
