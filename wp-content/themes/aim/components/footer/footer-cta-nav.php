<?php
$locations = get_nav_menu_locations();

if (isset($locations['footer-cta-menu'])) {
    $menu = wp_get_nav_menu_object($locations['footer-cta-menu']);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    if ($menu_items) {
        foreach ($menu_items as $item) {
            $url = esc_url($item->url);
            $title = esc_html($item->title);
            $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $rel = !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : ' rel="nofollow"';

            echo '<a href="' . $url . '"' . $target . $rel . ' class="aim__button--outlined">' . $title . '</a>';
        }
    }
}
?>
