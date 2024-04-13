<?php
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class STONEXCustomPosts {
    function __construct() {
        // add_action( 'admin_menu', array( $this, 'stonex_header_footer_menu' ) );
        // Header
        // add_action( 'init', array( $this, 'stonex_slide' ) );

        // add_action( 'init', array( $this, 'stonex_header' ) );
        // add_action( 'init', array( $this, 'stonex_footer' ) );
        // add_action( 'init', array( $this, 'stonex_megamenu' ) );




    }
    public function stonex_header_footer_menu() {
        global $menu, $submenu;
        add_menu_page(
            'Keystone Base',
            'Keystone Base',
            'read',
            'keystone-base',
            '',
            'dashicons-archive',
            40
        );
    }
    /**
     *
     * Keystone Base Header Footer Post Type
     *
     */
    public function stonex_header() {
        $labels = array(
            'name'               => _x( 'Header', 'post type general name', 'stonex-addons' ),
            'singular_name'      => _x( 'Header', 'post type singular name', 'stonex-addons' ),
            'menu_name'          => _x( 'Header', 'admin menu', 'stonex-addons' ),
            'name_admin_bar'     => _x( 'Header', 'add new on admin bar', 'stonex-addons' ),
            'add_new'            => __( 'Add New Header', 'stonex-addons' ),
            'add_new_item'       => __( 'Add New Header', 'stonex-addons' ),
            'new_item'           => __( 'New Header', 'stonex-addons' ),
            'edit_item'          => __( 'Edit Header', 'stonex-addons' ),
            'view_item'          => __( 'View Header', 'stonex-addons' ),
            'all_items'          => __( 'All Headers', 'stonex-addons' ),
            'search_items'       => __( 'Search Headers', 'stonex-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'stonex-addons' ),
            'not_found'          => __( 'No Headers found.', 'stonex-addons' ),
            'not_found_in_trash' => __( 'No Headers found in Trash.', 'stonex-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'stonex-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'show_in_menu'       => 'keystone-base',
            'rewrite'            => array( 'slug' => 'header' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'stonex_header', $args );
    }
    public function stonex_footer() {
        $labels = array(
            'name'               => _x( 'Footer', 'post type general name', 'stonex-addons' ),
            'singular_name'      => _x( 'Footer', 'post type singular name', 'stonex-addons' ),
            'menu_name'          => _x( 'Footer', 'admin menu', 'stonex-addons' ),
            'name_admin_bar'     => _x( 'Footer', 'add new on admin bar', 'stonex-addons' ),
            'add_new'            => __( 'Add New Footer', 'stonex-addons' ),
            'add_new_item'       => __( 'Add New Footer', 'stonex-addons' ),
            'new_item'           => __( 'New Footer', 'stonex-addons' ),
            'edit_item'          => __( 'Edit Footer', 'stonex-addons' ),
            'view_item'          => __( 'View Footer', 'stonex-addons' ),
            'all_items'          => __( 'All Footers', 'stonex-addons' ),
            'search_items'       => __( 'Search Footers', 'stonex-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'stonex-addons' ),
            'not_found'          => __( 'No Footers found.', 'stonex-addons' ),
            'not_found_in_trash' => __( 'No Footers found in Trash.', 'stonex-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'stonex-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'footer' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'keystone-base',
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'stonex_footer', $args );
    }
    public function stonex_megamenu() {
        $labels = array(
            'name'               => _x( 'Mega Menu', 'post type general name', 'stonex-addons' ),
            'singular_name'      => _x( 'Mega Menu', 'post type singular name', 'stonex-addons' ),
            'menu_name'          => _x( 'Mega Menu', 'admin menu', 'stonex-addons' ),
            'name_admin_bar'     => _x( 'Mega Menu', 'add new on admin bar', 'stonex-addons' ),
            'add_new'            => __( 'Add New Mega Menu', 'stonex-addons' ),
            'add_new_item'       => __( 'Add New Mega Menu', 'stonex-addons' ),
            'new_item'           => __( 'New Mega Menu', 'stonex-addons' ),
            'edit_item'          => __( 'Edit Mega Menu', 'stonex-addons' ),
            'view_item'          => __( 'View Mega Menu', 'stonex-addons' ),
            'all_items'          => __( 'All Mega Menus', 'stonex-addons' ),
            'search_items'       => __( 'Search Mega Menus', 'stonex-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'stonex-addons' ),
            'not_found'          => __( 'No Mega Menus found.', 'stonex-addons' ),
            'not_found_in_trash' => __( 'No Mega Menus found in Trash.', 'stonex-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'stonex-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'megamenu' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'keystone-base',
            'supports'           => array( 'title', 'elementor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'stonex_megamenu', $args );
    }


    //SLide
    public function stonex_slide() {
        $labels = array(
            'name'               => _x( 'Slide', 'post type general name', 'stonex-addons' ),
            'singular_name'      => _x( 'Slide', 'post type singular name', 'stonex-addons' ),
            'menu_name'          => _x( 'Slide', 'admin menu', 'stonex-addons' ),
            'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'stonex-addons' ),
            'add_new'            => __( 'Add New Slide', 'stonex-addons' ),
            'add_new_item'       => __( 'Add New Slide', 'stonex-addons' ),
            'new_item'           => __( 'New Slide', 'stonex-addons' ),
            'edit_item'          => __( 'Edit Slide', 'stonex-addons' ),
            'view_item'          => __( 'View Slide', 'stonex-addons' ),
            'all_items'          => __( 'All Slide', 'stonex-addons' ),
            'search_items'       => __( 'Search Slide', 'stonex-addons' ),
            'parent_item_colon'  => __( 'Parent :', 'stonex-addons' ),
            'not_found'          => __( 'No Slide found.', 'stonex-addons' ),
            'not_found_in_trash' => __( 'No Slide found in Trash.', 'stonex-addons' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'stonex-addons' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-slides',
            'rewrite'            => array( 'slug' => 'stonex_slide', 'with_front' => true, 'pages' => true, 'feeds' => true ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title','elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'stonex_slide', $args );
    }

}
$stonexCcases_stydyInstance = new STONEXCustomPosts;
