<?php
register_post_type(
    'product',
    array(
        'labels' => array(
            'name' => __('Products'),
            'singular_name' => __('Product'),
            'add_new_item' => "Add Product",
            'edit_item' => "Edit Product",
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'wine', 'with_front' => false),
        'publicly_queryable' => true,
        'show_in_rest' => true,
        'rest_base' => 'products',
        'menu_icon' => 'dashicons-cart',
        'supports' => array(
            'page-attributes',
            'title',
            'excerpt',
            'editor'
        )
    )
);
