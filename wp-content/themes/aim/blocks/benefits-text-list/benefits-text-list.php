<?php

/**
 * Benefits Text List Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'benefits-text-list-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Get fields
$cards = get_field('cards');
?>

<section id="<?php echo esc_attr($id); ?>" class="benefits-text-list">
  <?php if (!empty(get_field('eyebrow'))): ?>
    <p class="benefits-text-list__eyebrow"><?php echo esc_html(get_field('eyebrow')); ?></p>
  <?php endif; ?>

  <?php if (!empty(get_field('headline'))): ?>
    <div class="benefits-text-list__headline">
      <?php echo wp_kses_post(get_field('headline')); ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($cards)): ?>
    <div class="benefits-text-list__grid">
      <?php foreach ($cards as $index => $card): ?>
        <div class="benefits-text-list__item">
          <label for="benefits-item-<?php echo esc_attr($index); ?>-<?php echo esc_attr($block['id']); ?>" class="benefits-text-list__item-header">
            <?php if (!empty($card['image'])): ?>
              <div class="benefits-text-list__item-image">
                <?php echo get_responsive_image($card['image'], 55, 55); ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($card['heading'])): ?>
              <h3 class="benefits-text-list__item-title"><?php echo esc_html($card['heading']); ?></h3>
              <span class="benefits-text-list__item-icon"></span>
            <?php endif; ?>
          </label>

          <input type="checkbox"
            id="benefits-item-<?php echo esc_attr($index); ?>-<?php echo esc_attr($block['id']); ?>"
            class="benefits-text-list__checkbox"
            hidden>

          <div class="benefits-text-list__item-content">
            <div class="benefits-text-list__item-content-inner">
              <?php if (!empty($card['description'])): ?>
                <div class="benefits-text-list__item-description">
                  <?php echo wp_kses_post($card['description']); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>