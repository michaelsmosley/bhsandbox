<?php

acf_register_block_type([
    'name' => 'events-grid',
    'title' => __('Events Grid'),
    'description' => __('A grid display of upcoming events'),
    'category' => 'aim-blocks',
    'icon' => 'grid-view',
    'keywords' => ['events', 'grid', 'calendar'],
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true
    ],
    'render_template' => 'blocks/events-grid/events-grid.php',
    'enqueue_style' => get_template_directory_uri() . '/assets/css/blocks/events-grid/events-grid.css',
]);