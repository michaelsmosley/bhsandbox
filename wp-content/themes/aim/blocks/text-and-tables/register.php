<?php

acf_register_block_type([
    "name" => "Text and Tables",
    "title" => __("Text and Tables"),
    "description" => __("A Text and Tables block."),
    "render_template" => "blocks/text-and-tables/text-and-tables.php",
    "category" => "formatting",
    "icon" => "text",
    "edit" => true,
    "keywords" => ["text", "tables", "content"],
    "mode" => "edit",
    "supports" => [
        "mode" => true,
        "align" => false,
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/text-and-tables/text-and-tables.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('text-and-tables-block', $file, array(), $version);
}

]);
