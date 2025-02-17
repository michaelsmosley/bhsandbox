<?php
/**
 * FAQ Block Template
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'faq-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$className = 'faq-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load FAQ items
$faq_items = get_field('faq_items');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h2 class="faq-block__title">Frequently Asked Question</h2>
    
    <?php if ($faq_items): ?>
        <div class="faq-block__items">
            <?php foreach ($faq_items as $item): ?>
                <div class="faq-block__item">
                    <button class="faq-block__question" aria-expanded="false">
                        <?php echo esc_html($item['question']); ?>
                        <span class="faq-block__toggle">
                            <span class="faq-block__toggle-icon">
                                <span class="plus-icon">
                                    <?php include get_template_directory() . '/assets/icons/plus-black.svg'; ?>
                                </span>
                                <span class="minus-icon">
                                    <?php include get_template_directory() . '/assets/icons/minus-black.svg'; ?>
                                </span>
                            </span>
                        </span>
                    </button>
                    <div class="faq-block__answer" hidden>
                        <div class="faq-block__answer-content">
                            <?php echo wp_kses_post($item['answer']); ?>
                            
                            <?php if (!empty($item['links'])): ?>
                                <div class="faq-block__link-wrapper">
                                <?php foreach ($item['links'] as $link): ?>
                                        <?php if (!empty($link['link'])): ?>
                                            <a href="<?php echo esc_url($link['link']['url']); ?>" 
                                               class="faq-block__link button"
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