<?php defined('ABSPATH') or die('No script please!'); ?>
<article class="post__item">
    <a href="<?php the_permalink(); ?>" class="post__item-image ajax">
        <?php lazyload_image_by_id(
            array(
                'image_id' => get_post_thumbnail_id(),
                'default_size' => 'news-list',
                'responsive_sizes' => array (
                    1400 => 'news-list-large'
                )
            )
        ); ?>
    </a>
    <div class="post__item-meta">
        <?php
        $terms = get_the_terms( $post->ID, 'category' );
        if ($terms && ! is_wp_error($terms)): ?>
            <ul class="post__item-categories small-caps">
                <?php foreach($terms as $term): ?>
                    <li><a class="ajax" href="<?php echo get_term_link( $term->slug, 'category'); ?>" rel="tag"><?php echo $term->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <h2 class="h4 post__item-title">
            <a class="ajax" href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <a class="ajax read-more" href="<?php the_permalink(); ?>">Read</a>
    </div>
</article>
