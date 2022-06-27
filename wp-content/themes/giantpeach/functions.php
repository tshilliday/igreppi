<?php
include_once('vendor/autoload.php');
include('post-types/post-types-product.php');
include('functions/includes.php');
add_action('after_setup_theme', 'gp_theme_setup');

function gp_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'main-menu' => 'Main Nav - Menu',
        'main-submenu' => 'Main Nav - Submenu',
        'footer-menu' => 'Footer Menu',
        'sidenav' => 'Side Navigation'
    ));
}

/**
 * Move jQuery to the footer.
 */
function wpse_173601_enqueue_scripts()
{
    // Below line commented out because Instagram Feed plugin requires jQuery in header
    // wp_scripts()->add_data('jquery', 'group', 1);
    wp_scripts()->add_data('jquery-core', 'group', 1);
    wp_scripts()->add_data('jquery-migrate', 'group', 1);
    wp_scripts()->add_data('gp_forms', 'group', 1);
}

add_action('wp_enqueue_scripts', 'wpse_173601_enqueue_scripts');

function insert_theme_js()
{
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_script('vendor_js', get_template_directory_uri() . '/dist/js/vendor.js', array(), $theme_version, true);
    wp_enqueue_script('main_js', get_template_directory_uri() . '/dist/js/main.js', array('jquery'), $theme_version, true);
}
add_filter('wp_enqueue_scripts', 'insert_theme_js', 1);

/* Styling prev/next post buttons */
add_filter('next_post_link', 'posts_link_attributes');
add_filter('previous_post_link', 'posts_link_attributes');

function posts_link_attributes($output)
{
    $code = 'class="button"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

function add_current_nav_class($classes, $item)
{
    // Getting the current post details
    global $post;

    // Get post ID, if nothing found set to NULL
    $id = (isset($post->ID) ? get_the_ID() : null);

    // Checking if post ID exist...
    if (isset($id)) {
        // Getting the post type of the current post
        $current_post_type = get_post_type_object(get_post_type($post->ID));

        // Getting the rewrite slug containing the post type's ancestors
        $ancestor_slug = $current_post_type->rewrite['slug'];

        // Split the slug into an array of ancestors and then slice off the direct parent.
        $ancestors = explode('/', $ancestor_slug);
        $parent = array_pop($ancestors);

        // Getting the URL of the menu item
        $menu_slug = strtolower(trim($item->url));

        // If the menu item URL contains the post type's parent
        if (!empty($menu_slug) && !empty($parent) && strpos($menu_slug, $parent) !== false) {
            $classes[] = 'current-menu-item';
        }

        // If the menu item URL contains any of the post type's ancestors
        foreach ($ancestors as $ancestor) {
            if (!empty($ancestor) && strpos($menu_slug, $ancestor) !== false) {
                $classes[] = 'current-page-ancestor';
            }
        }
    }
    // Return the corrected set of classes to be added to the menu item
    return $classes;
}

add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2);

function get_button_html($url = null, $link_text = null, $target = null, $class = "button")
{

    $html = '';

    if (strpos($url, '/') === 0) {
        if (strpos($url,'#') === false) {
            $class .= ' ajax';
        }
    }

    if ($url) {
        $html = sprintf("<a class='%s' target='%s' href='%s'>%s</a>", $class, $target, $url, $link_text);
    }

    return $html;
}

function get_display_url($url)
{
    $url = preg_replace("(^https?://)", "", $url);
    $url = rtrim($url, "/");
    return $url;
}

function get_page_link_by_template($template_filename)
{

    $args = array(
        'post_type' => 'page',
        'fields' => 'ids',
        'meta_key' => '_wp_page_template',
        'meta_value' => $template_filename
    );

    $pages = get_posts($args);

    wp_reset_postdata();

    foreach ($pages as $page) {
        $link = get_page_link($page);
        if ($link) {
            return $link;
        }
        break;
    }
    return false;
}

function get_page_id_by_template($template_filename)
{

    $args = array(
        'post_type' => 'page',
        'fields' => 'ids',
        'meta_key' => '_wp_page_template',
        'meta_value' => $template_filename
    );

    $pages = get_posts($args);

    wp_reset_postdata();

    foreach ($pages as $page) {
        return $page;
    }
    return false;
}

// acf/update_value - filter for every field
add_filter('acf/update_value', 'acf_link_url_relative', 10, 3);

function acf_link_url_relative($value, $post_id, $field)
{
    if ($field['type'] == 'link') {
        $site_url = get_home_url();
        // Make link relative so that when we replace test site URLs with live site URLs, the serialized array doesn't get messed up.
        if ($value['url'] == $site_url) {
            // if linking to home page
            $value['url'] = '/';
        } else {
            // else, replace base URL with nothing
            $value['url'] = str_replace($site_url, '', $value['url']);
        }
    }

    return $value;
}

/**
 * $format string ( 'full' , 'first' , 'login')
 */
function get_user_name($format = 'full')
{
    $name = '';
    $user = wp_get_current_user();

    if ($format == 'full' || $format == 'first') {
        $name .= $user->user_firstname;
    }

    if ($format == 'full') {
        if (!empty($user->user_lastname)) {
            $name .= ' ' . $user->user_lastname;
        }
    }

    if ($format == 'login') {
        $name = $user->login;
    }

    return trim($name);
}

/***
 * Make taxonomy description on taxonomy list views trimmed in admin
 */
add_action('admin_head-edit-tags.php', 'gp_edit_tags_trim_description');
function gp_edit_tags_trim_description()
{
    add_filter(
        'get_terms',
        'gp_trim_description_callback',
        100,
        2
    );
}

function gp_trim_description_callback($terms, $taxonomies)
{
    if ('product_cat' == $taxonomies[ 0 ] || 'category' == $taxonomies[ 0 ]) {
        foreach ($terms as $key => $term) {
            $terms[ $key ]->description =
                wp_trim_words(
                    $term->description,
                    30,
                    ' [...]'
                );
        }
    }
    return $terms;
}

add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'no-js' ) );
} );

function get_sidenav_links() {
    // if not in menu, just show link back to Home

    // if blog post, show prev/next blog post

    //

    $sidenav = wp_get_nav_menu_items( wp_get_nav_menu_object("Side navigation" ) );
    if ($sidenav) {
        $matched = false;
        $prev = false;
        $next = false;
        foreach ($sidenav as $item) {
            $item_post_id = get_post_meta( $item->ID, '_menu_item_object_id', true );
            if ($matched) { // if previous item matched page
                $next = $item;
                break;
            }
            if ($item_post_id == get_the_ID()) { // if current item matches page
                $matched = $item;
                if (!$prev) {
                    $prev = end($sidenav);
                }
                continue;
            }
            $prev = $item; // if no match
        }

        if (!$matched) {
            return array(
                'prev' => (object) array('url' => get_home_url(), 'title' => 'Home'),
                'next' => false
            );
        }

        return array(
            'prev' => $prev,
            'next' => $next
        );

    }

    return false;
}
