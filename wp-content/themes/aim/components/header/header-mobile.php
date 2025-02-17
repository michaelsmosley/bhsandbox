<header class="aim__header-mobile">
    <div class="aim__header-mobile__top-bar">
        <a href="<?php echo get_home_url(); ?>" class="aim__header-mobile__top-bar__logo">
            <?php require get_template_directory() . "/assets/svg/aim-logo.svg" ?>
        </a>
        <button
          id="aim-header-mobile-top-hamburger"
          class="aim__header-mobile__hamburger"
          onclick="toggleHamburgerState()">
            <img class="aim__header-mobile__hamburger--open" src="<?php echo get_template_directory_uri(); ?>/assets/icons/hamburger.svg" alt="Open" />
            <img class="aim__header-mobile__hamburger--close" src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="Close" />
        </button>
    </div>
    <div class="aim__header-mobile__dropdown" id="aim-header-mobile-top-navigation">
        <div>
        <?php
            $locations = get_nav_menu_locations();
            if (isset($locations['header-menu'])) {
                $menu = wp_get_nav_menu_object($locations['header-menu']);
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                if ($menu_items) {
                    $menu_tree = [];
                    foreach ($menu_items as $item) {
                        $menu_tree[$item->menu_item_parent][] = $item;
                    }
                    if (!empty($menu_tree[0])) {
                        foreach ($menu_tree[0] as $parent_item) {
                            $has_children = !empty($menu_tree[$parent_item->ID]);
                            echo '<details class="aim__header-mobile__nav-group"' . (!$has_children ? ' open' : '') . '>';
                            echo '<summary class="aim__header-mobile__nav-group__section"><span>' . esc_html($parent_item->title) . '</span>';
                            if ($has_children) {
                                echo '<img src="' . get_template_directory_uri() . '/assets/icons/chevron-down.svg" alt="" class="aim__header-mobile__nav-group__arrow-down" />';
                            }
                            echo '</summary>';
                            if ($has_children) {
                                echo '<div class="aim__header-mobile__nav-group__section__links">';
                                foreach ($menu_tree[$parent_item->ID] as $child_item) {
                                    $has_grandchildren = !empty($menu_tree[$child_item->ID]);
                                    if ($has_grandchildren) {
                                        echo '<div>';
                                        if(esc_html($child_item->title) !== '-') {
                                            echo '<div class="aim__header-mobile__nav-group__section__title">' . esc_html($child_item->title) . '</div>';
                                        }
                                        echo '<div class="aim__header-mobile__nav-group__section__sub-links">';
                                        foreach ($menu_tree[$child_item->ID] as $grandchild_item) {
                                            echo '<a class="aim__header-mobile__nav-group__section__sub-link-wrap" href="' . esc_url($grandchild_item->url) . '">';
                                                echo '<span class="aim__header-mobile__nav-group__section__sub-link">' . esc_html($grandchild_item->title) . '</span>
                                                <img src="' . get_template_directory_uri() . '/assets/icons/arrow-top-right-black.svg" alt="" class="aim__header-mobile__nav-group__arrow-right" />';
                                            echo '</a>';
                                        }
                                        echo '</div>';

                                        echo '</div>';
                                    } else {
                                        echo '<a class="aim__header-mobile__nav-group__section__sub-link" href="' . esc_url($child_item->url) . '">' . esc_html($child_item->title) . '</a>';
                                    }
                                }
                                echo '</div>';
                            }
                            echo '</details>';
                        }
                    }
                }
            }
        ?>
        </div>
        <div class="aim__header-mobile__dropdown__cta">
            <?php
                $walker = new Separate_Parent_Child_Walker();
                wp_nav_menu(array(
                'theme_location' => 'header-cta-menu',
                'walker' => $walker,
                'echo' => false,
                ));

                foreach ($walker->parent_items as $parent) {
                    echo '<a href="'. esc_html($parent->url) .'" class="aim__header-mobile__dropdown__cta__button">';
                    echo esc_html($parent->title);
                    echo '<img src="' .  get_template_directory_uri() . '/assets/icons/arrow-top-right.svg" alt="" class="aim__header-mobile__dropdown__cta__icon" /></a>';
                }
            ?>
        </div>
    </div>
</header>