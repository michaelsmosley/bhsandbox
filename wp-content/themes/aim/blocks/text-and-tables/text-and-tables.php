<?php
/** Block Name: Text and Tables */

$eyebrow = get_field('eyebrow');
$title = get_field('title');
$body = get_field('body');
$link_label = get_field('link_label');
$link_page = get_field('link_page');
$table_eyebrow = get_field('table_eyebrow');
$table_eyebrow_right = get_field('table_eyebrow_right');
$tables = get_field('tables');
?>

<div class="aim__text-and-tables">
    <div>
        <?php if ($eyebrow) : ?>
            <div class="aim__text-and-tables__eyebrow">
                <div class="aim__text-and-tables__eyebrow__content-row">
                    <span><?php echo esc_html($eyebrow) ?></span>
                </div>
                <div class="aim__text-and-tables__eyebrow__line"></div>
            </div>
        <?php endif; ?>

        <?php if ($title) : ?>
            <h3 class="aim__text-and-tables__title h3"><?php echo $title; ?></h3>
        <?php endif; ?>

        <?php if ($body) : ?>
            <div class="aim__text-and-tables__body">
                <?php echo $body; ?>
            </div>
        <?php endif; ?>

        <?php if ($link_label && $link_page) : ?>
            <a href="<?php echo $link_page ?>" class="aim__text-and-tables__link">
                <?php echo $link_label; ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-top-right-black.svg"
                     class="aim__text-and-tables__link__icon"
                     alt="Arrow icon"/>
            </a>
        <?php endif; ?>
    </div>
    <div>
        <?php if ($table_eyebrow || $table_eyebrow_right) : ?>
            <div class="aim__text-and-tables__eyebrow">
                <div class="aim__text-and-tables__eyebrow__content-row">
                    <span><?php echo esc_html($table_eyebrow) ?></span>
                    <span><?php echo esc_html($table_eyebrow_right) ?></span>
                </div>
                <div class="aim__text-and-tables__eyebrow__line aim__text-and-tables__eyebrow__line--full"></div>
            </div>
        <?php endif; ?>

        <div class="aim__text-and-tables__tables">
            <?php if (!empty($tables)) :
                foreach ($tables as $tab) : ?>
                    <div class="aim__text-and-tables__tables__table">
                        <p class="aim__text-and-tables__tables__table__title"><?php echo $tab['title']; ?></p>
                        <div class="aim__text-and-tables__tables__table__container">
                            <?php
                            if (!empty($tab['table'])) {
                                foreach ($tab['table'] as $tableContainer) {
                                    if (!isset($tableContainer['table'])) {
                                        continue;
                                    }

                                    $table = $tableContainer['table'];
                                    ?>
                                    <div class="aim__text-and-tables__tables__table__grid">
                                        <?php if (!empty($table['use_header']) && !empty($table['header'])) : ?>
                                            <div class="aim__text-and-tables__tables__table__grid__header-row">
                                                <?php foreach ($table['header'] as $headerCell) : ?>
                                                    <div class="aim__text-and-tables__tables__table__grid__header-cell">
                                                        <?php echo $headerCell['c']; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($table['body'])) :
                                            foreach ($table['body'] as $rowIndex => $row) : ?>
                                                <div class="aim__text-and-tables__tables__table__grid__body-row">
                                                    <?php foreach ($row as $cellIndex => $cell) :
                                                        // Determine if this is first or last cell for modifiers
                                                        $cell_classes = 'aim__text-and-tables__tables__table__grid__body-cell';
                                                        if ($cellIndex === 0) {
                                                            $cell_classes .= ' aim__text-and-tables__tables__table__grid__body-cell--first';
                                                        }
                                                        if ($cellIndex === count($row) - 1) {
                                                            $cell_classes .= ' aim__text-and-tables__tables__table__grid__body-cell--last';
                                                        }
                                                        ?>
                                                        <div class="<?php echo $cell_classes; ?>">
                                                            <?php echo isset($cell['c']) ? $cell['c'] : ''; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endforeach;
                                        endif; ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>
