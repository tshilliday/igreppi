<?php
function custom_excerpt_length($length)
{
    return 20;
}

function custom_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);
add_filter('excerpt_more', 'custom_excerpt_more');
