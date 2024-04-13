<?php
namespace STONEX_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class STONEX_Accordion extends Widget_Base {

	public function get_name() {
		return 'stonex-accordion';
	}

	public function get_title() {
		return esc_html__( 'STONEX Accordion', 'stonex' );
	}

	public function get_icon() {
		return 'stonex eicon-accordion';
	}


	public function get_keywords() {
		return [ 'acc', 'faq', 'accordion', 'tab' ];
	}

   public function get_categories() {
		return [ 'stonex' ];
	}

	protected function register_controls() {

		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');


  		/**
  		 * Fd Addons Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'stonex_section_exclusive_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Contents', 'stonex' )
  			]
  		);

  		$repeater = new Repeater();

        $repeater->start_controls_tabs('stonex_accordion_item_tabs');

        $repeater->start_controls_tab('stonex_accordion_item_content_tab', ['label' => __('Content', 'stonex')]);

        $repeater->add_control(
			'stonex_exclusive_accordion_default_active', [
				'label'        => esc_html__( 'Active as Default', 'stonex' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $repeater->add_control(
			'stonex_exclusive_accordion_icon_show', [
				'label'        => esc_html__( 'Enable Title Icon', 'stonex' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'stonex' ),
				'label_off'    => __( 'Off', 'stonex' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$repeater->add_control(
			'stonex_exclusive_accordion_title_icon',
			[
				'label'       => __( 'Icon', 'stonex' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition'   => [
					'stonex_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);

        $repeater->add_control(
			'stonex_exclusive_accordion_title', [
				'label'   => esc_html__( 'Title', 'stonex' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Accordion Title', 'stonex' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		 $repeater->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'happy-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'separator' => 'before',
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'happy-elementor-addons' ),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h6',
				'toggle' => false,
			]
		);

		$repeater->add_control(
			'stonex_exclusive_accordion_content',
			[
				'label' => esc_html__( 'Description', 'stonex' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => esc_html__( 'Type your description here', 'stonex' ),
			]
		);
		$repeater->add_control(
			'content_size',
			[
				'label' => esc_html__( 'Text Size', 'stonex' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'stonex' ),
					'small' => esc_html__( 'Small', 'stonex' ),
					'medium' => esc_html__( 'Medium', 'stonex' ),
					'large' => esc_html__( 'Large', 'stonex' ),
					'xl' => esc_html__( 'XL', 'stonex' ),
					'xxl' => esc_html__( 'XXL', 'stonex' ),
				],
			]
		);

        $repeater->add_control(
            'stonex_accordion_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Button.', 'stonex' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'stonex' ),
				'label_off'    => __( 'Off', 'stonex' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'separator'	   => 'before'
            ]
        );

        $repeater->add_control(
            'stonex_accordion_read_more_btn_text',
            [
				'label'       => esc_html__( 'Button Text', 'stonex' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', 'stonex'),
				'default'     => esc_html__('See Details', 'stonex' ),
				'condition'   => [
                    '.stonex_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'stonex_accordion_read_more_btn_url',
            [
                'label'         => esc_html__( 'Button Link', 'stonex' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'           => '#',
                    'is_external'   => ''
                ],
                'show_external'     => true,
                'placeholder'       => __( 'http://your-link.com', 'stonex' ),
                'condition'     => [
                    '.stonex_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('stonex_accordion_item_image_tab', ['label' => __('Image', 'stonex')]);

        $repeater->add_control(
			'stonex_accordion_image', [
				'label' => esc_html__( 'Choose Image', 'stonex' ),
				'type'  => Controls_Manager::MEDIA
			]
		);

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('stonex_accordion_item_style_tab', ['label' => __('Style', 'stonex')]);

        $repeater->add_control(
            'stonex_accordion_each_item_container_style',
            [
				'label' => esc_html__( 'Container', 'stonex' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

		$repeater->add_control(
		    'stonex_accordion_each_item_container_bg_color',
		    [
		        'label'     => __( 'Background Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'stonex_accordion_number_color',
		    [
		        'label'     => __( 'Number Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-number span' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'stonex_accordion_number_bg_color',
		    [
		        'label'     => __( 'Number Background Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-number span' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'stonex_accordion_each_item_title_style',
            [
				'label'     => esc_html__( 'Title', 'stonex' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_control(
		    'stonex_accordion_each_item_title_color',
		    [
		        'label'     => __( 'Text Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-title' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'stonex_accordion_each_item_title_bg_color',
		    [
		        'label'     => __( 'Background Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-title' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'stonex_accordion_each_item_title_hover_color',
		    [
		        'label'     => __( 'Hover Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-title:hover' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'stonex_accordion_each_item_title_hover_bg_color',
		    [
		        'label'     => __( 'Hover Background Color', 'stonex' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item .stonex-accordion-title:hover' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'stonex_accordion_each_item_content_style',
            [
				'label'     => esc_html__( 'Content', 'stonex' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_group_control(
		    Group_Control_Border::get_type(),
		    [
				'name'     => 'stonex_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.stonex-accordion-single-item'
		    ]
		);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

  		$this->add_control(
			'stonex_exclusive_accordion_tab',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[
						'stonex_exclusive_accordion_title'          => esc_html__( 'Accordion Title 1', 'stonex' ),
						'stonex_exclusive_accordion_default_active' => 'yes'
					],
					[ 'stonex_exclusive_accordion_title' => esc_html__( 'Accordion Title 2', 'stonex' ) ],
					[ 'stonex_exclusive_accordion_title' => esc_html__( 'Accordion Title 3', 'stonex' ) ]
				],
				'title_field' => '{{stonex_exclusive_accordion_title}}'
			]
		);

        $this->add_control(
			'stonex_show_number',
			[
				'label'        => esc_html__( 'Show Number', 'stonex' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

        $this->add_control(
			'stonex_exclusive_accordion_tab_title_show_active_inactive_icon',
			[
				'label'        => esc_html__( 'Show Active/Inactive Icon?', 'stonex' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'	   => 'before'
			]
		);

		$this->add_control(
			'icon_alignment',
			[
				'label' => esc_html__( 'Icon Alignment', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);

		$this->add_control(
			'stonex_exclusive_accordion_tab_title_active_icon',
			[
				'label'       => __( 'Active Icon', 'stonex' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'stonex_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'stonex_exclusive_accordion_tab_title_inactive_icon',
			[
				'label'       => __( 'Inactive Icon', 'stonex' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'stonex_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'stonex_section_exclusive_accordions_container_style',
			[
				'label'	=> esc_html__( 'Box', 'stonex' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);
		$this->start_controls_tabs( 'stonex_accordion_active_inactive_container_tabs' );
		// normal state tab
		$this->start_controls_tab( 'stonex_accordion_container_style', [ 'label' => esc_html__( 'Normal', 'stonex' ) ] );

		$this->add_control(
			'stonex_accordion_container_background_color',
			[
				'label'		=> esc_html__( 'Background Color', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'stonex_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'stonex_exclusive_accordion_container_border',
				'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item'
            ]
		);

        $this->add_responsive_control(
            'stonex_exclusive_accordion_container_padding',
            [
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'stonex_exclusive_accordion_container_margin',
            [
				'label'        => __('Margin', 'stonex'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
                'selectors'    => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'stonex_exclusive_accordion_container_border_radius',
            [
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->end_controls_tab();

		// hover state tab
		$this->start_controls_tab( 'stonex_accordion_container_style_hover', [ 'label' => esc_html__( 'Active', 'stonex' ) ] );

		$this->add_control(
			'stonex_accordion_container_background_color_active',
			[
				'label'		=> esc_html__( 'Background Color', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'stonex_accordion_container_box_shadow_active',
				'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active'
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'stonex_exclusive_accordion_container_border_active',
				'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active'
            ]
		);
		$this->add_responsive_control(
            'stonex_exclusive_accordion_container_border_radius_active',
            [
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'stonex_exclusive_accordion_container_margin_active',
            [
				'label'      => __('Margin', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'stonex_exclusive_accordion_container_padding_active',
            [
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item.wraper-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'stonex_acc_number',
			[
				'label' => esc_html__( 'Number', 'stonex' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'stonex_number_typography',
				'selector'        => '{{WRAPPER}} .stonex-accordion-number span',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600',
					]
				]
			]
		);
		$this->add_responsive_control(
			'stonex_number_size',
			[
				'label'        => __( 'Size', 'stonex' ),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1
					]
				],
				'selectors'    => [
					'{{WRAPPER}} .stonex-accordion-number span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'numbar_color',
			[
				'label'		=> esc_html__( 'Text Color', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $accent_color,
				'selectors'	=> [
					'{{WRAPPER}} .stonex-accordion-number span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'numbar_border',
				'label'                 => __( 'Border', 'stonex' ),
				'selector'              => '{{WRAPPER}} .stonex-accordion-number span',
			]
		);
		$this->add_control(
			'numbar_background_color',
			[
				'label'		=> esc_html__( 'Background', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .stonex-accordion-number span' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'stonex_number_border_radius',
			[
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .stonex-accordion-number span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'stonex_number_margin',
			[
				'label'      => __('Margin', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .stonex-accordion-number span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'stonex_number_padding',
			[
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .stonex-accordion-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'stonex_section_exclusive_accordions_tab_style',
			[
				'label' => esc_html__( 'Title', 'stonex' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->start_controls_tabs( 'stonex_exclusive_accordion_header_tabs' );

			# Normal State Tab
			$this->start_controls_tab( 'stonex_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'stonex' ) ] );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'            => 'stonex_exclusive_accordion_title_typography',
					'selector'        => '{{WRAPPER}} .stonex-accordion-heading',
					'fields_options'  => [
						'font_weight' => [
							'default' => '600'
						]
					]
				]
			);

			$this->add_control(
					'stonex_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> $secondary_color,
						'selectors'	=> [
							'{{WRAPPER}} .stonex-accordion-heading' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'stonex_exclusive_accordion_tab_color',
					[
						'label'     => esc_html__( 'Background Color', 'stonex' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .stonex-accordion-heading' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'stonex_exclusive_accordion_title_border',
						'fields_options'     => [
							'border' 	     => [
								'default'    => 'solid'
							],
							'width'  	     => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	     => [
								'default'    => $secondary_color,
							]
						],
						'selector'           => '{{WRAPPER}} .stonex-accordion-heading'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'stonex_accordion_title_box_shadow',
						'selector' => '{{WRAPPER}} .stonex-accordion-heading'
					]
				);

				$this->add_responsive_control(
					'stonex_exclusive_accordion_title_padding',
					[
						'label'      => __('Padding', 'stonex'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '20',
							'right'  => '20',
							'bottom' => '20',
							'left'   => '20'
						],
						'selectors'  => [
							'{{WRAPPER}} .stonex-accordion-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'stonex_exclusive_accordion_title_margin',
					[
						'label'      => __('Margin', 'stonex'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', '%'],
						'default'    => [
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0'
						],
						'selectors'  => [
							'{{WRAPPER}} .stonex-accordion-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'stonex_accordion_title_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'stonex' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px'],
						'selectors'  => [
							'{{WRAPPER}} .stonex-accordion-heading'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
			$this->end_controls_tab();

			#Hover State Tab
			$this->start_controls_tab( 'stonex_exclusive_accordion_header_hover', [ 'label' => esc_html__( 'Hover', 'stonex' ) ] );
				$this->add_control(
					'stonex_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .stonex-accordion-heading:hover' => 'color: {{VALUE}};',

						]
					]
				);

				$this->add_control(
					'stonex_exclusive_accordion_tab_color_bg_hover',
					[
						'label'		=> esc_html__( 'Background Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .stonex-accordion-heading:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			#Active State Tab
			$this->start_controls_tab( 'stonex_exclusive_accordion_header_active', [ 'label' => esc_html__( 'Active', 'stonex' ) ] );
				$this->add_control(
					'stonex_exclusive_accordion_tab_text_color_active',
					[
						'label'		=> esc_html__( 'Text Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .stonex-accordion-title.active .stonex-accordion-heading' => 'color: {{VALUE}} !important;'
						]
					]
				);

				$this->add_control(
					'stonex_exclusive_accordion_tab_color_bg_active',
					[
						'label'		=> esc_html__( 'Background Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .stonex-accordion-title.active .stonex-accordion-heading' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'stonex_active_accordion_title_border',
						'fields_options'     => [
							'border' 	     => [
								'default'    => 'solid'
							],
							'width'  	     => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	     => [
								'default'    => $secondary_color,
							]
						],
						'selector'           => '{{WRAPPER}} .stonex-accordion-title.active .stonex-accordion-heading'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Icon Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'stonex_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__( 'Title Icon', 'stonex' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

        $this->start_controls_tabs( 'stonex_accordion_title_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'stonex_accordion_title_icon_general_style', [ 'label' => esc_html__( 'Normal', 'stonex' ) ] );

			$this->add_control(
				'stonex_accordion_tab_title_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'stonex_accordion_tab_title_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'stonex_accordion_title_icon_border',
					'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon'
				]
			);

			$this->add_responsive_control(
				'stonex_accordion_title_icon_size',
				[
					'label'        => __( 'Size', 'stonex' ),
					'type'         => Controls_Manager::SLIDER,
					'range'        => [
						'px'       => [
							'min'  => 10,
							'max'  => 150,
							'step' => 2
						]
					],
					'default'      => [
						'unit'     => 'px',
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control(
				  'stonex_accordion_title_icon_width',
				  [
					'label'    => esc_html__( 'Width', 'stonex' ),
					'type'     => Controls_Manager::SLIDER,
					'default'  => [
						  'size' => 70
					],
					'range'    => [
						  'px'   => [
							  'max' => 100
						  ]
					],
					'selectors' => [
						  '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon' => 'width: {{SIZE}}px;'
					]
				  ]
			);


			$this->add_responsive_control(
				'stonex_accordion_title_icon_padding',
				[
					'label'      => __('Padding', 'stonex'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control(
				'stonex_accordion_title_icon_margin',
				[
					'label'      => __('Margin', 'stonex'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title span.stonex-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'stonex_accordion_title_icon_active_style', [ 'label' => esc_html__( 'Active', 'stonex' ) ] );

			$this->add_control(
				'stonex_accordion_title_icon_active_color',
				[
					'label'		=> esc_html__( 'Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active span.stonex-tab-title-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'stonex_accordion_title_icon_active_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active span.stonex-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'stonex_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__( 'Active/Inactive Icon', 'stonex' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'stonex_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);



        $this->start_controls_tabs( 'stonex_accordion_active_inactive_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'stonex_accordion_general_style', [ 'label' => esc_html__( 'Normal', 'stonex' ) ] );

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'stonex_accordion_active_inactive_icon_border',
						'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon'
					]
				);

				$this->add_control(
					'stonex_accordion_general_icon_color',
					[
						'label'		=> esc_html__( 'Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> $secondary_color,
						'selectors'	=> [
							'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon svg' => 'color: {{VALUE}};',
							'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon svg path' => 'fill: {{VALUE}};',

						]
					]
				);

				$this->add_control(
					'stonex_accordion_general_icon_bg_color',
					[
						'label'		=> esc_html__( 'Background Color', 'stonex' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_responsive_control(
				'stonex_accordion_active_inactive_icon_size',
				[
					'label'        => esc_html__( 'Size', 'stonex' ),
					'type'         => Controls_Manager::SLIDER,
					'range'        => [
						'px'       => [
							'min'  => 10,
							'max'  => 150,
							'step' => 2
						]
					],
					'default'      => [
						'unit'     => 'px',
						'size'     => 20
					],
					'selectors'    => [
						'{{WRAPPER}}  .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}  .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);

			// $this->add_responsive_control(
			// 	'stonex_accordion_active_inactive_icon_width',
			// 	[
			// 		'label'       => esc_html__( 'Width', 'stonex' ),
			// 		'type'        => Controls_Manager::SLIDER,
			// 		'default'     => [
			// 			'size'    => 70
			// 		],
			// 		'range'       => [
			// 			'px'      => [
			// 				'max' => 100
			// 			]
			// 		],
			// 		'selectors'   => [
			// 			'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title .stonex-active-inactive-icon' => 'width: {{SIZE}}px;'
			// 		]
			// 	]
			// );


			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'stonex_accordion_active_style', [ 'label' => esc_html__( 'Active', 'stonex' ) ] );

			$this->add_control(
				'stonex_accordion_active_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> $secondary_color,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active .stonex-active-inactive-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active .stonex-active-inactive-icon svg' => 'color: {{VALUE}};',
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active .stonex-active-inactive-icon svg path' => 'fill: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'stonex_accordion_active_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'stonex' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-title.active .stonex-active-inactive-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'stonex_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content', 'stonex' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'stonex_exclusive_accordion_content_typography',
				'selector' => '{{WRAPPER}} .stonex-accordion-single-item .stonex-accordion-text p'
			]
		);

		$this->add_control(
			'stonex_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-content .stonex-accordion-content-wrapper .stonex-accordion-text p' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stonex_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'stonex' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $primary_color,
				'selectors' => [
					'{{WRAPPER}} .stonex-accordion-single-item .stonex-accordion-text p' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'                 => 'stonex_exclusive_accordion_content_border',
				'fields_options'       => [
                    'border' 	       => [
                        'default'      => 'solid'
                    ],
                    'width'  		   => [
                        'default' 	   => [
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => false
                        ]
                    ],
                    'color' 		   => [
                        'default' 	   => $secondary_color
                    ]
                ],
                'selector'             => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-content .stonex-accordion-content-wrapper .stonex-accordion-text p'
            ]
		);
        $this->add_responsive_control(
            'stonex_accordion_content_padding',
            [
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-content .stonex-accordion-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'stonex_accordion_content_margin',
            [
				'label'      => __('Margin', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-single-item .stonex-accordion-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
            'stonex_accordion_content_border_radius',
            [
				'label'      => __('Border Radius', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-content .stonex-accordion-content-wrapper .stonex-accordion-text p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

  		$this->end_controls_section();

		$this->start_controls_section(
			'stonex_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__( 'Image', 'stonex' ),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'stonex_accordion_image_size',
				'label'   => esc_html__( 'Image Type', 'stonex' ),
				'default' => 'medium'
            ]
        );

        $this->add_control(
            'stonex_accordion_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'stonex' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'stonex' ),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'stonex' ),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'       => 'right'
            ]
        );

        $this->add_responsive_control(
            'stonex_accordion_image_padding',
            [
				'label'      => __('Padding', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'stonex_accordion_image_margin',
            [
				'label'      => __('Margin', 'stonex'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);

  		$this->end_controls_section();

		$this->start_controls_section(
            'stonex_accordion_details_btn_style_section',
            [
				'label' => esc_html__( 'Button', 'stonex' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'stonex_accordion_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'stonex_accordion_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'stonex' ) ] );
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'stonex_accordion_details_btn_typography',
					'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a'
				]
			);

            $this->add_control(
                'stonex_accordion_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'stonex' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'stonex_accordion_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'stonex' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $secondary_color,
                    'selectors' => [
                        '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );
			$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'stonex_accordion_details_button_shadow',
                    'selector'  => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a'
                ]
            );

            $this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'               => 'stonex_accordion_details_btn_border',
					'fields_options'     => [
	                    'border' 	     => [
	                        'default'    => 'solid'
	                    ],
	                    'width'  	     => [
	                        'default'    => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color' 	     => [
	                        'default'    => $secondary_color
	                    ]
	                ],
                    'selector'           => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a'
                ]
            );

			$this->add_responsive_control(
				'stonex_accordion_details_btn_padding',
				[
					'label'      => esc_html__( 'Padding', 'stonex' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default'    => [
						'top'    => '15',
						'right'  => '40',
						'bottom' => '15',
						'left'   => '40'
					],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control(
				'stonex_accordion_details_btn_margin',
				[
					'label'      => esc_html__( 'Margin', 'stonex' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default'    => [
						'top'    => '30',
						'right'  => '0',
						'bottom' => '0',
						'left'   => '0'
					],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'stonex_accordion_details_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'stonex' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);



            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'stonex_accordion_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'stonex' ) ] );

            $this->add_control(
                'stonex_accordion_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'stonex' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $secondary_color,
                    'selectors' => [
                        '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'stonex_accordion_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'stonex' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

			$this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'     => 'stonex_accordion_details_btn_hover_border',
					'selector' => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a:hover'
                ]
            );

			$this->add_responsive_control(
				'stonex_accordion_details_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'stonex' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'stonex_accordion_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .stonex-accordion-items .stonex-accordion-single-item .stonex-accordion-button a:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

	}

    private function render_image( $accordion, $settings ) {
        $image_id   = $accordion['stonex_accordion_image']['id'];
        $image_size = $settings['stonex_accordion_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'stonex_accordion_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="'.Control_Media::get_image_alt( $accordion['stonex_accordion_image'] ).'" />', esc_url($image_src) );
    }

	protected function render() {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'stonex_accordion_heading', 'class', 'stonex-accordion-heading' );
        $this->add_render_attribute( 'stonex_accordion_details', 'class', 'stonex-accordion-text' );
        $this->add_render_attribute( 'stonex_accordion_button', 'class', 'stonex-accordion-button' );

		$i = 1;
        echo '<div class="stonex-accordion-items">';
        	do_action('stonex_accordion_wrapper_before');
            foreach( $settings['stonex_exclusive_accordion_tab'] as $key => $accordion ) :

            	do_action('stonex_accordion_each_item_wrapper_before');



                $accordion_item_setting_key = $this->get_repeater_setting_key('stonex_exclusive_accordion_title', 'stonex_exclusive_accordion_tab', $key);

                $accordion_class = ['stonex-accordion-title'];

                if ( $accordion['stonex_exclusive_accordion_default_active'] === 'yes' ) {
                    $accordion_class[] = 'active-default';
                }

                $this->add_render_attribute( $accordion_item_setting_key, 'class', $accordion_class );

				$has_image = !empty( $accordion['stonex_accordion_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

                echo '<div class="stonex-accordion-single-item '.$accordion['stonex_exclusive_accordion_default_active'].'  elementor-repeater-item-'. esc_attr($accordion['_id']).'">';

                    echo '<div '.$this->get_render_attribute_string($accordion_item_setting_key).'>';
						if($settings['stonex_show_number'] == 'yes' ):
						echo '<div class="stonex-accordion-number">';
							echo '<span>';
							echo $i++;
							echo '</span>';
						echo '</div>';
			            endif;

						if ( ! empty( $accordion['stonex_exclusive_accordion_title_icon']['value'] ) && 'yes' === $accordion['stonex_exclusive_accordion_icon_show'] ) :
							echo '<span class="stonex-tab-title-icon">';
								Icons_Manager::render_icon( $accordion['stonex_exclusive_accordion_title_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</span>';
						endif;
						if( 'yes' === $settings['stonex_exclusive_accordion_tab_title_show_active_inactive_icon'] && 'left' == $settings['icon_alignment']):
                            echo '<div class="stonex-active-inactive-icon '.$settings['icon_alignment'].'">';
                                if(!empty($settings['stonex_exclusive_accordion_tab_title_active_icon']['value'])){
                                    echo '<span class="stonex-active-icon">';
                                        Icons_Manager::render_icon( $settings['stonex_exclusive_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';
                                }
                                if(!empty($settings['stonex_exclusive_accordion_tab_title_inactive_icon']['value'])){
                                    echo '<span class="stonex-inactive-icon">';
                                        Icons_Manager::render_icon( $settings['stonex_exclusive_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';
                                }
                            echo '</div>';
                        endif;
						printf( '<%1$s %2$s>%3$s</%1$s>',tag_escape( $accordion['title_tag'] ),$this->get_render_attribute_string( 'stonex_accordion_heading'),
						keystonex_kses_basic( $accordion['stonex_exclusive_accordion_title'] )
						);

                        if( 'yes' === $settings['stonex_exclusive_accordion_tab_title_show_active_inactive_icon'] && 'right' == $settings['icon_alignment']):
                            echo '<div class="stonex-active-inactive-icon '.$settings['icon_alignment'].'">';
                                if(!empty($settings['stonex_exclusive_accordion_tab_title_active_icon']['value'])){
                                    echo '<span class="stonex-active-icon">';
                                        Icons_Manager::render_icon( $settings['stonex_exclusive_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';
                                }
                                if(!empty($settings['stonex_exclusive_accordion_tab_title_inactive_icon']['value'])){
                                    echo '<span class="stonex-inactive-icon">';
                                        Icons_Manager::render_icon( $settings['stonex_exclusive_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';
                                }
                            echo '</div>';
                        endif;
                    echo '</div>';

                    echo '<div class="stonex-accordion-content">';
                        echo '<div class="stonex-accordion-content-wrapper has-image-'.esc_attr($has_image).' image-position-'.esc_attr($settings['stonex_accordion_image_align']).'">';
                            echo '<div '.$this->get_render_attribute_string( 'stonex_accordion_details' ).'>';
                                echo '<p class=stonex-size-'.$accordion['content_size'].' >'.wp_kses_post( $accordion['stonex_exclusive_accordion_content'] ).'</p>';
                                if( 'yes' === $accordion['stonex_accordion_show_read_more_btn']):
									if( $accordion['stonex_accordion_read_more_btn_url']['url'] ) {
									    $this->add_render_attribute( $link_key, 'href', esc_url( $accordion['stonex_accordion_read_more_btn_url']['url'] ) );
									    if( $accordion['stonex_accordion_read_more_btn_url']['is_external'] ) {
									        $this->add_render_attribute( $link_key, 'target', '_blank' );
									    }
									    if( $accordion['stonex_accordion_read_more_btn_url']['nofollow'] ) {
									        $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									    }
									}
                                    if ( ! empty( $accordion['stonex_accordion_read_more_btn_text'] ) ) :
                                        echo '<div '.$this->get_render_attribute_string( 'stonex_accordion_button' ).'>';
                                            echo '<a '.$this->get_render_attribute_string( $link_key ).'>';
                                            	echo esc_html( $accordion['stonex_accordion_read_more_btn_text'] );
                                            echo '</a>';
                                        echo '</div>';
                                    endif;
                                endif;
                            echo '</div>';

                            if ( ! empty( $accordion['stonex_accordion_image']['url'] ) ) {
                                echo '<div class="stonex-accordion-image">';
                                    echo $this->render_image( $accordion, $settings );
                                echo '</div>';
                            }

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                do_action('stonex_accordion_each_item_wrapper_after');
            endforeach;
            do_action('stonex_accordion_wrapper_after');
        echo '</div>';
    }
}
$widgets_manager->register( new \STONEX_Addons\Widgets\STONEX_Accordion() );