<?php
/**
 * Checklist Block Template
 */

// Get block fields
$headline = get_field('headline');
$body_copy = get_field('body_copy');
$columns_heading_a = get_field('columns_heading_a');
$columns_heading_b = get_field('columns_heading_b');
$column_a = get_field('column_a');
$column_b = get_field('column_b');
?>

<div class="checklist">
    <div class="checklist__text-content-wrapper">
        <div class="checklist__text-content">
            <?php if ($headline): ?>
                <h2 class="checklist__headline"><?php echo $headline; ?></h2>
            <?php endif; ?>

            <?php if ($body_copy): ?>
                <div class="checklist__body"><?php echo $body_copy; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="checklist__columns">
        <div class="checklist__columns-grid">
            <?php if ($column_a): ?>
                <div class="checklist__column">
                    <h3
                        class="checklist__columns-heading<?php echo !$columns_heading_a ? ' checklist__columns-heading--empty' : ''; ?>">
                        <?php if ($columns_heading_a): ?>
                            <?php echo $columns_heading_a; ?>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
                    </h3>
                    <ul class="checklist__items">
                        <?php foreach ($column_a as $item): ?>
                            <li class="checklist__item <?php echo get_field('checkmark_color'); ?>">
                                <?php include get_template_directory() . '/blocks/checklist/checkmark.svg'; ?>

                                <span class="checklist__text"><?php echo $item['text']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($column_b): ?>
                <div class="checklist__column">
                    <h3
                        class="checklist__columns-heading<?php echo !$columns_heading_b ? ' checklist__columns-heading--empty' : ''; ?>">
                        <?php if ($columns_heading_b): ?>
                            <?php echo $columns_heading_b; ?>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
                    </h3>
                    <ul class="checklist__items">
                        <?php foreach ($column_b as $item): ?>
                            <li class="checklist__item <?php echo get_field('checkmark_color'); ?>">
                                <?php include get_template_directory() . '/blocks/checklist/checkmark.svg'; ?>

                                <span class="checklist__text"><?php echo $item['text']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>