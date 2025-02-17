<?php

acf_register_block_type([
  "name" => "benefit-card",
  "title" => __("Benefit Card"),
  "description" => __("A benefit card block."),
  "render_template" => "blocks/benefit-card/benefit-card.php",
  "category" => "formatting",
  "icon" => "images-alt2",
  "keywords" => ["benefit", "card"],
  "mode" => "edit",
  "supports" => [
    "mode" => true,
    "align" => false, // Disable alignment options
  ],
  'enqueue_assets' => function () {
    $path = '/assets/css/blocks/benefit-card/benefit-card.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('benefit-card-block', $file, array(), $version);
  },
]);
