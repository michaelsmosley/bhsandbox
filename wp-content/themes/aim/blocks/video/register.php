<?php

acf_register_block_type([
    'name' => 'video',
    'title' => __('Styled Video'),
    'description' => __('A custom video component block.'),
    'render_template' => 'blocks/video/video.php',
    'category' => 'formatting',
    'icon' => 'video-alt3',
    'keywords' => ['video', 'media'],
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true
    ],
    'enqueue_assets' => function () {
        $path = '/blocks/video/video.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_script('video-block', $file, array(), $version, true);

        $path = '/assets/css/blocks/video/video.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('video-block', $file, array(), $version);
    },
]);
