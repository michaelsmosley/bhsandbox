<?php

/**
 * Block Name: Benefits Link List with Images
 * Description: A link list with images showing different benefits
 *
 * Features:
 * - Eyebrow (Optional)
 * - Headline with link capability
 * - Primary CTA
 * - 2-3 cards with images and multiple CTAs
 * - No BG Color
 */

$eyebrow = get_field('eyebrow');
$headline = get_field('headline');
$primary_cta = get_field('primary_cta');
$cards = get_field('cards');

?>

<section class="benefit-link-list">
  <div class="benefit-link-list__header">
    <?php if ($eyebrow): ?>
      <div class="benefit-link-list__eyebrow">
        <?php echo esc_html($eyebrow); ?>
      </div>
    <?php endif; ?>

    <?php if ($headline): ?>
      <div class="benefit-link-list__headline">
        <?php echo wp_kses_post($headline); ?>
      </div>
    <?php endif; ?>

    <?php if ($primary_cta && !empty($primary_cta['cta_text']) && !empty($primary_cta['cta_url'])): ?>
      <a href="<?php echo esc_url($primary_cta['cta_url']); ?>"
        class="benefit-link-list__primary-cta btn btn-primary btn-primary-large button-m">
        <span><?php echo esc_html($primary_cta['cta_text']); ?></span>
        <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
      </a>
    <?php endif; ?>
  </div>

  <?php if ($cards): ?>
    <div class="benefit-link-list__grid">
      <?php foreach ($cards as $card):
        $image = $card['image'] ?? null;
        $heading = $card['heading'] ?? '';
        $description = $card['description'] ?? '';
        $cta_list = $card['cta_list'] ?? [];
        ?>
        <div class="benefit-link-list__item">
          <?php if ($image): ?>
            <div class="benefit-link-list__image">
              <?php echo get_responsive_image($image, 539, 303, array(
                'format' => 'jpeg',
                'quality' => 90,
                'size' => 'tablet'
              )); ?>
            </div>
          <?php endif; ?>

          <div class="benefit-link-list__content">
            <?php if ($heading): ?>
              <h3 class="benefit-link-list__title"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>

            <?php if ($description): ?>
              <div class="benefit-link-list__description">
                <?php echo wp_kses_post($description); ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($cta_list)): ?>
              <div class="benefit-link-list__cta-list">
                <?php foreach ($cta_list as $cta_item):
                  if ($cta_item && !empty($cta_item['cta_text']) && !empty($cta_item['cta_url'])):
                    ?>
                    <a href="<?php echo esc_url($cta_item['cta_url']); ?>" class="btn btn-text-link body-m">
                      <span><?php echo esc_html($cta_item['cta_text']); ?></span>
                      <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
                    </a>
                  <?php endif;
                endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>