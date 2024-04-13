<?php

namespace STONEX_Addons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class STONEX_Main_Menu extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'stonex-main-menu';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Primary Menu', 'stonex');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'stonex eicon-nav-menu';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['stonex'];
    }
    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus()
    {
        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $secondary_color = get_theme_mod('secondary_color');
        $accent_color    = get_theme_mod('accent_color');
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Content', 'stonex'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'use_main_menu',
            [
                'label'        => __('Use Main Menu', 'stonex'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'stonex'),
                'label_off'    => __('No', 'stonex'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'primary_menu',
                [
                    'label'        => __('Menu', 'header-footer-elementor'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor'), admin_url('nav-menus.php')),
                    'condition'    => [
                        'use_main_menu!' => 'yes',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
            'menu_style',
            [
                'label'   => __('Menu Style', 'stonex'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => __('Inline', 'stonex'),
                    'flyout' => __('Flyout', 'stonex'),
                ],
            ]
        );

        $this->add_control(
            'mobile_menu_style',
            [
                'label'   => __('Mobile Menu Style', 'stonex'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Style 1', 'stonex'),
                    '2' => __('Style 2', 'stonex'),
                    '3' => __('Style 3', 'stonex'),
                    '4' => __('Style 4', 'stonex'),
                ],
            ]
        );

        $this->add_control(
            'menu_logo',
            [
                'label'     => __('Menu Logo', 'stonex'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-menu-logo' => 'background-image: url({{URL}});',
                ],

                'condition' => [
                    'mobile_menu_style' => '4',
                ],
            ]
        );

        $this->add_control(
            'trigger_label',
            [
                'label' => __('Trigger Label', 'stonex'),
                'type'  => Controls_Manager::TEXT,
                'default' => __('Menu', 'stonex')
            ]
        );
        $this->add_control(
            'trigger_open_icon',
            [
                'label' => __('Trigger Icon', 'stonex'),
                'type'  => Controls_Manager::ICONS,

            ]
        );
        $this->add_control(
            'trigger_close_icon',
            [
                'label' => __('Trigger Close Icon', 'stonex'),
                'type'  => Controls_Manager::ICONS,
            ]
        );
        $this->add_responsive_control(
            'menu_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'flex-end',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation .navbar-nav' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button1',
            [
                'label' => __('Header Buttons', 'stonex-hp'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label'     => esc_html__('Dual Button Align', 'plugin-name'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'flex-end',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-main-menu-wrap .stonex-header-buttons' => 'justify-content: {{VALUE}}',

                ],
            ]
        );

        $this->start_controls_tabs('stonex_dual_button_content_tabs');
        $this->start_controls_tab(
            'stonex_dual_button_primary_button_content',
            [
                'label' => esc_html__('Primary', 'stonex'),
            ]
        );
        $this->add_control(
            'enable_primary_btn',
            [
                'label'        => __('Enable Primary Button?', 'stonex-hp'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'stonex-hp'),
                'label_off'    => __('No', 'stonex-hp'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_text',
            [
                'label'       => esc_html__('Text', 'stonex'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('VIEW DEMO', 'stonex'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_url',
            [
                'label'         => esc_html__('Link', 'stonex'),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __('https://your-link.com', 'stonex'),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true,
                ],
                'condition'     => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_icon',
            [
                'label'     => esc_html__('Icon', 'stonex'),
                'type'      => Controls_Manager::ICONS,
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_icon_position',
            [
                'label'     => __('Icon Position', 'stonex'),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'stonex-icon-pos-left'  => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'eicon-angle-left',
                    ],
                    'stonex-icon-pos-right' => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'eicon-angle-right',
                    ],
                ],
                'default'   => 'stonex-icon-pos-left',
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'stonex_dual_button_secondary_button_content',
            [
                'label' => esc_html__('Secondary', 'stonex'),

            ]
        );

        $this->add_control(
            'enable_secondary_btn',
            [
                'label'        => __('Enable Secondary Button?', 'stonex-hp'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'stonex-hp'),
                'label_off'    => __('No', 'stonex-hp'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'stonex_dual_button_secondary_button_text',
            [
                'label'       => esc_html__('Text', 'stonex'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('ORDER NOW', 'stonex'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_url',
            [
                'label'         => esc_html__('Link', 'stonex'),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __('https://your-link.com', 'stonex'),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true,
                ],
                'condition'     => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_icon',
            [
                'label' => esc_html__('Icon', 'stonex'),
                'type'  => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_icon_position',
            [
                'label'     => __('Icon Position', 'stonex'),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'stonex-icon-pos-left'  => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'eicon-angle-left',
                    ],
                    'stonex-icon-pos-right' => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'eicon-angle-right',
                    ],
                ],
                'default'   => 'stonex-icon-pos-left',
                'condition' => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_style',
            [
                'label'     => __('Menu Style', 'stonex'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'menu_items_tabs'
        );
        $this->start_controls_tab(
            'menu_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'label'    => __('Menu Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'menu_color',
            [
                'label'     => __('Item Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => __('Menu Gap', 'stonex'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'margin-right: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __('Item Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_readius',
            [
                'label'      => __('Item Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'menu_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_control(
            'menu_hover_color',
            [
                'label'     => __('Menu Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav li.current-menu-item>a'                                 => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .sub-menu:not(.stonex-megamenu-builder-content-wrap) a .menu-item-text:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_hover_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li:hover>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'dropdown_style',
            [
                'label'     => __('Dropdown Style', 'stonex'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'dropdown_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dripdown_typography',
                'label'    => __('Menu Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'dropdown_item_color',
            [
                'label'     => __('Item Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dropdown_menu_border',
                'label'    => __('menu_box_border', 'stonex'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_box_shadow',
                'label' => __('Box Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu',
            ]
        );


        $this->add_control(
            'ddown_menu_border_color',
            [
                'label'     => __('Menu Border Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu,
                    {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:before' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_radius',
            [
                'label'      => __('Menu radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu'      => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label'      => __('Item Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_padding',
            [
                'label'      => __('Menu Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children:not(.stonex-mega-menu) .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'dropdown_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_control(
            'dropdown_item_hover_color',
            [
                'label'     => __('Item Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap ) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap ) li.current-menu-item> a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_hover_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-addons-megamenu-builder-content-wrap ) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_flyout_style',
            [
                'label' => __('Flyout/Mobile Menu Style', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_menu_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_menu_typography',
                'label'    => __('Item Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'flyout_menu_color',
            [
                'label'     => __('Item Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_item_padding',
            [
                'label'      => __('Item Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_menu_padding',
            [
                'label'      => __('Menu Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_menu_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_control(
            'flyout_menu_hover_color',
            [
                'label'     => __('Menu Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'flyout_dropdown_style',
            [
                'label' => __('Flyout/Mobile Dropdown Style', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_dropdown_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_dripdown_typography',
                'label'    => __('Dropdown Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu:not(.stonex-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_color',
            [
                'label'     => __('Item Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_dropdown_item_padding',
            [
                'label'      => __('Item Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_dropdown_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_hover_color',
            [
                'label'     => __('Item Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a:hover,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_hover_color',
            [
                'label'     => __('Item Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) a:hover,
                    {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.stonex-megamenu-builder-content-wrap) .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'trigger_style',
            [
                'label' => __('Trigger Style', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'trigger_style_tabs'
        );
        $this->start_controls_tab(
            'trigger_style_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trigger_typography',
                'label'    => __('Trigger Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_color',
            [
                'label'     => __('Trigger Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon'         => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navbar-toggler.open-menu svg,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_background',
            [
                'label'     => __('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_border',
                'label'    => __('Border', 'stonex'),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_icon_size',
            [
                'label'      => __('Icon size', 'stonex'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'trigger_icon_gap',
            [
                'label'      => __('Icon Gap', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'trigger_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->add_responsive_control(
            'trigger_padding',
            [
                'label'      => __('Button Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'trigger_style_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_control(
            'trigger_hover_color',
            [
                'label'     => __('Trigger Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_hover_background',
            [
                'label'     => __('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_hover_border',
                'label'    => __('Border', 'stonex'),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu:hover',
            ]
        );
        $this->add_control(
            'trigger_hover_animation',
            [
                'label' => __('Hover Animation', 'stonex'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_responsive_control(
            'trigger_hover_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'panel_style',
            [
                'label' => __('Panel Style', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_label_typography',
                'label'    => __('Label Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler',
            ]
        );
        $this->add_control(
            'panel_label_color',
            [
                'label'     => __('Label Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_color',
            [
                'label'     => __('Close Trigger Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler i'        => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_fill_color',
            [
                'label'     => __('Close Trigger Fill Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_label_background',
            [
                'label'     => __('Label Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.close-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'panel_background',
            [
                'label'     => __('Panel Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_cloxe_icon_size',
            [
                'label'      => __('Close Icon size', 'stonex'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'panel_shadow',
                'label'    => __('Panel Shadow', 'stonex'),
                'selector' => '{{WRAPPER}}  .navbar-inner',
            ]
        );
        $this->add_responsive_control(
            'close_label_padding',
            [
                'label'      => __('Label Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .menu-style-flyout .navbar-toggler.close-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .navbar-toggler.close-menu'           => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'panel_padding',
            [
                'label'      => __('Panel Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner'           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout  .navbar-inner' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'megamenu_style',
            [
                'label' => __('Megamenu Settings', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'megamenu_items_tabs'
        );
        $this->start_controls_tab(
            'megamenu_normal_tab',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'megamenu_title_typography',
                'label'    => __('Heading Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu>li.megamenu-heading>a',
            ]
        );
        $this->add_control(
            'megamenu_title_color',
            [
                'label'     => __('Heading Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu>li.megamenu-heading>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'mega_menu_bg_color',
            [
                'label'     => __('Menu Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'megamenu_parent',
            [
                'label'        => __('Menu Parent', 'stonex'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 'container',
                'options'      => [
                    'container' => __('Container', 'stonex'),
                    'current'   => __('Current', 'stonex'),
                ],
                'prefix_class' => 'stonex-megamenu-position-',
            ]
        );
        $this->add_control(
            'megamenu_panel_width',
            [
                'label'      => __('Menu Width', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'megamenu_builder_margin',
            [
                'label'      => __('Megamenu Builder Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.stonex-megamenu-builder-parent>ul.stonex-megamenu-builder-content-wrap.sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'megamenu_padding',
            [
                'label'      => __('Menu Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'megamenu_hover_tab',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );
        $this->add_control(
            'megamenu_title_color_hover',
            [
                'label'     => __('Heading Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu>li.megamenu-heading>a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
         * Keystone Base Dual Button Primary Button Style
         */
        $this->start_controls_section(
            'stonex_container_primary_button_style',
            [
                'label'     => esc_html__('Primary Button', 'stonex'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('stonex_dual_button_primary_button_tabs');
        $this->start_controls_tab('stonex_dual_button_primary_button_noemal', ['label' => esc_html__('Normal', 'stonex')]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'stonex_container_primary_button_typography',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary span',
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_icon_margin',
            [
                'label'      => __('Icon Space', 'stonex'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary .stonex-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-dual-button-primary .stonex-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'stonex_dual_button_primary_button_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_container_primary_button_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_container_primary_button_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_radius',
            [
                'label'      => __('Border radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-1::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-2::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-3::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-4::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_normal_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4243DC',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-6' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_normal_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_primary_button_hover', ['label' => esc_html__('Hover', 'stonex')]);
        $this->add_control(
            'stonex_dual_button_primary_button_animation',
            [
                'label'   => esc_html__('Hover Effect', 'stonex'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __('Effect 1', 'stonex'),
                    'effect-2' => __('Effect 2', 'stonex'),
                    'effect-3' => __('Effect 3', 'stonex'),
                    'effect-4' => __('Effect 4', 'stonex'),
                    'effect-5' => __('Effect 5', 'stonex'),
                    'effect-6' => __('Effect 6', 'stonex'),
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_hover_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5543dc',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-6::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_hover_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
         * Keystone Base Dual Button secondary Button Style
         */
        $this->start_controls_section(
            'stonex_container_secondary_button_style',
            [
                'label'     => esc_html__('Secondary Button', 'stonex'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('stonex_dual_button_secondary_button_tabs');
        $this->start_controls_tab('stonex_dual_button_secondary_button_noemal', ['label' => esc_html__('Normal', 'stonex')]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'stonex_container_secondary_button_typography',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary span',
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_icon_margin',
            [
                'label'      => __('Icon Space', 'stonex'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary .stonex-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary .stonex-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'stonex_dual_button_secondary_button_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_normal_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-6' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_normal_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary',
            ]
        );
        $this->add_responsive_control(
            'stonex_container_secondary_button_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_container_secondary_button_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_radius',
            [
                'label'      => __('Border radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary, {{WRAPPER}} .stonex-dual-button-secondary.effect-1::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-2::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-3::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-4::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_secondary_button_hover', ['label' => esc_html__('Hover', 'stonex')]);
        $this->add_control(
            'stonex_dual_button_secondary_button_animation',
            [
                'label'   => esc_html__('Hover Effect', 'stonex'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __('Effect 1', 'stonex'),
                    'effect-2' => __('Effect 2', 'stonex'),
                    'effect-3' => __('Effect 3', 'stonex'),
                    'effect-4' => __('Effect 4', 'stonex'),
                    'effect-5' => __('Effect 5', 'stonex'),
                    'effect-6' => __('Effect 6', 'stonex'),
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_hover_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_hover_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $popular_post_key       = array();
        $popular_meta_value_num = array();
        $settings               = $this->get_settings_for_display();
        if ('yes' == $settings['use_main_menu']) {
            $args = [
                'theme_location'  => 'main-menu',
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'stonex-menu-container',
            ];
        } else {
            $args = [
                'menu'            => $settings['primary_menu'],
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'stonex-menu-container',
            ];
        }

?>
        <div class="stonex-main-menu-wrap navbar <?php printf('menu-style-%s mobile-menu-style-%s  ', esc_attr($settings['menu_style']), esc_attr($settings['mobile_menu_style'])) ?>">
            <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <?php
                    if ('' != $settings['trigger_open_icon']['value']) {
                        Icons_Manager::render_icon($settings['trigger_open_icon'], ['aria-hidden' => 'true']);
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" height="384pt" viewBox="0 -53 384 384" width="384pt"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path></svg>';
                    }
                    ?>
                </span>
                <?php if (!empty($settings['trigger_label'])) {
                    printf('<span class="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '');
                } ?>
            </button>
            <!-- end of Nav toggler -->
            <div class="navbar-inner">
                <div class="stonex-mobile-menu"></div>
                <div class="mobile-menu-logo">
                    <span><?php echo esc_html__('menu', 'stonex'); ?></span>
                </div>
                <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <?php if (!empty($settings['trigger_label'])) {
                        printf('<span cla ss="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '');
                    } ?>
                    <span class="navbar-toggler-icon close">
                        <?php
                        if ('' != $settings['trigger_open_icon']['value']) {
                            Icons_Manager::render_icon($settings['trigger_close_icon'], ['aria-hidden' => 'true']);
                        } else {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" height="329pt" viewBox="0 0 329.26933 329" width="329pt"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"></path></svg>';
                        }
                        ?>
                    </span>
                </button>
                <nav id="site-navigation" class="main-navigation ">
                    <?php wp_nav_menu($args); ?>
                </nav><!-- #site-navigation -->
                <?php if ('yes' == $settings['enable_primary_btn'] || 'yes' == $settings['enable_secondary_btn']) : ?>
                    <div class="stonex-header-buttons">
                        <?php $this->stonex_dual_buttons() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    public function stonex_dual_buttons()
    {
        $settings               = $this->get_settings_for_display();
        $secondary_btn_icon_pos = $settings['stonex_dual_button_secondary_button_icon_position'];
        $primary_btn_icon_pos   = $settings['stonex_dual_button_primary_button_icon_position'];

        $this->add_render_attribute(
            'stonex_dual_button_primary_button_url',
            [
                'class' => [
                    'stonex-dual-button-primary stonex-dual-button-action',
                    esc_attr($settings['stonex_dual_button_primary_button_animation']),
                ],
            ]
        );
        $this->add_render_attribute(
            'stonex_dual_button_secondary_button_url',
            [
                'class' => [
                    'stonex-dual-button-secondary stonex-dual-button-action',
                    esc_attr($settings['stonex_dual_button_secondary_button_animation']),
                ],
            ]
        );
        if (isset($settings['stonex_dual_button_primary_button_url']['url'])) {
            $this->add_render_attribute('stonex_dual_button_primary_button_url', 'href', esc_url($settings['stonex_dual_button_primary_button_url']['url']));
            if (isset($settings['stonex_dual_button_primary_button_url']['is_external'])) {
                $this->add_render_attribute('stonex_dual_button_primary_button_url', 'target', '_blank');
            }
            if (isset($settings['stonex_dual_button_primary_button_url']['nofollow'])) {
                $this->add_render_attribute('stonex_dual_button_primary_button_url', 'rel', 'nofollow');
            }
        }
        if (isset($settings['stonex_dual_button_secondary_button_url']['url'])) {
            $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'href', esc_url($settings['stonex_dual_button_secondary_button_url']['url']));
            if (isset($settings['stonex_dual_button_secondary_button_url']['is_external'])) {
                $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'target', '_blank');
            }
            if (isset($settings['stonex_dual_button_secondary_button_url']['nofollow'])) {
                $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'rel', 'nofollow');
            }
        }
        $this->add_inline_editing_attributes('stonex_dual_button_primary_button_text', 'none');
        $this->add_inline_editing_attributes('stonex_dual_button_secondary_button_text', 'none');
    ?>
        <div <?php echo $this->get_render_attribute_string('stonex_dual_button'); ?>>
            <div class="stonex-dual-button-wrapper">
                <a <?php echo $this->get_render_attribute_string('stonex_dual_button_primary_button_url'); ?>>
                    <span class="<?php echo esc_attr($primary_btn_icon_pos); ?>">
                        <?php
                        if ('stonex-icon-pos-left' === $primary_btn_icon_pos && !empty($settings['stonex_dual_button_primary_button_icon']['value'])) {
                            Icons_Manager::render_icon($settings['stonex_dual_button_primary_button_icon']);
                        }
                        ?>
                        <span <?php echo $this->get_render_attribute_string('stonex_dual_button_primary_button_text'); ?>>
                            <?php echo esc_html($settings['stonex_dual_button_primary_button_text']); ?>
                        </span>
                        <?php
                        if ('stonex-icon-pos-right' === $primary_btn_icon_pos && !empty($settings['stonex_dual_button_primary_button_icon']['value'])) {
                            Icons_Manager::render_icon($settings['stonex_dual_button_primary_button_icon']);
                        }
                        ?>
                    </span>
                </a>
                <a <?php echo $this->get_render_attribute_string('stonex_dual_button_secondary_button_url'); ?>>
                    <span class="<?php echo esc_attr($secondary_btn_icon_pos); ?>">
                        <?php
                        if ('stonex-icon-pos-left' === $secondary_btn_icon_pos && !empty($settings['stonex_dual_button_secondary_button_icon']['value'])) {
                            Icons_Manager::render_icon($settings['stonex_dual_button_secondary_button_icon']);
                        }
                        ?>
                        <span <?php echo $this->get_render_attribute_string('stonex_dual_button_secondary_button_text'); ?>>
                            <?php echo esc_html($settings['stonex_dual_button_secondary_button_text']); ?>
                        </span>
                        <?php
                        if ('stonex-icon-pos-right' === $secondary_btn_icon_pos && !empty($settings['stonex_dual_button_secondary_button_icon']['value'])) {
                            Icons_Manager::render_icon($settings['stonex_dual_button_secondary_button_icon']);
                        }
                        ?>
                    </span>
                </a>
            </div>
        </div>
<?php
    }
}
$widgets_manager->register(new \STONEX_Addons\Widgets\STONEX_Main_Menu());
