<?php

namespace STONEX_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class STONEX_Dual_Button extends Widget_Base
{
    public function get_name()
    {
        return 'stonex-dual-button';
    }
    public function get_title()
    {
        return esc_html__('Dual Button', 'stonex-addons');
    }
    public function get_icon()
    {
        return 'eicon-dual-button';
    }
    public function get_categories()
    {
        return ['stonex-addons'];
    }
    public function get_keywords()
    {
        return ['stonex', 'multiple', 'dual', 'anchor', 'link', 'btn', 'double'];
    }
    protected function register_controls()
    {
        /*
        * STONEX Dual Button Content
        */
        $this->start_controls_section(
            'stonex_content_section',
            [
                'label' => esc_html__('Content', 'stonex-addons')
            ]
        );
        $this->start_controls_tabs('stonex_dual_button_content_tabs');
        $this->start_controls_tab('stonex_dual_button_primary_button_content', ['label' => esc_html__('Primary', 'stonex-addons')]);
        $this->add_control(
            'stonex_dual_button_primary_button_text',
            [
                'label'       => esc_html__('Text', 'stonex-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('VIEW DEMO', 'stonex-addons'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_url',
            [
                'label'         => esc_html__('Link', 'stonex-addons'),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __('https://your-link.com', 'stonex-addons'),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_icon',
            [
                'label'   => esc_html__('Icon', 'stonex-addons'),
                'type'    => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_icon_position',
            [
                'label'     => __('Icon Position', 'stonex-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'stonex-icon-pos-left'  => [
                        'title' => __('Left', 'stonex-addons'),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'stonex-icon-pos-right' => [
                        'title' => __('Right', 'stonex-addons'),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'   => 'stonex-icon-pos-left',
                'condition' => [
                    'stonex_dual_button_primary_button_icon[value]!' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_connector_content', ['label' => esc_html__('Connector', 'stonex-addons')]);
        $this->add_control(
            'stonex_dual_button_connector_switch',
            [
                'label'        => esc_html__('Connector Show/Hide', 'stonex-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'stonex-addons'),
                'label_off'    => __('Hide', 'stonex-addons'),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );
        $this->add_control(
            'stonex_dual_button_connector_type',
            [
                'label'     => esc_html__('Type', 'stonex-addons'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'icon',
                'options'   => [
                    'icon'  => __('Icon', 'stonex-addons'),
                    'text'  => __('Text', 'stonex-addons')
                ],
                'condition' => [
                    'stonex_dual_button_connector_switch' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_connector_text',
            [
                'label'     => esc_html__('Text', 'stonex-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('OR', 'stonex-addons'),
                'condition' => [
                    'stonex_dual_button_connector_switch' => 'yes',
                    'stonex_dual_button_connector_type'   => 'text'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_connector_icon',
            [
                'label'       => esc_html__('Icon', 'stonex-addons'),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'stonex_dual_button_connector_switch' => 'yes',
                    'stonex_dual_button_connector_type'   => 'icon'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_secondary_button_content', ['label' => esc_html__('Secondary', 'stonex-addons')]);
        $this->add_control(
            'stonex_dual_button_secondary_button_text',
            [
                'label'       => esc_html__('Text', 'stonex-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('ORDER NOW', 'stonex-addons'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_url',
            [
                'label'         => esc_html__('Link', 'stonex-addons'),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __('https://your-link.com', 'stonex-addons'),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_icon',
            [
                'label'   => esc_html__('Icon', 'stonex-addons'),
                'type'    => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_icon_position',
            [
                'label'     => __('Icon Position', 'stonex-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'stonex-icon-pos-left'  => [
                        'title' => __('Left', 'stonex-addons'),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'stonex-icon-pos-right' => [
                        'title' => __('Right', 'stonex-addons'),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'   => 'stonex-icon-pos-left',
                'condition' => [
                    'stonex_dual_button_secondary_button_icon[value]!' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*
        * STONEX Dual Button Container Style
        */
        $this->start_controls_section(
            'stonex_container_style_section',
            [
                'label' => esc_html__('Container', 'stonex-addons'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_container_alignment',
            [
                'label'   => __('Alignment', 'stonex-addons'),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'stonex-dual-button-align-left'   => [
                        'title' => __('Left', 'stonex-addons'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'stonex-dual-button-align-center' => [
                        'title' => __('Center', 'stonex-addons'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'stonex-dual-button-align-right'  => [
                        'title' => __('Right', 'stonex-addons'),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default' => 'stonex-dual-button-align-center'
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_container_button_margin',
            [
                'label'      => __('Space Between Buttons', 'stonex-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'     => [
                        'min' => -3,
                        'max' => 100
                    ]
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary'                             => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-dual-button-primary .stonex-dual-button-connector' => 'right: calc( 0px - {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .stonex-dual-button-secondary'                           => 'margin-left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_padding',
            [
                'label'      => __('Padding', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '12',
                    'right'    => '45',
                    'bottom'   => '12',
                    'left'     => '45',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_section();
        /*
        * STONEX Dual Button Primary Button Style
        */
        $this->start_controls_section(
            'stonex_container_primary_button_style',
            [
                'label' => esc_html__('Primary Button', 'stonex-addons'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('stonex_dual_button_primary_button_tabs');
        $this->start_controls_tab('stonex_dual_button_primary_button_noemal', ['label' => esc_html__('Normal', 'stonex-addons')]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'stonex_container_primary_button_typography',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary span'
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_icon_margin',
            [
                'label'       => __('Icon Space', 'stonex-addons'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 3
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
                'selectors'   => [
                    '{{WRAPPER}} .stonex-dual-button-primary .stonex-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-dual-button-primary .stonex-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
                    'stonex_dual_button_primary_button_icon[value]!' => ''
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_container_primary_button_padding',
            [
                'label'      => __('Padding', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_container_primary_button_margin',
            [
                'label'      => __('Margin', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_primary_button_radius',
            [
                'label'      => __('Border radius', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-primary,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-1::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-2::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-3::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-4::before,
                            {{WRAPPER}} .stonex-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_normal_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4243DC',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-6' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_normal_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_primary_button_hover', ['label' => esc_html__('Hover', 'stonex-addons')]);
        $this->add_control(
            'stonex_dual_button_primary_button_animation',
            [
                'label'   => esc_html__('Hover Effect', 'stonex-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __('Effect 1', 'stonex-addons'),
                    'effect-2' => __('Effect 2', 'stonex-addons'),
                    'effect-3' => __('Effect 3', 'stonex-addons'),
                    'effect-4' => __('Effect 4', 'stonex-addons'),
                    'effect-5' => __('Effect 5', 'stonex-addons'),
                    'effect-6' => __('Effect 6', 'stonex-addons')
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_primary_button_hover_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5543dc',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-primary.effect-6::before' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_hover_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_primary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-primary:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*
        * STONEX Dual Button Connector Style
        */
        $this->start_controls_section(
            'stonex_dual_button_connector_style',
            [
                'label'     => esc_html__('Connector', 'stonex-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'stonex_dual_button_connector_switch' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'stonex_dual_button_connector_typoghrphy',
                'selector'  => '{{WRAPPER}} .stonex-dual-button-connector span',
                'condition' => [
                    'stonex_dual_button_connector_type' => 'text'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_connector_icon_size',
            [
                'label'      => __('Icon Size', 'stonex-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'      => [
                        'min' => 0,
                        'max' => 40
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 14
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-connector span' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'stonex_dual_button_connector_type'         => 'icon',
                    'stonex_dual_button_connector_icon[value]!' => ''
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_connector_background',
            [
                'label'     => esc_html__('Background Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-connector' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_connector_color',
            [
                'label'     => esc_html__('Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-connector span' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_connector_height',
            [
                'label'      => __('Height', 'stonex-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => 30
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-connector' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_connector_width',
            [
                'label'      => __('Width', 'stonex-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 30
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-connector' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_connector_radius',
            [
                'label'      => __('Border radius', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-connector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_connector_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-connector'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_connector_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-connector'
            ]
        );
        $this->end_controls_section();
        /*
        * STONEX Dual Button secondary Button Style
        */
        $this->start_controls_section(
            'stonex_container_secondary_button_style',
            [
                'label' => esc_html__('Secondary Button', 'stonex-addons'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('stonex_dual_button_secondary_button_tabs');
        $this->start_controls_tab('stonex_dual_button_secondary_button_noemal', ['label' => esc_html__('Normal', 'stonex-addons')]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'stonex_container_secondary_button_typography',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary span'
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_icon_margin',
            [
                'label'       => __('Icon Space', 'stonex-addons'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 3
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
                'selectors'   => [
                    '{{WRAPPER}} .stonex-dual-button-secondary .stonex-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary .stonex-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
                    'stonex_dual_button_secondary_button_icon[value]!' => ''
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_normal_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-6' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_normal_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary'
            ]
        );
        $this->add_responsive_control(
            'stonex_container_secondary_button_padding',
            [
                'label'      => __('Padding', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_container_secondary_button_margin',
            [
                'label'      => __('Margin', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'stonex_dual_button_secondary_button_radius',
            [
                'label'      => __('Border radius', 'stonex-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-dual-button-secondary, {{WRAPPER}} .stonex-dual-button-secondary.effect-1::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-2::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-3::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-4::before, {{WRAPPER}} .stonex-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stonex_dual_button_secondary_button_hover', ['label' => esc_html__('Hover', 'stonex-addons')]);
        $this->add_control(
            'stonex_dual_button_secondary_button_animation',
            [
                'label'   => esc_html__('Hover Effect', 'stonex-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __('Effect 1', 'stonex-addons'),
                    'effect-2' => __('Effect 2', 'stonex-addons'),
                    'effect-3' => __('Effect 3', 'stonex-addons'),
                    'effect-4' => __('Effect 4', 'stonex-addons'),
                    'effect-5' => __('Effect 5', 'stonex-addons'),
                    'effect-6' => __('Effect 6', 'stonex-addons')
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'stonex_dual_button_secondary_button_hover_bg',
            [
                'label'     => esc_html__('Background Color', 'stonex-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .stonex-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_hover_border',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'stonex_dual_button_secondary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .stonex-dual-button-secondary:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings                = $this->get_settings_for_display();
        $secondary_btn_icon_pos = $settings['stonex_dual_button_secondary_button_icon_position'];
        $primary_btn_icon_pos   = $settings['stonex_dual_button_primary_button_icon_position'];
        $this->add_render_attribute(
            'stonex_dual_button',
            [
                'class' => [
                    'stonex-dual-button',
                    esc_attr($settings['stonex_dual_button_container_alignment'])
                ]
            ]
        );
        $this->add_render_attribute(
            'stonex_dual_button_primary_button_url',
            [
                'class' => [
                    'stonex-dual-button-primary stonex-dual-button-action',
                    esc_attr($settings['stonex_dual_button_primary_button_animation'])
                ]
            ]
        );
        $this->add_render_attribute(
            'stonex_dual_button_secondary_button_url',
            [
                'class' => [
                    'stonex-dual-button-secondary stonex-dual-button-action',
                    esc_attr($settings['stonex_dual_button_secondary_button_animation'])
                ]
            ]
        );
        if ($settings['stonex_dual_button_primary_button_url']['url']) {
            $this->add_render_attribute('stonex_dual_button_primary_button_url', 'href', esc_url($settings['stonex_dual_button_primary_button_url']['url']));
            if ($settings['stonex_dual_button_primary_button_url']['is_external']) {
                $this->add_render_attribute('stonex_dual_button_primary_button_url', 'target', '_blank');
            }
            if ($settings['stonex_dual_button_primary_button_url']['nofollow']) {
                $this->add_render_attribute('stonex_dual_button_primary_button_url', 'rel', 'nofollow');
            }
        }
        if ($settings['stonex_dual_button_secondary_button_url']['url']) {
            $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'href', esc_url($settings['stonex_dual_button_secondary_button_url']['url']));
            if ($settings['stonex_dual_button_secondary_button_url']['is_external']) {
                $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'target', '_blank');
            }
            if ($settings['stonex_dual_button_secondary_button_url']['nofollow']) {
                $this->add_render_attribute('stonex_dual_button_secondary_button_url', 'rel', 'nofollow');
            }
        }
        $this->add_inline_editing_attributes('stonex_dual_button_primary_button_text', 'none');
        $this->add_inline_editing_attributes('stonex_dual_button_connector_text', 'none');
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
                    <?php
                    if ('yes' === $settings['stonex_dual_button_connector_switch']) { ?>
                        <div class="stonex-dual-button-connector">
                            <?php if ('text' === $settings['stonex_dual_button_connector_type']) { ?>
                                <span <?php echo $this->get_render_attribute_string('stonex_dual_button_connector_text'); ?>>
                                    <?php echo esc_html($settings['stonex_dual_button_connector_text']); ?>
                                </span>
                            <?php
                            }
                            if ('icon' === $settings['stonex_dual_button_connector_type'] && !empty($settings['stonex_dual_button_connector_icon']['value'])) { ?>
                                <span>
                                    <?php Icons_Manager::render_icon($settings['stonex_dual_button_connector_icon']); ?>
                                </span>
                            <?php } ?>
                        </div>
                    <?php } ?>
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
$widgets_manager->register(new \STONEX_Addons\Widgets\STONEX_Dual_Button());
