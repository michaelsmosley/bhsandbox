<?php

acf_register_block_type([
    "name" => "resources-list",
    "title" => __("Resources List"),
    "description" => __("A custom resources list block with two columns"),
    "render_template" => "blocks/resources-list/resources-list.php",
    "category" => "formatting",
    "icon" => "list-view",
    "keywords" => ["resources", "list", "columns"],
    "supports" => [
        "align" => false,
        'mode' => true,
        "jsx" => true,
    ],
    "example" => [
        "attributes" => [
            "mode" => "preview",
            "data" => [
                "headline" => "Resources List",
                "body_copy" => "Sample body copy text",
                "column_a" => [
                    [
                        "text" => "Sample resource item"
                    ]
                ]
            ]
        ]
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/resources-list/resources-list.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('resources-list-block', $file, array(), $version);
    },
]);
