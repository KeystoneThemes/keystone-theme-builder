<?php
/*
Plugin Name: Keystone Theme Builder
Plugin URI: https://keystonethemes.com/
Description: The Keystone Builder is an Elementor addon that allows the user to create custom header and footer without Elementor pro and it comes with premium custom widgets.
Version: 1.2
Author: Keystone Themes
Author URI: https://themeforest.com/user/grayic/
License: GPLv2 or later
Text Domain: stonex
 */

if (!defined('ABSPATH')) {
    exit;
}

//Set plugin version constant.
define('STONEX_VERSION', '1.3.0');
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

if (!class_exists('KeystoneCoreUpdateChecker')) {

    class KeystoneCoreUpdateChecker
    {

        public $plugin_slug;
        public $version;
        public $cache_key;
        public $cache_allowed;

        public function __construct()
        {
            if (!is_admin()) {
                return;
            }

            if (!function_exists('get_plugin_data')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            $plugin_data = get_plugin_data(__FILE__);

            $this->plugin_slug = plugin_basename(__DIR__);

            $this->version       = $plugin_data['Version'];
            $this->cache_key     = 'keystone_core_custom_updc';
            $this->cache_allowed = true;

            add_filter('plugins_api', array($this, 'info'), 20, 3);
            add_filter('site_transient_update_plugins', array($this, 'update'));
            add_action('upgrader_process_complete', array($this, 'purge'), 10, 2);
        }

        public function request()
        {
            $remote = get_transient($this->cache_key);

            if (false === $remote || !$this->cache_allowed) {

                $response = wp_remote_get(
                    'https://api.github.com/repos/KeystoneThemes/keystone-theme-builder/releases/latest',
                    array(
                        'timeout' => 10,
                        'headers' => array(
                            'Accept' => 'application/json',
                            'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
                        ),
                    )
                );

                if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                    return false;
                }

                $remote = json_decode(wp_remote_retrieve_body($response));

                set_transient($this->cache_key, $remote, DAY_IN_SECONDS);
            }

            return $remote;
        }

        function info($res, $action, $args)
        {
            // do nothing if you're not getting plugin information right now
            if ('plugin_information' !== $action) {
                return $res;
            }

            // do nothing if it is not our plugin
            if ($this->plugin_slug !== $args->slug) {
                return $res;
            }

            // get updates
            $remote = $this->request();

            if (!$remote) {
                return $res;
            }

            $res = new stdClass();

            $res->name           = 'Keystone Theme Builder';
            $res->slug           = $this->plugin_slug;
            $res->version        = $remote->tag_name;
            $res->author         = 'Keystone Themes';
            $res->author_homepage= 'https://github.com/KeystoneThemes';
            $res->download_link  = $remote->zipball_url;
            $res->trunk          = $remote->zipball_url;
            $res->last_updated   = $remote->published_at;

            $res->sections = array(
                'description'  => $remote->body,
                'installation' => '',
                'changelog'    => '',
            );

            return $res;
        }

        public function update($transient)
        {
            if (empty($transient->checked)) {
                return $transient;
            }

            $remote = $this->request();

            if ($remote && version_compare($this->version, $remote->tag_name, '<')) {
                $res                    = new stdClass();
                $res->slug              = $this->plugin_slug;
                $res->plugin            = plugin_basename(__FILE__);
                $res->new_version       = $remote->tag_name;
                $res->package           = $remote->zipball_url;
                $transient->response[$res->plugin] = $res;
            }

            return $transient;
        }

        public function purge($upgrader, $options)
        {
            if (
                $this->cache_allowed
                && 'update' === $options['action']
                && 'plugin' === $options['type']
            ) {
                // just clean the cache when new plugin version is installed
                delete_transient($this->cache_key);
            }
        }
    }

    new KeystoneCoreUpdateChecker();
}
