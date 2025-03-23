<?php
defined('ABSPATH') || exit;
?>

<div class="yp-card yp-card-full">
    <div class="yp-card-header">
        <h2 class="yp-card-title">
            <span class="dashicons dashicons-admin-tools"></span>
            <?php _e('Quick Actions', 'yoopixel-admin-ui'); ?>
        </h2>
    </div>

    <div class="yp-action-grid">
        <a href="https://portal.yoopixel.com/clientarea.php?action=services" target="_blank" class="yp-icon-tile">
            <span class="dashicons dashicons-screenoptions"></span>
            <span class="yp-icon-label"><?php _e('My Services', 'yoopixel-admin-ui'); ?></span>
        </a>
        <a href="https://portal.yoopixel.com/supporttickets.php" target="_blank" class="yp-icon-tile">
            <span class="dashicons dashicons-sos"></span>
            <span class="yp-icon-label"><?php _e('Support Tickets', 'yoopixel-admin-ui'); ?></span>
        </a>
        <a href="https://portal.yoopixel.com/clientarea.php?action=invoices" target="_blank" class="yp-icon-tile">
            <span class="dashicons dashicons-media-spreadsheet"></span>
            <span class="yp-icon-label"><?php _e('My Invoices', 'yoopixel-admin-ui'); ?></span>
        </a>
                <a href="https://cloud.yoopixel.com" target="_blank"  class="yp-icon-tile">
            <span class="dashicons dashicons-cloud"></span>
            <span class="yp-icon-label"><?php _e('YOO Cloud', 'yoopixel-admin-ui'); ?></span>
        </a>
    </div>
</div>
