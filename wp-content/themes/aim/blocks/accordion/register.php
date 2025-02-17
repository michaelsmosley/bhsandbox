<?php

acf_register_block_type([
    'name' => 'accordion',
    'title' => __('Accordion'),
    'description' => __('A collapsible Accordion section'),
    'render_template' => 'blocks/accordion/accordion.php',
    'category' => 'formatting',
    'icon' => 'editor-help',
    'keywords' => ['accordion', 'questions', 'answers'],
    'supports' => [
        'align' => true,
        'mode' => true,
        'jsx' => true,
        'anchor' => true
    ],
    'enqueue_assets' => function () {
        $path = '/blocks/accordion/accordion.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_script('accordion-block', $file, array('jquery'), $version, true);

        $path = '/assets/css/blocks/accordion/accordion.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('accordion-block', $file, array(), $version);
    },
]);
