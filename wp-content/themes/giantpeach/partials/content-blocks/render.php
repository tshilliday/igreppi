<?php

if (have_rows('content_blocks')) :
    $GLOBALS['content_block_count'] = 0;
    while (have_rows('content_blocks')) :
        $GLOBALS['content_block_count']++;
        the_row();
        if (get_row_layout() == 'block_full_width_content') :
            get_template_part('partials/content-blocks/block-full-width-content');
        endif;

        if (get_row_layout() == 'block_two_column_content') :
            get_template_part('partials/content-blocks/block-two-column-content');
        endif;

        if (get_row_layout() == 'block_latest_news') :
            get_template_part('partials/content-blocks/block-latest-news');
        endif;

        if (get_row_layout() == 'block_feature') :
            get_template_part('partials/content-blocks/block-feature');
        endif;

        if (get_row_layout() == 'block_feature_intro') :
            get_template_part('partials/content-blocks/block-feature-intro');
        endif;

        if (get_row_layout() == 'block_text_map') :
            get_template_part('partials/content-blocks/block-text-map');
        endif;

        if (get_row_layout() == 'block_text_satellite') :
            get_template_part('partials/content-blocks/block-text-satellite');
        endif;

        if (get_row_layout() == 'block_products') :
            get_template_part('partials/content-blocks/block-products');
        endif;

        if (get_row_layout() == 'block_video') :
            get_template_part('partials/content-blocks/block-video');
        endif;

        if (get_row_layout() == 'block_featured_text') :
            get_template_part('partials/content-blocks/block-featured-text');
        endif;

        if (get_row_layout() == 'block_annotated_image') :
            get_template_part('partials/content-blocks/block-annotated-image');
        endif;

        if (get_row_layout() == 'block_hero') :
            get_template_part('partials/content-blocks/block-hero');
        endif;

        if (get_row_layout() == 'block_form') :
            get_template_part('partials/content-blocks/block-form');
        endif;

        if (get_row_layout() == 'block_instagram') :
            get_template_part('partials/content-blocks/block-instagram');
        endif;

        if (get_row_layout() == 'block_talk_to_us') :
            get_template_part('partials/content-blocks/block-talk-to-us');
        endif;
    endwhile;
endif;
