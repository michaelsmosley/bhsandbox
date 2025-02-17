<?php

// increase image size upload limit
add_filter("upload_size_limit", "wpse_228300_change_upload_size");
function wpse_228300_change_upload_size()
{
    return 10 * 1024 * 1024; // 10MB in bytes
}

// Include blocks registration
require_once get_stylesheet_directory() . "/inc/acf-blocks.php";

// Include image functions
require_once get_stylesheet_directory() . '/inc/image-functions.php';

// Include post type registration
require_once get_stylesheet_directory() . "/inc/post-types.php";

// Include modal template
require_once get_template_directory() . '/inc/modals/contact-modal.php';
require_once get_template_directory() . '/inc/modals/partner-with-us-modal.php';

// Basic theme setup
function aim_setup()
{
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    add_theme_support("wp-block-styles");
}
add_action("after_setup_theme", "aim_setup");

require_once get_template_directory() . '/inc/footer-admin.php';

function register_footer_menus()
{
    register_nav_menus([
        'header-menu' => __('Header Menu'),
        'header-cta-menu' => __('Header CTA Menu'),
        'footer-cta-menu' => __('Footer CTA Menu'),
        'footer-social-media-menu' => __('Footer Social Media Menu'),
        'footer-legal-menu' => __('Footer Legal Menu'),
        'footer-menu' => __('Footer Menu'),
    ]);
}
add_action('init', 'register_footer_menus');

class Separate_Parent_Child_Walker extends Walker_Nav_Menu
{
    public $parent_items = []; // To store parent items
    public $child_items = [];  // To store child items

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        // Separate parents and children based on depth
        if ($depth === 0) {
            $this->parent_items[] = $item; // Store parent items
        } else {
            $this->child_items[] = $item; // Store child items
        }
    }
}
function aim_enqueue_styles()
{
    wp_enqueue_style(
        'aim-lqip-styles',
        get_template_directory_uri() . '/assets/css/lqip.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/lqip.css')
    );
    wp_enqueue_style(
        'aim-styles',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );
}
add_action('wp_enqueue_scripts', 'aim_enqueue_styles');

/**
 * Modify the main query for event tag filtering
 */
function aim_filter_events_by_tags($query)
{
    // Only modify the main query on the event archive page or event taxonomies
    if (
        !is_admin() && $query->is_main_query() &&
        (is_post_type_archive('event') || is_tax('event_category') || is_tax('event_tag'))
    ) {
        // Add sorting by event start date
        $query->set('meta_key', 'event_start_date');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'ASC');

        $tax_query = array('relation' => 'AND');

        // Handle category filtering
        if (is_tax('event_category')) {
            $tax_query[] = array(
                'taxonomy' => 'event_category',
                'field' => 'term_id',
                'terms' => get_queried_object_id(),
            );
        }

        // Handle tag filtering
        $url_tags = isset($_GET['tags']) && !empty($_GET['tags']) ? explode(',', $_GET['tags']) : array();
        $archive_tag = is_tax('event_tag') ? get_queried_object()->slug : '';
        $all_tags = array_unique(array_merge($url_tags, $archive_tag ? array($archive_tag) : array()));

        if (!empty($all_tags)) {
            $tax_query[] = array(
                'taxonomy' => 'event_tag',
                'field' => 'slug',
                'terms' => $all_tags,
                'operator' => 'AND'
            );
        }

        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'aim_filter_events_by_tags');

// Enqueue modal scripts and styles
function aim_enqueue_modal_assets()
{
    wp_enqueue_script(
        'aim-modal',
        get_template_directory_uri() . '/assets/js/components/modal.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'aim_enqueue_modal_assets');

function aim_admin_css()
{
    wp_enqueue_style(
        'aim-lqip-styles',
        get_template_directory_uri() . '/assets/css/lqip.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/lqip.css')
    );

    // Make Gutenberg full width
    echo <<<EOF
    <style type="text/css">
        /* Main column width */
        .wp-block {
            max-width: 100%;
        }

        /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
            max-width: 1080px;
        }

        /* Width of "full-wide" blocks */
        .wp-block[data-align="full"] {
            max-width: none;
        }
    </style>
    EOF;
}
add_action('enqueue_block_editor_assets', 'aim_admin_css');

