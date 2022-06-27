<?php
$heading = get_sub_field('heading');
$link = get_sub_field('link');

$args = array(
    'post_status' => 'publish',
    'post_type' => 'post',
    'posts_per_page' => 2
);

if (isset($categories) && !empty($categories)) {
    $args['tax_query'] = array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' => $categories,
    );
}

if (is_singular('post')) {
    $args['post__not_in'] = array(get_the_ID());
}
if (!$heading && is_singular('post')) {
    $heading = "Related News";
}

$the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()) : ?>
    <section class="content-block content-block--latest-news">
        <div class="c">
            <?php if ($heading) : ?>
                <h2 class="content-block__heading fg-black"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <div class="r">
                <?php
                $speed = 6;
                while ($the_query->have_posts()) :
                    $the_query->the_post(); ?>
                    <div class="c-sm-6 moveit" data-moveit-speed="<?php echo $speed; ?>" data-moveit-mode="before-scroll">
                        <?php get_template_part('partials/post/item'); ?>
                    </div>
                <?php
                $speed = 3;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php if ($link && !empty($link['url'])) : ?>
                <div class="text--right">
                    <?php echo get_button_html($link['url'], $link['title'], $link['target'], 'button button--alt text--center'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>
