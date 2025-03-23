<?php
/**
 * Security checks and requirements verification
 */

defined('ABSPATH') || exit;

if (!function_exists('yoopixel_check_requirements')) {
    function yoopixel_check_requirements() {
        // Minimum PHP version required
        $min_php = '7.4';
        
        // Minimum WordPress version required
        $min_wp = '5.6';
        
        // Check PHP version
        $php_valid = version_compare(PHP_VERSION, $min_php, '>=');
        
        // Check WordPress version
        global $wp_version;
        $wp_valid = version_compare($wp_version, $min_wp, '>=');
        
        return $php_valid && $wp_valid;
    }
}

if (!function_exists('yoopixel_show_requirements_error')) {
    function yoopixel_show_requirements_error() {
        $message = sprintf(
            esc_html__('YOOPixel Admin UI Error: Requires PHP %1$s+ and WordPress %2$s+', 'yoopixel'),
            '7.4',
            '5.6'
        );
        echo '<div class="notice notice-error"><p><strong>' . esc_html($message) . '</strong></p></div>';
    }
}
