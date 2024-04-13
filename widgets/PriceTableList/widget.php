<?php

namespace STONEX_Addons\Widgets;

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

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

class Price_Table_Two extends \Elementor\Widget_Base
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
        return 'stonex-price-table-list';
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
        return __('Pricing Table List', 'stonex');
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
        return 'eicon-price-table';
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
        return ['stonex-addons'];
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
    public function search_keyword()
    {
        return ['Price', 'pricing table', 'pricing'];
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
        /**
         * Content tab
         */
        $this->start_controls_section(
            'price_heading_content',
            [
                'label' => __('Price Heading', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'header_top_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'pricing_type',
            [
                'label' => esc_html__('Pricing Type', 'stonex'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Free', 'stonex'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'price_icon',
            [
                'label' => esc_html__('Currency', 'stonex'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$', 'stonex'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'stonex'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('30', 'stonex'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'month_year',
            [
                'label' => esc_html__('Month/Year', 'stonex'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Month', 'stonex'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pricing_head_list',
            [
                'label' => esc_html__('Add Pricing', 'stonex'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'pricing_type' => esc_html__('Add Pricing Type', 'stonex'),
                        'price' => esc_html__('30', 'stonex'),
                        'month_year' => esc_html__('Month/Year', 'stonex'),
                    ],
                ],
                'title_field' => '{{{ pricing_type }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'feature_type',
            [
                'label' => __('Feature Type', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'enable_title',
            [
                'label' => __('Show Title', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex-addons'),
                'label_off' => __('Hide', 'stonex-addons'),
                'return_value' => 'title',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'feature_text',
            [
                'label' => esc_html__('Feature Text', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'stonex-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            'table_field_one',
            [
                'label' => __('Field One', 'stonex-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'stonex-addons'),
                    'field_text_one'  => __('Text', 'stonex-addons'),
                    'field_icon_one' => __('Icon', 'stonex-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_one',
            [
                'label' => __('Icon', 'stonex-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_one' => 'field_icon_one'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_one',
            [
                'label' => __('Text', 'stonex-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_one' => 'field_text_one'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_two',
            [
                'label' => __('Field Two', 'stonex-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'stonex-addons'),
                    'field_text_two'  => __('Text', 'stonex-addons'),
                    'field_icon_two' => __('Icon', 'stonex-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_two',
            [
                'label' => __('Icon', 'stonex-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_two' => 'field_icon_two'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_two',
            [
                'label' => __('Text', 'stonex-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_two' => 'field_text_two'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_three',
            [
                'label' => __('Field Three', 'stonex-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'stonex-addons'),
                    'field_text_three'  => __('Text', 'stonex-addons'),
                    'field_icon_three' => __('Icon', 'stonex-addons'),
                ],
            ]
        );
        $repeater->add_control(
            'field_icon_three',
            [
                'label' => __('Icon', 'stonex-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_three' => 'field_icon_three'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_three',
            [
                'label' => __('Text', 'stonex-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_three' => 'field_text_three'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_four',
            [
                'label' => __('Field Four', 'stonex-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'stonex-addons'),
                    'field_text_four'  => __('Text', 'stonex-addons'),
                    'field_icon_four' => __('Icon', 'stonex-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_four',
            [
                'label' => __('Icon', 'stonex-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_four' => 'field_icon_four'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_four',
            [
                'label' => __('Text', 'stonex-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_four' => 'field_text_four'
                ]
            ]
        );
        $this->add_control(
            'feature_list_box',
            [
                'label' => esc_html__('Feature List', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_text' => esc_html__('Title #1', 'stonex-addons'),
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();
        // Row
        $this->start_controls_section(
            'table_main_price',
            [
                'label' => __('Price Section', 'stonex-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_main_price_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header h3' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_price_typography',
                'selector' => '{{WRAPPER}} .pricing-header h3',
            ]
        );

        $this->add_control(
            'table_main_price_color',
            [
                'label' => esc_html__('Price Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_price_padding',
            [
                'label' => __('Price Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_price_margin',
            [
                'label' => __('Price Margin', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'table_main_category_color',
            [
                'label' => esc_html__('Category Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .price-category' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_cat_typography',
                'selector' => '{{WRAPPER}} .price-category',
            ]
        );
        $this->add_responsive_control(
            'table_main_category_padding',
            [
                'label' => __('Cateogry Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price-category' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_category_margin',
            [
                'label' => __('Category Margin', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price-category' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'table_main_price_bg_color',
            [
                'label' => esc_html__('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_price_border_radius',
            [
                'label' => __('Border Radius', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_price_width',
            [
                'label' => esc_html__('Wrapper Width', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_wrapper_padding',
            [
                'label' => __('Wrapper Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_wrapper_margin',
            [
                'label' => __('Wrapper Margin', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_main_price_border',
                'label' => __('Border', 'stonex-addons'),
                'selector' => '{{WRAPPER}} .pricing-heading',
            ]
        );
        $this->end_controls_section();

        // Main
        $this->start_controls_section(
            'table_main_heading',
            [
                'label' => __('Table Main Title', 'stonex-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_main_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_heading_typography',
                'selector' => '{{WRAPPER}} .table-main-title .pricing-list-heading',
            ]
        );
        $this->add_responsive_control(
            'table_main_heading_width',
            [
                'label' => esc_html__('Wrapper Width', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_main_heading_bg_color',
            [
                'label' => esc_html__('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_main_heading_color',
            [
                'label' => esc_html__(' Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_heading_border_radius',
            [
                'label' => __('Border Radius', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .table-main-title .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_main_heading_padding',
            [
                'label' => __('Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .table-main-title .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_main_heading_border',
                'label' => __('Border', 'stonex-addons'),
                'selector' => '{{WRAPPER}} .table-main-title .pricing-list-heading',
            ]
        );
        $this->end_controls_section();

        // heading
        $this->start_controls_section(
            'table_heading',
            [
                'label' => __('Table Head', 'stonex-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_head_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_heading_typography',
                'selector' => '{{WRAPPER}} .pricing-list-heading',
            ]
        );
        $this->add_responsive_control(
            'table_heading_width',
            [
                'label' => esc_html__('Wrapper Width', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_heading_bg_color',
            [
                'label' => esc_html__('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_heading_color',
            [
                'label' => esc_html__(' Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_heading_border_radius',
            [
                'label' => __('Border Radius', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_heading_padding',
            [
                'label' => __('Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_heading_border',
                'label' => __('Border', 'stonex-addons'),
                'selector' => '{{WRAPPER}} .pricing-list-heading',
            ]
        );
        $this->end_controls_section();
        // Main
        $this->start_controls_section(
            'table_content',
            [
                'label' => __('Table Content', 'stonex-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_content_align',
            [
                'label'     => __('Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_content_typography',
                'selector' => '{{WRAPPER}} .pricing-list',
            ]
        );
        $this->add_responsive_control(
            'table_content_width',
            [
                'label' => esc_html__('Width', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_content_height',
            [
                'label' => esc_html__('Height', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_content_color',
            [
                'label' => esc_html__('Item Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_content_border_radius',
            [
                'label' => __('Border Radius', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_content_margin',
            [
                'label' => __('Margin', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );


        $this->add_responsive_control(
            'table_content_padding',
            [
                'label' => __('Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_content_border',
                'label' => __('Border', 'stonex-addons'),
                'selector' => '{{WRAPPER}} .pricing-list',
            ]
        );
        $this->add_control(
            'price_icon_options',
            [
                'label' => esc_html__('Icon Options', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'table_icon_color',
            [
                'label' => esc_html__('Icon Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pricing-list svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-list svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Wrapper
        $this->start_controls_section(
            'wrapper',
            [
                'label' => __('Wrapper', 'stonex-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'table_wrapper_width',
            [
                'label' => esc_html__('Wrapper Width', 'stonex-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_wrapper_color',
            [
                'label' => esc_html__('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_wrapper_border_radius',
            [
                'label' => __('Border Radius', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_wrapper_padding',
            [
                'label' => __('Padding', 'stonex-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'Border',
                'label' => __('Border', 'stonex-addons'),
                'selector' => '{{WRAPPER}} .pricing-table',
            ]
        );

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
        $settings = $this->get_settings_for_display();
?>
        <div class="pricing-table-wrapper">
            <table class="pricing-table">
                <?php
                if ($settings['pricing_head_list']) {
                ?>
                    <thead class="heading-top">
                        <tr class="pricing-header heading-wrapper">
                            <th class="pricing-heading heading-empty"></th>
                            <?php
                            foreach ($settings['pricing_head_list'] as $item) {
                            ?>
                                <th class="pricing-heading">
                                    <p class="price-category"><?php echo $item['pricing_type']; ?></p>
                                    <h3 class="price">
                                        <span class="pricing-icon"><?php echo $item['price_icon'] ?></span>
                                        <span><?php echo $item['price']; ?></span>
                                        <span class="month-year"><?php echo $item['month_year']; ?></span>
                                    </h3>
                                </th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                <?php
                }
                ?>

                <tbody class="single-pricing-body">
                    <?php

                    if ($settings['feature_list_box']) {
                        foreach ($settings['feature_list_box']  as $item) {

                    ?>
                            <tr class="pricing-feature table-main-<?php echo $item['enable_title'] ?>">
                                <th class="pricing-list-heading"><?php echo $item['feature_text']; ?></th>
                                <td class="pricing-list" data-label="<?php echo $settings['pricing_head_list'][0]['pricing_type']; ?>">
                                    <?php
                                    if (!empty($item["field_icon_one"]['value']) || !empty($item['field_text_one'])) {
                                        if ('field_text_one' == $item['table_field_one']) {
                                            echo esc_html($item['field_text_one']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_one"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>

                                </td>
                                <td class="pricing-list" data-label="<?php echo $settings['pricing_head_list'][1]['pricing_type']; ?>">

                                    <?php
                                    if (!empty($item["field_icon_two"]['value']) || !empty($item['field_text_two'])) {

                                        if ('field_text_two' == $item['table_field_two']) {
                                            echo esc_html($item['field_text_two']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_two"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="pricing-list" data-label="<?php echo $settings['pricing_head_list'][2]['pricing_type']; ?>">
                                    <?php
                                    if (!empty($item["field_icon_three"]['value']) || !empty($item['field_text_three'])) {

                                        if ('field_text_three' == $item['table_field_three']) {
                                            echo esc_html($item['field_text_three']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_three"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="pricing-list" data-label="<?php echo $settings['pricing_head_list'][3]['pricing_type']; ?>">
                                    <?php
                                    if (!empty($item["field_icon_four"]['value']) || !empty($item['field_text_four'])) {

                                        if ('field_text_four' == $item['table_field_four']) {
                                            echo esc_html($item['field_text_four']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_four"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}

$widgets_manager->register(new \STONEX_Addons\Widgets\Price_Table_Two());
