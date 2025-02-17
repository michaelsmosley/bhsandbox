<?php

/**
 * Image handling functions
 *
 * @package aim
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


/**
 * Get responsive image URLs using the Simple Image Resizer. Useful for background images.
 * 
 * @param array|string $image ACF image array or image URL
 * @param string $format Output format (jpeg, png, etc)
 * @param int $quality Image quality (1-100)
 * @return array Array of responsive image URLs
 */
function get_responsive_image_urls($image, $format = 'jpeg', $quality = 90)
{
    // Handle both ACF image array and direct URLs
    $image_url = is_array($image) ? $image['url'] : $image;

    // Get relative path
    $parsed_url = parse_url($image_url);
    $relative_path = ltrim($parsed_url['path'], '/');

    return array(
        'lqip' => site_url("/resize-image/{$relative_path}/?w=100&type=jpg&q=20"),
        'mobile' => site_url("/resize-image/{$relative_path}/?w=576&type={$format}&q={$quality}"),
        'tablet' => site_url("/resize-image/{$relative_path}/?w=768&type={$format}&q={$quality}"),
        'laptop' => site_url("/resize-image/{$relative_path}/?w=992&type={$format}&q={$quality}"),
        'desktop' => site_url("/resize-image/{$relative_path}/?w=1200&type={$format}&q={$quality}"),
        'max' => site_url("/resize-image/{$relative_path}/?w=1920&type={$format}&q={$quality}")
    );
}

function get_responsive_image($image, $width, $height, $args = array(), $lqip = true)
{
    // If in admin, don't do lqip
    if (is_admin()) {
        $lqip = false;
    }

    // Check if image is SVG
    if (is_array($image) && isset($image['subtype']) && $image['subtype'] === 'svg+xml') {
        return sprintf(
            '<img src="%s" alt="%s" width="%d" height="%d">',
            esc_url($image['url']),
            esc_attr($image['alt']),
            $width,
            $height
        );
    }

    // Default arguments
    $defaults = array(
        'alt' => '',
        'class' => '',
        'id' => '',
        'format' => 'jpg',
        'quality' => 90,
        'attributes' => array(),
        'lazy' => true,
        'priority' => false,
        'object_fit' => 'cover',
        'container_class' => ''
    );

    // Merge defaults with provided args
    $args = wp_parse_args($args, $defaults);

    // Get image URL and path
    $image_url = is_array($image) ? $image['url'] : $image;
    $parsed_url = parse_url($image_url);
    $relative_path = ltrim($parsed_url['path'], '/');

    // Base resize URL without dimensions
    $base_resize_url = site_url("/resize-image/{$relative_path}/");

    // LQIP version always uses small dimensions but maintains aspect ratio
    $lqip_width = 100;
    $lqip_height = round(($lqip_width * $height) / $width);
    $lqip_url = $base_resize_url . "w={$lqip_width},h={$lqip_height},type=jpg,q=20/";
    $non_lqip_url = site_url("/resize-image/{$relative_path}/w={$width},h={$height},q={$args['quality']},type={$args['format']}/");

    // If image is ACF array, get alt text if not provided
    if (is_array($image) && empty($args['alt']) && !empty($image['alt'])) {
        $args['alt'] = $image['alt'];
    }

    // Build additional attributes string
    $extra_attributes = '';
    foreach ($args['attributes'] as $attr => $value) {
        $extra_attributes .= sprintf(' %s="%s"', esc_attr($attr), esc_attr($value));
    }

    // Add lqip class if enabled
    if ($lqip) {
        $args['container_class'] .= $args['container_class'] . ' lqip-image';
    } else {
        $args['container_class'] .= $args['container_class'] . ' non-lqip-image';
    }

    // Handle priority loading
    $loading_attr = '';
    if ($args['priority']) {
        $loading_attr = ' fetchpriority="high"';
    } else if ($args['lazy']) {
        $loading_attr = ' loading="lazy"';
    }

    // Output img tag with data attributes for JavaScript
    return sprintf(
        '<div class="%s"><img src="%s" alt="%s"%s%s%s data-src="%s" data-format="%s" data-quality="%s" width="%d" height="%d" %s></div>',
        $args['container_class'],
        $lqip ? $lqip_url : $non_lqip_url,
        esc_attr($args['alt']),
        !empty($args['class']) ? ' class="' . esc_attr($args['class']) . '"' : '',
        !empty($args['id']) ? ' id="' . esc_attr($args['id']) . '"' : '',
        !empty($extra_attributes) ? $extra_attributes : '',
        esc_url($base_resize_url),
        esc_attr($args['format']),
        esc_attr($args['quality']),
        $width,
        $height,
        esc_attr($args['object_fit']),
        $loading_attr
    );
}

function aim_image_function_enqueue_scripts()
{
    if (!is_admin()) {
        wp_enqueue_script(
            'aim-lqip',
            get_template_directory_uri() . '/assets/js/lqip.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/lqip.js')
        );
    }
}
add_action('wp_enqueue_scripts', 'aim_image_function_enqueue_scripts');
