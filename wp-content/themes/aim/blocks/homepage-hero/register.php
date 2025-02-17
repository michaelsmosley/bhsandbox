<?php

acf_register_block_type([
    "name" => "Homepage Hero",
    "title" => __("Homepage Hero"),
    "description" => __("A custom homepage-hero block."),
    "render_template" => "blocks/homepage-hero/homepage-hero.php",
    "category" => "formatting",
    "icon" => "admin-comments",
    "edit" => true,
    "keywords" => ["homepage-hero", "banner"],
    "supports" => [
        "mode" => true,
        "align" => false,
    ],
]);

function aim_homepage_hero_enqueue_styles()
{
    $path = '/assets/css/blocks/homepage-hero/homepage-hero.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('homepage-hero-block', $file, array(), $version);
}
add_action('wp_enqueue_scripts', 'aim_homepage_hero_enqueue_styles');
add_action('enqueue_block_editor_assets', 'aim_homepage_hero_enqueue_styles');