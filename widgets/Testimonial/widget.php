<?php

/**
 * KeystoneX Testimonial Normal Widget.
 *
 *
 * @since 1.0.0
 */

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class Scalo_Testimonail_Loop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'stonex-testimonial-loop';
    }
    public function get_title()
    {
        return __('STONEX Testimonial', 'stonex');
    }
    public function get_icon()
    {
        return ('eicon-site-identity');
    }
    public function get_categories()
    {
        return ['stonex'];
    }
    public function get_script_depends()
    {
        return ['stonex-addons-script', 'stonex-slick'];
    }

    public function get_keywords()
    {
        return ['team', 'card', 'testimonial', 'membar', 'reviw', 'rating'];
    }
    protected function register_controls()
    {
        /**
         * @package content_section
         */
        $this->stonex_testimonial_section();
        $this->column_settings();
        $this->stonex_slider_settings();

        /**
         * @package style section
         */
        $this->section_image_style();
        $this->section_name_style();
        $this->section_designation_style();
        $this->section_description_style();
        $this->stonex_content_style();
        $this->stonex_user_style();
        $this->stonex_rating_style();
        $this->stonex_tm_bottom_style();
        $this->stonex_dots_navigation();
        $this->stonex_arrows_navigation();
        $this->stonex_box_style();
        $this->stonex_wrapper_style();
    }
    protected function stonex_rating_style()
    {
        $this->start_controls_section(
            'rating_style',
            [
                'label' => __('Rating Icon', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rating_active_color',
            [
                'label'     => __('Active Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__single i.active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-testimonial__single svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rating_inactive_color',
            [
                'label'     => __('Inactive Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__single span.inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-testimonial__single span.inactive_color svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'star_rating_size',
            [
                'label'          => __('Rating Size', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-testimonial__single span i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-testimonial__single span svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'star_rating_space',
            [
                'label'      => __('Space Between Ratings', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__single span i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__single span i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap_rating',
            [
                'label'          => __('Gap', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rating_area' => 'padding-top: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function section_description_style()
    {
        $this->start_controls_section(
            'description',
            [
                'label' => __('Description', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'description_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
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
                    '{{WRAPPER}} .stonex-testimonial__decription' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__decription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dis_color_hover',
            [
                'label'     => __('Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex--tn-single:hover .stonex-testimonial__decription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}}  .stonex-testimonial__decription',
            ]
        );
        $this->add_responsive_control(
            'dis_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .stonex-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .stonex-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'dis_border',
                'selector'  => '{{WRAPPER}} .stonex-testimonial__decription',
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function section_designation_style()
    {
        $this->start_controls_section(
            'tn_position',
            [
                'label' => __('Designation', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tn_position_color',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__position p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tn_position_color_hover',
            [
                'label'     => __('Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__single:hover .stonex-testimonial__position p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_position_typo',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}}  .stonex-testimonial__position p',
            ]
        );
        $this->add_responsive_control(
            'tn_position_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__position p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__position p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tn_position_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__position p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__position p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function section_name_style()
    {
        $this->start_controls_section(
            'tn_name',
            [
                'label' => __('Name', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__name p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'name_color_hover',
            [
                'label'     => __('Hover Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__single:hover .stonex-testimonial__name p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_name_typo',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}}  .stonex-testimonial__name p',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__name p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__name p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function section_image_style()
    {
        $this->start_controls_section(
            'image_style',
            [
                'label' => __('Image', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-testimonial__img img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-testimonial__img img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-testimonial__img img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'stonex'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'stonex'),
                    'fill'    => __('Fill', 'stonex'),
                    'cover'   => __('Cover', 'stonex'),
                    'contain' => __('Contain', 'stonex'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .stonex-testimonial__img img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .stonex-testimonial__img img',
            ]
        );
        $this->end_controls_section();
    }

    protected function stonex_user_style()
    {
        $this->start_controls_section(
            'user_style',
            [
                'label' => __('User Box', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'user_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'user_bg_color_normal',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'user_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'user_border',
                'selector'  => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'user_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );

        $this->add_responsive_control(
            'user_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'user_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'user_color_ct_hover',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'user_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'user_border_hover',
                'selector'  => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'user_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_responsive_control(
            'user_border_radius_hover',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function stonex_tm_bottom_style()
    {
        $this->start_controls_section(
            'tm_bottom_text',
            [
                'label' => __('Bottom Text', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->start_controls_tabs(
            'rated_style_tabs'
        );
        $this->start_controls_tab(
            'review_normal_tab',
            [
                'label' => esc_html__('Normal', 'plugin-name'),
            ]
        );
        $this->add_control(
            'rated_text_color',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content p span.bottom-rated-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btm_rated_typo',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .testimonial-content p span.bottom-rated-text',
            ]
        );
        $this->add_control(
            'review_text',
            [
                'label'     => __('Review', 'stonex'),
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'btm_text_color',
            [
                'label'     => __('Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content p.tm-bottom-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btm_text_typo',
                'label'    => __('Typography', 'stonex'),
                'selector' => '{{WRAPPER}} .testimonial-content p.tm-bottom-text',
            ]
        );
        $this->add_responsive_control(
            'btm_text_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-content p.tm-bottom-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-content p.tm-bottom-text' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'rated_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'plugin-name'),
            ]
        );

        $this->add_control(
            'btm_text_color_hover',
            [
                'label'     => __('Review Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content:hover p.tm-bottom-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btm_rated_color_hover',
            [
                'label'     => __('Rated Color', 'stonex'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content:hover p span.bottom-rated-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function stonex_dots_navigation()
    {
        $this->start_controls_section(
            'dots_navigation',
            [
                'label' => __('Navigation - Dots', 'stonex'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_dots');

        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __('Alignment', 'stonex'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'          => __('Gap Right', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_min_margin',
            [
                'label'      => __('Margin', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'stonex'),
            ]
        );
        $this->add_control(
            'dots_color_active',
            [
                'label' => __('Active Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function stonex_arrows_navigation()
    {
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'stonex'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Arrow Line Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-testimonial-slider-arrow button ',
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __('Position', 'stonex'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'stonex'),
                'label_on' => __('Custom', 'stonex'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        /*
Arrow Position
*/
        $start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
        $end = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

        /* tobol */
        $this->add_control(
            'offset_orientation_v',
            [
                'label' => __('Vertical Orientation', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow' => '{{VALUE}}: 0;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arrow_position_top',
            [
                'label' => __('Vertical', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'top',
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_position_bottom',
            [
                'label' => __('Vertical', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'bottom',
                ],
            ]
        );


        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __('Horizontal Position', 'stonex'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default',    'stonex'),
                    'space_between'    =>   __('Space Between',    'stonex'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_position_x_prev',
            [
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .stonex-testimonial-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],

            ]
        );



        // default == arrow gap
        // space-between == left position, right position

        $this->add_responsive_control(
            'arrow_position_right',
            [
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'stonex'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .stonex-testimonial-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .stonex-testimonial-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'stonex'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Button border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-testimonial-slider-arrow button',
            ]
        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_hover_border',
                'label'    => __('Button border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover',
            ]
        );

        $this->add_responsive_control(
            'arrows_hover_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_active',
            [
                'label' => __('Active', 'stonex'),
            ]
        );

        $this->add_control(
            'arrow_active_color',
            [
                'label' => __('Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'stonex'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_active_border',
                'label'    => __('Button border', 'stonex'),
                'selector' => '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active button',
            ]
        );

        $this->add_responsive_control(
            'arrows_active_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function stonex_slider_settings()
    {

        $this->start_controls_section(
            'stonex_slider_settings',
            [
                'label' => __('Slider Settings', 'stonex'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default'            => 4,
                'tablet_default'     => 2,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'stonex'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'stonex'),
                    '2000'  => __('2 Second', 'stonex'),
                    '3000'  => __('3 Second', 'stonex'),
                    '4000'  => __('4 Second', 'stonex'),
                    '5000'  => __('5 Second', 'stonex'),
                    '6000'  => __('6 Second', 'stonex'),
                    '7000'  => __('7 Second', 'stonex'),
                    '8000'  => __('8 Second', 'stonex'),
                    '9000'  => __('9 Second', 'stonex'),
                    '10000' => __('10 Second', 'stonex'),
                    '11000' => __('11 Second', 'stonex'),
                    '12000' => __('12 Second', 'stonex'),
                    '13000' => __('13 Second', 'stonex'),
                    '14000' => __('14 Second', 'stonex'),
                    '15000' => __('15 Second', 'stonex'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'stonex'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'stonex'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function column_settings()
    {
        $this->start_controls_section(
            'column_settings',
            [
                'label' => __('Column Settings', 'stonex'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'stonex'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'tablet_extra'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'item_gap_right',
            [
                'label'          => __('Gap Right', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .keystonex-addons-post-widget-wrap' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'stonex'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .keystonex-addons-post-widget-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stonex-testimonial' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function stonex_testimonial_section()
    {
        $this->start_controls_section(
            'stonex_testimonial_section',
            [
                'label' => __('General', 'stonex'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_style',
            [
                'label'             => __('Testimonial Style', 'stonex'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'style-one',
                'options'           => [
                    'style-one'    =>   __('Style 01', 'stonex'),
                    'style-two'    =>   __('Style 02', 'stonex'),
                    'style-three'    =>   __('Style 03', 'stonex'),
                    'style-four'    =>   __('Style 04', 'stonex'),
                    'style-five'    =>   __('Style 05', 'stonex'),
                    'style-six'    =>   __('Style 06', 'stonex'),
                    'style-seven'    =>   __('Style 07', 'stonex'),
                    'style-eight'    =>   __('Style 08', 'stonex'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'show_masonary',
            [
                'label' => esc_html__('Show Masonary', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'stonex'),
                'label_off' => esc_html__('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'stonex'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'stonex'),
                'label_off' => __('No', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable_rating_icon',
            [
                'label' => __('Enable Rating Icon', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'rating_icon',
            [
                'label' => __('Rating Icon', 'stonex'),
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ],
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],

            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Testimonial Rating', 'rating_icon'),
                'type' => Controls_Manager::SELECT,
                'default' => '5',
                'options'   => [
                    '5'     => esc_html__('5', 'rating_icon'),
                    '4'     => esc_html__('4', 'rating_icon'),
                    '3'     => esc_html__('3', 'rating_icon'),
                    '2'     => esc_html__('2', 'rating_icon'),
                    '1'     => esc_html__('1', 'rating_icon'),
                ],
                'label_block' => true,
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ]

            ]
        );

        $repeater->add_control(
            'stonex_testimonial_name',
            [
                'label' => esc_html__('Name', 'stonex'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Jenny', 'stonex'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'name_size',
            [
                'label' => esc_html__('Name Size', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'stonex'),
                    'small' => esc_html__('Small', 'stonex'),
                    'medium' => esc_html__('Medium', 'stonex'),
                    'large' => esc_html__('Large', 'stonex'),
                    'xl' => esc_html__('XL', 'stonex'),
                    'xxl' => esc_html__('XXL', 'stonex'),
                ],
            ]
        );
        $repeater->add_control(
            'stonex_testimonial_position',
            [
                'label' => esc_html__('Positions', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Co-Founder', 'plugin-name'),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'position_size',
            [
                'label' => esc_html__('Positions Size', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'stonex'),
                    'small' => esc_html__('Small', 'stonex'),
                    'medium' => esc_html__('Medium', 'stonex'),
                    'large' => esc_html__('Large', 'stonex'),
                    'xl' => esc_html__('XL', 'stonex'),
                    'xxl' => esc_html__('XXL', 'stonex'),
                ],
            ]
        );

        $repeater->add_control(
            'stonex_testimonial_content',
            [
                'label' => esc_html__('Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Create this account for myself secuse in the future. best site to earn.', 'plugin-name'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'size',
            [
                'label' => esc_html__('Description Size', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'stonex'),
                    'small' => esc_html__('Small', 'stonex'),
                    'medium' => esc_html__('Medium', 'stonex'),
                    'large' => esc_html__('Large', 'stonex'),
                    'xl' => esc_html__('XL', 'stonex'),
                    'xxl' => esc_html__('XXL', 'stonex'),
                ],
            ]
        );

        $repeater->add_control(
            'stonex_testimonial_user_img',
            [
                'label' => esc_html__('Add User Images', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'enable_rated_text',
            [
                'label' => __('Enable Rated Text', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'rated_text',
            [
                'label' => esc_html__('Rating Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Rated 4.5/5'),
                'show_label' => true,
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'rated_size',
            [
                'label' => esc_html__('Rated Size', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'stonex'),
                    'small' => esc_html__('Small', 'stonex'),
                    'medium' => esc_html__('Medium', 'stonex'),
                    'large' => esc_html__('Large', 'stonex'),
                    'xl' => esc_html__('XL', 'stonex'),
                    'xxl' => esc_html__('XXL', 'stonex'),

                ],
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'review_text',
            [
                'label' => esc_html__('Review Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('-from over 100 reviews'),
                'show_label' => true,
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'review_size',
            [
                'label' => esc_html__('Review Size', 'stonex'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'stonex'),
                    'small' => esc_html__('Small', 'stonex'),
                    'medium' => esc_html__('Medium', 'stonex'),
                    'large' => esc_html__('Large', 'stonex'),
                    'xl' => esc_html__('XL', 'stonex'),
                    'xxl' => esc_html__('XXL', 'stonex'),

                ],
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'testimonial_list',
            [
                'label' => esc_html__('Testimonial List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stonex_testimonial_name' => esc_html__('Name', 'plugin-name'),
                        'stonex_testimonial_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
                    ]
                ],
                'title_field' => '{{{ stonex_testimonial_name }}}',
            ]
        );
        $this->end_controls_section();
    }
    // content
    protected function stonex_content_style()
    {
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content Box', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-five',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'ct_bg_color_normal',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'ct_border',
                'selector'  => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bg_color_ct_hover',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'ct_border_hover',
                'selector'  => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_responsive_control(
            'ct_border_radius_hover',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function stonex_box_style()
    {
        $this->start_controls_section(
            'ts_style',
            [
                'label' => __('Box', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'tn_bg_color',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .stonex-testimonial__single',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .stonex-testimonial__single',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .stonex-testimonial__single',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'stonex'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__single' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => __('Content Box Alignment', 'stonex'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial__bottom-meta' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bg_color_hover',
            [
                'label' => __('Hover', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .stonex-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .stonex-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .stonex-testimonial__single:hover',
            ]
        );
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function stonex_wrapper_style()
    {
        $this->start_controls_section(
            'wrapper_ts_style',
            [
                'label' => __('Wrapper', 'stonex'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'wrapper_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'wrapper_tn_bg_color',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .stonex-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border',
                'selector'  => '{{WRAPPER}} .stonex-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .stonex-testimonial',
            ]
        );
        $this->add_responsive_control(
            'wrapper_align',
            [
                'label' => __('Alignment', 'stonex'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .stonex-testimonial' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_box_padding',
            [
                'label'      => __('Padding', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => __('Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'wrapper_bg_color_hover',
            [
                'label' => __('Normal', 'stonex'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .stonex-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border_hover',
                'selector'  => '{{WRAPPER}} .stonex-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .stonex-testimonial:hover',
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius_hover',
            [
                'label'      => __('wrapper_Border Radius', 'stonex'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $testimonial_style = $settings['testimonial_style'];
        $massnoay = '';
        if ('yes' == $settings['show_masonary']) {
            $massnoay = 'tm-masonary';
        } else {
            $massnoay = '';
        }
        $slider_extraSetting = array(
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);
        if (('yes' == $settings['show_slider_settings'])) {
            $this->add_render_attribute('testimonail_version', 'class', array('stonex-testimonial-slider', 't-style'));
            $this->add_render_attribute('testimonail_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('testimonail_version', 'class', array($testimonial_style, 'row g-0 justify-content-center', $massnoay));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('tn_classes', 'class', [$grid_classes, 'keystonex-addons-post-widget-wrap']);
        }

?>

        <?php
        if ($settings['testimonial_list']) {

        ?>
            <div class="stonex-testimonial">
                <div <?php echo $this->get_render_attribute_string('testimonail_version'); ?>>
                    <?php
                    $i = 1;
                    foreach ($settings['testimonial_list'] as $item) {
                        $ratting = $item['rating'];

                    ?>
                        <!-- Single Slider -->

                        <div <?php echo $this->get_render_attribute_string('tn_classes'); ?>>

                            <?php if ($testimonial_style) {
                                include('content/' . $testimonial_style . '.php');
                            } ?>
                        </div>

                <?php
                        $i++;
                    }
                }
                echo '</div>';
                echo '</div>';
                ?>
                <?php if ('yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']) : ?>
                    <div class="stonex-testimonial-slider-arrow">
                        <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                            <button type="button" class="slick-prev prev slick-arrow slick-active">
                                <?php Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                            <button type="button" class="slick-next next slick-arrow ">
                                <?php Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
        <?php
    }
}
$widgets_manager->register(new \Scalo_Testimonail_Loop());
