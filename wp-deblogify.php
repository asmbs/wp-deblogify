<?php
/**
 * Plugin Name: The Unblog
 * Version:     1.1.0
 * Description: Removes the admin UI for blog-centric WordPress components like posts and comments.
 * Plugin URI:  https://github.com/asmbs/wp-unblog
 * Author:      The A-TEAM
 * Author URI:  https://github.com/asmbs
 * License:     MIT
 */

namespace Unblog;

// This plugin should only run in primary execution
if (defined('DOING_AJAX') || defined('DOING_CRON') || defined('DOING_AUTOSAVE'))
  return;

// ---------------------------------------------------------------------------------------------------------------------

/**
 * Remove admin menu items.
 */
function remove_nav_items()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}

/**
 * Remove admin bar items.
 */
function remove_adminbar_items()
{
    /** @var \WP_Admin_Bar */
    global $wp_admin_bar;

    // Remove nodes
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-post');

    // Update the "new content" target to point to nothing
    $wp_admin_bar->add_node([
        'id'   => 'new-content',
        'href' => '#'
    ]);
}

/**
 * Remove dashboard widgets.
 */
function remove_dashboard_widgets()
{
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}

// ---------------------------------------------------------------------------------------------------------------------

add_action('admin_init', 'Unblog\remove_nav_items');
add_action('wp_before_admin_bar_render', 'Unblog\remove_adminbar_items');
add_action('wp_dashboard_setup', 'Unblog\remove_dashboard_widgets');
