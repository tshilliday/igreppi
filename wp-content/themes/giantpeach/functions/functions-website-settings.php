<?php

if (function_exists('acf_add_options_page')) {
    website_settings_init();
}

function website_settings_init()
{
    $website_settings = acf_add_options_page(array(
        'page_title' => 'Website Settings',
        'menu_title' => 'Website Settings',
        'menu-slug' => 'website-settings',
        'post_id' => 'website-settings',
        'redirect' => false
    ));

    $form_settings = acf_add_options_page(array(
        'page_title' => 'Form Settings',
        'menu_title' => 'Form Settings',
        'menu-slug' => 'form-settings',
        'post_id' => 'form-settings',
        'parent_slug' => $website_settings['menu_slug']
    ));

    $contact_details = acf_add_options_sub_page(array(
        'page_title' => 'Contact Details',
        'menu_title' => 'Contact Details',
        'menu-slug' => 'contact-details',
        'post_id' => 'contact-details',
        'parent_slug' => $website_settings['menu_slug']
    ));
}
