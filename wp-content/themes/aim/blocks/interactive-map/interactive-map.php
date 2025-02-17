<?php
    /**
     * Block Name: Interactive Map
     * Description: Interactive map component
     */

    $locations = array_map(function ($location) {
        return [
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
            'city' => $location['city'],
            'state' => $location['state'],
            'url' => $location['url']
        ];
    }, get_field('locations') ?: []);
    $states = array_unique(array_column($locations, 'state'));
    $heading = get_field('heading');
    $description = get_field('description');
    $cta_text = get_field('cta_text');
    $cta_link = get_field('cta_link');
    $eyebrow = get_field('eyebrow');
?>

<div class="interactive-map__block">
    <div class="interactive-map__container">
        <div class="interactive-map__text-container">
            <h8 class="interactive-map__eyebrow">
                <?php echo esc_html($eyebrow); ?>
            </h8>
            <div class="interactive-map__eyebrow-line"></div>
            <?php if ($heading): ?>
                <h2 class="interactive-map__heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="interactive-map__description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>

            <?php if ($cta_text && $cta_link): ?>

                <a href="<?php echo esc_url($cta_link); ?>" class="btn btn-primary button-l">
                    <?php echo esc_html($cta_text); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <g clip-path="url(#clip0_7902_12557)">
                            <path d="M7.42969 20.3789L20.6629 7.1457" stroke="black" stroke-miterlimit="10" />
                            <path
                                d="M7.94727 7.0332C11.1543 8.10123 19.706 8.10272 20.7755 7.0332C19.706 8.10272 19.7075 16.6544 20.7755 19.8614"
                                stroke="black" stroke-miterlimit="10" />
                        </g>
                        <defs>
                            <clipPath id="clip0_7902_12557">
                                <rect width="18.874" height="18.8384" fill="white"
                                    transform="translate(0.769531 13.7188) rotate(-45)" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="interactive-map__visual-container">
            <div id="map" data-locations='<?php echo esc_attr(json_encode($locations)); ?>'
                data-states='<?php echo esc_attr(json_encode($states)); ?>'>
            </div>
            <div class="interactive-map__location-buttons">
                <?php foreach ($locations as $index => $location): ?>
                    <?php if(esc_html($location['url'])): ?>
                        <a href="<?php echo esc_url($location['url']); ?>" class="interactive-map__location-button"
                            data-index="<?php echo $index; ?>">
                            <?php echo esc_html($location['city'] . ', ' . $location['state']); ?>
                        </a>
                    <?php else: ?>
                        <button type="button" class="interactive-map__location-button"
                            data-index="<?php echo $index; ?>">
                            <?php echo esc_html($location['city'] . ', ' . $location['state']); ?>
                        </button>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>