<?php
acf_register_block_type([
    'name' => 'testimonials',
    'title' => __('Testimonials'),
    'description' => __('A grid display of Testimonials'),
    'category' => 'aim-blocks',
    'icon' => 'dashicons-format-quote',
    'keywords' => ['testimonials'],
    'mode' => 'edit',
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true
    ],
    'render_template' => 'blocks/testimonials/testimonials.php',
    'enqueue_assets' => function () {
        wp_enqueue_script('testimonials-js', get_template_directory_uri() . '/blocks/testimonials/testimonials.js');
        wp_enqueue_style('testimonials', get_template_directory_uri() . '/assets/css/blocks/testimonials/testimonials.css');
    }
]);