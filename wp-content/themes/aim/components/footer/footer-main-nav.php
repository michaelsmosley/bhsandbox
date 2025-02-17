    <?php
    $locations = get_nav_menu_locations();
    if (isset($locations['footer-menu'])) {
        $menu = wp_get_nav_menu_object($locations['footer-menu']);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        if ($menu_items) {
            $menu_tree = [];
            foreach ($menu_items as $item) {
                $menu_tree[$item->menu_item_parent][] = $item;
            }

            if (!empty($menu_tree[0])) {
                foreach ($menu_tree[0] as $parent_item) {
                    echo '<details class="aim__footer__nav-group" open>';
                    echo '<summary class="aim__footer__nav-group__section"><span>' . esc_html($parent_item->title) . '</span>';
                    if (!empty($menu_tree[$parent_item->ID])) {
                        echo '<img src="' .  get_template_directory_uri() . '/assets/icons/chevron-down.svg" alt="" class="aim__footer__nav-group__arrow-down">';
                    }
                    echo'</summary>';
                    if (!empty($menu_tree[$parent_item->ID])) {
                        echo '<div class="aim__footer__nav-group__section__links">';
                        foreach ($menu_tree[$parent_item->ID] as $child_item) {
                            echo '<a class="button-s" href="' . esc_url($child_item->url) . '">' . esc_html($child_item->title) . '</a>';
                        }
                        echo '</div>';
                    }
                    echo '</details>';
                }
            }
        }
    }
    ?>
