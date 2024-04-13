<?php

namespace STONEX_Addons\Widgets\Elementor;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class STONEX_Animated_Text extends Widget_Base
{
	public function get_name()
	{
		return 'stonex-animated';
	}
	public function get_title()
	{
		return esc_html__('Animated Text', 'stonex');
	}
	public function get_icon()
	{
		return 'stonex eicon-animated-headline';
	}
	public function get_categories()
	{
		return ['stonex'];
	}
	public function get_keywords()
	{
		return ['stonex', 'fancy', 'heading', 'animate', 'animation'];
	}
	protected function register_controls()
	{
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');
		/*
	    * Animated Text Content
	    */
		$this->start_controls_section(
			'stonex_section_animated_text_content',
			[
				'label' => esc_html__('Content', 'stonex')
			]
		);
		$this->add_control(
			'stonex_animated_text_before_text',
			[
				'label'   => esc_html__('Before Text', 'stonex'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__('This is', 'stonex'),
				'dynamic'     => ['active' => true],
			]
		);
		$this->add_control(
			'stonex_animated_text_animated_heading',
			[
				'label'       => esc_html__('Animated Text', 'stonex'),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Enter your animated text with comma separated.', 'stonex'),
				'description' => __('<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'stonex'),
				'default'     => esc_html__('STONEX, Addons, Elementor', 'stonex'),
				'dynamic'     => ['active' => true]
			]
		);
		$this->add_control(
			'stonex_animated_text_after_text',
			[
				'label'   => esc_html__('After Text', 'stonex'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__('For You.', 'stonex'),
				'dynamic'     => ['active' => true],
			]
		);
		$this->add_control(
			'stonex_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__('HTML Tag', 'stonex'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __('H1', 'stonex'),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __('H2', 'stonex'),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __('H3', 'stonex'),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __('H4', 'stonex'),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __('H5', 'stonex'),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __('H6', 'stonex'),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__('Alignment', 'stonex'),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'left'   => [
						'title' => __('Left', 'stonex'),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __('Center', 'stonex'),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __('Right', 'stonex'),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
					'{{WRAPPER}} .stonex-animated-text-align' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Container Style
	    */
		$this->start_controls_section(
			'stonex_section_animated_text_animation_tyle',
			[
				'label' => esc_html__('Animation', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'stonex_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__('Animation Type', 'stonex'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'stonex-typed-animation',
				'options' => [
					'stonex-typed-animation'   => __('Typed', 'stonex'),
					'stonex-morphed-animation' => __('Animate', 'stonex')
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__('Animation Style', 'stonex'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __('Fade In', 'stonex'),
					'fadeInUp'          => __('Fade In Up', 'stonex'),
					'fadeInDown'        => __('Fade In Down', 'stonex'),
					'fadeInLeft'        => __('Fade In Left', 'stonex'),
					'fadeInRight'       => __('Fade In Right', 'stonex'),
					'zoomIn'            => __('Zoom In', 'stonex'),
					'zoomInUp'          => __('Zoom In Up', 'stonex'),
					'zoomInDown'        => __('Zoom In Down', 'stonex'),
					'zoomInLeft'        => __('Zoom In Left', 'stonex'),
					'zoomInRight'       => __('Zoom In Right', 'stonex'),
					'slideInDown'       => __('Slide In Down', 'stonex'),
					'slideInUp'         => __('Slide In Up', 'stonex'),
					'slideInLeft'       => __('Slide In Left', 'stonex'),
					'slideInRight'      => __('Slide In Right', 'stonex'),
					'bounce'            => __('Bounce', 'stonex'),
					'bounceIn'          => __('Bounce In', 'stonex'),
					'bounceInUp'        => __('Bounce In Up', 'stonex'),
					'bounceInDown'      => __('Bounce In Down', 'stonex'),
					'bounceInLeft'      => __('Bounce In Left', 'stonex'),
					'bounceInRight'     => __('Bounce In Right', 'stonex'),
					'flash'             => __('Flash', 'stonex'),
					'pulse'             => __('Pulse', 'stonex'),
					'rotateIn'          => __('Rotate In', 'stonex'),
					'rotateInDownLeft'  => __('Rotate In Down Left', 'stonex'),
					'rotateInDownRight' => __('Rotate In Down Right', 'stonex'),
					'rotateInUpRight'   => __('rotate In Up Right', 'stonex'),
					'rotateIn'          => __('Rotate In', 'stonex'),
					'rollIn'            => __('Roll In', 'stonex'),
					'lightSpeedIn'      => __('Light Speed In', 'stonex')
				],
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-morphed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Settings
	    */
		$this->start_controls_section(
			'stonex_section_animated_text_settings',
			[
				'label' => esc_html__('Settings', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'stonex_animated_text_animation_speed',
			[
				'label'     => __('Animation Speed', 'stonex'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-morphed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_type_speed',
			[
				'label'   => __('Type Speed', 'stonex'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_start_delay',
			[
				'label'     => __('Start Delay', 'stonex'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_back_type_speed',
			[
				'label'     => __('Back Type Speed', 'stonex'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_back_delay',
			[
				'label'     => __('Back Delay', 'stonex'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_loop',
			[
				'label'        => __('Loop', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'stonex'),
				'label_off'    => __('OFF', 'stonex'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_show_cursor',
			[
				'label'        => __('Show Cursor', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'stonex'),
				'label_off'    => __('OFF', 'stonex'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_fade_out',
			[
				'label'        => __('Fade Out', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'stonex'),
				'label_off'    => __('OFF', 'stonex'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_smart_backspace',
			[
				'label'        => __('Smart Backspace', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'stonex'),
				'label_off'    => __('OFF', 'stonex'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'stonex_animated_text_animated_heading_animated_type' => 'stonex-typed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text pre animated Text Style
		*/
		$this->start_controls_section(
			'stonex_pre_animated_text_style',
			[
				'label'     => esc_html__('Pre Animated text', 'stonex'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'stonex_animated_text_before_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'stonex_pre_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .stonex-animated-text-pre-heading',
			]
		);
		$this->add_control(
			'stonex_pre_animated_text_color',
			[
				'label'     => esc_html__('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .stonex-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text animated Text Style
	    */
		$this->start_controls_section(
			'stonex_animated_text_style',
			[
				'label' => esc_html__('Animated text', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'stonex_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .stonex-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);
		$this->add_control(
			'stonex_animated_text_color',
			[
				'label'     => esc_html__('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .stonex-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'stonex_animated_text_spacing',
			[
				'label'      => __('Spacing', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit'   => 'px',
					'size'   => 8
				],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text post animated Text Style
	    */
		$this->start_controls_section(
			'stonex_post_animated_text_style',
			[
				'label'     => esc_html__('Post Animated text', 'stonex'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'stonex_animated_text_after_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'stonex_post_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .stonex-animated-text-post-heading'
			]
		);
		$this->add_control(
			'stonex_post_animated_text_color',
			[
				'label'     => esc_html__('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .stonex-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings      = $this->get_settings_for_display();
		$id            = substr($this->get_id_int(), 0, 3);
		$type_heading  = explode(',', $settings['stonex_animated_text_animated_heading']);
		$before_text   = $settings['stonex_animated_text_before_text'];
		$heading_text  = $settings['stonex_animated_text_animated_heading'];
		$after_text    = $settings['stonex_animated_text_after_text'];
		$heading_tag   = $settings['stonex_animated_text_animated_heading_tag'];
		$heading_align = $settings['stonex_animated_text_animated_heading_alignment'];
		$this->add_render_attribute('stonex_typed_animated_string', 'class', 'stonex-typed-strings');
		$this->add_render_attribute(
			'stonex_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr($settings['stonex_animated_text_animated_heading_animated_type'])
			]
		);
		if ($settings['stonex_animated_text_animated_heading_animated_type'] === 'stonex-typed-animation') {
			$this->add_render_attribute(
				'stonex_typed_animated_string',
				[
					'data-type_speed'      => esc_attr($settings['stonex_animated_text_type_speed']),
					'data-back_type_speed' => esc_attr($settings['stonex_animated_text_back_type_speed']),
					'data-loop'            => esc_attr($settings['stonex_animated_text_loop']),
					'data-show_cursor'     => esc_attr($settings['stonex_animated_text_show_cursor']),
					'data-fade_out'        => esc_attr($settings['stonex_animated_text_fade_out']),
					'data-smart_backspace' => esc_attr($settings['stonex_animated_text_smart_backspace']),
					'data-start_delay'     => esc_attr($settings['stonex_animated_text_start_delay']),
					'data-back_delay'      => esc_attr($settings['stonex_animated_text_back_delay'])
				]
			);
		}
		if ($settings['stonex_animated_text_animated_heading_animated_type'] === 'stonex-morphed-animation') {
			$this->add_render_attribute(
				'stonex_typed_animated_string',
				[
					'data-animation_style' => esc_attr($settings['stonex_animated_text_animated_heading_animation_style']),
					'data-animation_speed' => esc_attr($settings['stonex_animated_text_animation_speed'])
				]
			);
		}
		$this->add_render_attribute(
			'stonex_animated_text_animated_heading',
			[
				'id'    => 'stonex-animated-text-' . $id,
				'class' => 'stonex-animated-text-animated-heading'
			]
		);
		$this->add_render_attribute('stonex_animated_text_before_text', 'class', 'stonex-animated-text-pre-heading');
		$this->add_inline_editing_attributes('stonex_animated_text_before_text');
		$this->add_render_attribute('stonex_animated_text_after_text', 'class', 'stonex-animated-text-post-heading');
		$this->add_inline_editing_attributes('stonex_animated_text_after_text');
		echo '<div class="stonex-animated-text-align">';
		do_action('stonex_animated_text_wrapper_before');
		echo '<' . esc_attr($heading_tag) . ' ' . $this->get_render_attribute_string('stonex_typed_animated_string') . '>';
		do_action('stonex_animated_text_content_before');
		$before_text ? printf('<span ' . $this->get_render_attribute_string('stonex_animated_text_before_text') . '>%s</span>', wp_kses_post($before_text)) : '';
		if ('stonex-typed-animation' === $settings['stonex_animated_text_animated_heading_animated_type']) {
			echo '<span id="stonex-animated-text-' . esc_attr($id) . '" class="stonex-animated-text-animated-heading"></span>';
		}
		if ('stonex-morphed-animation' === $settings['stonex_animated_text_animated_heading_animated_type']) {
			echo '<span ' . $this->get_render_attribute_string('stonex_animated_text_animated_heading') . '>' . wp_kses_post($heading_text) . '</span>';
		}
		$after_text ? printf('<span ' . $this->get_render_attribute_string('stonex_animated_text_after_text') . '>%s</span>', wp_kses_post($after_text)) : '';
		do_action('stonex_animated_text_content_after');
		echo '</' . esc_attr($heading_tag) . '>';
		do_action('stonex_animated_text_wrapper_after');
		echo '</div>';
	}
}
$widgets_manager->register(new \STONEX_Addons\Widgets\Elementor\STONEX_Animated_Text());
