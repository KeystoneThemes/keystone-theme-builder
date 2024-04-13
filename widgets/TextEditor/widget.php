<?php

namespace STONEX_Addons\Widgets;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;
use \Elementor\Widget_Base;

class STONEX_Text_Editor extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve text editor widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'stonex-text-editor';
    }

    /**
     * Get widget title.
     *
     * Retrieve text editor widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'STONEX Text Editor', 'stonex' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve text editor widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-text';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the text editor widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['stonex'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['text', 'editor'];
    }

    /**
     * Register text editor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_editor',
            [
                'label' => esc_html__( 'Text Editor', 'stonex' ),
            ]
        );

        $this->add_control(
            'editor',
            [
                'label'   => '',
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'stonex' ) . '</p>',
            ]
        );

        $this->add_control(
            'drop_cap',
            [
                'label'              => esc_html__( 'Drop Cap', 'stonex' ),
                'type'               => Controls_Manager::SWITCHER,
                'label_off'          => esc_html__( 'Off', 'stonex' ),
                'label_on'           => esc_html__( 'On', 'stonex' ),
                'prefix_class'       => 'stonex-drop-cap-',
                'frontend_available' => true,
            ]
        );

        $text_columns     = range( 1, 10 );
        $text_columns     = array_combine( $text_columns, $text_columns );
        $text_columns[''] = esc_html__( 'Default', 'stonex' );

        $this->add_responsive_control(
            'text_columns',
            [
                'label'     => esc_html__( 'Columns', 'stonex' ),
                'type'      => Controls_Manager::SELECT,
                'separator' => 'before',
                'options'   => $text_columns,
                'selectors' => [
                    '{{WRAPPER}}' => 'columns: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => esc_html__( 'Columns Gap', 'stonex' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vw'],
                'range'      => [
                    'px' => [
                        'max' => 100,
                    ],
                    '%'  => [
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                    'vw' => [
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                    'em' => [
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label'        => esc_html__( 'Size', 'stonex' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'default',
                'options'      => [
                    'default' => esc_html__( 'Default', 'stonex' ),
                    'small'   => esc_html__( 'Small', 'stonex' ),
                    'medium'  => esc_html__( 'Medium', 'stonex' ),
                    'large'   => esc_html__( 'Large', 'stonex' ),
                    'xl'      => esc_html__( 'XL', 'stonex' ),
                    'xxl'     => esc_html__( 'XXL', 'stonex' ),
                ],
                'prefix_class' => 'stonex-size-',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Text Editor', 'stonex' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'stonex' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'stonex' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Center', 'stonex' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'stonex' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'stonex' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'stonex' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_drop_cap',
            [
                'label'     => esc_html__( 'Drop Cap', 'stonex' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'drop_cap' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_view',
            [
                'label'        => esc_html__( 'View', 'stonex' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'default' => esc_html__( 'Default', 'stonex' ),
                    'stacked' => esc_html__( 'Stacked', 'stonex' ),
                    'framed'  => esc_html__( 'Framed', 'stonex' ),
                ],
                'default'      => 'default',
                'prefix_class' => 'stonex-drop-cap-view-',
            ]
        );

        $this->add_control(
            'drop_cap_primary_color',
            [
                'label'     => esc_html__( 'Primary Color', 'stonex' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.stonex-drop-cap-view-stacked .stonex-drop-cap'                                                       => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.stonex-drop-cap-view-framed .stonex-drop-cap, {{WRAPPER}}.stonex-drop-cap-view-default .stonex-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_secondary_color',
            [
                'label'     => esc_html__( 'Secondary Color', 'stonex' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.stonex-drop-cap-view-framed .stonex-drop-cap'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.stonex-drop-cap-view-stacked .stonex-drop-cap' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'drop_cap_view!' => 'default',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'drop_cap_shadow',
                'selector' => '{{WRAPPER}} .stonex-drop-cap',
            ]
        );

        $this->add_control(
            'drop_cap_size',
            [
                'label'     => esc_html__( 'Size', 'stonex' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 5,
                ],
                'range'     => [
                    'px' => [
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-drop-cap' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'drop_cap_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_space',
            [
                'label'     => esc_html__( 'Space', 'stonex' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 10,
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .stonex-drop-cap' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .stonex-drop-cap'       => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'stonex' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default'    => [
                    'unit' => '%',
                ],
                'range'      => [
                    '%' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .stonex-drop-cap' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_border_width',
            [
                'label'     => esc_html__( 'Border Width', 'stonex' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .stonex-drop-cap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'drop_cap_view' => 'framed',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'drop_cap_typography',
                'selector' => '{{WRAPPER}} .stonex-drop-cap-letter',
                'exclude'  => [
                    'letter_spacing',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render text editor widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings                     = $this->get_settings_for_display();
        $is_dom_optimized             = Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' );
        $is_edit_mode                 = Plugin::$instance->editor->is_edit_mode();
        $should_render_inline_editing = ( !$is_dom_optimized || $is_edit_mode );

        $editor_content = $this->get_settings_for_display( 'editor' );
        $editor_content = $this->parse_text_editor( $editor_content );
        $this->add_render_attribute( 'stonex-paragraph', 'class', 'stonex-size-' . $settings['size'] );

        if ( $should_render_inline_editing ) {
            $this->add_render_attribute( 'editor', 'class', ['stonex-text-editor', 'stonex-clearfix'] );
        }

        $this->add_inline_editing_attributes( 'editor', 'advanced' );
        ?>
		<?php if ( $should_render_inline_editing ) {?>
			<div <?php $this->print_render_attribute_string( 'editor' );?>>
			<?php }?>
			<div class="stonex-paragraph-editor">
				<div <?php echo $this->get_render_attribute_string( 'stonex-paragraph' ); ?>><?php echo wpautop( $editor_content ); ?></div>
			</div>
		<?php if ( $should_render_inline_editing ) {?>
			</div>
		<?php }?>
<?php
}

    /**
     * Render text editor widget as plain content.
     *
     * Override the default behavior by printing the content without rendering it.
     *
     * @since 1.0.0
     * @access public
     */
    public function render_plain_content() {
        // In plain mode, render without shortcode
        $this->print_unescaped_setting( 'editor' );
    }

    /**
     * Render text editor widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
}
$widgets_manager->register( new \STONEX_Addons\Widgets\STONEX_Text_Editor() );
