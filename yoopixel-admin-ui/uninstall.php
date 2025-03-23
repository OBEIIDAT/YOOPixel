<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// Remove plugin options
delete_option('yoopixel_settings');

// Remove custom capabilities
$roles = wp_roles();
foreach ($roles->roles as $role => $details) {
    $roles->remove_cap($role, 'manage_yoopixel');
}