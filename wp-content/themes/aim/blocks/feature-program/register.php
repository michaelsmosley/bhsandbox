<?php

acf_register_block_type(array(
  'name'              => 'feature-program',
  'title'             => __('Feature Program'),
  'description'       => __('A block to feature an academic program.'),
  'render_template'   => 'blocks/feature-program/feature-program.php',
  'category'          => 'formatting',
  'icon'              => 'welcome-learn-more',
  'keywords'          => array('program', 'feature', 'academic'),
  'supports'          => array(
    'align' => false,
    'mode' => true,
    'jsx' => true
  ),
  'enqueue_assets' => function () {
    $path = '/assets/css/blocks/feature-program/feature-program.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('feature-program-block', $file, array(), $version);
  },
));
