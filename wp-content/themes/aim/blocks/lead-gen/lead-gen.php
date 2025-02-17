<?php
// Get fields or use preview data
$quiz_section = get_field('quiz_section');
$info_section = get_field('info_section');

// If in preview and no data is set, use example data
if (empty($quiz_section) && !empty($block['data'])) {
    $quiz_section = $block['data']['quiz_section'];
    $info_section = $block['data']['info_section'];
}

// Set default values if nothing is set
if (empty($quiz_section)) {
    $quiz_section = [
        'headline' => 'Take Our Career Readiness Quiz',
        'body' => 'Add your quiz description here',
        'cta' => 'Start Quiz',
        'link' => '#'
    ];
}

if (empty($info_section)) {
    $info_section = [
        'headline' => 'Request More Information',
        'body' => 'Add your information request description here',
        'cta' => 'Learn More',
        'link' => '#'
    ];
}

// Add unique ID for the block
$id = 'lead-gen-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className"
$className = 'lead-gen-container';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if (is_admin()): ?>
        <div class="lead-gen-cta">
        <?php else: ?>
            <a href="<?php echo esc_url($quiz_section['link']); ?>" class="lead-gen-cta" target="_self">
            <?php endif; ?>
            <div class="lead-gen-item lead-gen-item-1">
                <div class="lead-gen-content">
                    <div>
                        <h3><?php echo esc_html($quiz_section['headline']); ?></h3>
                        <p><?php echo $quiz_section['body']; ?></p>
                    </div>
                    <div class="lead-gen-icon">
                        <?php include get_template_directory() . '/blocks/lead-gen/open-url.svg'; ?>
                    </div>
                </div>
            </div>
            <?php if (is_admin()): ?>
        </div>
    <?php else: ?>
        </a>
    <?php endif; ?>

    <?php if (is_admin()): ?>
        <div class="lead-gen-cta">
        <?php else: ?>
            <a href="<?php echo esc_url($info_section['link']); ?>" class="lead-gen-cta" target="_self">
            <?php endif; ?>
            <div class="lead-gen-item lead-gen-item-2">
                <div class="lead-gen-content">
                    <div>
                        <h3><?php echo esc_html($info_section['headline']); ?></h3>
                        <p><?php echo $info_section['body']; ?></p>
                    </div>
                    <div class="lead-gen-icon">
                        <?php include get_template_directory() . '/blocks/lead-gen/open-url.svg'; ?>
                    </div>
                </div>
            </div>
            <?php if (is_admin()): ?>
        </div>
    <?php else: ?>
        </a>
    <?php endif; ?>
</div>