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
class Price_Table extends \Elementor\Widget_Base
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
        return 'stonex-price-table';
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
        return __('Pricing Table', 'stonex');
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
        return ['stonex'];
    }

    public function get_keywords()
    {
        return ['price', 'package', 'product', 'plan', 'pricing', 'stonex'];
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
            'price_tabs',
            [
                'label' => __('Price Tabs', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_tab_title',
            [
                'label'   => __('First tab title', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Monthly '),
            ]
        );

        $this->add_control(
            'second_tab_title',
            [
                'label'   => __('Second tab title', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Yearly '),
            ]
        );

        $this->add_control(
            'price_show_offer',
            [
                'label' => esc_html__('Show Offer', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'price_offer',
            [
                'label'   => __('Offer text', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Save 20% '),
                'condition' => [
                    'price_show_offer' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'switcher_style',
            [
                'label'   => __('Switcher Style', 'stonex'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'style-1' => __('Style 1', 'stonex'),
                    'style-2' => __('Style 2', 'stonex'),
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_align',
            [
                'label'     => __('Tab wrapper Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'price_tables',
            [
                'label' => __('Price tables', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns', 'omega-hp'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1 Column',
                '6'  => '2 Column',
                '4'  => '3 Column',
                '3'  => '4 Column',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => __('Column Gap', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-box-wrap>div' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-box-wrap'     => 'margion-left: -{{SIZE}}{{UNIT}}; margion-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'omega'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-pricing-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-box-wrap' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'focused',
            [
                'label'        => __('Make it focsed', 'stonex'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Not Focused', 'stonex'),
                'label_off'    => __('Focused', 'stonex'),
                'return_value' => 'focused',

            ]
        );
        $repeater->add_control(
            'price_show_icon',
            [
                'label' => esc_html__('Show Icon', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'price_icon',
            [
                'label' => esc_html__('Header Icon', 'stonex'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'price_show_icon' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'   => __('Price title', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Personal',
            ]
        );
        $repeater->add_control(
            'price_sub_title',
            [
                'label' => esc_html__('Show Subtitle', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'price_subtitle_title',
            [
                'label'   => __('Price Sub title', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Personal',
                'condition' => [
                    'price_sub_title' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'price_badge',
            [
                'label' => __('Price Badge', 'stonex'),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'price_currency',
            [
                'label'   => __('Price Currency', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('$', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_monthly',
            [
                'label'   => __('Montly Price', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('99', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_duration_monthly',
            [
                'label'   => __('Montly Price Duration text', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('per month', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_subtitle_monthly',
            [
                'label'   => __('Montly Price Subtitle', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('billed monthly', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_yearly',
            [
                'label'   => __('Yearly  Price', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('180', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_duration_yearly',
            [
                'label'   => __('Yearly Price Duration text', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('per year', 'stonex'),
            ]
        );

        $repeater->add_control(
            'price_subtitle_yearly',
            [
                'label'   => __('Yearly Price Subtitle', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('billed Yearly', 'stonex'),
            ]
        );
        $repeater->add_control(
            'features',
            [
                'label' => __('Features', 'stonex'),
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $repeater->add_control(
            'show_btn',
            [
                'label'        => __('Show Button', 'stonex'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'stonex'),
                'label_off'    => __('Hide', 'stonex'),
                'default'      => 'true',
                'return_value' => 'true',
            ]
        );

        $repeater->add_control(
            'btn_icon',
            [
                'label'     => __('Button Icon', 'stonex'),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'   => '',
                    'library' => '',
                ],
            ]
        );

        $repeater->add_control(
            'button_label',
            [
                'label'     => __('Button text', 'stonex'),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => 'Learn More',
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'button_monthly_url',
            [
                'label'     => __('Button Monthly URL', 'stonex'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]

        );

        $repeater->add_control(
            'button_yearly_url',
            [
                'label'     => __('Button Yearly URL', 'stonex'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]

        );

        $repeater->add_control(
            'bottom_info',
            [
                'label'   => __('Bottom Info', 'stonex'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'No credit card required',
            ]
        );

        $this->add_control(
            'pricing_list',
            [
                'label'       => __('Repeater List', 'stonex'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );





        $this->add_control(
            'stonex_addons_pricing_table_btn_wrapper_alignment',
            [
                'label'         => __('Button Wrapper Alignment', 'stonex'),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'        => 'center',
                'options'       => [
                    'start'      => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __('Center', 'stonex'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'end'     => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item .stonex-btn-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label'     => __('Button Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'justify-content:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_align',
            [
                'label'     => __('Price Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-price' => 'justify-content:{{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_align',
            [
                'label'     => __('Content Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_align',
            [
                'label'     => __('Vertical Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Top', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('Cnter', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Bottom', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} #stonex-dynamic-deck' => 'align-items:{{VALUE}}',
                ],
            ]
        );



        /* Price button position start*/

        $this->add_responsive_control(
            'price_btn_position_type',
            array(
                'label' => __('Button Position', 'stonex'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'stonex'),
                    'static' => __('Static', 'stonex'),
                    'relative' => __('Relative', 'stonex'),
                    'absolute' => __('Absolute', 'stonex'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_top',
            array(
                'label' => __('Top', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_right',
            array(
                'label' => __('Right', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_btn_content_position_bottom',
            array(
                'label' => __('Bottom', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_left',
            array(
                'label' => __('Left', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_from_center',
            array(
                'label' => __('From Center', 'stonex'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price button position End*/



        /* Price title position start*/

        $this->add_responsive_control(
            'price_title_position_type',
            array(
                'label' => __('Price Title Position', 'stonex'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'stonex'),
                    'static' => __('Static', 'stonex'),
                    'relative' => __('Relative', 'stonex'),
                    'absolute' => __('Absolute', 'stonex'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_top',
            array(
                'label' => __('Top', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_right',
            array(
                'label' => __('Right', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_bottom',
            array(
                'label' => __('Bottom', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_left',
            array(
                'label' => __('Left', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_from_center',
            array(
                'label' => __('From Center', 'stonex'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-pricing-title' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price title position End*/


        /* Price position start*/

        $this->add_responsive_control(
            'price_content_position_type',
            array(
                'label' => __('Price Position Type', 'stonex'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'stonex'),
                    'static' => __('Static', 'stonex'),
                    'relative' => __('Relative', 'stonex'),
                    'absolute' => __('Absolute', 'stonex'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_top',
            array(
                'label' => __('Top', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_right',
            array(
                'label' => __('Right', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_content_position_bottom',
            array(
                'label' => __('Bottom', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_left',
            array(
                'label' => __('Left', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_from_center',
            array(
                'label' => __('From Center', 'stonex'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .stonex-price' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price position End*/

        /* Price subtitle position start*/

        $this->add_responsive_control(
            'price_subtitle_position_type',
            array(
                'label' => __('Price Subtitle Position', 'stonex'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'stonex'),
                    'static' => __('Static', 'stonex'),
                    'relative' => __('Relative', 'stonex'),
                    'absolute' => __('Absolute', 'stonex'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_top',
            array(
                'label' => __('Top', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_right',
            array(
                'label' => __('Right', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_bottom',
            array(
                'label' => __('Bottom', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_left',
            array(
                'label' => __('Left', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_from_center',
            array(
                'label' => __('From Center', 'stonex'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .stonex-price-wrap .price-subtitle' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price subtitle position End*/



        $this->end_controls_section();
        /**
         * Header Icon
         */

        $this->start_controls_section(
            'pring_header_icon',
            [
                'label' => __('Header Icon', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'header_icon_width',
            [
                'label' => esc_html__('Font Size', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-icon svg ' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'header_iocn_color',
            [
                'label' => esc_html__('Icon Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-pricing-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'header_icon_gap',
            [
                'label' => esc_html__('Gap', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} span.stonex-pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */

        $this->start_controls_section(
            'pricing_tabs_tyle',
            [
                'label' => __('Pricing Tabs', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'toggle_wrap_padding',
            [
                'label'      => __('Toggle Wrapper padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],

            ]
        );
        $this->add_responsive_control(
            'toggle_margin',
            [
                'label'      => __('Toggle Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price-tabs-switcher' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'toggle_border',
                'label'    => __('toggle_border', 'stonex'),
                'selector' => '{{WRAPPER}} #pricing-dynamic-deck--head a',
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]

        );

        $this->add_responsive_control(
            'toggle_border_radius',
            [
                'label'      => __('Toggle Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_title_typo',
                'label'    => __('Title typography', 'stonex'),
                'selector' => '{{WRAPPER}} .first-tabs-title,{{WRAPPER}} .second-tabs-title',
            ]
        );

        $this->add_control(
            'tabs_title_color',
            [
                'label'     => __('Title Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title, {{WRAPPER}} .second-tabs-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_title_active_color',
            [
                'label'     => __('Title Active Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title.active, {{WRAPPER}} .second-tabs-title.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_title_active_bg_color',
            [
                'label'     => __('Title Active Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title.active, {{WRAPPER}} .second-tabs-title.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'switcher_divide',
            [
                'type'      => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'switcher_bg_color',
                'label'     => __('Switcher Background Color', 'stonex'),
                'types'     => ['classic', 'gradient'],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'gradient'
                    ],
                ],
                'selector'  => '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle',
            ]
        );

        $this->add_control(
            'switcher_bg_active_color',
            [
                'label'     => __('Switcher Active Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );
        $this->add_control(
            'switcher_circle_color',
            [
                'label'     => __('Switcher Circle Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle span' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_padding',
            [
                'label' => __('Title Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'first_title_active_border_radius',
            [
                'label'      => __('First active title Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 a.tabs-title.first-tabs-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_title_active_border_radius',
            [
                'label'      => __('Second active title Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 a.tabs-title.second-tabs-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'switcher_wrap_bg_active_color',
            [
                'label'     => __('Switcher Wraper Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'wraper_box_active_border',
                'label'    => __('wraper_box_border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab',
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'wraper_border_radius',
            [
                'label'      => __('Switcher Wraper Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_tabs_wraper',
                'label' => esc_html__('Switcher Wraper Box Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab',
            ]
        );
        $this->add_responsive_control(
            'tile_tab_width',
            [
                'label' => __('Switcher Width', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'tile_tab_height',
            [
                'label' => __('Switcher Height', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs.style-2 .stonex-pricing-tab' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'shitcher_position',
            [
                'label' => __('Switcher Position', 'omega-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'absolute'  => __('Absolute', 'omega-hp'),
                    'initial' => __('Initial', 'omega-hp'),
                    'fixed' => __('Fixed', 'omega-hp'),
                    'relative' => __('Relative', 'omega-hp'),
                    'default' => __('Default', 'omega-hp'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'position: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'switcher_position_left',
            [
                'label' => __('Left', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'left: {{SIZE}}{{UNIT}} !important; right: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_right',
            [
                'label' => __('Right', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_top',
            [
                'label' => __('Top', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'top: {{SIZE}}{{UNIT}} !important; button: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_bottom',
            [
                'label' => __('Bottom', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-tabs' => 'bottom: {{SIZE}}{{UNIT}} !important; top: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );

        $this->add_responsive_control(
            'switcher_bottom_gap',
            [
                'label' => __('Bottom Gap', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 55,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'offer_divide',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'offer_typo',
                'label'    => __('Offer typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-price-offer',
            ]
        );

        $this->add_control(
            'offer_color',
            [
                'label'     => __('Offer Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-price-offer' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offer_bg_color',
            [
                'label'     => __('Offer Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-price-offer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'offer_padding',
            [
                'label'      => __('Offer Text Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'offer_radius',
            [
                'label'      => __('Offer Text Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //Price Badge

        $this->start_controls_section(
            'Price_Badge',
            [
                'label' => __('Price Badge', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'price_badge_style_tabs'
        );

        $this->start_controls_tab(
            'price_badge_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typo',
                'label'    => __('Badge Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-badge',
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => __('Badge Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => __('Badge Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => __('Badge Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => '8',
                    'right'  => '8',
                    'bottom' => '8',
                    'left'   => '8',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => __('Badge Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_x_postion',
            [
                'label'      => __('Badge X Position', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_y_postion',
            [
                'label'      => __('Badge Y Position', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'price_badge_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );

        $this->add_control(
            'badge_color_active',
            [
                'label'     => __('Badge Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color_active',
            [
                'label'     => __('Badge Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'Title_style',
            [
                'label' => __('Title', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_title_style_tabs'
        );

        $this->start_controls_tab(
            'price_title_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Title typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_gap',
            [
                'label' => esc_html__('Title Gap', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_title_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'title_color_active',
            [
                'label'     => __('Title Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // subtitel
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => __('Sub Title', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_subtitle_style_tabs'
        );

        $this->start_controls_tab(
            'price_subtitle_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typo',
                'label'    => __('subtitle typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-subtitle',
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('subtitle Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_subtitle_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'sub_title_color_active',
            [
                'label'     => __('subtitle Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'price_style',
            [
                'label' => __('Price', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_style_tabs'
        );

        $this->start_controls_tab(
            'price_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typo',
                'label'    => __('Price typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item .stonex-price h2',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label'     => __('Price Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item .stonex-price h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_currency_typo',
                'label'    => __('Price Currency Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item .stonex-price .price-currency',
            ]
        );
        $this->add_control(
            'price_currency_color',
            [
                'label'     => __('Currency Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item .stonex-price .price-currency' => 'color: {{VALUE}}',
                ],
            ]
        );

        /* Separator */


        $this->add_control(
            'stonex_addons_pricing_table_price_box_separator',
            [
                'label'        => esc_html__('Enable Separator', 'stonex'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('ON', 'stonex'),
                'label_off'    => __('OFF', 'stonex'),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_responsive_control(
            'stonex_addons_pricing_table_price_box_separator_height',
            [
                'label'     => esc_html__('Separator Height', 'stonex'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => '1',
                'selectors' => [
                    '{{WRAPPER}} .stonex-addons-price-bottom-separator' => 'height: {{VALUE}}px;'
                ],
                'condition' => [
                    'stonex_addons_pricing_table_price_box_separator' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'stonex_addons_pricing_table_price_box_separator_color',
            [
                'label'     => esc_html__('Separator Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-addons-price-bottom-separator'  => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'stonex_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'stonex_addons_pricing_table_price_box_separator_spacing',
            [
                'label'       => esc_html__('Separator Spacing', 'stonex'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .stonex-addons-price-bottom-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

                'condition'   => [
                    'stonex_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );



        /* Separator end */





        $this->add_control(
            'dura_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_dur_typo',
                'label'    => __('Price Duration typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-price span.stonex-pricing-duration',
            ]
        );

        $this->add_control(
            'duration_color',
            [
                'label'     => __('Duration Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-duration' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_per_margin',
            [
                'label'      => __('Price Duration Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-duration ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'subtitle_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_subtitle_typo',
                'label'    => __('Price Subtitle typography', 'stonex'),
                'selector' => '{{WRAPPER}} .price-subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => __('Subtitle Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_subtitle_border',
                'label'    => __('Price Border', 'stonex'),
                'selector' => '{{WRAPPER}} .price-subtitle',
            ]
        );

        $this->add_control(
            'price_wrap_bg_color',
            [
                'label'     => __('Price Wrap Backgrounr', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-price-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_wrap_border',
                'label'    => __('Price Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-price-wrap',
            ]
        );

        $this->add_control(
            'price_toggle',
            [
                'label'        => __('Price Advanced Options', 'stonex'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'stonex'),
                'label_on'     => __('Custom', 'stonex'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'        => 'pricing_border',
                'label'       => __('Price Border', 'stonex'),
                'label_block' => true,
                'selector'    => '{{WRAPPER}} .stonex-price',
            ]
        );
        $this->add_responsive_control(
            'price_currency_margin',
            [
                'label'      => __('Price Currency Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_subtitle_padding',
            [
                'label'      => __('Price Subtitle Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_subtitle_gap',
            [
                'label'      => __('Price Subtitle Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_padding',
            [
                'label'      => __('Price Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_wrap_padding',
            [
                'label'      => __('Price Wrap Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_wrap_gap',
            [
                'label'      => __('Price Gap', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-price h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'price_color_active',
            [
                'label'     => __('Price Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-price h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'stonex_addons_pricing_table_price_box_separator_color_active',
            [
                'label'     => esc_html__('Separator Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-addons-price-bottom-separator'  => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'stonex_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'price_currency_color_active',
            [
                'label'     => __('Currency Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused  .stonex-price .price-currency' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'duration_color_active',
            [
                'label'     => __('Duration Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-duration' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_active',
            [
                'label'     => __('Subtitle Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .price-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'active_pricing_subtitle_border',
                'label'    => __('Price Subtitle Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused .price-subtitle',
            ]
        );

        $this->add_control(
            'price_wrap_bg_color_active',
            [
                'label'     => __('Price Wrap Backgrounr', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused  .stonex-price-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_wrap_border_active',
                'label'    => __('Price Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused  .stonex-price-wrap',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            'feature_style',
            [
                'label' => __('Feature', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'featur_box_height',
            [
                'label' => esc_html__('Feature Height', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'price_features_style_tabs'
        );

        $this->start_controls_tab(
            'price_features_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_typo',
                'label'    => __('Features typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-features',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_strong_typo',
                'label'    => __('Features Strong typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-features strong',
            ]
        );

        $this->add_control(
            'features_color',
            [
                'label'     => __('Features Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_strong_color',
            [
                'label'     => __('Features Strong Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features strong' => 'color: {{VALUE}}',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'feature_border',
                'label'    => __('Feature Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-features ul li',

            ]
        );


        $this->add_responsive_control(
            'features_align',
            [
                'label'     => __('Feature Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('center', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'end'  => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'features_text_align',
            [
                'label'     => __('Feature text Align', 'stonex'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __('Left', 'stonex'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('center', 'stonex'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'end'  => [
                        'title' => __('Right', 'stonex'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features ul li' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_item_gap',
            [
                'label'      => __('Item gap', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features p:not(:last-child),{{WRAPPER}} .stonex-pricing-features ul li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_item_padding',
            [
                'label'      => __('Iteam Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'feature_gap',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_features_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'features_color_active',
            [
                'label'     => __('Features Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-features' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_strong_color_active',
            [
                'label'     => __('Features Strong Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-features strong' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_icon_color_active',
            [
                'label'     => __('Features Icon Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-pricing-features i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'featur_icon_option',
            [
                'label' => esc_html__('Icon Options', 'stonex'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'fea_icon_color',
            [
                'label'     => __('Icon Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features ul li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-pricing-features ul li svg path ' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_strong_icon_color',
            [
                'label'     => __('Icon Strong Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-features strong i' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .stonex-pricing-features strong svg path' => 'fill: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_icon_size',
            [
                'label'      => __('Icon Size', 'stonex'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features p i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features p img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features li img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_icon_gap',
            [
                'label'      => __('Icon Gap', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-features ul li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features p i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features p img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-pricing-features li img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );

        $this->add_control(
            'boxed_btn_color',
            [
                'label'     => __('Button Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'bottom_typography',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_control(
            'boxed_btn_background',
            [
                'label'     => __('Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __('Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __('Button Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_btn_width',
            [
                'label' => __('Button Width', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_btn_height',
            [
                'label' => __('Button Height', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __('Button Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => __('Button Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item .stonex-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_icon_options',
            [
                'label' => esc_html__('Icon Options', 'stonex'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'p_icon_size',
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
                    '{{WRAPPER}} .stonex-btn-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-btn-wrapper svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_color',
            [
                'label' => __('Icon Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-btn-wrapper svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_icon_color',
            [
                'label' => __('Icon Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item:hover .stonex-btn-wrapper i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-pricing-area .stonex-pricing-item:hover .stonex-btn-wrapper svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_icon_margin',
            [
                'label' => __('Icon Margin', 'stonex'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .stonex-btn-wrapper i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-btn-wrapper svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );

        $this->add_control(
            'stonex_addons_pricing_table_btn_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item:hover .stonex-btn' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'stonex_addons_pricing_table_btn_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item:hover .stonex-btn' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_hover_border',
                'label'    => __('Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item:hover .stonex-btn',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item:hover .stonex-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_shadow',
                'label'    => __('Button Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-btn-wrapper .stonex-btn:hover',
            ]
        );

        $this->add_control(
            'btn_icon_hoverr_color',
            [
                'label' => __('Hover Icon  Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item:hover .stonex-btn i' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();


        $this->start_controls_tab(
            'button_style_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );

        $this->add_control(
            'btn_active_color',
            [
                'label'     => __('Button Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused.stonex-pricing-item.focused  .stonex-btn-wrapper .stonex-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'btn_active_background',
                'types'     => ['classic', 'gradient'],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'gradient'
                    ],
                ],
                'selector'  => '{{WRAPPER}} .stonex-pricing-item.focused .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_active_border',
                'label'    => __('Border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'stonex'),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_active_shadow',
                'label'    => __('Button Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused .stonex-btn-wrapper .stonex-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_active_hover_shadow',
                'label'    => __('Button Hover Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused .stonex-btn-wrapper .stonex-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'button_active_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item.focused .stonex-btn-wrapper .stonex-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'bottom_text',
            [
                'label' => __('Bottom Info', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'bottom_typo',
                'label'    => __('typography', 'stonex'),
                'selector' => '{{WRAPPER}} .pricing-bottom-info',
            ]
        );

        $this->add_control(
            'bottom_info_olor',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-bottom-info' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'bottom_info_gap',
            [
                'label'      => __('Gap', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .pricing-bottom-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'Box',
            [
                'label' => __('Box', 'stonex'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_height',
            [
                'label' => esc_html__('Box Height', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
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
                    '{{WRAPPER}} .stonex-pricing-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'box_normal_tab',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => __('Box Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __('Foucsed Box Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __('box_border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __('Box Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Box Padding', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Box Margin', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_hover_tab',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __('Box Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __('Hover Box Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item:hover',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __('box_border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item:hover',
            ]
        );

        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __('Box Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_active_tab',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'box_active_bg_color',
            [
                'label'     => __('Box Background Color', 'stonex'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-pricing-item.focused' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_active_shadow',
                'label'    => __('Foucsed Box Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_active_border',
                'label'    => __('box_border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-pricing-item.focused',
            ]
        );

        $this->add_responsive_control(
            'box_active_radius',
            [
                'label'      => __('Box Radius', 'stonex'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-pricing-item.focused' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        /* Grid Class */
        $grid_classes = [];
        $grid_classes[] = 'col-xl-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('pricing_gride_classes', 'class', [$grid_classes, 'col-lg-6 stonex-pricing-item-wrap']);

?>
        <?php
        if ($settings['pricing_list']) :
        ?>
            <div class="stonex-pricing-area pricing-style-classic">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="stonex-pricing-tabs <?php echo esc_attr($settings['switcher_style']) ?>">
                            <?php if ('style-2' == $settings['switcher_style']) : ?>
                                <div class="stonex-pricing-tab">
                                    <a href="javascript:" class="tabs-title first-tabs-title active" data-pricing-tab-trigger data-target="#stonex-dynamic-deck">
                                        <?php echo esc_html($settings['first_tab_title']); ?>
                                    </a>
                                    <a href="javascript:" class="tabs-title second-tabs-title" data-pricing-tab-trigger data-target="#stonex-dynamic-deck">
                                        <?php echo esc_html($settings['second_tab_title']); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <span class="first-tabs-title"><?php echo $settings['first_tab_title'] ?></span>
                                <div class="stonex-price-tabs-switcher">
                                    <div id="pricing-dynamic-deck--head">
                                        <a href="javascript:" class="btn-toggle active mx-3" data-pricing-trigger data-target="#stonex-dynamic-deck"><span class="round"></span></a>
                                    </div>
                                </div>
                                <span class="second-tabs-title"><?php echo $settings['second_tab_title'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($settings['price_offer'])) : ?>
                                <span class="stonex-price-offer"><?php echo $settings['price_offer'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row pricing-box-wrap justify-content-center" id="stonex-dynamic-deck" data-pricing-dynamic data-value-active="monthly">
                    <?php foreach ($settings['pricing_list'] as $pricing) : ?>
                        <div <?php echo $this->get_render_attribute_string('pricing_gride_classes'); ?>>
                            <div class="stonex-pricing-item <?php echo $pricing['focused'] ?>">
                                <!-- classic pricing -->
                                <div class="stonex-price-wrap">
                                    <?php if ('yes' === $pricing['price_show_icon']) : ?>
                                        <span class="stonex-pricing-icon"><?php \Elementor\Icons_Manager::render_icon($pricing['price_icon'], ['aria-hidden' => 'true']); ?></span>
                                    <?php endif; ?>
                                    <span class="stonex-pricing-title"><?php echo $pricing['title'] ?></span>
                                    <?php if ('yes' === $pricing['price_sub_title']) : ?>
                                        <span class="stonex-pricing-subtitle"><?php echo $pricing['price_subtitle_title'] ?></span>
                                    <?php endif; ?>
                                    <?php if ($pricing['price_badge']) : ?>
                                        <span class="stonex-pricing-badge"><?php echo $pricing['price_badge'] ?></span>
                                    <?phP endif; ?>
                                    <div class="stonex-price stonex-price-monthly d-flex align-items-center">
                                        <h2 class="dynamic-value" data-active="<?php echo $pricing['price_monthly'] ?>" data-monthly="<?php echo $pricing['price_monthly'] ?>" data-yearly="<?php echo $pricing['price_yearly'] ?>"><span class="price-currency"><?php echo esc_html($pricing['price_currency']) ?></span></h2>
                                        <span class="stonex-pricing-duration dynamic-value" data-active="<?php echo $pricing['price_duration_monthly'] ?>" data-monthly="<?php echo $pricing['price_duration_monthly'] ?>" data-yearly="<?php echo $pricing['price_duration_yearly'] ?>"></span>
                                    </div>
                                    <?php if ($pricing['price_subtitle_monthly'] || $pricing['price_subtitle_yearly']) : ?>
                                        <span class="price-subtitle dynamic-value" data-active="<?php echo esc_attr($pricing['price_subtitle_monthly']) ?>" data-monthly="<?php echo esc_attr($pricing['price_subtitle_monthly']) ?>" data-yearly="<?php echo esc_attr($pricing['price_subtitle_yearly']) ?>"></span>
                                    <?php endif; ?>
                                </div><!--  end of stonex-price-wrap  -->
                                <div class="stonex-pricing-head-filler"></div>
                                <?php
                                if ('yes' === $settings['stonex_addons_pricing_table_price_box_separator']) :
                                    echo '<div class="stonex-addons-price-bottom-separator"></div>';
                                endif;
                                ?>
                                <div class="stonex-pricing-features">
                                    <?php echo ($pricing['features']); ?>
                                </div>
                                <!-- minimal pricing -->
                                <!-- minimal pricing -->
                                <?php
                                if ('true' == $pricing['show_btn']) : ?>
                                    <div class="stonex-btn-wrapper">
                                        <a class="stonex-btn <?php printf('%s', esc_attr('elementor-animation-' . $settings['btn_hover_animation'])) ?>" data-monthly="<?php echo esc_url($pricing['button_monthly_url']['url']); ?>" data-yearly="<?php echo esc_url($pricing['button_yearly_url']['url']); ?>" href="<?php echo esc_url($pricing['button_monthly_url']['url']); ?>"><?php echo $pricing['button_label'] ?> <?php \Elementor\Icons_Manager::render_icon($pricing['btn_icon'], ['aria-hidden' => 'true']); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ('' != $pricing['bottom_info']) {
                                    printf('<span class="pricing-bottom-info">%s</span>', $pricing['bottom_info']);
                                } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new \STONEX_Addons\Widgets\Price_Table());
