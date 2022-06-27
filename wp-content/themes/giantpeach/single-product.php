<?php get_header(); ?>

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>

            <?php
            $image = get_field('main_image');
            $image = wp_get_attachment_image_src($image, 'medium');
            $images = array($image);

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
                "@context": "https://schema.org/",
                "@type": "Product",
                "name": "<?php the_title();?>",
                "image": [
                    <?php foreach ($images as $key => $image) :?>
                        "<?php echo $image[0];?>"<?php if (($key + 1) != $count):?>,<?php endif;?>
                    <?php endforeach;?>
                ],
                "description": "<?php echo wp_strip_all_tags(get_the_excerpt());?>",
                "brand": {
                    "@type": "Thing",
                    "name": "I Greppi"
                }
            }
            </script>

            <?php get_template_part('partials/content', 'banner'); ?>

            <?php if (!get_field('banners')) : ?>
            <div class="c">

                <div class="r">
                    <div class="c-md-12">
                        <div class="content">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif; ?>


            <?php
            $colour = get_field('colour');
            ?>

            <div class="product-colour-<?php echo $colour;?>">
                <?php get_template_part('partials/product/excerpt'); ?>

                <?php get_template_part('partials/product/notes'); ?>

                <?php get_template_part('partials/product/profile'); ?>

                <?php get_template_part('partials/product/share'); ?>
            </div>

            <?php
        }
    }
    ?>

<?php get_footer(); ?>
