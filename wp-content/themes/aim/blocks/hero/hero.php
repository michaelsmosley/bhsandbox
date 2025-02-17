<?php
    /**
     * Block Name: Hero
     * Description: Hero block with background image and text overlay.
     */

    $location_tag = get_field("location_tag");
    $location_tag_icon = get_field("location_tag_icon");
    $copy = get_field("copy");
    $cta = get_field("cta");
    $image = get_field("image");
    $cta_over_image = get_field("cta_over_image");
    $airplane_swoosh_overlay = get_field("airplane_swoosh_overlay");

    $title = get_field('title');

    $hero_id = 'hero-' . uniqid();
?>

<div class="hero" id="<?php echo esc_attr($hero_id); ?>">
    <div class="hero__content">
        <div class="hero__text-container">
            <div class="hero__description">
                <div class="hero__location">
                    <?php if ($location_tag): ?>
                        <span class="hero__location-tag">
                            <?php if ($location_tag_icon): ?>
                                <?= get_responsive_image($location_tag_icon, 16, 16, ['lazy' => false, 'priority' => true]) ?>
                            <?php endif; ?>
                            <span class="hero__location-text h7"><?php echo $location_tag; ?></span>
                        </span>
                        <div class="hero__location-tag--fill"></div>
                    <?php endif; ?>
                    <?php echo ($copy); ?>
                </div>
            </div>

            <?php if ($cta && $cta["cta_text"]): ?>
                <a href="<?php echo esc_attr($cta['cta_url']); ?>" class="btn btn-secondary btn-secondary-large button-l hero__btn">
                    <?php echo $cta["cta_text"]; ?> <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="text"></div>
    </div>

    <div class="hero__image-container">
        <?php if ($image): ?>
            <?= get_responsive_image($image, 1920, 711, ['lazy' => false, 'priority' => true]) ?>
        <?php endif; ?>

        <?php if ($airplane_swoosh_overlay): ?>
            <div class="hero__image-swoosh">
                <?php include get_template_directory() . '/blocks/hero/airplane-swoosh.svg'; ?>
            </div>
        <?php endif; ?>

        <?php if ($cta_over_image && $cta_over_image["cta_text"]): ?>
            <a href="<?php echo esc_attr($cta_over_image['cta_url']); ?>"
                class="btn btn-primary btn-primary-large hero__overlay-button button-l hero__btn">
                <?php echo $cta_over_image["cta_text"]; ?>
                <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
            </a>
        <?php endif; ?>
    </div>
</div>