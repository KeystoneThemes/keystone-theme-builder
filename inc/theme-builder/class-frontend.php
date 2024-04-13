<?php

namespace STONEX\Elementor\ThemeBuilder;

use STONEX\Footer;

defined('ABSPATH') || exit();

/**
 * Theme Builder Frontend functions
 *
 * @since 2.0.0
 */
class Frontend
{

    protected $is_header;
    protected $header_id;

    protected $is_footer;
    protected $footer_id;

    protected $is_job;
    protected $job_id;

    protected $is_cs;
    protected $cs_id;

    // protected $is_popup;
    // protected $popup_id;

    public $is_single = false; //2788; //2053;

    /**
     * Construct Theme Builder Frontend functions
     *
     * @since 2.0.0
     */
    public function __construct()
    {
        add_action('wp', function () {
            $this->init();



            add_action('stonex_header_section', [$this, 'header'], 5);
            add_action('stonex_footer_settings', [$this, 'footer'], 5);
            add_filter('stonex_single_page_content', [$this, 'archive'], 5);



            if ((is_singular('job') && $this->is_job) || (is_singular('case-study') && $this->is_cs)) {
                $this->common_remove_hook();
            }

            // add_action('stonex_content_end', [$this, 'popup'],999);

            // add_filter('stonex_single_tb', [$this, 'true']);
            // add_action('do_stonex_single_tb', [$this,'do_single']);

        });

        //Change the menu walker so we can inject the megamenu
        add_filter('walker_nav_menu_start_el', [$this, 'megamenu_content_in_nav'], 10, 4);
        add_filter('nav_menu_css_class', [$this, 'megamenu_item_class'], 10, 2);
    }

    function common_remove_hook()
    {
        remove_action('stonex_banner_section', 'stonex_banner_section_start', 10);
        remove_action('stonex_banner_section', 'stonex_banner_title', 20);
        remove_action('stonex_banner_section', 'stonex_banner_section_end', 30);

        remove_action('stonex_content_start', 'stonex_content_start', 10);
        remove_action('stonex_content_start', 'stonex_content_inner_start', 20);
        remove_action('stonex_content_end', 'stonex_content_inner_end', 10);
        remove_action('stonex_content_end', 'stonex_content_end', 20);
    }

    function false()
    {
        return false;
    }
    function true()
    {
        return true;
    }

    /**
     * Get Frontend Themebuilder elements to display
     *
     * @return void>
     * @since 2.0.0
     */
    function init()
    {

        $this->get_settings('footer');
        $this->get_settings('header');
        $this->get_settings('job');
        $this->get_settings('cs');
        // $this->get_settings('popup');
    }

    /**
     * Get frontend elments
     *
     * @param [type] $type
     * @return void>
     * @since 2.0.0
     */
    function get_settings($type)
    {
        $templates = self::get_template_id($type);
        $template  = !is_array($templates) ? $templates : $templates[0];
        $template  = apply_filters("stonex_tb_get_settings_{$type}", $template);

        if ('' !== $templates) {
            switch ($type) {
                case 'job':
                    $this->is_job = true;
                    $this->job_id = $template;

                    $settings = get_post_meta($template, 'tb_settings', true);
                    // if($settings['keep_default'] != 'true'){
                    //     add_filter('stonex_show_default_header', [$this, 'false']);
                    // }
                    break;
                case 'cs':
                    $this->is_cs = true;
                    $this->cs_id = $template;

                    $settings = get_post_meta($template, 'tb_settings', true);
                    // if($settings['keep_default'] != 'true'){
                    //     add_filter('stonex_show_default_header', [$this, 'false']);
                    // }
                    break;
                case 'footer':
                    $this->is_footer = true;
                    $this->footer_id = $template;

                    $settings = get_post_meta($template, 'tb_settings', true);
                    if ($settings['keep_default'] != 'true') {
                        add_filter('stonex_show_default_footer', [$this, 'false']);
                    }
                    break;

                case 'header':
                    $this->is_header = true;
                    $this->header_id = $template;

                    $settings = get_post_meta($template, 'tb_settings', true);
                    // if($settings['keep_default'] != 'true'){
                    //     add_filter('stonex_show_default_header', [$this, 'false']);
                    // }
                    break;

                    // case 'popup':
                    //     $this->is_popup = true;
                    //     $this->popup_id = $templates;
                    //     break;

            }
        }
    }

