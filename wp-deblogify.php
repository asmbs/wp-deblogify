<?php
/**
 * Plugin Name: Deblogifier
 * Version:     1.0.0-dev
 * Description: Removes the admin UI for blog-centric WordPress components like posts and comments.
 * Plugin URI:  https://github.com/asmbs/wp-deblogify
 * Author:      The A-TEAM (ASMBS)
 * Author URI:  https://github.com/asmbs
 * License:     MIT License
 */

namespace Deblogifier;

// ---------------------------------------------------------------------------------------------

add_action('admin_init', 'Deblogifier\\remove_nav_items');
add_action('wp_dashboard_setup', 'Deblogifier\\remove_dashboard_widgets');

// ---------------------------------------------------------------------------------------------

/**
 * Remove items from the admin menu.
 * Action: admin_init
 *
 */
function remove_nav_items()
{
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

/**
 * Remove admin bar items.
 * Action: ?
 *
 */
function remove_adminbar_items()
{}

/**
 * Remove dashboard widgets.
 * Action: wp_dashboard_setup
 *
 */
function remove_dashboard_widgets()
{
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
