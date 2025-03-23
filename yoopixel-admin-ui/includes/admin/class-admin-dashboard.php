<?php
/**
 * Handles admin dashboard functionality
 */

defined('ABSPATH') || exit;

class YOOPixel_Admin_Dashboard {
    public function __construct() {
        // تحميل سكربتات YOOPixel
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);

        // تسجيل صفحات YOOPixel
        add_action('admin_menu', [$this, 'add_dashboard_pages']);
    }

    /**
     * تحميل الأصول (أنماط/سكريبتات) الخاصة بلوحة YOOPixel
     * @param string $hook اسم الصفحة الحالية
     */
    public function enqueue_scripts($hook) {
        if (!function_exists('get_current_screen')) {
            return;
        }

        $current_screen = get_current_screen();

        if (
            empty($current_screen) ||
            !in_array($current_screen->id, [
                'toplevel_page_yoopixel-dashboard',
                'yoopixel_page_yoopixel-posts',
                'yoopixel_page_yoopixel-pages'
            ])
        ) {
            return;
        }

        // المسارات الموحدة
        $plugin_path = plugin_dir_path(__DIR__) . '../';
        $plugin_url  = plugins_url('', $plugin_path . 'yoopixel-admin-ui.php');

        // تحميل الأنماط
        wp_enqueue_style(
            'yp-dynamic-styles',
            $plugin_url . '/includes/helpers/dynamic-styles.php',
            [],
            filemtime($plugin_path . 'includes/helpers/dynamic-styles.php')
        );

        wp_enqueue_style(
            'yp-admin-core',
            $plugin_url . '/assets/css/admin/yp-admin-core.css',
            ['yp-dynamic-styles'],
            filemtime($plugin_path . 'assets/css/admin/yp-admin-core.css')
        );

        wp_enqueue_style(
            'yp-dashboard-style',
            $plugin_url . '/assets/css/admin/yp-dashboard.css',
            ['yp-admin-core'],
            filemtime($plugin_path . 'assets/css/admin/yp-dashboard.css')
        );

        wp_enqueue_style(
            'yp-popup-style',
            $plugin_url . '/assets/css/admin/yp-popup.css',
            ['yp-dashboard-style'],
            filemtime($plugin_path . 'assets/css/admin/yp-popup.css')
        );

        // تحميل السكربتات
        wp_enqueue_script(
            'yp-admin-scripts',
            $plugin_url . '/assets/js/admin/yp-admin-core.js',
            ['jquery'],
            filemtime($plugin_path . 'assets/js/admin/yp-admin-core.js') . '-' . time(),
            true
        );

        wp_enqueue_script(
            'yoopixel-menus',
            $plugin_url . '/assets/js/admin/yp-menus.js',
            [],
            filemtime($plugin_path . 'assets/js/admin/yp-menus.js'),
            true
        );

        wp_enqueue_script(
            'yp-popup-script',
            $plugin_url . '/assets/js/admin/yp-popup.js',
            [],
            filemtime($plugin_path . 'assets/js/admin/yp-popup.js'),
            true
        );
    }

    /**
     * تسجيل صفحات YOOPixel في القائمة الجانبية
     */
    public function add_dashboard_pages() {
        // الصفحة الرئيسية
        add_menu_page(
            __('YOOPixel', 'yoopixel'),
            __('YOOPixel', 'yoopixel'),
            'manage_options',
            'yoopixel-dashboard',
            [$this, 'render_dashboard'],
            'dashicons-admin-generic',
            2
        );

        // صفحة المنشورات
        add_submenu_page(
            'yoopixel-dashboard',
            __('Manage Posts', 'yoopixel'),
            __('Posts', 'yoopixel'),
            'manage_options',
            'yoopixel-posts',
            [$this, 'render_posts_page']
        );

        // صفحة الصفحات
        add_submenu_page(
            'yoopixel-dashboard',
            __('Manage Pages', 'yoopixel'),
            __('Pages', 'yoopixel'),
            'manage_options',
            'yoopixel-pages',
            [$this, 'render_pages_page']
        );
    }

    /**
     * عرض صفحة لوحة التحكم الرئيسية
     */
    public function render_dashboard() {
        $yp_inner_page = plugin_dir_path(__FILE__) . '../../templates/admin/dashboard-page.php';
        include plugin_dir_path(__FILE__) . '../../templates/admin/layout/page-wrapper.php';
    }

    /**
     * عرض صفحة YOOPixel Posts
     */
    public function render_posts_page() {
        $yp_inner_page = plugin_dir_path(__FILE__) . '../../templates/admin/pages/posts.php';
        include plugin_dir_path(__FILE__) . '../../templates/admin/layout/page-wrapper.php';
    }

    /**
     * عرض صفحة YOOPixel Pages
     */
    public function render_pages_page() {
        $yp_inner_page = plugin_dir_path(__FILE__) . '../../templates/admin/pages/pages.php';
        include plugin_dir_path(__FILE__) . '../../templates/admin/layout/page-wrapper.php';
    }
}

new YOOPixel_Admin_Dashboard();
