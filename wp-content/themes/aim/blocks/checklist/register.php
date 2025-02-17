<?php

acf_register_block_type([
    "name" => "checklist",
    "title" => __("Checklist"),
    "description" => __("A custom checklist block with two columns"),
    "render_template" => "blocks/checklist/checklist.php",
    "category" => "formatting",
    "icon" => "list-view",
    "keywords" => ["checklist", "columns"],
    "supports" => [
        "align" => false,
        'mode' => true,
        "jsx" => true,
    ],
    "example" => [
        "attributes" => [
            "mode" => "preview",
            "data" => [
                "headline" => "Checklist",
                "body_copy" => "Sample body copy text",
                "column_a" => [
                    [
                        "text" => "Sample checklist item"
                    ]
                ]
            ]
        ]
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/checklist/checklist.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('checklist-block', $file, array(), $version);
    },
]);
