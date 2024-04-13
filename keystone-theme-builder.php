<?php
/*
Plugin Name: Keystone Theme Builder
Plugin URI: https://keystonethemes.com/
Description: The Keystone Builder is an Elementor addon that allows the user to create custom header and footer without Elementor pro and it comes with premium custom widgets.
Version: 1.0.1
Author: Keystone Themes
Author URI: https://themeforest.com/user/grayic/
License: GPLv2 or later
Text Domain: stonex
 */

if (!defined('ABSPATH')) {
    exit;
}

//Set plugin version constant.
define('STONEX_VERSION', '1.0.1');
/* Set constant path to the plugin directory. */
define('STONEX_WIDGET', trailingslashit(plugin_dir_path(__FILE__)));
// Plugin Function Folder Path
define('STONEX_WIDGET_INC', plugin_dir_path(__FILE__) . 'inc/');
define('STONEX_WIDGET_LIB', plugin_dir_path(__FILE__) . 'lib/');

// Plugin Extensions Folder Path
define('STONEX_WIDGET_EXTENSIONS', plugin_dir_path(__FILE__) . 'extensions/');

// Plugin Widget Folder Path
define('STONEX_WIDGET_DIR', plugin_dir_path(__FILE__) . 'widgets/');

// Assets Folder URL
define('STONEX_ASSETS_PUBLIC', plugins_url('assets', __FILE__));

// Assets Folder URL
define('STONEX_ASSETS_VERDOR', plugins_url('assets/vendor', __FILE__));

require_once STONEX_WIDGET_INC . 'helper-function.php';

//ThemeBuilder works only with Elementor
if (class_exists('\Elementor\Plugin')) {

    // require STONEX_WIDGET_INC . 'class-core.php'; //Elementor Incubator
    require STONEX_WIDGET_INC . 'theme-builder/class-common.php'; //Theme Builder generic functions
    require STONEX_WIDGET_INC . 'theme-builder/class-rule.php'; //Theme Builder generic functions
    require STONEX_WIDGET_INC . 'theme-builder/class-rest-api.php'; //Theme Builder generic functions
    require STONEX_WIDGET_INC . 'theme-builder/documents/class-base.php'; //Elementor Documnet Type
    require STONEX_WIDGET_INC . 'theme-builder/documents/class-single.php'; //Elementor Documnet Type
    if (is_admin()) {
        require_once STONEX_WIDGET_INC . 'theme-builder/class-admin.php';
    }
    if (!is_admin()) {
        require_once STONEX_WIDGET_INC . 'theme-builder/class-frontend.php'; //Frontend related functions
    }
}

require_once STONEX_WIDGET_INC . 'elmentor-extender.php';
require_once STONEX_WIDGET_INC . 'cpt.php';
require_once STONEX_WIDGET_INC . 'Metabox/header-footer.php';
require_once STONEX_WIDGET_INC . 'Metabox/nav.php';
require_once STONEX_WIDGET_INC . 'Classes/breadcrumb-class.php';
require_once STONEX_WIDGET_INC . 'Traits/creative-button-murkup.php';
require_once STONEX_WIDGET_INC . 'Traits/inline-button-murkup.php';
require_once STONEX_WIDGET_INC . 'Icon.php';

// require_once STONEX_WIDGET_LIB . 'uxtheme-elements/uxtheme-elements.php';

require_once STONEX_WIDGET . 'base.php';

if ( ! class_exists( 'GitHub_Plugin_Updater' ) ) {
    require_once( plugin_dir_path( __FILE__ ) . 'github-updater.php' );
}

$github_updater = new GitHub_Plugin_Updater( __FILE__ );
$github_updater->set_username( 'KeystoneThemes' );
$github_updater->set_repository( 'keystone-theme-builder' );


// Add "Check for updates" link to plugin action links
if ( is_admin() ) {
    $plugin_basename = plugin_basename( __FILE__ );
    add_filter( "plugin_action_links_$plugin_basename", 'add_plugin_action_links' );
}

function add_plugin_action_links( $links ) {
    $settings_link = '<a href="options-general.php?page=github-updater">' . __( 'Settings' ) . '</a>';
    $check_update_link = '<a href="' . wp_nonce_url( admin_url( 'admin-post.php?action=check_plugin_update' ), 'check_plugin_update' ) . '">' . __( 'Check for updates' ) . '</a>';
    array_push( $links, $settings_link, $check_update_link );
    return $links;
}

// Handle checking for updates
add_action( 'admin_post_check_plugin_update', 'check_plugin_update' );

function check_plugin_update() {
    echo "Checking for updates...";
    exit;
}
