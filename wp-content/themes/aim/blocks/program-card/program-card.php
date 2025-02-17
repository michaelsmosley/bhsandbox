<?php
    /**
     * Block Name: Program Card
     * Description: A grid of program cards with images and titles
     */

    $eyebrow = get_field('eyebrow');
    $headline = get_field('headline');
    $primary_cta = get_field('primary_cta');
    $max_cards_per_row = get_field('max_cards_per_row');  // can be 2, 3, 4
    $cards = get_field('cards');
?>

<section class="program-card">
  <div class="program-card__header">
    <div class="program-card__header-content">
      <?php if ($eyebrow): ?>
        <div class="program-card__eyebrow">
          <?php echo esc_html($eyebrow); ?>
        </div>
      <?php endif; ?>

      <?php if ($headline): ?>
        <div class="program-card__headline">
          <?php echo wp_kses_post($headline); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if ($primary_cta && !empty($primary_cta['cta_text']) && !empty($primary_cta['cta_url'])): ?>
      <a href="<?php echo esc_url($primary_cta['cta_url']); ?>" class="program-card__primary-cta btn btn-secondary btn-secondary-large button-l">
        <span><?php echo esc_html($primary_cta['cta_text']); ?></span>
        <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
      </a>
    <?php endif; ?>
  </div>

  <?php if (!empty($cards)): ?>
    <div class="program-card__grid program-card__grid--<?php echo esc_attr($max_cards_per_row); ?>-col">
        <?php foreach ($cards as $card): ?>
            <a href="<?php echo esc_url($card['cta_url']); ?>" title="<?php echo $card['cta_text']; ?>">
                <div class="program-card__item">
                  <div class="program-card__item-header btn btn-tertiary button-m">
                    <?php if (!empty($card['cta_text']) && !empty($card['cta_url'])): ?>
                      <div class="program-card__item-title">
                        <span><?php echo esc_html($card['cta_text']); ?></span>
                      </div>
                      <div class="program-card__item-cta">
                        <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <?php if (!empty($card['image'])): ?>
                    <div class="program-card__image">
                      <?php echo get_responsive_image($card['image']["url"], 800, 800, array('format' => 'jpeg', 'quality' => 99)); ?>
                    </div>
                  <?php endif; ?>

                  <div class="program-card__content">
                    <?php if (!empty($card['name'])): ?>
                      <h3 class="program-card__title"><?php echo esc_html($card['name']); ?></h3>
                    <?php endif; ?>
                  </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
  <?php endif; ?>

</section>