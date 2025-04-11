<?php
/**
 * Plugin Name: CRT Manage
 * Description: CRT Manage is a front page customizer plugin for Wordpress themes by author domainlee
 * Version: 1.2.2
 * Author: Domainlee
 * Author URI: https://crthemes.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
! defined( 'CRT_MANAGE_PLUGIN_FILE' ) && define( 'CRT_MANAGE_PLUGIN_FILE', __FILE__ );
! defined( 'CRT_MANAGE_URI' ) && define( 'CRT_MANAGE_URI', plugin_dir_url( __FILE__ ) );
! defined( 'CRT_MANAGE_DIR' ) && define( 'CRT_MANAGE_DIR', plugin_dir_path( __FILE__ ) );
! defined( 'CRT_MANAGE_URL_DEMO' ) && define( 'CRT_MANAGE_URL_DEMO', wp_get_theme()->get( 'ThemeURI' ) );
! defined( 'CRT_MANAGE_THEME_NAME' ) && define( 'CRT_MANAGE_THEME_NAME', wp_get_theme()->get( 'Name' ) );

if (function_exists('is_plugin_active')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
require_once 'includes/class-crt-manage-base.php';
add_action('plugins_loaded', array('CRT_Manage_Base', 'instance'));
