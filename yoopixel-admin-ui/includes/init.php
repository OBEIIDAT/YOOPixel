<?php
defined('ABSPATH') || exit;

// 1. Load security checks FIRST
require_once YOOPIXEL_INCLUDES_DIR . 'security/security-checks.php';

// 2. Verify system requirements
if (!yoopixel_check_requirements()) {
    add_action('admin_notices', 'yoopixel_show_requirements_error');
    return;
}

// 3. Load admin components
require_once YOOPIXEL_ADMIN_DIR . 'class-admin-dashboard.php';
require_once YOOPIXEL_ADMIN_DIR . 'admin-settings.php';

// 4. Load frontend components
require_once YOOPIXEL_FRONTEND_DIR . 'login-customizer.php';

// 5. Load dynamic styles AFTER WordPress is fully loaded
add_action('wp_loaded', function() {
    require_once YOOPIXEL_HELPERS_DIR . 'dynamic-styles.php';
});