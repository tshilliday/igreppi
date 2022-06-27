<?php

// prevent editor from deleting, editing, or creating an administrator
// only needed if the editor was given right to edit users

class GpUserCaps
{

    // Add our filters
    public function __construct()
    {
        add_filter('editable_roles', array(&$this, 'setEditableRoles'));
        add_filter('map_meta_cap', array(&$this, 'setUserCapabilities'), 10, 4);
    }
    // Remove 'Administrator' from the list of roles if the current user is not an admin
    public function setEditableRoles($roles)
    {
        if (isset($roles['administrator']) && !current_user_can('administrator')) {
            unset($roles['administrator']);
        }
        if (isset($roles['subscriber'])) {
            unset($roles['subscriber']);
        }
        return $roles;
    }

    // If someone is trying to edit or delete an
    // admin and that user isn't an admin, don't allow it
    public function setUserCapabilities($caps, $cap, $user_id, $args)
    {
        switch ($cap) {
            case 'edit_user':
            case 'remove_user':
            case 'promote_user':
                if (isset($args[0]) && $args[0] == $user_id) {
                    break;
                } elseif (!isset($args[0])) {
                    $caps[] = 'do_not_allow';
                }
                $other = new WP_User(absint($args[0]));
                if ($other->has_cap('administrator')) {
                    if (!current_user_can('administrator')) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
            case 'delete_user':
            case 'delete_users':
                if (!isset($args[0])) {
                    break;
                }
                $other = new WP_User(absint($args[0]));
                if ($other->has_cap('administrator')) {
                    if (!current_user_can('administrator')) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
            default:
                break;
        }
        return $caps;
    }
}

$isa_user_caps = new GpUserCaps();

// Hide all administrators from user list for editors.

add_action('pre_user_query', 'gp_pre_user_query');
add_filter('views_users', 'my_views_users');
add_action('init', 'gp_editor_manage_users');

function gp_pre_user_query($user_search)
{
    if (! current_user_can('administrator')) {
        global $wpdb;

        $user_search->query_where =
            str_replace(
                'WHERE 1=1',
                "WHERE 1=1 AND {$wpdb->users}.ID IN (
                 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta
                    WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                    AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')",
                $user_search->query_where
            );
    }
}

function my_views_users($args)
{
    $hidden_role = 'administrator';  // it will hide filter with role 'administrator' - you can change it to some other role

    $users_counts = count_users();
    $total_users = $users_counts['total_users'] - $users_counts['avail_roles'][$hidden_role];

    $class = ( strpos($args['all'], 'current') === false ) ? "" : "current";

    $args['all'] = "<a href='users.php' class='$class'>" . sprintf(_nx('All <span class="count">(%s)</span>', 'All <span class="count">(%s)</span>', $total_users, 'users'), number_format_i18n($total_users)) . '</a>';
    unset($args[$hidden_role]);
    return $args;
}

// https://isabelcastillo.com/editor-role-manage-users-wordpress

/*
 * Let Editors manage users, and run this only once.
 */
function gp_editor_manage_users()
{
    if (get_option('gp_add_cap_editor_once') != 'done') {
        // let editor manage users
        $editor = get_role('editor'); // Get the user role
        $editor->add_cap('edit_users');
        $editor->add_cap('list_users');
        $editor->add_cap('promote_users');
        $editor->add_cap('create_users');
        $editor->add_cap('add_users');
        $editor->add_cap('delete_users');
        update_option('gp_add_cap_editor_once', 'done');
    }
}

// add editor the privilege to edit theme
// get the the role object
$role_object = get_role('editor');
// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');

add_action('admin_menu', 'hide_appearence_menu', 10);

// Allow editors to see access the Menus page under Appearance but hide other options
// Note that users who know the correct path to the hidden options can still access them
function hide_appearence_menu() {
    $user = wp_get_current_user();

   // Check if the current user is an Editor
   if ( in_array( 'editor', (array) $user->roles ) ) {

       // They're an editor, so grant the edit_theme_options capability if they don't have it
       if ( ! current_user_can( 'edit_theme_options' ) ) {
           $role_object = get_role( 'editor' );
           $role_object->add_cap( 'edit_theme_options' );
       }

       // Hide the Themes page
       remove_submenu_page( 'themes.php', 'themes.php' );

       // Hide the Widgets page
       remove_submenu_page( 'themes.php', 'widgets.php' );

       // Hide the Customize page
       remove_submenu_page( 'themes.php', 'customize.php' );

       // Remove Customize from the Appearance submenu
       global $submenu;
       unset($submenu['themes.php'][6]);
   }
}

/*
 * Setting the privacy policy page requires `manage_privacy_options`,
 * so editing it should require that too.
 */
add_action('map_meta_cap', 'custom_manage_privacy_options', 1, 4);
function custom_manage_privacy_options($caps, $cap, $user_id, $args)
{
  if ('manage_privacy_options' === $cap) {
    $manage_name = is_multisite() ? 'manage_network' : 'manage_options';
    $caps = array_diff($caps, [ $manage_name ]);
  }
  return $caps;
}