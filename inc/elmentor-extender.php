<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
// Add Alignment Feature on counter
add_action( 'elementor/element/counter/section_title/after_section_end', function ( $element, $args ) {
    // add a control
    $element->start_controls_section(
        'stonex_section_extra',
        [
            'label' => __( 'Keystone Base Extra', 'stonex' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'stonex_counter_align',
        [
            'label'     => __( 'Counter Alignment', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'left'   => [
                    'title' => __( 'Left', 'stonex' ),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'stonex' ),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right'  => [
                    'title' => __( 'Right', 'stonex' ),
                    'icon'  => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper ' => 'text-align: {{VALUE}}; display: block;',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_title_align',
        [
            'label'     => __( 'Title Alignment', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'left'    => [
                    'title' => __( 'Left', 'stonex' ),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center'  => [
                    'title' => __( 'Center', 'stonex' ),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right'   => [
                    'title' => __( 'Right', 'stonex' ),
                    'icon'  => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => __( 'Justified', 'stonex' ),
                    'icon'  => 'eicon-text-align-justify',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-title ' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_counter_gap',
        [
            'label'     => __( 'Counter Gap', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2 );
// Add select dropdown control to button widget
add_action( 'elementor/element/image-box/section_style_content/after_section_end', function ( $element, $args ) {
    // add a control
    $element->start_controls_section(
        'stonex_section_extra',
        [
            'label' => __( 'Keystone Base Extra', 'stonex' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'stonex_img_hover_scale',
        [
            'label'     => __( 'Image Hover Scale', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'min'       => 0,
            'max'       => 100,
            'step'      => 0.1,
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-img:hover' => 'transform: scale({{VALUE}});',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'stonex_image_hover_shadow',
            'label'    => __( 'Image Hover Shadow', 'stonex' ),
            'selector' => '{{WRAPPER}}:hover .elementor-image-box-img',
        ]
    );
    $element->add_responsive_control(
        'stonex_image_margin',
        [
            'label'      => __( 'Image Margin', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_title_padding',
        [
            'label'      => __( 'Content Padding', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'stonex_image_border',
            'label'    => __( 'Image Border', 'stonex' ),
            'selector' => '{{WRAPPER}} .elementor-image-box-img img',
        ]
    );
    $element->end_controls_section();
}, 10, 2 );

// Add select dropdown control to button widget
add_action( 'elementor/element/video/section_lightbox_style/after_section_end', function ( $element, $args ) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __( 'Keystone Base Extra', 'stonex-addons' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'play_icon_bg',
        [
            'label'     => __( 'Icon Box Background Color', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play'        => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .elementor-custom-embed-play:before' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'play_icon_before_size',
        [
            'label'     => __( 'Animation Size', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'default'   => [
                'size' => 0,
            ],
            'range'     => [
                'px' => [
                    'max'  => 200,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play:before' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_control(
        'iamge_overly_color',
        [
            'label'     => __( 'Image Overlay Color', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'iamge_overly_opacity',
        [
            'label'     => __( 'Opacity', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'default'   => [
                'size' => 0,
            ],
            'range'     => [
                'px' => [
                    'max'  => 1,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'play_icon_box_size',
        [
            'label'     => __( 'Icon Box Size', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 10,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'image_width',
        [
            'label'     => __( 'Image Width', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'range'     => [
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
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'width: {{SIZE}}{{UNIT}};',
            ],
            
        ]
    );

    $element->add_responsive_control(
        'image_height',
        [
            'label'     => __( 'Image Height', 'stonex-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'range'     => [
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
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'height: {{SIZE}}{{UNIT}};',
            ],
            
        ]
    );

    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'video_border',
            'label'    => __( 'Item Border', 'stonex-addons' ),
            'selector' => '{{WRAPPER}}  .elementor-custom-embed-play',
        ]
    );

    $element->add_responsive_control(
        'overlay_radius',
        [
            'label'      => __( 'Image Oveerlay Radius', 'stonex-addons' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img, {{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition'  => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    

    $element->end_controls_section();
}, 10, 2 );

add_action( 'elementor/element/video/section_video_style/after_section_start', function ( $element, $args ) {
    $element->add_control(
        'light_aspect_ratio',
        [
            'label' => esc_html__( 'Aspect-Ratio', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto' => esc_html__( 'auto', 'textdomain' ),
                '169' => '16:9',
				'219' => '21:9',
				'43' => '4:3',
				'32' => '3:2',
				'11' => '1:1',
				'916' => '9:16',
            ],
            'selectors_dictionary' => [
                'auto' => 'auto',
                '169' => '1.77777', // 16 / 9
                '219' => '2.33333', // 21 / 9
                '43' => '1.33333', // 4 / 3
                '32' => '1.5', // 3 / 2
                '11' => '1', // 1 / 1
                '916' => '0.5625', // 9 / 16
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox' => 'aspect-ratio: {{VALUE}};',
            ],
        ]
    );
}, 10, 2 );

// icon box
add_action( 'elementor/element/icon-box/section_style_icon/after_section_start', function ( $element, $args ) {
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'stonex_icon_box_border',
            'label'    => __( 'Item Border', 'stonex' ),
            'selector' => '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon',
        ]
    );
}, 10, 2 );
// button
add_action( 'elementor/element/button/section_style/after_section_start', function ( $element, $args ) {
    $element->add_control(
        'stonex_button_width',
        [
            'label'      => esc_html__( 'Width', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'stonex_button_height',
        [
            'label'      => esc_html__( 'Height', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'stonex_button_icon',
        [
            'label'     => esc_html__( 'Icon', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_control(
        'stonex_btn_icon_size',
        [
            'label'      => esc_html__( 'Icon Size', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'stonex_btn_icon_gap',
        [
            'label'      => esc_html__( 'Icon Gap', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2 );
add_action( 'elementor/element/before_section_end', function ( $element, $section_id, $args ) {
    /** @var \Elementor\Element_Base $element */
    if ( 'section_background' === $section_id ) {
        $element->add_control(
            'stonex_custom_bg_css',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __( 'Custom CSS', 'stonex' ),
                'selectors' => [
                    '{{WRAPPER}} ' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
            'stonex_rtl_css_on',
            [
                'label'        => __( 'RTL CSS', 'stonex' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'stonex' ),
                'label_off'    => __( 'Hide', 'stonex' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $element->add_control(
            'stonex_custom_bg_css_rtl',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __( 'Custom RTl CSS', 'stonex' ),
                'selectors' => [
                    'body.rtl {{WRAPPER}} ' => '{{VALUE}}',
                ],
                'condition' => [
                    'stonex_rtl_css_on' => 'yes',
                ],
            ]
        );
    }
    //overly Slider Control
    if ( 'stonex_section_background_overlay' === $section_id ) {
        $element->add_responsive_control(
            'stonex_custom_bg_overlay_css_slider',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Width', 'stonex' ),
                'size_units' => ['%', 'px'],
                'range'      => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'       => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    }
    if ( 'stonex_section_background_overlay' === $section_id ) {
        $element->add_responsive_control(
            'bc_padding',
            [
                'label'      => __( 'Padding', 'stonex' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
    }
    if ( 'stonex_section_background_overlay' === $section_id ) {
        $element->add_control(
            'custom_bg_overlay_css',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __( 'Custom CSS', 'stonex' ),
                'selectors' => [
                    '{{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
            'stonex_overlaY_rtl_css_on',
            [
                'label'        => __( 'RTL CSS', 'stonex' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'stonex' ),
                'label_off'    => __( 'Hide', 'stonex' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $element->add_control(
            'stonex_overlay_bg_css_rtl',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __( 'Custom RTl CSS', 'stonex' ),
                'selectors' => [
                    'body.rtl {{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
                'condition' => [
                    'overlaY_rtl_css_on' => 'yes',
                ],
            ]
        );
    }
}, 10, 3 );
// Add Alignment Feature on counter
add_action( 'elementor/element/testimonial/section_style_testimonial_job/after_section_end', function ( $element, $args ) {
    // add a control
    $element->start_controls_section(
        'stonex_section_extra',
        [
            'label' => __( 'Keystone Base Extra', 'stonex' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'stonex_counter_gap',
        [
            'label'     => __( 'Content Gap', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-content ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_name_gap',
        [
            'label'     => __( 'Name Gap', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-name ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2 );
// Add Alignment Feature on counter
add_action( 'elementor/element/accordion/section_toggle_style_content/after_section_end', function ( $element, $args ) {
    // add a control
    $element->start_controls_section(
        'stonex_section_extra',
        [
            'label' => __( 'Keystone Base Extra', 'stonex' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'stonex_acc_item_border_hading',
        [
            'label'     => __( 'Content border', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'stonex_acc_content_border',
            'label'    => __( 'Item Border', 'stonex' ),
            'selector' => '{{WRAPPER}}  .elementor-tab-content',
        ]
    );
    $element->add_control(
        'stonex_more_options',
        [
            'label'     => __( 'Box border', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'stonex_acc_border',
            'label'    => __( 'Item Border', 'stonex' ),
            'selector' => '{{WRAPPER}}  .elementor-accordion-item',
        ]
    );
    $element->add_control(
        'stonex_acc_bg',
        [
            'label'     => __( 'Accordion Item Background Color', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item ' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_acc_radius',
        [
            'label'      => __( 'Item Border Radius', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_acc_content_margin',
        [
            'label'      => __( 'Content Margin', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_acc_paddingn',
        [
            'label'      => __( 'Item Padding', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_acc_margin',
        [
            'label'      => __( 'Item Margin', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2 );
// / Add select dropdown control to button widget
add_action( 'elementor/element/icon-list/section_icon_style/after_section_start', function ( $element, $args ) {
    $element->add_control(
        'stonex_icon_line_color',
        [
            'label'     => __( 'Line Color', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );
    $element->add_control(
        'stonex_icon_bg_color',
        [
            'label'     => __( 'Background Color', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_iconlist_width',
        [
            'label'     => __( 'Width', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_iconlist_height',
        [
            'label'     => __( 'Height', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_iconlist_ border_radius',
        [
            'label'     => __( 'Border Radius', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_icon_self_align_position',
        [
            'label'     => esc_html__( 'Icon Position', 'elementor' ),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'elementor' ),
                    'icon'  => 'eicon-align-start-v',
                ],
                'center'     => [
                    'title' => esc_html__( 'Center', 'elementor' ),
                    'icon'  => 'eicon-align-center-v',
                ],
                'flex-end'   => [
                    'title' => esc_html__( 'End', 'elementor' ),
                    'icon'  => 'eicon-align-end-v',
                ],
            ],
            'default'   => 'center',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'align-items:{{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'stonex_iconlist_Icon_gap',
        [
            'label'     => __( 'Icon gap', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2 );
add_action( 'elementor/element/icon-list/section_text_style/after_section_start', function ( $element, $args ) {

    $element->add_responsive_control(
        'text_align',
        [
            'label' => esc_html__( 'Text Alignment', 'stonex' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__( 'Left', 'stonex' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'stonex' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__( 'Right', 'stonex' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} span.elementor-icon-list-text' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'text_width',
        [
            'label' => esc_html__( 'Text Width', 'elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
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
                '{{WRAPPER}} span.elementor-icon-list-text' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'stonex_icon_list_margin',
        [
            'label'      => __( 'Margin', 'stonex' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2 );
// social icon
add_action( 'elementor/element/social-icons/section_social_style/after_section_start', function ( $element, $args ) {
    $element->add_responsive_control(
        'stonex_icon_font_size',
        [
            'label'     => esc_html__( 'Icon Size', 'elementor' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon i'   => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2 );

function stonex_stickyregister_controls( $element, $args ) {
    $element->add_control(
        'stonex_sticky',
        [
            'label'              => __( 'Sticky', 'stonex' ),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'options'            => [
                'yes' => __( 'Yes', 'stonex' ),
                'no'  => __( 'No', 'stonex' ),
            ],
            'default'            => 'no',
            'separator'          => 'before',
            'prefix_class'       => 'STONEX-addons-sticky-',
            'frontend_available' => true,
            'render_type'        => 'template',
        ]
    );
    $element->add_control(
        'stonex_sticky_bg',
        [
            'label'     => __( 'Background Color', 'stonex' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.reveal-sticky' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'stonex_sticky' => 'yes',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'      => 'stonex_sticky_shadow',
            'label'     => __( 'Shadow', 'stonex' ),
            'selector'  => '{{WRAPPER}}.reveal-sticky',
            'condition' => [
                'stonex_sticky' => 'yes',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'      => 'stonex_sticky_border',
            'label'     => __( 'Border', 'stonex' ),
            'selector'  => '{{WRAPPER}}.reveal-sticky',
            'condition' => [
                'stonex_sticky' => 'yes',
            ],
        ]
    );
}
add_action( 'elementor/element/section/section_effects/after_section_start', 'stonex_stickyregister_controls', 10, 2 );
add_action( 'elementor/element/common/section_effects/after_section_start', 'stonex_stickyregister_controls', 10, 2 );
add_action( 'elementor/element/before_section_end', function ( $element, $section_id, $args ) {
    /** @var \Elementor\Element_Base $element */
    if ( 'section_shape_divider' === $section_id ) {
        $element->add_control(
            'stonex_animation_on',
            [
                'label'              => __( 'Animation', 'stonex' ),
                'type'               => \Elementor\Controls_Manager::SELECT,
                'options'            => [
                    'no'              => __( 'None', 'stonex' ),
                    'animation-one'   => __( 'Animation-one', 'stonex' ),
                    'animation-two'   => __( 'Animation-two', 'stonex' ),
                    'animation-three' => __( 'Animation-three', 'stonex' ),
                ],
                'default'            => 'no',
                'separator'          => 'before',
                'prefix_class'       => 'stonex-custom-animation-',
                'frontend_available' => true,
                'render_type'        => 'template',
            ]
        );
    }
}, 10, 3 );


// Text editor
add_action( 'elementor/element/text-editor/section_editor/before_section_end', function ( $element, $args ) {

    $element->add_control(
        'size',
        [
            'label' => esc_html__( 'Size', 'stonex' ),
            'type' => Elementor\Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html__( 'Default', 'stonex' ),
                'small' => esc_html__( 'Small', 'stonex' ),
                'medium' => esc_html__( 'Medium', 'stonex' ),
                'large' => esc_html__( 'Large', 'stonex' ),
                'xl' => esc_html__( 'XL', 'stonex' ),
                'xxl' => esc_html__( 'XXL', 'stonex' ),
            ],
            'prefix_class'       => 'stonex-size-',
        ]
    );

}, 10, 2 );
