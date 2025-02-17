<?php

acf_register_block_type([
    'name' => 'interactive-map',
    'title' => __('Interactive Map'),
    'description' => __('A custom interactive map component block.'),
    'render_template' => 'blocks/interactive-map/interactive-map.php',
    'category' => 'formatting',
    'icon' => 'location-alt',
    'keywords' => ['map', 'interactive'],
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true
    ],
    'enqueue_assets' => function () {
        wp_enqueue_script('d3', 'https://cdn.jsdelivr.net/npm/d3@7', array(), null, true);
        wp_enqueue_script('topojson', 'https://cdn.jsdelivr.net/npm/topojson@3', array('d3'), null, true);

        $path = '/blocks/interactive-map/interactive-map.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_script('interactive-map-block-js', $file, array('d3', 'topojson'), $version, true);

        $path = '/assets/css/blocks/interactive-map/interactive-map.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('interactive-map-block', $file, array(), $version);
    }
]);
