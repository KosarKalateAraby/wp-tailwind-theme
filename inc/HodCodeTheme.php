<?php

class HodCodeTheme
{
    protected static $instance = null;
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new HodCodeTheme();

        return self::$instance;

    }

    protected function __construct()
    {

    }

    public function init()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('custom-logo');

        foreach (get_class_methods(self::class) as $method) {
            if (substr($method, 0, strlen("register")) == "register")
                $this->{$method}();
        }


    }

    private function registerMenu()
    {
        add_action('init', function () {
            register_nav_menus(
                array (
                    'header-menu' => __('Header Menu'),
                    'footer-menu' => __('Footer Menu')
                )
            );
        });

    }


    // This function allows upload of svg files to WP media library
    private function registerSVG()
    {

        add_filter('upload_mimes', function ($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        });

    }

    private function _registerCustomizer()
    {
        add_action('customize_register', function ($wp_customize) {
            // Add a new section in the Customizer
            $wp_customize->add_section(
                'ThemeCustomSettings',
                array (
                    'title' => __('Custom Settings', 'mytheme'),
                    'priority' => 30,
                )
            );

            // Add a setting for the form IDs
            $wp_customize->add_setting(
                'CustomSettings',
                array (
                    'default' => '',
                    'type' => 'theme_mod',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => 'sanitize_text_field', // Sanitizes the input as a text field
                )
            );

            // Add a text control for the form IDs
            $wp_customize->add_control(
                'CustomSettings_control',
                array (
                    'label' => __('Form IDs', 'mytheme'),
                    'section' => 'ThemeCustomSettings',
                    'settings' => 'CustomSettings',
                    'type' => 'text',
                )
            );
        });

    }

    public static function getCustomSettings($type)
    {
        return get_theme_mod('CustomSettings', '');

    }

    private function registerLoadAsModule()
    {
        add_filter('script_loader_tag', function ($tag, $handle, $src) {

            if ('main' === $handle) {
                $tag = '<script type="module" src="' . esc_url($src) . '" id="scripts" ></script>';
            }
            return $tag;
        }, 10, 3);
    }

}