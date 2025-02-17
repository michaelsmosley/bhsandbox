<?php

acf_register_block_type([
    "name" => "Partner",
    "title" => __("Partner"),
    "description" => __("A custom partner block."),
    "render_template" => "blocks/partner/partner.php",
    "category" => "formatting",
    "icon" => "admin-comments",
    "edit" => true,
    "keywords" => ["partner","partnership"],
    "supports" => [
        "mode" => true,
        "align" => false,
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

        $path = '/blocks/partner/partner.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);
        wp_enqueue_script('partner-block-js', $file, array(), $version, true);

        wp_enqueue_script('video-block', $file, array(), $version, true);
        $path = '/assets/css/blocks/partner/partner.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('partner-block', $file, array(), $version);
    }
]);

