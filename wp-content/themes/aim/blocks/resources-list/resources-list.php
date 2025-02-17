<?php
/**
 * Resources List Block Template
 */

// Get block fields
$headline = get_field('headline');
$body_copy = get_field('body_copy');
$columns_heading_a = get_field('columns_heading_a');
$columns_heading_b = get_field('columns_heading_b');
$column_a = get_field('column_a');
$column_b = get_field('column_b');
?>

<div class="resources-list">
    <div class="resources-list__text-content-wrapper">
        <div class="resources-list__text-content">
            <?php if ($headline): ?>
                <h2 class="resources-list__headline"><?php echo $headline; ?></h2>
            <?php endif; ?>

            <?php if ($body_copy): ?>
                <div class="resources-list__body"><?php echo $body_copy; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="resources-list__columns">
        <div class="resources-list__columns-grid">
            <?php if ($column_a): ?>
                <div class="resources-list__column">
                    <h3
                        class="resources-list__columns-heading<?php echo !$columns_heading_a ? ' resources-list__columns-heading--empty' : ''; ?>">
                        <?php if ($columns_heading_a): ?>
                            <?php echo $columns_heading_a; ?>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
                    </h3>
                    <ul class="resources-list__items">
                        <?php foreach ($column_a as $item): ?>
                            <li class="resources-list__item">
                                <?php if ($item['icon']): ?>
                                    <img class="resources-list__icon" src="<?php echo $item['icon']['url']; ?>" alt="Icon">
                                <?php endif; ?>

                                <?php if ($item['link']): ?>
                                    <a href="<?php echo $item['link']['url']; ?>" class="resources-list__link">
                                        <?php echo $item['link']['title']; ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/blocks/resources-list/link-arrow.svg" alt="Arrow">
                                    </a>
                                <?php else: ?>
                                    <span class="resources-list__text"><?php echo $item['text']; ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($column_b): ?>
                <div class="resources-list__column">
                    <h3
                        class="resources-list__columns-heading<?php echo !$columns_heading_b ? ' resources-list__columns-heading--empty' : ''; ?>">
                        <?php if ($columns_heading_b): ?>
                            <?php echo $columns_heading_b; ?>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
                    </h3>
                    <ul class="resources-list__items">
                        <?php foreach ($column_b as $item): ?>
                            <li class="resources-list__item">
                                <?php if ($item['icon']): ?>
                                    <img class="resources-list__icon" src="<?php echo $item['icon']['url']; ?>" alt="Icon">
                                <?php endif; ?>

                                <?php if ($item['link']): ?>
                                    <a href="<?php echo $item['link']['url']; ?>" class="resources-list__link">
                                        <?php echo $item['link']['title']; ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/blocks/resources-list/link-arrow.svg" alt="Arrow">
                                    </a>
                                <?php else: ?>
                                    <span class="resources-list__text"><?php echo $item['text']; ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>