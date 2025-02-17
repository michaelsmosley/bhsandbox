<?php

acf_register_block_type([
    'name' => 'faq',
    'title' => __('FAQ'),
    'description' => __('A collapsible FAQ section'),
    'render_template' => 'blocks/faq/faq.php',
    'category' => 'formatting',
    'icon' => 'editor-help',
    'keywords' => ['faq', 'questions', 'answers'],
    'supports' => [
        'align' => true,
        'mode' => true,
        'jsx' => true
    ],
    'enqueue_assets' => function () {
        $path = '/blocks/faq/faq.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_script('faq-block', $file, array('jquery'), $version, true);

        $path = '/assets/css/blocks/faq/faq.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('faq-block', $file, array(), $version);
    },
]);
