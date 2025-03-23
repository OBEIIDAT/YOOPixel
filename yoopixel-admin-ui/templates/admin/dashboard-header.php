<?php
defined('ABSPATH') || exit;

// Get current user info
$current_user = wp_get_current_user();
$user_name = esc_html($current_user->display_name);
$user_avatar = esc_url(get_avatar_url($current_user->ID));
$logo_url = esc_url(plugins_url('assets/images/yoopixel_Dark.png', dirname(__FILE__, 2)));
?>

<header class="yp-header">
    <div class="yp-header-left">
        <img src="<?php echo $logo_url; ?>" alt="YOOPixel Logo" class="yp-logo">
    </div>

    <div class="yp-header-center">
        <label class="yp-switch">
            <input type="checkbox" id="yp-toggle-clean-view">
            <span class="yp-slider"></span>
        </label>
    </div>

    <div class="yp-header-right">
        <div class="yp-notifications">
            <span class="dashicons dashicons-megaphone"></span>
            <span class="notification-count">3</span>
        </div>

        <div class="yp-user-info">
            <img src="<?php echo $user_avatar; ?>" alt="<?php echo $user_name; ?>" class="yp-user-photo">
            <span class="yp-user-name"><?php echo $user_name; ?></span>

            <div class="yp-user-dropdown">
                <span class="yp-user-name-dropdown"><?php echo $user_name; ?></span>
                <a href="<?php echo esc_url(get_edit_profile_url($current_user->ID)); ?>">
                    <span class="dashicons dashicons-admin-users"></span> Edit Profile
                </a>
                <a href="<?php echo esc_url(wp_logout_url()); ?>">
                    <span class="dashicons dashicons-migrate"></span> Log Out
                </a>
            </div>
        </div>
    </div>
</header>
