<?php

/**
 * Register Benefits Text List Block
 */

acf_register_block_type([
  'name'              => 'benefits-text-list',
  'title'            => __('Benefits Text List', 'aim'),
  'description'      => __('A block to display benefits in a text list format', 'aim'),
  'category'          => 'aim-blocks',
  'icon'              => 'grid-view',
  'keywords'          => ['benefits', 'list', 'text'],
  'render_template'   => 'blocks/benefits-text-list/benefits-text-list.php',
  "supports" => [
    "align" => false,
    'mode' => true,
    "jsx" => true,
  ],
]);

function aim_benefits_text_list_enqueue_assets()
{
  // Enqueue CSS
  $css_path = '/assets/css/blocks/benefits-text-list/benefits-text-list.css';
  $css_file = get_template_directory_uri() . $css_path;
  $css_version = filemtime(get_template_directory() . $css_path);
  wp_enqueue_style('benefits-text-list-block', $css_file, array(), $css_version);

  // Enqueue JS
  $js_path = '/blocks/benefits-text-list/benefits-text-list.js';
  $js_file = get_template_directory_uri() . $js_path;
  $js_version = filemtime(get_template_directory() . $js_path);
  wp_enqueue_script('benefits-text-list-block', $js_file, array(), $js_version, true);
}

add_action('wp_enqueue_scripts', 'aim_benefits_text_list_enqueue_assets');
add_action('enqueue_block_editor_assets', 'aim_benefits_text_list_enqueue_assets');
