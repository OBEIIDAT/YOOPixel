<?php
defined('ABSPATH') || exit;
?>

<div class="yp-card yp-card-full">
  <div class="yp-card-header">
    <h2 class="yp-card-title">
      <span class="dashicons dashicons-admin-site"></span>
      <?php _e('Website Management', 'yoopixel-admin-ui'); ?>
    </h2>
  </div>

  <div class="yp-icon-grid-boxes">
    <!-- Posts -->
    <a href="javascript:void(0);" class="yp-icon-tile" onclick="ypShowPopup('posts')">
      <span class="dashicons dashicons-welcome-write-blog"></span>
      <span class="yp-icon-label"><?php _e('Posts', 'yoopixel-admin-ui'); ?></span>
    </a>

    <!-- Media -->
    <a href="javascript:void(0);" class="yp-icon-tile" onclick="ypShowPopup('media')">
      <span class="dashicons dashicons-format-image"></span>
      <span class="yp-icon-label"><?php _e('Media', 'yoopixel-admin-ui'); ?></span>
    </a>

    <!-- Plugins -->
    <a href="javascript:void(0);" class="yp-icon-tile" onclick="ypShowPopup('plugins')">
      <span class="dashicons dashicons-admin-plugins"></span>
      <span class="yp-icon-label"><?php _e('Plugins', 'yoopixel-admin-ui'); ?></span>
    </a>

    <!-- Users -->
    <a href="javascript:void(0);" class="yp-icon-tile" onclick="ypShowPopup('users')">
      <span class="dashicons dashicons-admin-users"></span>
      <span class="yp-icon-label"><?php _e('Users', 'yoopixel-admin-ui'); ?></span>
    </a>

    <!-- Pages (رابط ثابت فقط) --><!-- Pages -->
    <a href="javascript:void(0);" class="yp-icon-tile" onclick="ypShowPopup('pages')">
      <span class="dashicons dashicons-admin-page"></span>
      <span class="yp-icon-label"><?php _e('Pages', 'yoopixel-admin-ui'); ?></span>
    </a>

  </div>
</div>
