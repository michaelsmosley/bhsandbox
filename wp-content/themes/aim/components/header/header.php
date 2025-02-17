<header class="aim__header" id="aim-header">
    <div class="aim__header__container">
        <?php require_once "logo.php" ?>
        <div class="aim__header__menu">
            <nav class="parent-menu">
                <?php
                    $walker = new Separate_Parent_Child_Walker();
                    wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'walker' => $walker,
                    'echo' => false,
                    ));
                    echo '<ul>';
                    foreach ($walker->parent_items as $parent) {
                        echo '<li class="menu-item" id="parent-' . esc_attr($parent->ID) . '" data-parent-id="' . esc_attr($parent->ID) . '"><span>'.esc_html($parent->title).'<div class="aim__header__underline" /></span></li>';
                    }
                    echo '</ul>';
                ?>
            </nav>
        </div>
    </div>
    <div class="aim__header__dropdown">
            <div class="aim__header__dropdown__menu">
                <div class="aim__header__dropdown__heading">
                    <?php
                        $walker = new Separate_Parent_Child_Walker();
                        wp_nav_menu(array(
                        'theme_location' => 'header-menu',
                        'walker' => $walker,
                        'echo' => false,
                        ));

                        foreach ($walker->parent_items as $parent) {
                            echo '<ul class="child-menu">';
                            echo '<li class="menu-item child-of-' . esc_attr($parent->ID) . '" data-child-of="' . esc_attr($parent->ID) . '">';
                            echo '<span class="aim__header__dropdown__heading__title">' . esc_html($parent->title) . '</span>';
                            echo '</li>';
                            echo '</ul>';
                        }
                    ?>
                </div>
                <nav class="aim__header__dropdown__nav">
                    <?php
                        $walker = new Separate_Parent_Child_Walker();

                        $menu = wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'walker' => $walker,
                            'echo' => false,
                        ));

                        echo '<ul class="child-menu aim__header__dropdown__nav__links">';

                        foreach ($walker->child_items as $child) {

                            $has_grandchildren = false;
                            foreach ($walker->child_items as $potential_grandchild) {
                                if ($potential_grandchild->menu_item_parent == $child->ID) {
                                    $has_grandchildren = true;
                                    break;
                                }
                            }
                            echo '<li class="child-of-' . esc_attr($child->menu_item_parent) . '" data-child-of="' . esc_attr($child->menu_item_parent) . '">';

                            if($has_grandchildren) {
                                if(esc_html($child->title) !== '-') {
                                    echo '<p class="caption-emphasis aim__header__dropdown__nav__links__section-title">' . esc_html($child->title) . '</p>';
                                }
                            } else {
                                echo '<a class="aim__header__dropdown__nav__links__link" href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a>';
                             }


                            if ($has_grandchildren) {
                            echo '<div class="grandchild-menu  aim__header__dropdown__nav__sub-links">';
                                    foreach ($walker->child_items as $grandchild) {
                                        if ($grandchild->menu_item_parent == $child->ID) {
                                            echo '<div>';
                                            echo '<a class="aim__header__dropdown__nav__links__link" href="' . esc_url($grandchild->url) . '">' . esc_html($grandchild->title) . '</a>';
                                            echo '</div>';
                                        }
                                    }
                                 echo '</div>';


                            }

                            echo '</li>';
                        }

                        echo '</ul>';
                    ?>
                </nav>
        </div>
        <div class="aim__header__dropdown__cta">
            <?php
                $walker = new Separate_Parent_Child_Walker();
                wp_nav_menu(array(
                'theme_location' => 'header-cta-menu',
                'walker' => $walker,
                'echo' => false,
                ));

                foreach ($walker->parent_items as $parent) {
                    echo '<a href="'. esc_html($parent->url) .'" class="aim__header__dropdown__cta__button">';
                    echo esc_html($parent->title);
                    echo '<img src="' .  get_template_directory_uri() . '/assets/icons/arrow-top-right.svg" alt="" class="aim__header__dropdown__cta__icon" /></a>';
                }
            ?>
        </div>
    </div>
</header>