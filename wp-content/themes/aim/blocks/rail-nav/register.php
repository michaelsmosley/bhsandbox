<?php

acf_register_block_type([
    'name' => 'rail-nav',
    'title' => __('Rail Navigation'),
    'description' => __('A section with side navigation'),
    'category' => 'layout',
    'icon' => 'admin-links',
    'keywords' => ['section', 'nav'],
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true,
        'anchor' => true,
    ],
    'render_template' => 'blocks/rail-nav/rail-nav.php',
    'enqueue_assets' => function () {
        $path = '/blocks/rail-nav/rail-nav.js';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_script('rail-nav-block', $file, array(), $version, true);

        $path = '/assets/css/blocks/rail-nav/rail-nav.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('rail-nav-block', $file, array(), $version);
    },
    'example' => [
        'attributes' => [
            'mode' => 'preview',
            'data' => [
                'navigation_items' => [
                    [
                        'navigation_title' => 'Section 1',
                        'section_id' => 'section-1'
                    ],
                    [
                        'navigation_title' => 'Section 2',
                        'section_id' => 'section-2'
                    ]
                ],
                'innerBlocks' => [
                    [
                        'name' => 'core/heading',
                        'attributes' => [
                            'content' => 'Example Heading',
                            'level' => 2
                        ]
                    ],
                    [
                        'name' => 'core/paragraph',
                        'attributes' => [
                            'content' => 'This is an example paragraph to demonstrate the rail navigation block content.'
                        ]
                    ]
                ]
            ]
        ]
    ]
]);
