<?php

acf_register_block_type([
    "name" => "logo-marquee",
    "title" => __("Logo Marquee"),
    "description" => __("A right to left animating logo marquee block."),
    "render_template" => "blocks/logo-marquee/logo-marquee.php",
    "category" => "formatting",
    "icon" => "images-alt2",
    "keywords" => ["logo", "marquee", "slider"],
    "mode" => "edit",
    "supports" => [
        "mode" => true,
        "align" => false, // Disable alignment options
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/logo-marquee/logo-marquee.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('logo-marquee-block', $file, array(), $version);
    },
]);
