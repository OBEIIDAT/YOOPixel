<?php
/**
 * Login Page Customizer
 */

defined('ABSPATH') || exit;

class YOOPixel_Login_Customizer {
    public function __construct() {
        add_action('login_enqueue_scripts', [$this, 'enqueue_assets']);
        add_filter('login_headerurl', [$this, 'custom_login_logo_url']);
        add_filter('login_headertext', [$this, 'custom_login_logo_text']);
        add_action('login_footer', [$this, 'add_custom_links']);
    }

    // ==============================================
    // تحميل الأنماط والسيناريوهات
    // ==============================================
    public function enqueue_assets() {
        // تحميل فقط في صفحة تسجيل الدخول
        if ($GLOBALS['pagenow'] !== 'wp-login.php') return;

        // الأنماط الأساسية
        wp_enqueue_style(
            'yoopixel-login-core',
            YOOPIXEL_PLUGIN_URL . 'assets/css/frontend/yp-login.css',
            [],
            YOOPIXEL_VERSION
        );

        // الأنماط الديناميكية
        wp_enqueue_style(
            'yoopixel-login-dynamic',
            YOOPIXEL_DYNAMIC_CSS_URL,
            ['yoopixel-login-core'],
            YOOPIXEL_VERSION
        );
    }

    // ==============================================
    // تخصيص رابط الشعار
    // ==============================================
    public function custom_login_logo_url() {
        return esc_url('https://www.yoopixel.com');
    }

    // ==============================================
    // تخصيص نص الشعار
    // ==============================================
    public function custom_login_logo_text() {
        return esc_html__('YOOPixel Control Panel', 'yoopixel');
    }

    // ==============================================
    // إضافة الروابط المخصصة
    // ==============================================
    public function add_custom_links() {
        echo '<div class="yoopixel-login-links">';
        
        // رابط YOOPixel
        echo sprintf(
            '<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
            esc_url('https://www.yoopixel.com'),
            esc_html__('YOOPixel', 'yoopixel')
        );
        
        // فاصل
        echo '<span class="yp-footer-separator">|</span>';
        
        // رابط البوابة
        echo sprintf(
            '<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
            esc_url('https://portal.yoopixel.com'),
            esc_html__('YOOPixel Portal', 'yoopixel')
        );
        
        echo '</div>';
    }
}

new YOOPixel_Login_Customizer();