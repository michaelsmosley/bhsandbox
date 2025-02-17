<?php

/**
 * Block Name: Feature Program
 * Description: A block to feature an academic program.
 */

$eyebrow = get_field('eyebrow');
$headline = get_field('headline');
$image = get_field('image');
$information_bar = get_field('information_bar');
$additional_sections = get_field('additional_section');

?>

<div class="feature-program">
  <div class="feature-program__main">
    <div class="feature-program__content">
      <?php if ($eyebrow): ?>
        <div class="eyebrow">
          <span class="eyebrow-text"><?php echo esc_html($eyebrow); ?></span>
        </div>
      <?php endif; ?>

      <?php if ($headline) : ?>
        <div class="feature-program__headline">
          <?php echo wp_kses_post($headline); ?>
        </div>
      <?php endif; ?>

      <?php if ($image) : ?>
        <div class="feature-program__image">
          <?=
          get_responsive_image($image, 1920, 711, ['lazy' => false, 'priority' => true]);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($information_bar['datetime']) : ?>
        <div class="feature-program__details">
            <div class="feature-program__detail">
              <span class="feature-program__detail-label body-m-emphasis">Next Start Date</span>
                <?php foreach ($information_bar['datetime'] as $datetime) : ?>
                    <?php if ($datetime['start_date']) : ?>
                        <span class="feature-program__detail-value body-l"><?php echo esc_html($datetime['start_date']); ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="feature-program__detail">
              <span class="feature-program__detail-label body-m-emphasis">Program Duration</span>
              <?php foreach ($information_bar['datetime'] as $datetime) : ?>
                  <?php if ($datetime['program_duration']) : ?>
                      <span class="feature-program__detail-value body-l"><?php echo esc_html($datetime['program_duration']); ?></span>
                  <?php endif; ?>
              <?php endforeach; ?>
            </div>
            <div class="feature-program__detail">
              <span class="feature-program__detail-label body-m-emphasis">Credit Hours</span>
                <?php foreach ($information_bar['datetime'] as $datetime) : ?>
                    <?php if ($datetime['credit_hours']) : ?>
                        <span class="feature-program__detail-value body-l"><?php echo esc_html($datetime['credit_hours']); ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
          <?php if ($information_bar['campus_offerings']) : ?>
            <div class="feature-program__detail">
              <span class="feature-program__detail-label body-m-emphasis">Campuses Offering</span>
              <div class="feature-program__campus-list">
                <?php foreach ($information_bar['campus_offerings'] as $campus) : ?>
                  <div class="feature-program__campus-item button-s">
                      <?php if($campus['url']): ?>
                        <a href="<?php echo esc_html($campus['url']); ?>" class="feature-program__campus-item-text">
                          <?php echo esc_html($campus['city'] . ', ' . $campus['state']); ?>
                        </a>
                    <?php else: ?>
                        <span class="feature-program__campus-item-text">
                          <?php echo esc_html($campus['city'] . ', ' . $campus['state']); ?>
                        </span>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($additional_sections) : ?>
    <div class="feature-program__sections">
      <?php foreach ($additional_sections as $section) : ?>
        <div class="feature-program__section">
          <?php if ($section['section_eyebrow']): ?>
            <div class="feature-program__section-eyebrow">
              <?php echo esc_html($section['section_eyebrow']); ?>
            </div>
          <?php endif; ?>

          <?php if ($section['section_headline']): ?>
            <div class="feature-program__section-headline">
              <?php echo wp_kses_post($section['section_headline']); ?>
            </div>
          <?php endif; ?>

          <?php if ($section['section_body']): ?>
            <div class="feature-program__section-content body-l">
              <?php echo wp_kses_post($section['section_body']); ?>
            </div>
          <?php endif; ?>


          <?php if ($section['section_cta'] && !empty($section['section_cta']['title']) && !empty($section['section_cta']['url'])): ?>
            <a href="<?php echo esc_url($section['section_cta']['url']); ?>" target="<?php echo esc_attr($section['section_cta']['target']); ?>"
              class="feature-program__section-cta btn btn-primary btn-primary-large button-m">
              <span><?php echo esc_html($section['section_cta']['title']); ?></span>
              <?php include get_template_directory() . '/assets/icons/utility-arrow.svg'; ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>