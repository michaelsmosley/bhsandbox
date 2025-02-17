<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add the top-level menu for Footer Settings
function navigation_admin_menu() {
    add_menu_page(
        'Footer',                   // Page title
        'Footer settings',          // Menu title
        'manage_options',           // Capability
        'footer-settings',          // Menu slug
        'navigation_main_page',     // Callback function for the main page
        'dashicons-admin-generic',  // Icon
        30                          // Position
    );
}

add_action('admin_menu', 'navigation_admin_menu');

function navigation_main_page() {
    if (isset($_POST['save_footer_settings'])) {
        $address = sanitize_textarea_field($_POST['footer_address'] ?? '');
        $phone = sanitize_text_field($_POST['footer_phone'] ?? '');

        update_option('footer_address', $address);
        update_option('footer_phone', $phone);

        echo '<div class="updated"><p>Footer settings updated successfully!</p></div>';
    }

    $address = get_option('footer_address', '');
    $phone = get_option('footer_phone', '');

    ?>
    <div class="wrap">
        <h1>Footer settings</h1>
        <p>Manage footer settings below.</p>

        <div class="footer__settings__block">
            <h2>Contact information</h2>
            <form method="POST">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="footer_address">Address</label>
                        </th>
                        <td>
                            <input
                                type="text"
                                id="footer_address"
                                name="footer_address"
                                style="width: 100%;"
                                placeholder="Enter address"
                                value="<?php echo esc_textarea($address); ?>"
                            >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="footer_phone">Phone Number</label>
                        </th>
                        <td>
                            <input
                                type="text"
                                id="footer_phone"
                                name="footer_phone"
                                value="<?php echo esc_attr($phone); ?>"
                                style="width: 100%;"
                                placeholder="Enter phone number"
                            />
                        </td>
                    </tr>
                </table>
                <button type="submit" name="save_footer_settings" class="button-primary">Save Footer Settings</button>
            </form>
        </div>
        <style>
            .footer__settings__block {
                padding-top: 20px;
                margin-top: 40px;
                border-top: 1px solid gray;
            }
            .footer__settings__image>img {
                width: 100%;
                max-width: 1200px;
            }
        </style>
    <?php
}
