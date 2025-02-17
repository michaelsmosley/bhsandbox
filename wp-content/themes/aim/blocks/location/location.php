<?php
/**
 * Location Block Template
 */

// Get block fields
$eyebrow = get_field('eyebrow');
$address = get_field('address');
$phone = get_field('phone');
$fax = get_field('fax');
$virtual_tour_url = get_field('virtual_tour_url');
$map_embed_url = get_field('map_embed_url');

// Format Google Maps link from address
$google_maps_url = 'https://www.google.com/maps/search/' . urlencode($address);
?>

<div class="location">
    <div class="location__container">
        <div class="location__info">
            <?php if ($eyebrow): ?>
                <h8 class="location__eyebrow">
                    <?php echo esc_html($eyebrow); ?>
                </h8>
                <div class="location__eyebrow-line"></div>
            <?php endif; ?>

            <h2 class="location__title">Address & Contact Information</h2>

            <?php if ($address): ?>
                <div class="location__address">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/map-wide-black.svg' ?>"
                        alt="Map Icon" class="location__icon" />
                    <a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html($address); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($phone): ?>
                <div class="location__phone">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/phone-black.svg' ?>" alt="Phone Icon"
                        class="location__icon" />
                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone); ?>">
                        Phone: <?php echo esc_html($phone); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($fax): ?>
                <div class="location__fax">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/printer-black.svg' ?>"
                        alt="Printer Icon" class="location__icon" />
                    <span>Fax: <?php echo esc_html($fax); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($virtual_tour_url): ?>
                <div class="location__virtual-tour">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/video-black.svg' ?>" alt="Video Icon"
                        class="location__icon" />
                    <a href="<?php echo esc_url($virtual_tour_url); ?>" target="_blank" rel="noopener noreferrer">
                        Virtual Campus Tour
                        <img src="<?php echo get_template_directory_uri() . '/assets/icons/arrow-top-right-black.svg' ?>"
                            alt="Arrow" class="location__arrow-icon" />
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($map_embed_url): ?>
            <div class="location__map">
                <a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" rel="noopener noreferrer">
                    <iframe src="<?php echo esc_url($map_embed_url); ?>" width="100%" height="400" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>