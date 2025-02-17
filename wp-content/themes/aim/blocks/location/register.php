<?php

acf_register_block_type([
    'name' => 'location',
    'title' => __('Location'),
    'description' => __('A block to display location information with a map'),
    'render_template' => 'blocks/location/location.php',
    'category' => 'formatting',
    'icon' => 'location',
    'keywords' => ['location', 'map', 'address'],
    'supports' => [
        'align' => true,
        'mode' => true,
        'jsx' => true
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/location/location.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('location-block', $file, array(), $version);
    },
]);
