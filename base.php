<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

final class STONEX_Extension {

    const VERSION                   = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
    const MINIMUM_PHP_VERSION       = '5.6';

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'init', [$this, 'i18n'] );
        add_action( 'plugins_loaded', [$this, 'init'] );
    }

    public function i18n() {
        load_plugin_textdomain( 'stonex' );
    }

    public function init() {
        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_plugin'] );
            return;
        }
        // Check for required Elementor version
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_elementor_version'] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );
            return;
        }

        //add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
        add_action( 'elementor/widgets/register', [$this, 'init_widgets'] );
        add_action( 'elementor/elements/categories_registered', [$this, 'register_new_category'] );
        add_action( 'elementor/editor/after_enqueue_scripts', [$this, 'stonex_editor_scripts_js'], 100 );
        add_action( 'wp_enqueue_scripts', array( $this, 'stonex_register_frontend_styles' ), 10 );
        add_action( 'elementor/frontend/before_register_scripts', [$this, 'stonex_register_frontend_scripts'] );
    }

    /**
     * Load Frontend Script
     *
     */
    public function stonex_register_frontend_scripts() {

        wp_enqueue_style(
            'stonex-cj-icon',
            STONEX_ASSETS_PUBLIC . '/css/cj-icon.css',
            null,
            STONEX_VERSION
        );
        
        wp_enqueue_style(
            'stonex-addons-style',
            STONEX_ASSETS_PUBLIC . '/css/widget-style.css',
            null,
            STONEX_VERSION
        );
        wp_style_add_data( 'stonex-addons-style', 'rtl', 'replace' );
        wp_enqueue_style(
            'extra-css-style',
            STONEX_ASSETS_PUBLIC . '/css/extra.css',
            null,
            STONEX_VERSION
        );
        wp_style_add_data( 'extra-css-style', 'rtl', 'replace' );
        wp_enqueue_style(
            'creative-button',
            STONEX_ASSETS_PUBLIC . '/css/creative-button.css',
            null,
            STONEX_VERSION
        );
        wp_style_add_data( 'creative-button', 'rtl', 'replace' );

        wp_enqueue_style(
            'inline-button',
            STONEX_ASSETS_PUBLIC . '/css/inline-button.css',
            null,
            STONEX_VERSION
        );
        wp_style_add_data( 'inline-button', 'rtl', 'replace' );

        wp_enqueue_style(
            'slick',
            STONEX_ASSETS_PUBLIC . '/css/slick.css',
            null,
            STONEX_VERSION
        );

        // Add Keystone Theme Builder MAP API
        $stonex_map = get_theme_mods( 'stonex_map_api_settings' );
        $mapApi   = isset( $stonex_map['stonex_map_api_settings'] ) ? $stonex_map['stonex_map_api_settings'] : 1;
        if ( '1' !== $mapApi ) {
            $api = sprintf( 'https://maps.googleapis.com/maps/api/js?key=%1$s&language=%2$s', $mapApi, 'en' );
            wp_register_script( 'stonex-maps-api-input', $api, array(), '', false );
        }
        wp_enqueue_script(
            'stonex-maps-api-js',
            STONEX_ASSETS_PUBLIC . '/js/stonex-maps.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );
        wp_enqueue_script(
            'typed',
            STONEX_ASSETS_PUBLIC . '/js/typed.min.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );

        wp_enqueue_script(
            'stonex-slick',
            STONEX_ASSETS_PUBLIC . '/js/slick.min.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );

        wp_enqueue_script(
            'isotope',
            STONEX_ASSETS_PUBLIC . '/js/isotope.pkgd.min.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );
        wp_enqueue_script(
            'packery',
            STONEX_ASSETS_PUBLIC . '/js/packery-mode.pkgd.min.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );
        wp_enqueue_script(
            'imagesloaded',
            STONEX_ASSETS_PUBLIC . '/js/imagesloaded.pkgd.min.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );

        // widget js
        wp_enqueue_script(
            'stonex-addons-script',
            STONEX_ASSETS_PUBLIC . '/js/widget.js',
            array( 'jquery' ),
            STONEX_VERSION,
            true
        );
    }
    public function stonex_editor_scripts_js() {

         wp_enqueue_script(
            'stonex-editor-script',
            STONEX_ASSETS_PUBLIC . '/js/editor.js',
            array( 'jquery' ),
            STONEX_VERSION,
            true
        );

    }

    /**
     * Load Frontend Styles
     *
     */
    public function stonex_register_frontend_styles() {
        wp_enqueue_style(
            'themify-icons',
            STONEX_ASSETS_PUBLIC . '/vendor/themify-icons/themify-icons.css',
            null,
            STONEX_VERSION
        );

        wp_enqueue_script(
            'stonex-main',
            STONEX_ASSETS_PUBLIC . '/js/stonex-main.js',
            ['jquery'],
            STONEX_VERSION,
            true
        );

    }

    /**
     * Widgets Catgory
     *
     */
    public function register_new_category( $manager ) {
        $manager->add_category(
            'stonex',
            [
                'title' => __( 'Keystone Theme Builder Elementor Helper  Addons', 'stonex' ),
            ]
        );
    }

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'stonex' ),
            '<strong>' . esc_html__( 'Elementor Pawelements Extension', 'stonex' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'stonex' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'stonex' ),
            '<strong>' . esc_html__( 'Elementor stonex Extension', 'stonex' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'stonex' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'stonex' ),
            '<strong>' . esc_html__( 'Elementor Keystone Theme Builder Extension', 'stonex' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'stonex' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function init_widgets($widgets_manager) {


        /*
         * Extensions Include
         */
        require_once STONEX_WIDGET_EXTENSIONS . 'custom-css.php';
        require_once STONEX_WIDGET_EXTENSIONS . 'container-control.php';
        require_once STONEX_WIDGET_EXTENSIONS . 'css-transform.php';
        require_once STONEX_WIDGET_EXTENSIONS . 'custom-position.php';
        require_once STONEX_WIDGET_EXTENSIONS . 'floting-effect.php';

        //Include Widget files
        require_once STONEX_WIDGET_DIR . 'Advance-Tab/widget.php';
        require_once STONEX_WIDGET_DIR . 'Tab/widget.php';
        require_once STONEX_WIDGET_DIR . 'Menu/widget.php';
        require_once STONEX_WIDGET_DIR . 'Logo/widget.php';
        require_once STONEX_WIDGET_DIR . 'IconBox/widget.php';
        require_once STONEX_WIDGET_DIR . 'Breadcrumb/widget.php';
        require_once STONEX_WIDGET_DIR . 'ContactForm7/widget.php';
        require_once STONEX_WIDGET_DIR . 'Excerpt/widget.php';
        require_once STONEX_WIDGET_DIR . 'Heading/widget.php';
        require_once STONEX_WIDGET_DIR . 'FeatureImage/widget.php';
        require_once STONEX_WIDGET_DIR . 'DualHeading/widget.php';
        require_once STONEX_WIDGET_DIR . 'Popup/widget.php';
        require_once STONEX_WIDGET_DIR . 'ModalPopup/widget.php';
        require_once STONEX_WIDGET_DIR . 'CreativeButton/widget.php';
        require_once STONEX_WIDGET_DIR . 'PricingBox/widget.php';
        require_once STONEX_WIDGET_DIR . 'PriceTable/widget.php';
        require_once STONEX_WIDGET_DIR . 'PriceTableList/widget.php';
        require_once STONEX_WIDGET_DIR . 'Accordion/widget.php';
        require_once STONEX_WIDGET_DIR . 'AniamteText/widget.php';
        require_once STONEX_WIDGET_DIR . 'Search/widget.php';
        require_once STONEX_WIDGET_DIR . 'DualButton/widget.php';
        require_once STONEX_WIDGET_DIR . 'InlineButton/widget.php';
        require_once STONEX_WIDGET_DIR . 'AdvanceSlider/widget.php';
        require_once STONEX_WIDGET_DIR . 'GoogleMap/widget.php';
        require_once STONEX_WIDGET_DIR . 'TextEditor/widget.php';
        require_once STONEX_WIDGET_DIR . 'Testimonial/widget.php';
        require_once STONEX_WIDGET_DIR . 'BrandSlider/widget.php';
        require_once STONEX_WIDGET_DIR . 'TeamMember/widget.php';

        if ( class_exists( 'WooCommerce' ) ) {
            require_once STONEX_WIDGET_DIR . 'woocommerce/top-right-meta.php';
        }

    }
}
STONEX_Extension::instance();
