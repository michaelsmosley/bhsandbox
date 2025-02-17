<?php
    /**
     * Block Name: Partner
     * Description: Partner block is a slider with image or video.
     */

    $eyebrow = get_field('eyebrow');
    $id = uniqid();
?>

<div class="aim__partners" id="<?php echo $id; ?>">
    <div class="aim__partners__content">
        <?php if ($eyebrow) : ?>
            <div class="aim__partners__eyebrow">
                <p><?php echo esc_html($eyebrow) ?></p>
                <div class="aim__partners__eyebrow__line"></div>
            </div>
        <?php endif; ?>
        <?php require get_template_directory() . '/blocks/partner/partner_media.php'; ?>
        <?php require get_template_directory() . '/blocks/partner/partner_tabs.php'; ?>
        <div class="aim__partners__slider-wrap">
            <?php require get_template_directory() . '/blocks/partner/partner_body.php'; ?>
            <div class="aim__partners__footer">
                <div class="aim__partners__footer__buttons">
                    <button class="aim__partners__prev-button" aria-label="Previous Slide">
                        <?php require get_template_directory() . '/assets/icons/arrow-right.svg' ?>
                    </button>
                    <button class="aim__partners__next-button" aria-label="Next Slide">
                        <?php require get_template_directory() . '/assets/icons/arrow-right.svg' ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="aim__partners--mobile" id="<?php echo $id; ?>">
    <div class="aim__partners--mobile__content">
        <?php if ($eyebrow) : ?>
            <div class="aim__partners__eyebrow">
                <p><?php echo esc_html($eyebrow) ?></p>
                <div class="aim__partners__eyebrow__line"></div>
            </div>
        <?php endif; ?>
        <?php require get_template_directory() . '/blocks/partner/partner_tabs_mobile.php'; ?>
    </div>
</div>