<?php

acf_register_block_type(array(
  'name'              => 'program-card',
  'title'            => __('Program Card'),
  'description'      => __('A card displaying program information with image and details'),
  'render_template'  => 'blocks/program-card/program-card.php',
  'category'         => 'formatting',
  'icon'             => 'welcome-learn-more',
  'keywords'         => array('program', 'card', 'education'),
  'supports'         => array(
    'align' => false,
    'mode' => true,
  ),
  'enqueue_assets' => function () {

    $path = '/assets/css/blocks/program-card/program-card.css';
    $file = get_template_directory_uri() . $path;
    $version = filemtime(get_template_directory() . $path);

    wp_enqueue_style('program-card-block', $file, array(), $version);


    // wp_enqueue_style('program-card-block', get_template_directory_uri() . '/blocks/program-card/program-card.css', array(), '1.0.0');
  },
));
