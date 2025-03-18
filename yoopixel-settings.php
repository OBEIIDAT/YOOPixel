<?php
// Add settings page to the Settings menu
add_action('admin_menu', function () {
    add_options_page(
        'YOOPixel Admin UI Settings',
        'YOOPixel UI',
        'manage_options',
        'yoopixel-ui-settings',
        'yoopixel_ui_settings_page'
    );
});

// Register the setting
add_action('admin_init', function () {
    register_setting('yoopixel_ui_settings_group', 'yoopixel_custom_dashboard');
});

// Render settings page
function yoopixel_ui_settings_page() {
    ?>
    <div class="wrap">
        <h1>YOOPixel Admin UI Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('yoopixel_ui_settings_group'); ?>
            <?php do_settings_sections('yoopixel_ui_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable YOOPixel Dashboard UI</th>
                    <td>
                        <input type="checkbox" name="yoopixel_custom_dashboard" value="yes" <?php checked(get_option('yoopixel_custom_dashboard'), 'yes'); ?> />
                        <label for="yoopixel_custom_dashboard">Activate the custom dashboard interface</label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
?>
