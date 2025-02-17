<?php
function aim_register_post_types()
{
    // Events Post Type
    $labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'menu_name' => 'Events',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'view_item' => 'View Event',
        'search_items' => 'Search Events',
        'not_found' => 'No events found',
        'not_found_in_trash' => 'No events found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array(
            'slug' => 'events',
            'with_front' => false
        ),
        'taxonomies' => array('event_category', 'event_tag'),
    );

    register_post_type('event', $args);

    // Register Event Categories with basic slug
    register_taxonomy('event_category', 'event', array(
        'label' => 'Event Categories',
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => false  // Disable default rewrite
    ));

    // Register Event Tags
    register_taxonomy('event_tag', 'event', array(
        'label' => 'Event Tags',
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'event-tag'),
    ));


    // Testimonials Post Type
    $labelsTestimonials = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'menu_name' => 'Testimonials',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' => 'No testimonials found',
        'not_found_in_trash' => 'No testimonials found in Trash',
    );

    $argsTestimonials = array(
        'labels' => $labelsTestimonials,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'testimonials'),
    );

    register_post_type('testimonials', $argsTestimonials);
}
add_action('init', 'aim_register_post_types');

// Add custom rewrite rules
function aim_add_rewrite_rules()
{
    add_rewrite_rule(
        '^events/category/([^/]+)/?$',
        'index.php?event_category=$matches[1]',
        'top'
    );
}
add_action('init', 'aim_add_rewrite_rules', 10);

// Modify category links to match our desired URL structure
function aim_modify_event_category_link($url, $term, $taxonomy)
{
    if ($taxonomy === 'event_category') {
        return home_url('events/category/' . $term->slug);
    }
    return $url;
}
add_filter('term_link', 'aim_modify_event_category_link', 10, 3);
