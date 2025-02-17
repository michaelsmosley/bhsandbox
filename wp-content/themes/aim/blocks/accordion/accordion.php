<?php

/**
 * Accordion Block Template
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$className = 'accordion-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load Accordion items
$accordion_items = get_field('accordion_items');

$faq_title = get_field('header_text');
$is_header_colored = get_field('is_header_colored');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h2 class="accordion-block__title <?php echo $is_header_colored ? 'accordion-block__title--colored' : ''; ?>">
        <?php echo esc_html($faq_title); ?>
    </h2>

    <?php if ($accordion_items): ?>
        <div class="accordion-block__items">
            <?php foreach ($accordion_items as $item): ?>
                <div class="accordion-block__item">
                    <button class="accordion-block__question" aria-expanded="false">
                        <?php echo esc_html($item['question']); ?>
                        <span class="accordion-block__toggle">
                            <span class="accordion-block__toggle-icon">
                                <?php include get_template_directory() . '/assets/icons/plus-black.svg'; ?>
                            </span>
                        </span>
                    </button>
                    <div class="accordion-block__answer" hidden>
                        <div class="accordion-block__answer-content">
                            <?php echo wp_kses_post($item['answer']); ?>

                            <?php if (!empty($item['links'])): ?>
                                <div class="accordion-block__link-wrapper">
                                    <?php foreach ($item['links'] as $link): ?>
                                        <?php if (!empty($link['link'])): ?>
                                            <a href="<?php echo esc_url($link['link']['url']); ?>"
                                                class="accordion-block__link button"
                                                <?php echo !empty($link['link']['target']) ? 'target="' . esc_attr($link['link']['target']) . '"' : ''; ?>>
                                                <?php echo esc_html($link['link']['title']); ?>
                                                <?php include get_template_directory() . '/assets/icons/arrow-top-right-black.svg'; ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>