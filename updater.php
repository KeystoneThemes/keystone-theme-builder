<?php

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
        $this->cache_key     = 'finest_core_custom_updc';
        $this->cache_allowed = true;

        add_filter('plugins_api', array($this, 'info'), 20, 3);
        add_filter('site_transient_update_plugins', array($this, 'update'));
        add_action('upgrader_process_complete', array($this, 'purge'), 10, 2);
    }

    public function request()
    {

        $remote = get_transient($this->cache_key);

        if (false === $remote || !$this->cache_allowed) {

            $remote = wp_remote_get(
                'https://api.keystonethemes.com/updates/plugins/keystone-theme-builder/data.json',
                array(
                    'timeout' => 10,
                    'headers' => array(
                        'Accept' => 'application/json',
                    ),
                )
            );

            if (
                is_wp_error($remote)
                || 200 !== wp_remote_retrieve_response_code($remote)
                || empty(wp_remote_retrieve_body($remote))
            ) {
                return false;
            }

            set_transient($this->cache_key, $remote, DAY_IN_SECONDS);
        }

        $remote = json_decode(wp_remote_retrieve_body($remote));

        return $remote;
    }

    function info($res, $action, $args)
    {

        // print_r( $action );
        // print_r( $args );

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

        $res->name    = $remote->name;
        $res->slug    = $remote->slug;
        $res->version = $remote->version;

        $res->author          = $remote->author;
        $res->author_homepage = $remote->author_homepage;
        $res->download_link   = $remote->download_url;
        $res->trunk           = $remote->download_url;
        $res->last_updated    = $remote->last_updated;

        $res->sections = array(
            'description'  => '',
            'installation' => '',
            'changelog'    => '',
        );

        if (!empty($remote->banners)) {
            $res->banners = array(
                'low'  => '',
                'high' => '',
            );
        }

        return $res;
    }

    public function update($transient)
    {

        if (empty($transient->checked)) {
            return $transient;
        }

        $remote = $this->request();

        if (
            $remote
            && version_compare($this->version, $remote->version, '<')
        ) {
            $res              = new stdClass();
            $res->slug        = $this->plugin_slug;
            $res->plugin      = plugin_basename(__FILE__); // keystonex-update-plugin/keystonex-update-plugin.php
            $res->new_version = $remote->version;
            $res->package     = $remote->download_url;

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
 