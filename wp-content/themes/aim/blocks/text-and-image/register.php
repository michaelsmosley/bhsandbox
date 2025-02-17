<?php

acf_register_block_type([
    "name" => "Text and Image",
    "title" => __("Text and Image"),
    "description" => __("A Text and Image block."),
    "render_template" => "blocks/text-and-image/text-and-image.php",
    "category" => "formatting",
    "icon" => "text",
    "edit" => true,
    "keywords" => ["text", "image", "video", "content"],
    "mode" => "edit",
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


        $path = '/assets/css/blocks/text-and-image/text-and-image.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('text-and-image-block', $file, array(), $version);
}

]);
