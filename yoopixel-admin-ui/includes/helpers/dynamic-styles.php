<?php
defined('ABSPATH') || exit;

/**
 * توليد ملف CSS ديناميكي بناءً على إعدادات الألوان.
 * يتم حفظ الملف في assets/css/yoopixel-dynamic.css فقط عند وجود تغييرات.
 */
function yoopixel_generate_dynamic_css() {
    // استرجاع الإعدادات من قاعدة البيانات مع قيم افتراضية
    $primary   = get_option('yoopixel_primary_color', '#E89E43');
    $secondary = get_option('yoopixel_secondary_color', '#1A1A1A');

    // إعداد محتوى CSS بشكل نصي
    $css  = ":root {\n";
    $css .= "    --yp-primary: " . esc_attr($primary) . ";\n";
    $css .= "    --yp-secondary: " . esc_attr($secondary) . ";\n";
    $css .= "}\n\n";
    $css .= ".yoopixel-button {\n";
    $css .= "    background-color: var(--yp-primary);\n";
    $css .= "    color: #fff;\n";
    $css .= "    border: none;\n";
    $css .= "    padding: 10px 16px;\n";
    $css .= "    border-radius: 6px;\n";
    $css .= "}\n";
    $css .= ".yoopixel-button:hover {\n";
    $css .= "    opacity: 0.9;\n";
    $css .= "}\n";

    // حساب مسار مجلد الإضافة الأساسي (الذي يحتوي على assets/)
    // بما أن هذا الملف موجود في /includes/helpers/، نعود لمستوى الجذر عبر dirname مرتين.
    $plugin_root = dirname(dirname(__DIR__));

    // تحديد مسار ملف CSS الذي سيتم إنشاؤه
    $css_file_path = $plugin_root . '/assets/css/yoopixel-dynamic.css';

    // التأكد من وجود مجلد assets/css، وإن لم يكن موجودًا يتم إنشاؤه
    $css_dir = dirname($css_file_path);
    if (!file_exists($css_dir)) {
        if (!mkdir($css_dir, 0755, true)) {
            error_log('Failed to create directory: ' . $css_dir);
            return;
        }
    }

    // تحقق إذا كان الملف موجودًا بالفعل ومحتواه مطابق للمحتوى الجديد
    if (file_exists($css_file_path)) {
        $existing_css = file_get_contents($css_file_path);
        if ($existing_css === $css) {
            // لا حاجة للتحديث
            return;
        }
    }

    // كتابة المحتوى إلى الملف مع التحقق من الأخطاء
    if (false === file_put_contents($css_file_path, $css)) {
        error_log('Failed to write dynamic CSS to: ' . $css_file_path);
    }
}

// استدعاء الدالة لتوليد/تحديث ملف CSS
yoopixel_generate_dynamic_css();
