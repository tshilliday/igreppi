<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <?php
        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title h3"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        }
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">

        <?php if (is_single()) : ?>
            <?php
                /* translators: %s: Name of current post */
                the_content(sprintf(
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>'),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before'      => '<div class="page-links">' . __('Pages:'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ));
            ?>
        <?php else : ?>
            <?php the_excerpt(); ?>
            <a class="indent blog__read-more" href="<?php the_permalink(); ?>">Read More</a>
        <?php endif; ?>


    </div><!-- .entry-content -->

    <?php if (is_single()) : ?>
        <?php twentyseventeen_entry_footer(); ?>
    <?php endif; ?>

</article><!-- #post-## -->
