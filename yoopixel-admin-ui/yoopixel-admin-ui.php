<?php
/**
 * Plugin Name: YOOPixel Admin UI
 * Description: Custom WordPress admin interface for YOOPixel branding.
 * Version: 1.0.1
 * Author: YOOPixel Team
 * Text Domain: yoopixel
 */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('yoopixel-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap', false);
});
require_once plugin_dir_path(__FILE__) . 'includes/helpers/helper-functions.php';

// Start output buffering to prevent early output affecting WP Toolkit
ob_start();

defined('ABSPATH') || exit;

// Load core configuration
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/plugin-config.php';

// Initialize plugin components
//require_once YOOPIXEL_INCLUDES_DIR . 'init.php';

// Load admin interface
require_once YOOPIXEL_ADMIN_DIR . 'class-admin-dashboard.php';
require_once YOOPIXEL_ADMIN_DIR . 'admin-settings.php';

// Load frontend customizations
require_once YOOPIXEL_FRONTEND_DIR . 'login-customizer.php';

// Register activation/deactivation hooks
register_activation_hook(__FILE__, 'yoopixel_activate');
register_deactivation_hook(__FILE__, 'yoopixel_deactivate');

/**
 * Plugin activation handler
 */
function yoopixel_activate() {
    add_option('yoopixel_primary_color', '#E89E43');
    add_option('yoopixel_secondary_color', '#1A1A1A');
}

/**
 * Plugin deactivation handler
 */
function yoopixel_deactivate() {
    // Cleanup if necessary
}

// Flush output buffer on shutdown
add_action('shutdown', function () {
    if (ob_get_length()) {
        ob_end_flush();
    }
});
