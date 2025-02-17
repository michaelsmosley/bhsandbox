<?php
    /**
     * Rail Navigation Block Template
     */

    $className = 'rail-nav';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

    $headline = get_field('headline');
    $nav_items = get_field('navigation_items');
?>

<div class="<?php echo esc_attr($className); ?>">
    <div class="rail-nav__side">
        <nav class="rail-nav__nav">
            <?php if ($headline): ?>
                <h2 class="rail-nav__headline"><?php echo esc_html($headline); ?></h2>
            <?php endif; ?>
            <?php if ($nav_items): ?>
                <!-- Mobile Dropdown -->
                <select class="rail-nav__select">
                    <?php foreach ($nav_items as $item):
                        $title = $item['navigation_title'];
                        $section_id = $item['section_id'];
                    ?>
                        <option value="<?php echo esc_attr($section_id); ?>">
                           <?php echo esc_html($title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Desktop Navigation -->
                <ul class="rail-nav__list">
                    <?php foreach ($nav_items as $item):
                        $title = $item['navigation_title'];
                        $section_id = $item['section_id'];

                        // Determine the appropriate href format
                        $is_full_url = strpos($section_id, 'http') === 0;
                        $is_relative = strpos($section_id, '/') === 0 || strpos($section_id, './') === 0;
                        $href = $is_full_url || $is_relative
                            ? $section_id
                            : '#' . $section_id;
                    ?>
                        <li class="rail-nav__item">
                            <a href="<?php echo esc_attr($href); ?>" class="rail-nav__link">
                                <?php echo esc_html($title); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </nav>
    </div>

    <div class="rail-nav__content">
        <InnerBlocks />
    </div>
</div>