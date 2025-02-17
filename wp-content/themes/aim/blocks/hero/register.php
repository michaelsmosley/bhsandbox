<?php

acf_register_block_type([
    "name" => "hero",
    "title" => __("Hero"),
    "description" => __("A custom hero block."),
    "render_template" => "blocks/hero/hero.php",
    "category" => "formatting",
    "icon" => "admin-comments",
    "keywords" => ["hero", "banner"],
    "supports" => [
        "mode" => true,
        "align" => false, // Disable alignment options
    ],
]);

function aim_hero_enqueue_styles()
{
    $path = '/assets/css/blocks/hero/hero.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('hero-block', $file, array(), $version);
}
add_action('wp_enqueue_scripts', 'aim_hero_enqueue_styles');
add_action('enqueue_block_editor_assets', 'aim_hero_enqueue_styles');