<?php

namespace Fbth_Addons\Widgets;



if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;

use \Elementor\Repeater;

use \Elementor\Group_Control_Border;

use \Elementor\Group_Control_Box_Shadow;

use \Elementor\Group_Control_Image_Size;

use \Elementor\Group_Control_Background;

use \Elementor\Control_Media;

use \Elementor\Icons_Manager;

use \Elementor\Group_Control_Typography;

use \Elementor\Group_Control_Css_Filter;

use \Elementor\Utils;

use \Elementor\Widget_Base;



class Fbth_Team_Member extends Widget_Base
{

	public function get_name()
	{

		return 'stonex-team-member';
	}

	public function get_title()
	{

		return esc_html__('STONEX Team Member', 'stonex');
	}

	public function get_icon()
	{

		return 'eicon-lock-user';
	}

	public function get_categories()
	{

		return ['stonex'];
	}

	public function get_keywords()
	{

		return ['stonex', 'employee', 'staff', 'team', 'member'];
	}

	protected function register_controls()
	{

		/**

		 * Team Member Content Section

		 */

		$this->start_controls_section(

			'stonex_team_content',

			[

				'label' => esc_html__('Content', 'stonex')

			]

		);

		$this->add_control(
			'team_style',
			[
				'label'             => __('Team Style', 'qweb-hp'),
				'type'              => Controls_Manager::SELECT,
				'default'           => 'style-one',
				'options'           => [
					'style-one'   =>   __('Style One',    'qweb-hp'),
					'style-two'   =>   __('Style Two',    'qweb-hp'),
				],
				'separator' => 'after',
			]
		);

		$this->add_control(

			'stonex_team_member_image',

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

		$this->add_group_control(

			Group_Control_Image_Size::get_type(),

			[

				'name'      => 'team_member_image_size',

				'default'   => 'medium_large',

				'condition' => [

					'stonex_team_member_image[url]!' => ''

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_position',

			[

				'label'       => __('Position', 'stonex'),

				'type'        => Controls_Manager::SELECT,

				'default'     => 'center',

				'label_block' => true,

				'options'     => [

					'top'     => __('Top', 'stonex'),

					'center'  => __('Center', 'stonex'),

					'left'    => __('Left', 'stonex'),

					'right'   => __('Right', 'stonex'),

					'bottom'  => __('Bottom', 'stonex'),

					'custom'  => __('Custom', 'stonex')

				],

				'selectors'   => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-position: {{VALUE}};'

				],

				'condition' 		   => [

					'stonex_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_position_x_offset',

			[

				'label'       => __('X Offset', 'stonex'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 500

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'stonex_team_member_enable_image_mask' => 'yes',

					'stonex_team_member_mask_shape_position' => 'custom'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_position_y_offset',

			[

				'label'       => __('Y Offset', 'stonex'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 500

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'stonex_team_member_enable_image_mask' => 'yes',

					'stonex_team_member_mask_shape_position' => 'custom'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_size',

			[

				'label'       => __('Size', 'stonex'),

				'type'        => Controls_Manager::SELECT,

				'default'     => 'auto',

				'label_block' => true,

				'options'     => [

					'auto'    => __('Auto', 'stonex'),

					'contain' => __('Contain', 'stonex'),

					'cover'   => __('Cover', 'stonex'),

					'custom'  => __('Custom', 'stonex')

				],

				'selectors'   => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-size: {{VALUE}};'

				],

				'condition' 		   => [

					'stonex_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_custome_size',

			[

				'label'       => __('Mask Size', 'stonex'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 600

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'stonex_team_member_enable_image_mask' => 'yes',

					'stonex_team_member_mask_shape_size' => 'custom'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_mask_shape_repeat',

			[

				'label'         => __('Repeat', 'stonex'),

				'type'          => Controls_Manager::SELECT,

				'default'       => 'no-repeat',

				'label_block'   => true,

				'options'       => [

					'no-repeat' => __('No repeat', 'stonex'),

					'repeat'    => __('Repeat', 'stonex')

				],

				'selectors'     => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => '-webkit-mask-repeat: {{VALUE}};'

				],

				'condition' 	=> [

					'stonex_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_name',

			[

				'label'       => esc_html__('Name', 'stonex'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('John Doe', 'stonex'),

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_control(

			'stonex_team_member_designation',

			[

				'label'       => esc_html__('Designation', 'stonex'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('Designation', 'stonex'),

				'dynamic' => [

					'active' => true,

				]

			]

		);

		$this->add_control(

			'stonex_show_remark',

			[

				'label'        => __('Show Remark', 'stonex'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('ON', 'stonex'),

				'label_off'    => __('OFF', 'stonex'),

				'return_value' => 'yes',

				'default'      => 'no'

			]

		);

		$this->add_control(

			'team_member_remark',

			[

				'label' => esc_html__('Remark', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::TEXTAREA,

				'rows' => 10,

				'placeholder' => esc_html__('Type your description here', 'plugin-name'),

				'condition'   => [

					'stonex_show_remark' => 'yes'

				],

			]

		);

		$this->add_control(

			'remark_size',

			[

				'label' => esc_html__('Size', 'stonex'),

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

				'condition'   => [

					'stonex_show_remark' => 'yes'

				]

			]

		);

		$this->add_control(

			'stonex_section_team_members_cta_btn',

			[

				'label'        => __('Call To Action', 'stonex'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('ON', 'stonex'),

				'label_off'    => __('OFF', 'stonex'),

				'return_value' => 'yes',

				'default'      => 'no'

			]

		);



		$this->add_control(

			'stonex_team_members_cta_btn_text',

			[

				'label'       => esc_html__('Text', 'stonex'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('Read More', 'stonex'),

				'condition'   => [

					'stonex_section_team_members_cta_btn' => 'yes'

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_control(

			'stonex_team_members_cta_btn_link',

			[

				'label'       => esc_html__('Link', 'stonex'),

				'type'        => Controls_Manager::URL,

				'label_block' => true,

				'default'     => [

					'url'         => '#',

					'is_external' => ''

				],

				'show_external' => true,

				'condition' => [

					'stonex_section_team_members_cta_btn' => 'yes'

				]

			]

		);

		$this->add_control(

			'team_btn_icon',

			[

				'label' => esc_html__('Icon', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::ICONS,

				'condition'   => [

					'stonex_section_team_members_cta_btn' => 'yes'

				],

			]

		);

		$this->end_controls_section();

		/*

		* Team member Social profiles section

		*/

		$this->start_controls_section(

			'stonex_section_team_member_social_profiles',

			[

				'label' => esc_html__('Social Profiles', 'stonex')

			]

		);

		$this->add_control(

			'stonex_team_member_enable_social_profiles',

			[

				'label'   => esc_html__('Display Social Profiles?', 'stonex'),

				'type'    => Controls_Manager::SWITCHER,

				'default' => 'yes'

			]

		);

		$repeater = new Repeater();

		$repeater->add_control(

			'social_icon',

			[

				'label'            => __('Icon', 'stonex'),

				'type'             => Controls_Manager::ICONS,

				'label_block'      => true,

				'default'          => [

					'value'        => 'fab fa-wordpress',

					'library'      => 'fa-brands'

				]



			]

		);



		$repeater->add_control(

			'link',

			[

				'label'       => __('Link', 'stonex'),

				'type'        => Controls_Manager::URL,

				'label_block' => true,

				'default'     => [

					'url'         => '#',

					'is_external' => 'true'

				],

				'dynamic'     => [

					'active'  => true

				],

				'placeholder' => __('https://your-link.com', 'stonex')

			]

		);



		$this->add_control(

			'stonex_team_member_social_profile_links',

			[

				'label'       => __('Social Icons', 'stonex'),

				'type'        => Controls_Manager::REPEATER,

				'fields'      => $repeater->get_controls(),

				'condition'   => [

					'stonex_team_member_enable_social_profiles!' => ''

				],

				'default'     => [

					[

						'social_icon' => [

							'value'   => 'fab fa-facebook-f',

							'library' => 'fa-brands'

						]

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-twitter',

							'library' => 'fa-brands'

						]

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-linkedin-in',

							'library' => 'fa-brands'

						],

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-google-plus-g',

							'library' => 'fa-brands',

						]

					]

				],

				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'

			]

		);

		$this->end_controls_section();

		/*

		* Team Members Styling Section

		*/



		/*

		* Team Members Container Style

		*/

		$this->start_controls_section(

			'stonex_section_team_members_styles_preset',

			[

				'label' => esc_html__('Container', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'     => 'stonex_team_members_bg',

				'types'    => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .stonex-team-member'

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'stonex_team_members_border',

				'selector' => '{{WRAPPER}} .stonex-team-member'

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_radius',

			[

				'label'      => __('Border radius', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_padding',

			[

				'label'      => __('Padding', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_margin',

			[

				'label'      => __('Margin', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'     => 'stonex_team_members_box_shadow',

				'selector' => '{{WRAPPER}} .stonex-team-member',

				'fields_options'         => [

					'box_shadow_type'    => [

						'default'        => 'yes'

					],

					'box_shadow'         => [

						'default'        => [

							'horizontal' => 0,

							'vertical'   => 20,

							'blur'       => 49,

							'spread'     => 0,

							'color'      => 'rgba(24, 27, 33, 0.1)'

						]

					]

				]

			]

		);



		$this->end_controls_section();



		/**

		 * For Thumbnail style

		 */



		$this->start_controls_section(

			'stonex_section_team_members_image_style',

			[

				'label' => esc_html__('Image', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'stonex_team_membe_image_position',

			[

				'label'         => esc_html__('Image Position', 'stonex'),

				'type'          => Controls_Manager::CHOOSE,

				'toggle'        => false,

				'default'       => 'stonex-position-top',

				'options'       => [

					'stonex-position-left'  => [

						'title' => esc_html__('Left', 'stonex'),

						'icon'  => 'eicon-arrow-left'

					],

					'stonex-position-top'   => [

						'title' => esc_html__('Top', 'stonex'),

						'icon'  => 'eicon-arrow-up'

					],

					'stonex-position-right' => [

						'title' => esc_html__('Right', 'stonex'),

						'icon'  => 'eicon-arrow-right'

					]

				]

			]

		);



		$this->start_controls_tabs(

			'image_style_tabs'

		);



		$this->start_controls_tab(

			'image_normal_tab',

			[

				'label' => esc_html__('Normal', 'plugin-name'),

			]

		);



		$this->add_control(

			'stonex_section_team_members_thumbnail_box',

			[

				'label'        => __('Image Box', 'stonex'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('Show', 'stonex'),

				'label_off'    => __('Hide', 'stonex'),

				'return_value' => 'yes',

				'default'      => 'no'

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_thumbnail_box_height',

			[

				'label'      => __('Height', 'stonex'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 100

				],

				'range'        => [

					'px'       => [

						'min'  => 50,

						'max'  => 500,

						'step' => 5

					],

					'%'        => [

						'min'  => 1,

						'max'  => 100,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => 'height: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_thumbnail_box_width',

			[

				'label'      => __('Width', 'stonex'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 100

				],

				'range'        => [

					'px'       => [

						'min'  => 50,

						'max'  => 500,

						'step' => 5

					],

					'%'        => [

						'min'  => 1,

						'max'  => 100,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => 'width: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'      => 'stonex_section_team_members_thumbnail_box_border',

				'selector'  => '{{WRAPPER}} .stonex-team-member-thumb img',

				'condition' => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_thumbnail_box_radius',

			[

				'label'      => __('Border radius', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .stonex-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_thumbnail_box_margin_top',

			[

				'label'      => __('Top Spacing', 'stonex'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 0

				],

				'range'        => [

					'px'       => [

						'min'  => -300,

						'max'  => 300,

						'step' => 5

					],

					'%'        => [

						'min'  => -50,

						'max'  => 50,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => 'margin-top: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_thumbnail_box_margin_bottom',

			[

				'label'      => __('Bottom Spacing', 'stonex'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 0

				],

				'range'        => [

					'px'       => [

						'min'  => -300,

						'max'  => 300,

						'step' => 5

					],

					'%'        => [

						'min'  => -50,

						'max'  => 50,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-thumb img' => 'margin-bottom: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'      => 'stonex_section_team_members_thumbnail_box_shadow',

				'selector'  => '{{WRAPPER}} .stonex-team-member-thumb img',

				'condition' => [

					'stonex_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Css_Filter::get_type(),

			[

				'name' => 'stonex_section_team_members_thumbnail_css_filter',

				'selector' => '{{WRAPPER}} .stonex-team-member-thumb img',

			]

		);

		$this->end_controls_tab();

		$this->start_controls_tab(

			'image_style_hover_tab',

			[

				'label' => esc_html__('Hover', 'plugin-name'),

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'      => 'image_hover_border',

				'selector'  => '{{WRAPPER}} .stonex-team-member-thumb img:hover',

			]

		);



		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/*

		* Team Members Content Style

		*/

		$this->start_controls_section(

			'stonex_section_team_members_content_style',

			[

				'label' => esc_html__('Content', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_responsive_control(

			'width',

			[

				'label' => esc_html__('Width', 'plugin-name'),

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

					'size' => 60,

				],

				'selectors' => [

					'{{WRAPPER}} .stonex-position-left .stonex-team-member-content' => 'width: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_control(

			'stonex_team_member_content_alignment',

			[

				'label'   => __('Alignment', 'stonex'),

				'type'    => Controls_Manager::CHOOSE,

				'toggle'  => false,

				'options' => [

					'stonex-left'   => [

						'title'   => __('Left', 'stonex'),

						'icon'    => 'eicon-text-align-left'

					],

					'stonex-center' => [

						'title'   => __('Center', 'stonex'),

						'icon'    => 'eicon-text-align-center'

					],

					'stonex-right'  => [

						'title'   => __('Right', 'stonex'),

						'icon'    => 'eicon-text-align-right'

					]

				],

				'default' => 'stonex-center'

			]

		);



		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'     => 'stonex_team_members_content_background',

				'types'    => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .stonex-team-member-content'

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_content_padding',

			[

				'label'      => __('Padding', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '30',

					'right'  => '30',

					'bottom' => '30',

					'left'   => '30'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_section_team_members_content_margin',

			[

				'label'      => __('Margin', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_content_border_radius',

			[

				'label'      => __('Border Radius', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'     => 'stonex_section_team_members_content_box_shadow',

				'selector' => '{{WRAPPER}} .stonex-team-member-content'

			]

		);



		$this->end_controls_section();



		/*

		* Name style

		*/

		$this->start_controls_section(

			'section_team_carousel_name',

			[

				'label' => __('Name', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'stonex_team_name_color',

			[

				'label'     => __('Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#000000',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-name' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'stonex_team_name_typography',

				'selector' => '{{WRAPPER}} .stonex-team-member-name'

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_name_margin',

			[

				'label'        => __('Margin', 'stonex'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .stonex-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_section();



		/**

		 * Designation Style

		 */

		$this->start_controls_section(

			'section_team_member_designation',

			[

				'label' => __('Designation', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'stonex_team_designation_color',

			[

				'label'     => __('Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#8a8d91',

				'selectors' => [

					'{{WRAPPER}} span.stonex-team-member-designation' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'stonex_team_designation_typography',

				'selector' => '{{WRAPPER}} span.stonex-team-member-designation'

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_designation_margin',

			[

				'label'        => __('Margin', 'stonex'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} span.stonex-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_section();





		/**

		 * Remark Style

		 */

		$this->start_controls_section(

			'team_member_remark_style',

			[

				'label' => __('Remark', 'stonex'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'stonex_team_remark_color',

			[

				'label'     => __('Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#8a8d91',

				'selectors' => [

					'{{WRAPPER}} .member-remark p.team-remark' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'stonex_team_remark_typography',

				'selector' => '{{WRAPPER}} .member-remark p.team-remark'

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_remark_margin',

			[

				'label'        => __('Margin', 'stonex'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .member-remark p.team-remark' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_section();



		/**

		 * Call to action Style

		 */

		$this->start_controls_section(

			'stonex_team_member_cta_btn_style',

			[

				'label'     => __('Call To Action', 'stonex'),

				'tab'       => Controls_Manager::TAB_STYLE,

				'condition' => [

					'stonex_section_team_members_cta_btn' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'stonex_team_member_cta_btn_typography',

				'selector' => '{{WRAPPER}} .stonex-team-member-cta'

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_cta_btn_margin',

			[

				'label'        => __('Margin', 'stonex'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .stonex-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_cta_btn_padding',

			[

				'label'        => __('Padding', 'stonex'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '15',

					'right'    => '30',

					'bottom'   => '15',

					'left'     => '30',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .stonex-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_cta_btn_radius',

			[

				'label'      => __('Border Radius', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->start_controls_tabs('stonex_team_member_cta_btn_tabs');



		$this->start_controls_tab('stonex_team_member_cta_btn_tab_normal', ['label' => esc_html__('Normal', 'stonex')]);



		$this->add_control(

			'stonex_team_member_cta_btn_text_color_normal',

			[

				'label'     => esc_html__('Text Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#222222',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-cta' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_cta_btn_background_normal',

			[

				'label'     => esc_html__('Background Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#d6d6d6',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-cta' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'stonex_team_member_cta_btn_border_normal',

				'selector' => '{{WRAPPER}} .stonex-team-member-cta'

			]

		);



		$this->end_controls_tab();



		$this->start_controls_tab('stonex_team_member_cta_btn_tab_hover', ['label' => esc_html__('Hover', 'stonex')]);



		$this->add_control(

			'stonex_team_member_cta_btn_text_color_hover',

			[

				'label'     => esc_html__('Text Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#d6d6d6',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-cta:hover' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'stonex_team_member_cta_btn_background_hover',

			[

				'label'     => esc_html__('Background Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#222222',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-cta:hover' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'stonex_team_member_cta_btn_border_hover',

				'selector' => '{{WRAPPER}} .stonex-team-member-cta:hover'

			]

		);



		$this->end_controls_tab();



		$this->end_controls_tabs();

		$this->add_control(

			'team_icon_options',

			[

				'label' => esc_html__('Icon Options', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);



		$this->add_control(

			'icon_gap',

			[

				'label' => esc_html__('Icon Gap', 'plugin-name'),

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

				'default' => [

					'unit' => 'px',

					'size' => 5,

				],

				'selectors' => [

					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-left: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_control(

			'icon_svg_top_gap',

			[

				'label' => esc_html__('Svg Top Gap', 'plugin-name'),

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

				'default' => [

					'unit' => 'px',

					'size' => 3,

				],

				'selectors' => [

					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-top: {{SIZE}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();



		/**

		 * Social icons style

		 */

		$this->start_controls_section(

			'stonex_team_member_social_section',

			[

				'label'     => __('Social Icons', 'stonex'),

				'tab'       => Controls_Manager::TAB_STYLE,

				'condition' => [

					'stonex_team_member_enable_social_profiles!' => ''

				]

			]

		);





		$this->add_responsive_control(

			'stonex_team_members_social_icon_size',

			[

				'label'        => __('Size', 'stonex'),

				'type'         => Controls_Manager::SLIDER,

				'size_units'   => ['px'],

				'range'        => [

					'px'       => [

						'min'  => 0,

						'max'  => 50,

						'step' => 1

					]

				],

				'default'      => [

					'unit'     => 'px',

					'size'     => 14

				],

				'selectors'    => [

					'{{WRAPPER}} .stonex-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .stonex-team-member-social li a svg' => 'height: {{SIZE}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_social_padding',

			[

				'label'      => __('Padding', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'default'    => [

					'top'    => '15',

					'right'  => '15',

					'bottom' => '15',

					'left'   => '15'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_members_social_box_radius',

			[

				'label'      => __('Border radius', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'stonex_team_member_social_margin',

			[

				'label'      => __('Margin', 'stonex'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'selectors'  => [

					'{{WRAPPER}} .stonex-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->start_controls_tabs('stonex_team_members_social_icons_style_tabs');



		$this->start_controls_tab('stonex_team_members_social_icon_tab', ['label' => esc_html__('Normal', 'stonex')]);



		$this->add_control(

			'stonex_team_carousel_social_icon_color_normal',

			[

				'label'     => esc_html__('Icon Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#a4a7aa',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-social li a i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .stonex-team-member-social li a svg path' => 'fill: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'stonex_team_carousel_social_bg_color_normal',

			[

				'label'     => esc_html__('Background Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-social li a' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'stonex_team_carousel_social_border_normal',

				'selector' => '{{WRAPPER}} .stonex-team-member-social li a'

			]

		);



		$this->end_controls_tab();



		$this->start_controls_tab('stonex_team_members_social_icon_hover', ['label' => esc_html__('Hover', 'stonex')]);



		$this->add_control(

			'stonex_team_carousel_social_icon_color_hover',

			[

				'label'     => esc_html__('Icon Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#8a8d91',

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-social li a:hover i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .stonex-team-member-social li a:hover svg path' => 'fill: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'stonex_team_carousel_social_bg_color_hover',

			[

				'label'     => esc_html__('Background Color', 'stonex'),

				'type'      => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .stonex-team-member-social li a:hover' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'stonex_team_carousel_social_border_hover',

				'selector' => '{{WRAPPER}} .stonex-team-member-social li a:hover'

			]

		);



		$this->end_controls_tab();



		$this->end_controls_tabs();



		$this->end_controls_section();
	}

	private function team_member_cta()
	{

		$settings = $this->get_settings_for_display();



		$this->add_render_attribute('stonex_team_members_cta_btn_text', 'class', 'stonex-team-cta-button-text');

		$this->add_inline_editing_attributes('stonex_team_members_cta_btn_text', 'none');

?>

		<span <?php echo $this->get_render_attribute_string('stonex_team_members_cta_btn_text'); ?>>

			<?php echo esc_html($settings['stonex_team_members_cta_btn_text']); ?>

		</span>

	<?php

	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$team_style = $settings['team_style'];


		$this->add_render_attribute('stonex_team_member_name', 'class', 'stonex-team-member-name');

		$this->add_inline_editing_attributes('stonex_team_member_name', 'basic');

		$this->add_render_attribute('stonex_team_member_designation', 'class', 'stonex-team-member-designation');

		$this->add_inline_editing_attributes('stonex_team_member_designation', 'basic');

		$this->add_render_attribute('stonex_team_member_item', [

			'class' => [

				'stonex-team-member',

				esc_attr($settings['stonex_team_member_content_alignment']),

				esc_attr($settings['stonex_team_membe_image_position'])

			]

		]);

		$this->add_render_attribute('stonex_team_members_cta_btn_link', 'class', 'stonex-team-member-cta');

		if (isset($settings['stonex_team_members_cta_btn_link']['url'])) {

			$this->add_render_attribute('stonex_team_members_cta_btn_link', 'href', esc_url($settings['stonex_team_members_cta_btn_link']['url']));

			if ($settings['stonex_team_members_cta_btn_link']['is_external']) {

				$this->add_render_attribute('stonex_team_members_cta_btn_link', 'target', '_blank');
			}

			if ($settings['stonex_team_members_cta_btn_link']['nofollow']) {

				$this->add_render_attribute('stonex_team_members_cta_btn_link', 'rel', 'nofollow');
			}
		}

		$this->add_render_attribute('team_remark', 'class', 'team-remark stonex-size-' . $settings['remark_size']);

	?>

		<?php if ($team_style) {
			include('content/' . $team_style . '.php');
		} ?>




<?php

	}
}

$widgets_manager->register(new \Fbth_Addons\Widgets\Fbth_Team_Member());
