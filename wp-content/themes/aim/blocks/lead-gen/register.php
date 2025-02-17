<?php

acf_register_block_type([
    'name' => 'lead-gen',
    'title' => __('Lead Gen'),
    'description' => __('A dual lead generation component with hover effects.'),
    'render_template' => 'blocks/lead-gen/lead-gen.php',
    'category' => 'formatting',
    'icon' => 'admin-users',
    'keywords' => ['lead', 'generation', 'cta'],
    'mode' => 'preview',
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true
    ],
    'example' => [
        'attributes' => [
            'mode' => 'preview',
            'data' => [
                'quiz_section' => [
                    'headline' => 'Take Our Career Readiness Quiz',
                    'body' => 'Going back to school can be a big decision. Take our quiz to identify goals, potential strengths and important facts about your career.',
                    'cta' => 'Start Quiz',
                    'link' => '#'
                ],
                'info_section' => [
                    'headline' => 'Request More Information About AIM',
                    'body' => 'Going back to school can be a big decision. Let us help you identify your goals and make an informed decision about your future.',
                    'cta' => 'Learn More',
                    'link' => '#'
                ]
            ]
        ]
    ],
    'enqueue_assets' => function () {
        $path = '/assets/css/blocks/lead-gen/lead-gen.css';
        $file = get_template_directory_uri() . $path;
        $version = filemtime(get_template_directory() . $path);

        wp_enqueue_style('lead-gen-block', $file, array(), $version);
    },
]);
