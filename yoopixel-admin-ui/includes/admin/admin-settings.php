<?php
/**
 * Plugin settings page handler
 */

defined('ABSPATH') || exit;

class YOOPixel_Admin_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']); // <-- إضافة جديدة
    }

    public function add_settings_page() {
        add_menu_page(
            __('YOOPixel Settings', 'yoopixel'),
            'YOOPixel',
            'manage_options',
            'yoopixel-settings',
            [$this, 'render_settings_page'],
            'dashicons-admin-settings',
            80
        );
    }

    public function register_settings() {
        // Primary Color
        register_setting('yoopixel_settings', 'yoopixel_primary_color', [
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#E89E43'
        ]);
        
        // Secondary Color (إضافة جديدة)
        register_setting('yoopixel_settings', 'yoopixel_secondary_color', [
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#2C3E50'
        ]);

        // Colors Section
        add_settings_section(
            'yoopixel_colors',
            __('Brand Colors', 'yoopixel'),
            [$this, 'render_colors_section'],
            'yoopixel-settings'
        );

        // Primary Color Field
        add_settings_field(
            'primary_color',
            __('Primary Color', 'yoopixel'),
            [$this, 'render_primary_color_picker'],
            'yoopixel-settings',
            'yoopixel_colors'
        );

        // Secondary Color Field (إضافة جديدة)
        add_settings_field(
            'secondary_color',
            __('Secondary Color', 'yoopixel'),
            [$this, 'render_secondary_color_picker'],
            'yoopixel-settings',
            'yoopixel_colors'
        );
    }

    // دالة جديدة لتحميل الأصول
    public function enqueue_admin_assets($hook) {
        if ($hook !== 'toplevel_page_yoopixel-settings') return;
        
        wp_enqueue_style(
            'yp-admin-settings',
            YOOPIXEL_PLUGIN_URL . 'assets/css/admin/settings.css',
            [],
            YOOPIXEL_VERSION
        );
        
        wp_enqueue_script(
            'yp-color-picker',
            YOOPIXEL_PLUGIN_URL . 'assets/js/admin/color-picker.js',
            ['jquery'],
            YOOPIXEL_VERSION,
            true
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap yp-settings-wrapper">
            <h1><?php _e('YOOPixel Settings', 'yoopixel') ?></h1>
            <form method="post" action="options.php">
                <?php 
                settings_fields('yoopixel_settings');
                do_settings_sections('yoopixel-settings');
                submit_button(__('Save Changes', 'yoopixel'));
                ?>
            </form>
        </div>
        <?php
    }

    public function render_colors_section() {
        echo '<p>' . __('Customize your admin interface colors', 'yoopixel') . '</p>';
    }

    public function render_primary_color_picker() {
        $color = get_option('yoopixel_primary_color');
        echo '<input type="color" name="yoopixel_primary_color" value="' . esc_attr($color) . '">';
        echo '<span class="description">' . __('Main brand color for buttons and highlights', 'yoopixel') . '</span>';
    }

    // دالة جديدة للون الثانوي
    public function render_secondary_color_picker() {
        $color = get_option('yoopixel_secondary_color');
        echo '<input type="color" name="yoopixel_secondary_color" value="' . esc_attr($color) . '">';
        echo '<span class="description">' . __('Secondary color for headers and accents', 'yoopixel') . '</span>';
    }
}

new YOOPixel_Admin_Settings();