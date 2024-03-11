<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Event_Master
 *
 * @wordpress-plugin
 * Plugin Name:       Event Master
 * Description:       A custom event manager plugin built for AtomPoint
 * Version:           1.0.0
 * Author:            Muhammad Ali
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       event-master
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('EVENT_MASTER_VERSION', '1.0.0');
define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Managing CPT in separate file
if (is_readable(MY_PLUGIN_PATH . 'cpt.php')) {
    include MY_PLUGIN_PATH . 'cpt.php';
}
// Adding custom styles to meta boxes
add_action('admin_enqueue_scripts', 'load_admin_styles');
function load_admin_styles()
{
    wp_enqueue_style('admin_css', plugins_url('/assets/admin-style.css', __FILE__), false, '1.0.0');
}
// adding Bootstrap support for events card
function load_frontend_scripts()
{
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
}
add_action('wp_enqueue_scripts', 'load_frontend_scripts');

// Managing Plugin UI Files in separate folder
if (is_readable(MY_PLUGIN_PATH . '/view/event-master-ui.php')) {
    include MY_PLUGIN_PATH . '/view/event-master-ui.php';
}