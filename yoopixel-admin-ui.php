<?php
/*
Plugin Name: YOOPixel Admin UI
Description: Customizes the WordPress login page with YOOPixel branding.
Version: 1.0
Author: Rami @ YOOPixel
*/

defined('ABSPATH') || exit;

// ✅ تحميل ملفات CSS و JS لصفحة تسجيل الدخول
function yoopixel_enqueue_login_assets() {
    // تحميل ملف CSS
    wp_enqueue_style(
        'yoopixel-login-style',
        plugin_dir_url(__FILE__) . 'assets/css/login-style.css',
        [],
        '1.0'
    );

    // تحميل ملف JS
    wp_enqueue_script(
        'yoopixel-login-script',
        plugin_dir_url(__FILE__) . 'assets/js/login-script.js',
        [],
        '1.0',
        true
    );
}
add_action('login_enqueue_scripts', 'yoopixel_enqueue_login_assets');

// ✅ تغيير رابط شعار صفحة تسجيل الدخول
add_filter('login_headerurl', function () {
    return 'https://www.yoopixel.com';
});

// ✅ تغيير التولتيب عند تمرير الماوس على الشعار
add_filter('login_headertext', function () {
    return 'Yoopixel - Smart Web Solutions';
});

// ✅ استدعاء صفحة الإعدادات الخاصة بـ YOOPixel UI
require_once plugin_dir_path(__FILE__) . 'yoopixel-settings.php';