function generate_breadcrumbs() {
    global $post;

    $icon = file_get_contents(get_template_directory() . "/assets/icons/chevron-right-black.svg");
    $breadcrumbs = '<nav class="aim__breadcrumbs">';
    $breadcrumbs .= '<a href="' . home_url() . '">Home</a> ' . $icon . ' ';

    if (is_category()) {
        $blog_page_id = get_option('page_for_posts');
        if ($blog_page_id) {
            $breadcrumbs .= '<a href="' . get_permalink($blog_page_id) . '">Blog</a> ' . $icon . ' ';
        }

        $current_category = get_queried_object();
        $breadcrumbs .= get_category_parents($current_category, true, ' ' . $icon . ' ');
    } elseif (is_single()) {
        $blog_page_id = get_option('page_for_posts');
        if ($blog_page_id) {
            $breadcrumbs .= '<a href="' . get_permalink($blog_page_id) . '">Blog</a> ' . $icon . ' ';
        }

        $breadcrumbs .= '<span>' . get_the_title() . '</span>';
    } elseif (is_page() && !is_front_page()) {
        $parent_id  = $post->post_parent;
        $breadcrumbs_array = [];
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs_array[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs_array = array_reverse($breadcrumbs_array);
        $breadcrumbs .= implode(' ' . $icon . ' ', $breadcrumbs_array);
        $breadcrumbs .= ' ' . $icon . ' <a href="' . get_permalink($page->ID) . '">' . get_the_title() . '</a>';
    } elseif (is_home()) {
        $breadcrumbs .= '<a href="/blog">Blog</a>';
    }

    $breadcrumbs .= '</nav>';
    echo $breadcrumbs;
}


function aim_enqueue_scripts() {
    wp_enqueue_script(
        'aim-filter-posts',
        get_template_directory_uri() . '/components/articles/filter-posts.js',
        array(), // dependencies
        filemtime(get_template_directory() . '/components/articles/filter-posts.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'aim_enqueue_scripts');


// 2. Hook into pre_get_posts to filter the main query by categories and tags
function mytheme_filter_main_query( $query ) {
    // Only modify front-end main query, not admin
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    // Check for categories param: "?categories=12,34"
    if ( isset( $_GET['categories'] ) && ! empty( $_GET['categories'] ) ) {
        $cat_ids = array_map( 'absint', explode( ',', $_GET['categories'] ) );
    } else {
        $cat_ids = array();
    }

    // Check for tags param: "?tags=56,78"
    if ( isset( $_GET['tags'] ) && ! empty( $_GET['tags'] ) ) {
        $tag_ids = array_map( 'absint', explode( ',', $_GET['tags'] ) );
    } else {
        $tag_ids = array();
    }

    // Build tax_query
    $tax_query = array( 'relation' => 'AND' );

    if ( ! empty( $cat_ids ) ) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $cat_ids,
            'operator' => 'IN',
        );
    }

    if ( ! empty( $tag_ids ) ) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_ids,
            'operator' => 'IN',
        );
    }

    if ( count( $tax_query ) > 1 ) {
        $query->set( 'tax_query', $tax_query );
    }

    if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) {
        $query->set( 's', sanitize_text_field( $_GET['s'] ) );
    }
}
add_action( 'pre_get_posts', 'mytheme_filter_main_query' );

function has_block_in_page_content($page_id, $block_name) {
    $content = get_post_field('post_content', $page_id);
    $blocks = parse_blocks($content);
    $is_first = false;

    foreach ($blocks as $index => $block) {
        if (isset($block['blockName']) && $block['blockName'] === $block_name) {
            // Check if it's the first block
            $is_first = ($index === 0);
            return [
                'exists' => true,
                'is_first' => $is_first,
            ];
        }
    }

    return [
        'exists' => false,
        'is_first' => false,
    ];
}

function mergeQueryParams($url, $params) {
    $parsedUrl = parse_url($url);

    $existingParams = [];
    if (!empty($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $existingParams);
    }

    $mergedParams = array_merge($existingParams, $params);
    $newQuery = http_build_query($mergedParams);

    return (isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '') .
           (isset($parsedUrl['host']) ? $parsedUrl['host'] : '') .
           (isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '') .
           (isset($parsedUrl['path']) ? $parsedUrl['path'] : '') .
           (!empty($newQuery) ? '?' . $newQuery : '') .
           (isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '');
}