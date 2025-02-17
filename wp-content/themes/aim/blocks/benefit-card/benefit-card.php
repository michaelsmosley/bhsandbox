<?php

/**
 * Block Name: Benefit Card
 * Description: A benefit card block.
 *
 * Features:
 * - Eyebrow (Optional)
 * - Headline with CTA link
 * - 3 Program Cards
 * - Hover state on whole card
 * - No BG Color
 */

$eyebrow = get_field("eyebrow");
$headline = get_field("headline");
$cards = get_field("cards");
?>

<section class="benefit-card">
  <div class="benefit-card__content">
    <div class="benefit-card__text-container">
      <?php if ($eyebrow): ?>
        <div class="benefit-card__eyebrow">
          <span class="benefit-card__eyebrow-text"><?php echo esc_html($eyebrow); ?></span>
        </div>
      <?php endif; ?>

      <?php if ($headline): ?>
        <div class="benefit-card__description">
          <?php echo wp_kses_post($headline); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($cards): ?>
    <div class="benefit-card__cards">
      <?php foreach ($cards as $card): ?>
        <?php
        $program_card = $card['program_cards'];
        if (!empty($program_card)):
          $image = $program_card['image'] ?? null;
          $cta = $program_card['cta'] ?? null;
          ?>
          <?php if ($cta): ?>
            <a href="<?php echo esc_url($cta['cta_url']); ?>" class="benefit-card__card">
              <div class="benefit-card__cta button-m">
                <span><?php echo esc_html($cta['cta_text']); ?></span>
                <div class="benefit-card__cta-icon">
                  <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
                </div>
              </div>
              <?php if ($image): ?>
                <div class="benefit-card__card-image">
                  <?php echo get_responsive_image($image, 552, 310, array(
                    'format' => 'jpeg',
                    'quality' => 90,
                    'size' => 'tablet'
                  )); ?>
                </div>
              <?php endif; ?>
            </a>
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>