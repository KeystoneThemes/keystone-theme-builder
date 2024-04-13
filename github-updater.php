<?php
/**
 * GitHub Plugin Updater
 *
 * This class handles automatic updates for WordPress plugins from GitHub repositories.
 *
 * @package GitHub_Plugin_Updater
 */

if ( ! class_exists( 'GitHub_Plugin_Updater' ) ) {

    class GitHub_Plugin_Updater {

        private $file;
        private $username;
        private $repository;
        private $branch;
        private $access_token;
        private $cache_interval;

        public function __construct( $file ) {
            $this->file = $file;
            add_action( 'admin_init', array( $this, 'check_for_updates' ) );
        }

        public function set_username( $username ) {
            $this->username = $username;
        }

        public function set_repository( $repository ) {
            $this->repository = $repository;
        }

        public function set_branch( $branch ) {
            $this->branch = $branch;
        }

        public function enable_private_repo() {
            // Logic to handle private repositories
        }

        public function set_access_token( $access_token ) {
            $this->access_token = $access_token;
        }

        public function set_cache_interval( $cache_interval ) {
            $this->cache_interval = $cache_interval;
        }

        public function check_for_updates() {
            $plugin_data = get_plugin_data( $this->file );
            $current_version = $plugin_data['Version'];
            $transient_name = 'github_plugin_' . md5( $this->username . $this->repository . $this->branch );

            if ( false === ( $remote_version = get_transient( $transient_name ) ) ) {
                $response = wp_remote_get( "https://api.github.com/repos/{$this->username}/{$this->repository}/releases" );

                if ( is_wp_error( $response ) ) {
                    return;
                }

                $body = wp_remote_retrieve_body( $response );
                $json = json_decode( $body );

                if ( is_array( $json ) ) {
                    $remote_version = $json[0]->tag_name;
                } else {
                    $remote_version = false;
                }

                set_transient( $transient_name, $remote_version, $this->cache_interval );
            }

            if ( version_compare( $current_version, $remote_version, '<' ) ) {
                add_action( 'admin_notices', array( $this, 'display_update_notice' ) );
            }
        }

        public function display_update_notice() {
            ?>
            <div class="notice notice-info is-dismissible">
                <p><?php printf( __( 'A new version of the plugin is available. <a href="%s">Update now</a>.' ), admin_url( 'update.php?action=upgrade-plugin&plugin=' . urlencode( $this->file ) ) ); ?></p>
            </div>
            <?php
        }

        public function download_update() {
            $plugin_slug = plugin_basename( $this->file );
            $plugin_info = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_slug );

            $download_link = "https://github.com/{$this->username}/{$this->repository}/archive/{$this->branch}.zip";

            $temp_zip = download_url( $download_link );

            if ( is_wp_error( $temp_zip ) ) {
                return $temp_zip;
            }

            $temp_dir = trailingslashit( WP_CONTENT_DIR ) . 'temp-plugin-update/';
            $temp_file = $temp_dir . $plugin_slug . '.zip';

            wp_mkdir_p( $temp_dir );

            if ( rename( $temp_zip, $temp_file ) ) {
                return $temp_file;
            } else {
                unlink( $temp_zip );
                return new WP_Error( 'update_failed', __( 'Could not move file to temporary directory' ), $temp_file );
            }
        }

        public function install_update() {
            $plugin_slug = plugin_basename( $this->file );

            $temp_file = $this->download_update();

            if ( is_wp_error( $temp_file ) ) {
                return $temp_file;
            }

            $destination = WP_PLUGIN_DIR . '/' . $plugin_slug . '/';
            $plugin_info = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_slug );

            WP_Filesystem();
            global $wp_filesystem;

            $unzip_result = unzip_file( $temp_file, $destination );

            if ( is_wp_error( $unzip_result ) ) {
                return $unzip_result;
            }

            unlink( $temp_file );

            return true;
        }

        // Additional methods as needed
    }

}
