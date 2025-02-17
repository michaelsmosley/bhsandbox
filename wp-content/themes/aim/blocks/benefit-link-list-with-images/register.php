<?php

acf_register_block_type([
  "name" => "benefit-link-list-with-images",
  "title" => __("Benefit Link List with Images"),
  "description" => __("A link list with images showing different benefits"),
  "render_template" => "blocks/benefit-link-list-with-images/benefit-link-list-with-images.php",
  "category" => "formatting",
  "icon" => "admin-comments",
  "keywords" => ["benefit", "link", "list", "images"],
  "mode" => "edit",
  "supports" => [
    "mode" => true,
    "align" => false
  ],
  'enqueue_assets' => function () {
    $path = '/assets/css/blocks/benefit-link-list-with-images/benefit-link-list-with-images.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('benefit-link-list-with-images-block', $file, array(), $version);
  },
]);
