<?php

if (!defined('ABSPATH')) {

    exit;
}

// Exit if accessed directly

/**

 * Elementor Hello World

 *

 * Elementor widget for hello world.

 *

 * @since 1.0.0

 */

class STONEX_Top_Right_Meta extends \Elementor\Widget_Base

{

    /**

     * Retrieve the widget name.

     *

     * @since 1.0.0

     *

     * @access public

     *

     * @return string Widget name.

     */

    public function get_name()

    {

        return 'stonex-top-right-meta';
    }

    /**

     * Retrieve the widget title.

     *

     * @since 1.0.0

     *

     * @access public

     *

     * @return string Widget title.

     */

    public function get_title()

    {

        return __('STONEX Top Right Meta', 'stonex');
    }

    /**

     * Retrieve the widget icon.

     *

     * @since 1.0.0

     *

     * @access public

     *

     * @return string Widget icon.

     */

    public function get_icon()

    {

        return 'eicon-cart';
    }

    /**

     * Retrieve the list of categories the widget belongs to.

     *

     * Used to determine where to display the widget in the editor.

     *

     * Note that currently Elementor supports only one category.

     * When multiple categories passed, Elementor uses the first one.

     *

     * @since 1.0.0

     *

     * @access public

     *

     * @return array Widget categories.

     */

    public function get_categories()

    {

        return ['stonex-addons'];
    }

    /**

     * Register the widget controls.

     *

     * Adds different input fields to allow the user to change and customize the widget settings.

     *

     * @since 1.0.0

     *

     * @access protected

     */

    protected function register_controls()

    {

        $this->start_controls_section(

            'section_layout',

            [

                'label' => __('Layout', 'stonex'),

            ]

        );

        $this->add_control(

            'show_user_acc',

            [

                'label' => __('Show User Login', 'stonex'),

                'type' => \Elementor\Controls_Manager::SWITCHER,

                'label_on' => __('Show', 'stonex'),

                'label_off' => __('Hide', 'stonex'),

                'return_value' => 'yes',

                'default' => 'yes',

            ]

        );

        $this->add_control(

            'ac_icon',

            [

                'label' => __('Icon', 'stonex'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-user',
                    'library' => 'solid',

                ],
                'condition' => ['show_user_acc' => 'yes']
            ]
        );


        $this->add_control(
            'show_cart',
            [
                'label' => __('Show Cart Button', 'stonex'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'stonex'),
                'label_off' => __('Hide', 'stonex'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]

        );

        $this->add_control(
            'cart_icon',
            [
                'label' => __('Icon', 'stonex'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-cart-plus',
                    'library' => 'solid',
                ],
                'condition' => ['show_cart' => 'yes']
            ]

        );


        $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Align', 'stonex'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'stonex'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'stonex'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'stonex'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul' => 'justify-content: {{VALUE}};',
                ]

            ]
        );

        $this->end_controls_section();





        $this->start_controls_section(
            'featured_title',
            [
                'label' => __('Icon', 'stonex'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a svg path' => 'fill: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'icon_pop_color',
            [
                'label' => __('Notice Background Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a span' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_box_width',
            [
                'label' => __('Icon Box Size', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_box_height',
            [
                'label' => __('Icon Box Size', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_pos-x',
            [
                'label' => __('Icon Positions X', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a span' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_pos-y',
            [
                'label' => __('Icon Positions Y', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .stonex-woocommer-top-righ-wraper ul li a span' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**

     * Render the widget output on the frontend.

     *

     * Written in PHP and used to generate the final HTML.

     *

     * @since 1.0.0

     *

     * @access protected

     */

    protected function render()

    {

        $settings = $this->get_settings();
        $show_user_acc = $settings['show_user_acc'];
        $show_cart     = $settings['show_cart'];
?>

        <div class="stonex-woocommer-top-righ-wraper">
            <ul class="<?php echo $settings['content_align'] ?>">
                <!-- Login Registar -->
                <?php if ($show_user_acc == "yes") : ?>
                    <?php if (is_user_logged_in()) { ?>
                        <li class="stonex-login">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'stonex'); ?>">
                                <?php \Elementor\Icons_Manager::render_icon($settings["ac_icon"], ['aria-hidden' => 'true']); ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="stonex-login">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Login / Register', 'stonex'); ?>">
                                <?php \Elementor\Icons_Manager::render_icon($settings["ac_icon"], ['aria-hidden' => 'true']); ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php endif; ?>

                <!-- Cart-->
                <?php if ($show_cart == "yes") : ?>
                    <li class="stonex-cart">
                        <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('Cart', 'stonex'); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($settings["cart_icon"], ['aria-hidden' => 'true']); ?>
                            <span class="cart-contents">
                                <?php
                                if (is_null(WC()->cart)) {
                                } else {
                                    echo WC()->cart->get_cart_contents_count();
                                }

                                ?>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
<?php

    }
}

$widgets_manager->register(new \STONEX_Top_Right_Meta());
