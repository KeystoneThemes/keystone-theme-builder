<?php
/**
 * Add custom fields to menu item
 *
 * This will allow us to play nicely with any other plugin that is adding the same hook
 *
 * @param  int $item_id
 * @params obj $item - the menu item
 * @params array $args
 */
function stonex_nav_fields( $item_id, $item ) {
    wp_nonce_field( 'stonex_menu_meta_nonce', 'stonex_menu_meta_nonce_name' );
    $stonex_menu_meta = get_post_meta( $item_id, 'stonex_select_megamenu', true );
    $dropdown_args    = [
        'post_type'        => 'stonex-tb',
        'echo'             => 0,
        'show_option_none' => __( 'Select megamenu', 'stonex' ),
        'name'             => 'stonex_select_megamenu[' . $item_id . ']',
        'selected'         => $stonex_menu_meta,
    ];
    // check if megamenu is exist
    $megamenu = get_posts( [
        'post_type'      => 'stonex-tb',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ] );
    

    if ( !empty( $megamenu ) ) {
        // var_dump($megamenu);
        ?>
    <div class="field-stonex_menu_meta description-wide" style="margin: 5px 0;">
        <span class="description"><?php _e( "Select Megamenu", 'stonex' );?></span>
        <br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>" />
        <div class="logged-input-holder">
            <!-- <input type="text" name="stonex_menu_meta[<?php echo $item_id; ?>]" id="stonex-for-<?php echo $item_id; ?>" value="<?php echo esc_attr( $stonex_menu_meta ); ?>" /> -->
            <?php //wp_dropdown_pages( $dropdown_args )?>

            <select name="<?php echo esc_attr('stonex_select_megamenu[' . $item_id . ']') ?>" id="<?php echo esc_attr('stonex_select_megamenu[' . $item_id . ']') ?>">
                <?php 
                echo '<option value="">'. esc_html('Select megamenu' ).'</option>';
                foreach($megamenu as $mm){
                    $is_MM =isset(wp_get_post_terms($mm->ID, 'tb_type', ['fields' => 'names'])[0]) ? wp_get_post_terms($mm->ID, 'tb_type', ['fields' => 'names'])[0] : '';
                    if('_type_mm' == $is_MM){
                        $selected = $stonex_menu_meta == $mm->ID ? 'selected': '';
                        echo '<option '.$selected.' value="'.$mm->ID.'">'.$mm->post_title.'</option>';
                    }
                }?>
            </select>
        </div>
    </div>
    <?php
}
}
add_action( 'wp_nav_menu_item_custom_fields', 'stonex_nav_fields', 10, 2 );
/**
 * Save the menu item meta
 *
 * @param int $menu_id
 * @param int $menu_item_db_id
 */
function stonex_nav_update( $menu_id, $menu_item_db_id ) {
    // Verify this came from our screen and with proper authorization.
    if ( !isset( $_POST['stonex_menu_meta_nonce_name'] ) || !wp_verify_nonce( $_POST['stonex_menu_meta_nonce_name'], 'stonex_menu_meta_nonce' ) ) {
        return $menu_id;
    }
    if ( isset( $_POST['stonex_select_megamenu'][$menu_item_db_id] ) ) {
        $sanitized_data = sanitize_text_field( $_POST['stonex_select_megamenu'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, 'stonex_select_megamenu', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, 'stonex_select_megamenu' );
    }
}
add_action( 'wp_update_nav_menu_item', 'stonex_nav_update', 10, 2 );
/**
 * Displays text on the front-end.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @return string
 */
function stonex_nav_menu_title( $title, $item ) {
    if ( is_object( $item ) && isset( $item->ID ) ) {
        $stonex_menu_meta = get_post_meta( $item->ID, '_stonex_menu_meta', true );
        if ( !empty( $stonex_menu_meta ) ) {
            $title .= ' - ' . $stonex_menu_meta;
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'stonex_nav_menu_title', 10, 2 );

function stonex_addons_megamenu_builder_integrations($item_output, $item, $depth, $args)
{
    $selected_megamenu = get_post_meta($item->ID, 'stonex_select_megamenu', true);
    if (!empty($selected_megamenu)) {

        if (!array_key_exists('elementor-preview', $_GET)) {

            $custom_sub_menu_html = "   <ul class='stonex-addons-megamenu-builder-content-wrap sub-menu'>
            <li>" . stonex_layout_content( (int)$selected_megamenu ) . "</li>
        </ul>";
            // Append after <a> element of the menu item targeted
            $item_output .= $custom_sub_menu_html;
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'stonex_addons_megamenu_builder_integrations', 10, 4);

function stonex_implement_menu_meta($classes, $item)
{
    // $class = get_field('hide_this_menu', $item) ? 'hide-label' : '';
    // $class .= get_field('is_it_title', $item) ? 'megamenu-heading' : '';
    $class = get_post_meta($item->ID, 'stonex_select_megamenu', true) ? 'menu-item-has-children stonex-megamenu-builder-parent stonex-mega-menu' : '';
    $classes[] = $class;
    return $classes;
}
add_filter('nav_menu_css_class', 'stonex_implement_menu_meta', 10, 2);