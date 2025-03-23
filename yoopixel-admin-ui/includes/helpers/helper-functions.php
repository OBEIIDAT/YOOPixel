<?php
defined('ABSPATH') || exit;

/**
 * Get submenu items for a given top-level menu slug (supports partial match).
 */
function yp_get_submenu_items($menu_slug) {
    // 1. تهيئة البيئة الإدارية
    if (!function_exists('_wp_admin_menu')) {
        require_once ABSPATH . 'wp-admin/includes/admin.php';
    }

    // 2. تحميل بيانات المستخدم والصلاحيات
    if (!function_exists('wp_get_current_user')) {
        require_once ABSPATH . 'wp-includes/pluggable.php';
    }

    // 3. إعادة بناء القوائم من الصفر
    global $menu, $submenu;
    $menu = $submenu = array();
    _wp_admin_menu();

    // 4. البحث في القوائم (يبقى كما هو)
    error_log("🔎 Searching for submenu slug: $menu_slug");
    
    if (isset($submenu[$menu_slug])) {
        return yp_format_submenu_items($submenu[$menu_slug]);
    }

    foreach ($submenu as $key => $items) {
        if (strpos($key, $menu_slug) !== false) {
            return yp_format_submenu_items($items);
        }
    }

    return [];
}

/**
 * Ajax handler مع التهيئة الشاملة
 */
add_action('wp_ajax_yp_get_submenu_items', function () {
    if (!current_user_can('manage_options')) { // استخدام صلاحية أقوى
        wp_send_json_error(['message' => 'Unauthorized'], 403);
    }

    // 1. تهيئة الأساسيات
    require_once ABSPATH . 'wp-admin/includes/admin.php';
    
    // 2. محاكاة كاملة لبيئة الأدمن
    do_action('admin_init');
    do_action('admin_menu');
    do_action('admin_enqueue_scripts');

    // 3. إصلاح مشكلة ضغط الإخراج
    if (ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', 'Off');
    }

    // 4. معالجة الطلب
    $menu_slug = sanitize_text_field($_GET['menu_slug'] ?? '');
    $items = yp_get_submenu_items($menu_slug);
    
    wp_send_json_success($items);
});