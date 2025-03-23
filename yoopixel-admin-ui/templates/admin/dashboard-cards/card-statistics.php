<?php
defined('ABSPATH') || exit;
?>

<div class="yp-dashboard-grid">
    <!-- Welcome Card -->
    <div class="yp-card yp-card-left">
        <h2 class="yp-card-title"><?php _e('Welcome to YOOPixel Dashboard', 'yoopixel-admin-ui'); ?></h2>
        <p class="yp-card-text"><?php _e('We are glad to have you here! Access your tools and services easily from below.', 'yoopixel-admin-ui'); ?></p>
    </div>

    <!-- Quick Actions as Grid Icons -->
    <div class="yp-card yp-card-right">
        <div class="yp-card-header">
            <h2 class="yp-card-title">
                <span class="dashicons dashicons-admin-tools"></span>
                <?php _e('Quick Actions', 'yoopixel-admin-ui'); ?>
            </h2>
        </div>

        <div class="yp-icon-grid">
            <a href="#" class="yp-icon-tile">
                <span class="dashicons dashicons-sos"></span>
                <span class="yp-icon-label"><?php _e('Open Ticket', 'yoopixel-admin-ui'); ?></span>
            </a>
            <a href="#" class="yp-icon-tile">
                <span class="dashicons dashicons-media-spreadsheet"></span>
                <span class="yp-icon-label"><?php _e('My Invoices', 'yoopixel-admin-ui'); ?></span>
            </a>
            <!-- يمكنك إضافة المزيد من البلاطات هنا -->
        </div>
    </div>
</div>
