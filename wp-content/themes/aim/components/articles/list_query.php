<?php
function get_posts_query( $paged = 1 ) {
    $tag_id      = isset($_GET['tags']) ? intval($_GET['tags']) : 0;
    $category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
    $search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    $tax_query   = array( 'relation' => 'AND' );

    // Add tag filter if tag_id is set
    if ( $tag_id ) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        );
    }

    // Add category filter if category_id is set
    if ( $category_id ) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $category_id,
        );
    }

    // Build the main query
    $args = array(
        'posts_per_page' => 8,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'tax_query'      => $tax_query,

        // We include all posts, but use meta_query so we can sort featured vs non-featured
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'featured_post',
                'compare' => 'EXISTS',
            ),
            array(
                'key'     => 'featured_post',
                'compare' => 'NOT EXISTS',
            ),
        ),

        // Sort so that featured posts appear first, then by date descending
        // 'meta_key' is the meta field by which 'orderby' will look at 'meta_value'
        'meta_key' => 'featured_post',
        'orderby'  => array(
            'meta_value' => 'DESC', // posts with a value in featured_post come first
            'date'       => 'DESC',
        ),
        'order'    => 'DESC',
    );

    $query = new WP_Query( $args );

    // Remove any duplicates from the final result
    $unique_posts = array();
    $used_ids     = array();

    foreach ( $query->posts as $post ) {
        if ( ! in_array( $post->ID, $used_ids, true ) ) {
            $used_ids[]     = $post->ID;
            $unique_posts[] = $post;
        }
    }

    // Overwrite the original array and update the post count
    $query->posts      = $unique_posts;
    $query->post_count = count( $unique_posts );

    return $query;
}
?>
