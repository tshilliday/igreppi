<?php

add_filter('next_posts_link_attributes', 'next_posts_link_attributes');

function next_posts_link_attributes($output) {
        $output .= ' class="button next-posts-link"';
        return $output;
}