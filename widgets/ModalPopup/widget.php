<?php

namespace Fbth_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Fbth_Modal_Popup extends Widget_Base
{

	public function get_name()
	{
		return 'stonex-modal-popup';
	}

	public function get_title()
	{
		return esc_html__('Fbth Modal Popup', 'stonex');
	}

	public function get_icon()
	{
		return 'eicon-video-playlist';
	}

	public function get_categories()
	{
		return ['stonex'];
	}

	public function get_keywords()
	{
		return ['stonex', 'lightbox', 'popup', 'quickview', 'video'];
	}

	protected function register_controls()
	{
		$this->stonex_modal_content_section();
		$this->stonex_modal_setting_section();
		$this->stonex_modal_display_settings();
		$this->stonex_modal_icon_section();
		$this->stonex_modal_container_section();
		$this->stonex_modal_animation_tab();
		$this->stonex_modal_overlay_tab();
		$this->stonex_modal_close_btn_style();
	}
	/**
	 * stonex_modal_content_section
	 *
	 * @return void
	 */
	protected function stonex_modal_content_section()
	{
		$this->start_controls_section(
			'stonex_modal_content_section',
			[
				'label' => __('Contents', 'stonex')
			]
		);

		$this->add_control(
			'stonex_modal_content',
			[
				'label'   => __('Type of Modal', 'stonex'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image'          => __('Image', 'stonex'),
					'image-gallery'  => __('Image Gallery', 'stonex'),
					'html_content'   => __('HTML Content', 'stonex'),
					'youtube'        => __('Youtube Video', 'stonex'),
					'vimeo'          => __('Vimeo Video', 'stonex'),
					'external-video' => __('Self Hosted Video', 'stonex'),
					'external_page'  => __('External Page', 'stonex'),
					'shortcode'      => __('ShortCode', 'stonex')
				]
			]
		);

		/**
		 * Modal Popup image section
		 */
		$this->add_control(
			'stonex_modal_image',
			[
				'label'      => __('Image', 'stonex'),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'dynamic'    => [
					'active' => true
				],
				'condition'  => [
					'stonex_modal_content' => 'image'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'stonex_modal_content' => 'image'
				]
			]
		);

		/**
		 * Modal Popup image gallery
		 */

		$this->add_control(
			'stonex_modal_image_gallery_column',
			[
				'label'   => __('Column', 'stonex'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'column-three',
				'options' => [
					'column-one'   => __('Column 1', 'stonex'),
					'column-two'   => __('Column 2', 'stonex'),
					'column-three' => __('Column 3', 'stonex'),
					'column-four'  => __('Column 4', 'stonex'),
					'column-five'  => __('Column 5', 'stonex'),
					'column-six'   => __('Column 6', 'stonex')
				],
				'condition' => [
					'stonex_modal_content' => 'image-gallery'
				]
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'stonex_modal_image_gallery',
			[
				'label'   => __('Image', 'stonex'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);

		$image_repeater->add_control(
			'stonex_modal_image_gallery_text',
			[
				'label' => __('Description', 'stonex'),
				'type'  => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'stonex_modal_image_gallery_repeater',
			[
				'label'   => esc_html__('Image Gallery', 'stonex'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					['stonex_modal_image_gallery' => Utils::get_placeholder_image_src()],
					['stonex_modal_image_gallery' => Utils::get_placeholder_image_src()],
					['stonex_modal_image_gallery' => Utils::get_placeholder_image_src()]
				],
				'condition' => [
					'stonex_modal_content' => 'image-gallery'
				]
			]
		);
		/**
		 * Modal Popup html content section
		 */
		$this->add_control(
			'stonex_modal_html_content',
			[
				'label'     => __('Add your content here (HTML/Shortcode)', 'stonex'),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __('Add your popup content here', 'stonex'),
				'dynamic'   => ['active' => true],
				'condition' => [
					'stonex_modal_content' => 'html_content'
				]
			]
		);

		/**
		 * Modal Popup video section
		 */

		$this->add_control(
			'stonex_modal_youtube_video_url',
			[
				'label'       => __('Provide Youtube Video URL', 'stonex'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __('Place Youtube Video URL', 'stonex'),
				'title'       => __('Place Youtube Video URL', 'stonex'),
				'condition'   => [
					'stonex_modal_content' => 'youtube'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);


		$this->add_control(
			'stonex_modal_vimeo_video_url',
			[
				'label'       => __('Provide Vimeo Video URL', 'stonex'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __('Place Vimeo Video URL', 'stonex'),
				'title'       => __('Place Vimeo Video URL', 'stonex'),
				'condition'   => [
					'stonex_modal_content' => 'vimeo'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		/**
		 * Modal Popup external video section
		 */
		$this->add_control(
			'stonex_modal_external_video',
			[
				'label'      => __('External Video', 'stonex'),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
					'stonex_modal_content' => 'external-video'
				]
			]
		);

		$this->add_control(
			'stonex_modal_external_page_url',
			[
				'label'       => __('Provide External URL', 'stonex'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://stonexdevs.com',
				'placeholder' => __('Place External Page URL', 'stonex'),
				'condition'   => [
					'stonex_modal_content' => 'external_page'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_video_width',
			[
				'label'        => __('Content Width', 'stonex'),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => ['px', '%'],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 720
				],
				'selectors'    => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element iframe,
					{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stonex-modal-item' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'stonex_modal_content' => ['youtube', 'vimeo', 'external_page', 'external-video']
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_video_height',
			[
				'label'        => __('Content Height', 'stonex'),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => ['px', '%'],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 400
				],
				'selectors'    => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stonex-modal-item' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'stonex_modal_content' => ['youtube', 'vimeo', 'external_page']
				]
			]
		);

		$this->add_control(
			'stonex_modal_shortcode',
			[
				'label'       => __('Enter your shortcode', 'stonex'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('[gallery]', 'stonex'),
				'condition'   => [
					'stonex_modal_content' => 'shortcode'
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_content_width',
			[
				'label' => __('Content Width', 'stonex'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
					'stonex_modal_content' => ['image', 'image-gallery', 'html_content', 'shortcode']
				]
			]
		);

		$this->add_control(
			'stonex_modal_btn_text',
			[
				'label'       => __('Button Text', 'stonex'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Watch video', 'stonex'),
				'dynamic'     => [
					'active'  => true
				]
			]
		);

		$this->add_control(
			'stonex_modal_btn_icon',
			[
				'label'       => __('Button Icon', 'stonex'),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-play',
					'library' => 'fa-brands'
				]
			]
		);
		$this->add_control(
			'text_icon_align',
			[
				'label' => esc_html__('Icon Alignment', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'plugin-name'),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'plugin-name'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'condition' => [
					'stonex_modal_btn_icon[value]!' => ''
				],
				'default' => 'left',
				'toggle' => true,

			]
		);

		$this->end_controls_section();
	}
	/**
	 * stonex_modal_setting_section
	 *
	 * @return void
	 */
	protected function stonex_modal_setting_section()
	{

		$this->start_controls_section(
			'stonex_modal_setting_section',
			[
				'label' => __('Settings', 'stonex')
			]
		);

		$this->add_control(
			'stonex_modal_overlay',
			[
				'label'        => __('Overlay', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'stonex'),
				'label_off'    => __('Hide', 'stonex'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'stonex_modal_overlay_click_close',
			[
				'label'     => __('Close While Clicked Outside', 'stonex'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __('ON', 'stonex'),
				'label_off' => __('OFF', 'stonex'),
				'default'   => 'yes',
				'condition' => [
					'stonex_modal_overlay' => 'yes'
				]
			]
		);

		$this->end_controls_section();
	}
	/**
	 * stonex_modal_display_settings
	 *
	 * @return void
	 */
	protected function stonex_modal_display_settings()
	{
		$this->start_controls_section(
			'stonex_modal_display_settings',
			[
				'label' => __('Button', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'modal_button_align',
			[
				'label' => esc_html__('Alignment', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'plugin-name'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'plugin-name'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'plugin-name'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button' => 'text-align: {{VALUE}};'
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->start_controls_tabs('stonex_modal_btn_typhography_color', ['separator' => 'before']);

		$this->start_controls_tab('stonex_modal_btn_typhography_color_normal_tab', ['label' => esc_html__('Normal', 'stonex')]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'stonex_modal_btn_typhography',
				'label'     => __('Button Typography', 'stonex'),
				'selector'  => '{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action'
			]
		);

		$this->add_control(
			'stonex_modal_btn_typhography_color_normal',
			[
				'label'     => __('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_control(
			'stonex_modal_btn_background_normal',
			[
				'label'     => __('Background Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4243DC',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_fixed_width',
			[
				'label'      => esc_html__('Width', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

				],

			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_fixed_height',
			[
				'label'      => esc_html__('Height', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],

				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
				],

			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_padding',
			[
				'label'        => __('Padding', 'stonex'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '18',
					'right'    => '20',
					'bottom'   => '18',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'stonex_modal_btn_border_normal',
				'selector'           => '{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action'
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_radius',
			[
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab('stonex_modal_btn_typhography_color_hover_tab', ['label' => esc_html__('Hover', 'stonex')]);

		$this->add_control(
			'stonex_modal_btn_color_hover',
			[
				'label'     => __('Text Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stonex_modal_btn_background_hover',
			[
				'label'     => __('Background Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'stonex_modal_btn_border_hover',
				'selector' => '{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * stonex_modal_icon_section
	 */
	protected function stonex_modal_icon_section()
	{
		$this->start_controls_section(
			'stonex_modal_icon_section',
			[
				'label' => __('Icon', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs(
			'btn_icon_style_tabs'
		);

		$this->start_controls_tab(
			'stonex_modal_btn_icon_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'stonex')
			]
		);
		$this->add_responsive_control(
			'stonex_modal_btn_icon_size',
			[
				'label'       => __('Icon Size', 'stonex'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .stonex-modal-wrapper .stonex-midal-btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stonex-modal-wrapper .stonex-midal-btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'stonex_modal_btn_icon_indent',
			[
				'label'       => __('Icon Spacing', 'stonex'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 10
				],
				'selectors'   => [
					'{{WRAPPER}} .stonex-modal-wrapper .stonex-midal-btn-icon.modal-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stonex-modal-wrapper .stonex-midal-btn-icon.modal-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'stonex_modal_btn_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
			'stonex_modal_btn_icon_color_normal',
			[
				'label'     => __('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon svg' => 'stroke: {{VALUE}};'
				]
			]
		);


		$this->add_control(
			'stonex_modal_btn_icon_background_normal',
			[
				'label'     => __('Background Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stonex_modal_icon_fixed_width_height',
			[
				'label' => __('Enable Fixed Height & Width?', 'stonex'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'stonex'),
				'label_off' => __('Hide', 'stonex'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_icon_fixed_width',
			[
				'label'      => esc_html__('Width', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 100
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon' => 'width: {{SIZE}}{{UNIT}};'

				],
				'condition' => [
					'stonex_modal_icon_fixed_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_icon_fixed_height',
			[
				'label'      => esc_html__('Height', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 100
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'stonex_modal_icon_fixed_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_icon_padding',
			[
				'label'        => __('Padding', 'stonex'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '20',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'stonex_modal_btn_icon_border_normal',
				'selector'           => '{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon'
			]
		);

		$this->add_responsive_control(
			'stonex_modal_btn_icon_radius',
			[
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('stonex_modal_btn_icon_color_hover_tab', ['label' => esc_html__('Hover', 'stonex')]);

		$this->add_control(
			'stonex_modal_btn_icon_color_hover',
			[
				'label'     => __('Icon Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover span.stonex-midal-btn-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover span.stonex-midal-btn-icon svg' => 'stroke: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stonex_modal_btn_icon_background_hover',
			[
				'label'     => __('Background Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover span.stonex-midal-btn-icon i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stonex-modal-button .stonex-modal-image-action:hover span.stonex-midal-btn-icon svg' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'stonex_modal_btn_icon_border_hover',
				'selector' => '{{WRAPPER}} .stonex-modal-wrapper span.stonex-midal-btn-icon:hover'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * stonex_modal_container_section
	 */
	protected function stonex_modal_container_section()
	{
		$this->start_controls_section(
			'stonex_modal_container_section',
			[
				'label' => __('Container', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'stonex_modal_content_align',
			[
				'label'     => __('Alignment', 'stonex'),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'  => [
						'title' => __('Left', 'stonex'),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __('Center', 'stonex'),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __('Right', 'stonex'),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'stonex_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_content_height',
			[
				'label' => __('Contant Height for Tablet & Mobile', 'stonex'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'stonex_modal_image_gallery_description_typography',
				'selector'  => '{{WRAPPER}} .stonex-modal-content .stonex-modal-element .stonex-modal-element-card .stonex-modal-element-card-body p',
				'condition' => [
					'stonex_modal_content' => ['image-gallery']
				]
			]
		);

		$this->add_control(
			'stonex_modal_image_gallery_description_color',
			[
				'label'     => __('Description Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-content .stonex-modal-element .stonex-modal-element-card .stonex-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'stonex_modal_content' => ['image-gallery']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'stonex_modal_content_border',
				'selector' => '{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element'
			]
		);

		$this->add_control(
			'stonex_modal_image_gallery_bg',
			[
				'label'     => __('Background Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'stonex_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_control(
			'stonex_modal_image_gallery_padding',
			[
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element .stonex-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'stonex_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'stonex_modal_image_gallery_description_margin',
			[
				'label'      => __('Margin(Description)', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .stonex-modal-item .stonex-modal-content .stonex-modal-element .stonex-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'stonex_modal_content' => ['image-gallery']
				]
			]
		);

		$this->add_control(
			'stonex_modal_overlay_overflow_x',
			[
				'label'        => __('Overflow X', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'stonex'),
				'label_off'    => __('No', 'stonex'),
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'stonex_modal_overlay_overflow_y',
			[
				'label'        => __('Overflow Y', 'stonex'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'stonex'),
				'label_off'    => __('No', 'stonex'),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * stonex_modal_animation_tab
	 */
	protected function stonex_modal_animation_tab()
	{
		$this->start_controls_section(
			'stonex_modal_animation_tab',
			[
				'label' => __('Animation', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'stonex_modal_transition',
			[
				'label'   => __('Style', 'stonex'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __('Top To Middle', 'stonex'),
					'bottom-to-middle' => __('Bottom To Middle', 'stonex'),
					'right-to-middle'  => __('Right To Middle', 'stonex'),
					'left-to-middle'   => __('Left To Middle', 'stonex'),
					'zoom-in'          => __('Zoom In', 'stonex'),
					'zoom-out'         => __('Zoom Out', 'stonex'),
					'left-rotate'      => __('Rotation', 'stonex')
				]
			]
		);

		$this->end_controls_section();
	}

	/**
	 * stonex_modal_overlay_tab
	 */
	protected function stonex_modal_overlay_tab()
	{
		$this->start_controls_section(
			'stonex_modal_overlay_tab',
			[
				'label'     => __('Overlay', 'stonex'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'stonex_modal_overlay' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'stonex_modal_overlay_color',
				'types'           => ['classic'],
				'selector'        => '{{WRAPPER}} .stonex-modal-overlay',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => 'rgba(0,0,0,.5)'
					]
				]
			]
		);

		$this->end_controls_section();
	}

	/**
	 * stonex_modal_close_btn_style
	 */
	protected function stonex_modal_close_btn_style()
	{
		$this->start_controls_section(
			'stonex_modal_close_btn_style',
			[
				'label' => __('Close Button', 'stonex'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'stonex_modal_close_btn_position',
			[
				'label' => __('Close Button Position', 'stonex'),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __('Default', 'stonex'),
				'label_on' => __('Custom', 'stonex'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'stonex_modal_close_btn_position_x_offset',
			[
				'label' => __('X Offset', 'stonex'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -4000,
						'max' => 4000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'stonex_modal_close_btn_position_y_offset',
			[
				'label' => __('Y Offset', 'stonex'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -4000,
						'max' => 4000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'stonex_modal_close_btn_icon_size',
			[
				'label'      => __('Icon Size', 'stonex'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 30,
					],
				],
				'default'   => [
					'unit'  => 'px',
					'size'  => 20
				],
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
				],
			]
		);

		$this->add_control(
			'stonex_modal_close_btn_color',
			[
				'label'     => __('Color', 'stonex'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn span::before, {{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stonex_modal_close_btn_bg_color',
			[
				'label'    => __('Background Color', 'stonex'),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .stonex-modal-item.modal-vimeo .stonex-modal-content .stonex-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings            = $this->get_settings_for_display();

		if ('youtube' === $settings['stonex_modal_content']) {
			$url = $settings['stonex_modal_youtube_video_url'];

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

			$youtube_id = $matches[1];
		}

		if ('vimeo' === $settings['stonex_modal_content']) {
			$vimeo_url       = $settings['stonex_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode('&', str_replace('https://vimeo.com', '', end($vimeo_id_select)));
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute('stonex_modal_action', [
			'class'             => 'stonex-modal-image-action image-modal',
			'data-stonex-modal'   => '#stonex-modal-' . $this->get_id(),
			'data-stonex-overlay' => esc_attr($settings['stonex_modal_overlay'])
		]);

		$this->add_render_attribute('stonex_modal_overlay', [
			'class'                         => 'stonex-modal-overlay',
			'data-stonex_overlay_click_close' => $settings['stonex_modal_overlay_click_close']
		]);

		$this->add_render_attribute('stonex_modal_item', 'class', 'stonex-modal-item');
		$this->add_render_attribute('stonex_modal_item', 'class', 'modal-vimeo');
		$this->add_render_attribute('stonex_modal_item', 'class', $settings['stonex_modal_transition']);
		$this->add_render_attribute('stonex_modal_item', 'class', $settings['stonex_modal_content']);
		$this->add_render_attribute('stonex_modal_item', 'class', esc_attr('stonex-content-overflow-x-' . $settings['stonex_modal_overlay_overflow_x']));
		$this->add_render_attribute('stonex_modal_item', 'class', esc_attr('stonex-content-overflow-y-' . $settings['stonex_modal_overlay_overflow_y']));
?>

		<div class="stonex-modal">
			<div class="stonex-modal-wrapper">

				<div class="stonex-modal-button">
					<a href="#" <?php echo $this->get_render_attribute_string('stonex_modal_action'); ?>>
						<?php if ('left' === $settings['text_icon_align'] && !empty($settings['stonex_modal_btn_icon']['value'])) : ?>
							<span class="stonex-midal-btn-icon modal-icon-<?php echo esc_attr($settings['text_icon_align']); ?>">
								<?php Icons_Manager::render_icon($settings['stonex_modal_btn_icon'], ['aria-hidden' => 'true']); ?>
							</span>
						<?php endif; ?>
						<span class="stonex-modal-txt"> <?php echo esc_html($settings['stonex_modal_btn_text']); ?></span>
						<?php if ('right' === $settings['text_icon_align'] && !empty($settings['stonex_modal_btn_icon']['value'])) : ?>
							<span class="stonex-midal-btn-icon modal-icon-<?php echo esc_attr($settings['text_icon_align']); ?>">
								<?php Icons_Manager::render_icon($settings['stonex_modal_btn_icon'], ['aria-hidden' => 'true']); ?>
							</span>
						<?php endif; ?>
					</a>
				</div>

				<div id="stonex-modal-<?php echo esc_attr($this->get_id()); ?>" <?php echo $this->get_render_attribute_string('stonex_modal_item'); ?>>
					<div class="stonex-modal-content">
						<div class="stonex-modal-element <?php echo esc_attr($settings['stonex_modal_image_gallery_column']); ?>">
							<?php if ('image' === $settings['stonex_modal_content']) {
								echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'stonex_modal_image');
							}

							if ('image-gallery' === $settings['stonex_modal_content']) {
								foreach ($settings['stonex_modal_image_gallery_repeater'] as $gallery) : ?>
									<div class="stonex-modal-element-card">
										<div class="stonex-modal-element-card-thumb">
											<?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'thumbnail', 'stonex_modal_image_gallery'); ?>
										</div>
										<?php if (!empty($gallery['stonex_modal_image_gallery_text'])) { ?>
											<div class="stonex-modal-element-card-body">
												<p><?php echo wp_kses_post($gallery['stonex_modal_image_gallery_text']); ?></p>
											</div>
										<?php }; ?>
									</div>
								<?php
								endforeach;
							}

							if ('html_content' === $settings['stonex_modal_content']) { ?>
								<div class="stonex-modal-element-body">
									<p><?php echo wp_kses_post($settings['stonex_modal_html_content']); ?></p>
								</div>
							<?php }

							if ('youtube' === $settings['stonex_modal_content']) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ('vimeo' === $settings['stonex_modal_content']) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ('external-video' === $settings['stonex_modal_content']) { ?>
								<video class="stonex-video-hosted" src="<?php echo esc_url($settings['stonex_modal_external_video']['url']); ?>" controls="" controlslist="nodownload">
								</video>
							<?php }

							if ('external_page' === $settings['stonex_modal_content']) { ?>
								<iframe src="<?php echo esc_url($settings['stonex_modal_external_page_url']); ?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ('shortcode' === $settings['stonex_modal_content']) {
								echo do_shortcode($settings['stonex_modal_shortcode']);
							}; ?>

							<div class="stonex-close-btn">
								<span></span>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('stonex_modal_overlay'); ?>></div>
		</div>
<?php
	}
}
$widgets_manager->register(new \Fbth_Addons\Widgets\Fbth_Modal_Popup());
