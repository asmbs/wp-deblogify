<?php
/**
 * Plugin Name: Deblogifier
 * Version:     1.0.1
 * Description: Removes the admin UI for blog-centric WordPress components like posts and comments.
 * Plugin URI:  https://github.com/asmbs/wp-deblogify
 * Author:      The A-TEAM (ASMBS)
 * Author URI:  https://github.com/asmbs
 * License:     MIT License
 */

namespace Deblogifier;

// This plugin should only run in primary execution
if (defined('DOING_AJAX') || defined('DOING_CRON') || defined('DOING_AUTOSAVE'))
  return;

// ---------------------------------------------------------------------------------------------

// Remove admin menu links
add_action('admin_init', 'Deblogifier\\remove_nav_items');

// Remove admin bar items
add_action('wp_before_admin_bar_render', 'Deblogifier\\remove_adminbar_items');

// Remove dashboard widgets
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
 * Action: wp_before_admin_bar_render
 *
 */
function remove_adminbar_items()
{
  /**
   * @var  \WP_Admin_Bar
   * @global
   */
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
 * Action: wp_dashboard_setup
 *
 */
function remove_dashboard_widgets()
{
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
