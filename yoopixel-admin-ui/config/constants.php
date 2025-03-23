<?php
/**
 * الثوابت الأساسية للإضافة
 */

defined('ABSPATH') || exit;

// ==============================================
// 1. مسارات الملفات الأساسية
// ==============================================
define('YOOPIXEL_VERSION', '1.0.0');
define('YOOPIXEL_PLUGIN_FILE', __FILE__);
define('YOOPIXEL_PLUGIN_DIR', plugin_dir_path(dirname(__FILE__)));
define('YOOPIXEL_PLUGIN_URL', plugin_dir_url(dirname(__FILE__)));

// ==============================================
// 2. مسارات المجلدات الداخلية
// ==============================================
define('YOOPIXEL_INCLUDES_DIR', YOOPIXEL_PLUGIN_DIR . 'includes/');
define('YOOPIXEL_ADMIN_DIR', YOOPIXEL_INCLUDES_DIR . 'admin/');
define('YOOPIXEL_FRONTEND_DIR', YOOPIXEL_INCLUDES_DIR . 'frontend/');
define('YOOPIXEL_HELPERS_DIR', YOOPIXEL_INCLUDES_DIR . 'helpers/');
define('YOOPIXEL_SECURITY_DIR', YOOPIXEL_INCLUDES_DIR . 'security/');
define('YOOPIXEL_TEMPLATES_DIR', YOOPIXEL_PLUGIN_DIR . 'templates/');

// ==============================================
// 3. إعدادات العلامة التجارية
// ==============================================
define('YOOPIXEL_PRIMARY_COLOR', '#E89E43');
define('YOOPIXEL_SECONDARY_COLOR', '#2C3E50');
define('YOOPIXEL_LOGO_URL', YOOPIXEL_PLUGIN_URL . 'assets/images/yoopixel.png');

// ==============================================
// 4. مسارات الملفات الديناميكية
// ==============================================
define('YOOPIXEL_DYNAMIC_CSS_URL', YOOPIXEL_PLUGIN_URL . 'includes/helpers/dynamic-styles.php');
define('YOOPIXEL_SETTINGS_PAGE_SLUG', 'yoopixel-settings');

// ==============================================
// 5. إعدادات الأمان
// ==============================================
define('YOOPIXEL_MIN_PHP_VERSION', '7.4');
define('YOOPIXEL_MIN_WP_VERSION', '5.6');