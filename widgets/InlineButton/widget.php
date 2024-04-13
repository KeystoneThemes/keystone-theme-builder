<?php

namespace STONEX\Widgets\Elementor;

if (!defined('ABSPATH')) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use STONEX\Elementor\Traits\STONEX_Inline_Button_Markup;

class STONEX_Inline_Button extends Widget_Base
{
	use STONEX_Inline_Button_Markup;
	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'stonex-inline-button';
	}
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Inline Button', 'stonex-addons');
	}
	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-button';
	}
	/**
	 * Get widget category.
	 */
	public function get_categories()
	{
		return ['stonex-addons'];
	}
	public function get_keywords()
	{
		return ['link', 'hover', 'animation', 'stonex', 'inline'];
	}
	/**
	 * Register widget content controls
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'_section_title',
			[
				'label' => __('Button Content', 'stonex-addons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animation_style',
			[
				'label'   => __('Animation Style', 'stonex-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => [
					'carpo'   => __('Carpo', 'stonex-addons'),
					'carme'   => __('Carme', 'stonex-addons'),
					'dia'     => __('Dia', 'stonex-addons'),
					'eirene'  => __('Eirene', 'stonex-addons'),
					'elara'   => __('Elara', 'stonex-addons'),
					'ersa'    => __('Ersa', 'stonex-addons'),
					'helike'  => __('Helike', 'stonex-addons'),
					'herse'   => __('Herse', 'stonex-addons'),
					'io'      => __('Io', 'stonex-addons'),
					'iocaste' => __('Iocaste', 'stonex-addons'),
					'kale'    => __('Kale', 'stonex-addons'),
					'leda'    => __('Leda', 'stonex-addons'),
					'metis'   => __('Metis', 'stonex-addons'),
					'mneme'   => __('Mneme', 'stonex-addons'),
					'thebe'   => __('Thebe', 'stonex-addons'),
				],
			]
		);
		$this->add_control(
			'link_text',
			[
				'label'       => __('Title', 'stonex-addons'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Inline Button', 'stonex-addons'),
				'placeholder' => __('Type Link Title', 'stonex-addons'),
				'dynamic'     => [
					'active' => true,
				],
			]
		);
		$this->add_responsive_control(
			'link_align',
			[
				'label' => __('Alignment', 'stonex-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'stonex-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'stonex-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'stonex-addons'),
						'icon' => 'eicon-text-align-right',
					]
				],
				'default' => 'left',
				'toggle' => true,
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right' => 'justify-content: flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .stonex_content__item' => '{{VALUE}}'
				]
			]
		);
		$this->add_control(
			'link_url',
			[
				'label'         => __('Link', 'stonex-addons'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'stonex-addons'),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => __('Button Content', 'stonex-addons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __('Content Box Padding', 'stonex-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .stonex_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __('Link Color', 'stonex-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stonex-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label'     => __('Link Hover Color', 'stonex-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stonex-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __('Typography', 'stonex-addons'),
				'selector' => '{{WRAPPER}} .stonex-link',
				'scheme'   => Typography::TYPOGRAPHY_2,
			]
		);
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		self::{'render_' . $settings['animation_style'] . '_markup'}($settings);
	}
}
$widgets_manager->register(new \STONEX\Widgets\Elementor\STONEX_Inline_Button());
