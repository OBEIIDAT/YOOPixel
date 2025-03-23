<?php
defined('ABSPATH') || exit;

function yp_handle_get_submenu_items() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized', 403);
    }

    if (!isset($_GET['menu_slug'])) {
        wp_send_json_error('Missing menu_slug', 400);
    }

    $menu_slug = sanitize_text_field($_GET['menu_slug']);
    global $submenu;

    if (!isset($submenu[$menu_slug]) || !is_array($submenu[$menu_slug])) {
        wp_send_json_success([]); // Return empty array if not found
    }

    $items = [];

    foreach ($submenu[$menu_slug] as $submenu_item) {
        $items[] = [
            'label' => wp_strip_all_tags($submenu_item[0]),
            'url'   => admin_url($submenu_item[2]),
            'icon'  => 'dashicons-arrow-right-alt2' // Placeholder icon
        ];
    }

    wp_send_json_success($items);
}