    /**
     * Get Item ID to display is is anny
     *
     * @param [type] $type
     * @return void>
     * @since 2.0.0
     */
    public static function get_template_id($type)
    {
        $option = [
            'include' => 'tb_rule_include',
            'exclude' => 'tb_rule_exclude',
            'type'    => '_type_' . $type,
        ];

        // var_dump($option);

        // $item_list = \STONEX\Elementor\ThemeBuilder\Rule::get_instance()->get_posts_by_conditions( $option );
        $item_list = \STONEX\Elementor\ThemeBuilder\Rule::get_instance()->get_posts_by_conditions($option);
        // var_dump($item_list);
        $list = '';
        foreach ($item_list as $item) {
            if (Common::get_the_type($item['id']) == $type) {
                if (!is_array($list)) {
                    $list = [];
                }
                $list[] = $item['id'];
            }
        }
        return $list;
    }

    /**
     * Hook footer elements in page
     *
     * @return void>
     * @since 2.0.0
     */
    function footer()
    {
        if ($this->is_footer) {
            $this->display('footer');
        }
    }

    /**
     * Hook header elements in page
     *
     * @return void>
     * @since 2.0.0job
     */
    function header()
    {
        if ($this->is_header) {
            $this->display('header');
        }
    }

    /**
     * Hook Job elements in page
     *
     * @return void>
     * @since 2.0.0
     */
    function archive($content)
    {

        if (is_singular('job') && $this->is_job) {
            $this->display('job');
        } else if (is_singular('case-study') && $this->is_cs) {
            $this->display('cs');
        } else {
            echo $content;
        }
    }
    /**
     * Hook header elements in page
     *
     * @return void>
     * @since 2.0.0
     */
    function popup()
    {
        if ($this->is_popup) {
            $this->display('popup');
        }
    }

    function do_single()
    {
        if ($this->is_single) {
            echo Common::get_elementor_content($this->is_single);
        }
    }

    /**
     * Display item makrup
     *
     * @param string $type
     * @param [type] $id
     * @return void>
     * @since 2.0.0
     */
    function display($type, $id = null)
    {
        if ($type === 'header') {
            $stonex          = get_option('stonex');
            $sticky_class  = '';
            $sticky_mobile = '';
            if (isset($stonex['enable_sticky_header']) && true == $stonex['enable_sticky_header']) {
                $sticky_class = 'sticky-header';
            }
            if (isset($stonex['sticky_mobile']) && true != $stonex['sticky_mobile']) {
                $sticky_mobile = 'sticky-mobile-off';
            }

            $id = $this->header_id;
?>
            <header id="stonex-tb-header" class="<?php printf('%s %s', $sticky_class, $sticky_mobile); ?>" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
                <?php echo Common::get_elementor_content($id); ?>
            </header>
        <?php
        }

        if ($type === 'footer') {
            $id = $this->footer_id;
        ?>
            <footer id="stonex-tb-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
                <?php echo Common::get_elementor_content($id); ?>
            </footer>
<?php
        }
        if ($type === 'job') {
            $id      = $this->job_id;
            $content = Common::get_elementor_content($id);
            echo $content;
        }
        if ($type === 'cs') {
            $id      = $this->cs_id;
            $content = Common::get_elementor_content($id);
            echo $content;
        }
        // if($type === 'popup'){
        //     $ids = $this->popup_id;
        //     foreach($ids as $id){
        //         $content = Common::get_elementor_content($id);
        //         Common::popup_markup($content,$id);
        //     }
        // }

    }

    /**
     * Inject Megamenu in navbar
     *
     * @param [type] $item_output
     * @param [type] $item
     * @param [type] $depth
     * @param [type] $args
     * @return void>
     * @since 2.0.0
     */
    function megamenu_content_in_nav($item_output, $item, $depth, $args)
    {
        if ($item->object === 'stonex-tb') {
            $atts     = null;
            $settings = get_post_meta($item->object_id, 'tb_settings', true);
            if ($settings['width'] === 'custom') {
                $atts = 'style="--stonex-max-width:' . $settings['widthCustom'] . 'px"';
            }
            //add bdt-navbar-dropdown for bdt navbar element
            $extra_class = 'stonex-megamenu bdt-navbar-dropdown';
            $item_output .= '<ul class="sub-menu ' . $extra_class . '" ' . $atts . '>';
            $item_output .= Common::get_elementor_content($item->object_id, true);
            $item_output .= '</ul>';
        }
        return $item_output;
    }

    /**
     * Add Magamenu item class in navbar
     *
     * @param [type] $classes
     * @param [type] $item
     * @return void>
     * @since 2.0.0
     */
    function megamenu_item_class($classes, $item)
    {
        if ($item->object === 'stonex-tb') {
            $item->url = apply_filters("stonex_tb_megamenu_url_{$item->object_id}", '#');
            $classes[] = "menu-item-has-children";
            $classes[] = "menu-item-has-megamenu";
            $settings  = get_post_meta($item->object_id, 'tb_settings', true);
            if ($settings['width'] === 'custom') {
                $classes[] = 'custom-width';
            }
            if ($settings['width'] === 'container') {
                $classes[] = 'container-width';
            }
        }
        return $classes;
    }
}
new Frontend();
