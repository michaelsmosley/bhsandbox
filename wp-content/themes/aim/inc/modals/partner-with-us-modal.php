<?php
function aim_partner_modal()
{
    ?>
    <div id="<?php echo uniqid(); ?>" class="contact-us-modal modals" modal_url="#partner-with-us">
        <div class="contact-us-modal-content">
            <button class="contact-us-modal-close modal-close">
                <?php include get_template_directory() . '/assets/icons/close.svg'; ?>
            </button>
            <div class="modal-body">
                <?php
                if (class_exists('GFAPI')) {
                    $form = GFAPI::get_form(3);
                    if (is_wp_error($form)) {
                        echo "Error: " . $form->get_error_message();
                    } else {
                        gravity_form(3, true, true, false, null, true);
                    }
                } else {
                    echo "Error: Gravity Forms API not available";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

add_action('wp_footer', 'aim_partner_modal');
?>