<?php

/**
 * Block Name: Logo Marquee
 * Description: A right to left animating logo marquee block.
 */

$headline = get_field("headline");
$logo_images = get_field("logo_images");

?>

<div class="logo-marquee">
    <div class="logo-marquee__headline">
        <?php echo $headline; ?>
    </div>

    <?php if (!empty($logo_images) && is_array($logo_images)): ?>
        <div class="logo-marquee__logos-container">
            <div class="logo-marquee__logos">
                <?php foreach ($logo_images as $logo_image): ?>
                    <div class="logo-marquee__logo">
                        <img src="<?php echo esc_attr($logo_image["url"]); ?>"
                            alt="<?php echo esc_attr($logo_image["alt"]); ?>">
                    </div>
                <?php endforeach; ?>

                <!-- Hidden logos for marquee animation without end gap -->
                <?php foreach ($logo_images as $logo_image): ?>
                    <div class="logo-marquee__logo" aria-hidden="true">
                        <img src="<?php echo esc_attr($logo_image["url"]); ?>"
                            alt="<?php echo esc_attr($logo_image["alt"]); ?>">
                    </div>
                <?php endforeach; ?>
                <?php foreach ($logo_images as $logo_image): ?>
                    <div class="logo-marquee__logo" aria-hidden="true">
                        <img src="<?php echo esc_attr($logo_image["url"]); ?>"
                            alt="<?php echo esc_attr($logo_image["alt"]); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>