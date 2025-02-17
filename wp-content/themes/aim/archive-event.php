<?php get_header(); ?>
<main class="aim__main aim__main--spacing">
    <div class="events-archive">
        <h1>
            <?php
            // Show category name if viewing a category archive, otherwise show "Events"
            if (is_tax('event_category')) {
                single_term_title();
            } else {
                echo 'Events';
            }
            ?>
        </h1>
        <div class="events-search">
            <form role="search" method="get" class="events-search__form" action="<?php echo esc_url(home_url('/')); ?>">
                <?php include get_template_directory() . '/assets/icons/search-maginifier-black.svg'; ?>
                <div class="events-search__field-container">
                    <input type="search" class="events-search__field" placeholder="Search"
                        value="<?php echo get_search_query(); ?>" name="s" />
                </div>
                <input type="hidden" name="post_type" value="event" />
            </form>
        </div>
        <div class="container">
            <aside class="events-aside">
                <div class="events-filters">
                    <div class="events-filters__group">
                        <h6>Categories</h6>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'event_category',
                            'hide_empty' => true,
                        ));
                        if ($categories):
                            ?>
                            <ul class="events-filters__list">
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                        <a href="<?php echo get_term_link($category); ?>" class="events-filters__item">
                                            <?php echo $category->name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="events-filters__group">
                        <h6>Popular Tags</h6>
                        <?php
                        $tags = get_terms(array(
                            'taxonomy' => 'event_tag',
                            'hide_empty' => false,
                        ));
                        if ($tags):
                            // Get current category if we're on a category archive
                            $current_category = is_tax('event_category') ? get_queried_object() : null;

                            // Get current tag if we're on a tag archive
                            $current_archive_tag = is_tax('event_tag') ? get_queried_object()->slug : '';

                            // Modify how we get current tags to include archive tag
                            $url_tags = isset($_GET['tags']) && !empty($_GET['tags']) ? explode(',', $_GET['tags']) : array();
                            $current_tags = array_unique(array_merge($url_tags, $current_archive_tag ? array($current_archive_tag) : array()));
                            ?>
                            <ul class="events-filters__list">
                                <?php foreach ($tags as $tag):
                                    $is_selected = in_array($tag->slug, $current_tags);

                                    if ($is_selected) {
                                        // Remove this tag from selection
                                        $new_tags = array_diff($current_tags, array($tag->slug));
                                    } else {
                                        // Add this tag to selection
                                        $new_tags = array_merge($current_tags, array($tag->slug));
                                    }

                                    // Build URL with updated tags
                                    if ($current_category) {
                                        // If we're on a category page, link to the category archive
                                        $base_url = get_term_link($current_category);
                                    } else {
                                        // Otherwise link to main events archive
                                        $base_url = get_post_type_archive_link('event');
                                    }

                                    if (empty($new_tags)) {
                                        $tag_url = remove_query_arg('tags', $base_url);
                                    } else {
                                        $tag_url = add_query_arg('tags', implode(',', $new_tags), $base_url);
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($tag_url); ?>"
                                            class="events-filters__item<?php echo $is_selected ? ' events-filters__item--selected' : ''; ?>">
                                            <?php echo $tag->name; ?>

                                            <?php if ($is_selected): ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/x-icon-orange.svg" />
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if($current_tags): ?>
                        <a
                            href="/events"
                            class="events__reset-filter btn btn-primary btn-primary-small"
                        >
                            Reset
                        </a>
                    <?php endif; ?>
                </div>
            </aside>

            <div class="events-grid__column">
                <div class="events-grid__container">
                    <?php
                    // Modify the main query
                    global $wp_query;
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    // Get current tags from URL
                    $current_archive_tag = is_tax('event_tag') ? get_queried_object()->slug : '';
                    $url_tags = isset($_GET['tags']) && !empty($_GET['tags']) ? explode(',', $_GET['tags']) : array();
                    $current_tags = array_unique(array_merge($url_tags, $current_archive_tag ? array($current_archive_tag) : array()));

                    $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => 7,
                        'paged' => $paged,
                        'meta_key' => 'event_start_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'event_start_date',
                                'value' => date('Y-m-d H:i:s'),
                                'compare' => '>=',
                                'type' => 'DATETIME'
                            )
                        )
                    );

                    // Initialize tax_query as an array
                    $tax_query = array();

                    // Add category filtering if we're on a category archive
                    if (is_tax('event_category')) {
                        $tax_query[] = array(
                            'taxonomy' => 'event_category',
                            'field' => 'term_id',
                            'terms' => get_queried_object_id()
                        );
                    }

                    // Add tag filtering if tags are selected
                    if (!empty($current_tags)) {
                        $tax_query[] = array(
                            'taxonomy' => 'event_tag',
                            'field' => 'slug',
                            'terms' => $current_tags,
                            'operator' => 'IN'
                        );
                    }

                    // Add tax_query to args if we have any taxonomy conditions
                    if (!empty($tax_query)) {
                        // If we have multiple tax queries, we want posts that match ALL conditions
                        if (count($tax_query) > 1) {
                            $tax_query['relation'] = 'AND';
                        }
                        $args['tax_query'] = $tax_query;
                    }

                    $wp_query = new WP_Query($args);

                    if (have_posts()):
                        $post_count = 0;
                        while (have_posts()):
                            the_post();
                            $post_count++;
                            ?>
                            <article class="event-card <?php echo $post_count === 1 ? 'event-card--featured' : ''; ?>">
                                <?php $event_url = get_field('event_url'); ?>
                                <a href="<?php echo esc_url($event_url ? $event_url : get_permalink()); ?>"
                                    class="event-card__link">
                                    <div class="event-card__content">
                                        <div class="event-card__header">
                                            <div class="event-card__date">
                                                <?php
                                                $start_date = get_field('event_start_date');
                                                if ($start_date) {
                                                    $start = new DateTime($start_date);
                                                    ?>
                                                    <span class="event-card__month"><?php echo $start->format('F'); ?></span>
                                                    <span class="event-card__day"><?php echo $start->format('j'); ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                            <div class="event-reserve-container">
                                                <span class="reserve-button--desktop">
                                                    Reserve your spot now
                                                    <img
                                                        src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-top-right-black.svg" />
                                                </span>
                                            </div>
                                        </div>

                                        <div class="event-card__bottom-section">
                                            <h2 class="event-card__title">
                                                <?php the_title(); ?>
                                            </h2>
                                            <?php
                                                $location = get_field('event_location');
                                                $start_date = get_field('event_start_date');
                                                $end_date = get_field('event_end_date');
                                            ?>
                                            <div class="event-card__details">
                                                <?php if ($location): ?>
                                                    <div class="event-card__location">
                                                        <?php echo esc_html($location); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($start_date && $end_date): ?>
                                                    <div class="event-card__time">
                                                        <?php
                                                        $start = date("g:i", strtotime($start_date));
                                                        $end = date("g:iA", strtotime($end_date));
                                                        echo esc_html($start . '-' . $end);
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="event-card__image">
                                                <?php echo get_responsive_image(get_the_post_thumbnail_url(), 555, 214, array(
                                                    'format' => 'jpg',
                                                    'quality' => 90
                                                )); ?>
                                            </div>
                                        <?php endif; ?>

                                        <span class="reserve-button--mobile">
                                            <span>Reserve your spot now</span>
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-top-right-black.svg" />
                                        </span>
                                    </div>
                                </a>
                            </article>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No upcoming events found.</p>
                    <?php endif; ?>
                </div>

                <div class="events-pagination">
                    <span
                        class="events-pagination__pages"><?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?>
                        <span class="events-pagination__total">/ <?php echo $wp_query->max_num_pages; ?></span></span>
                    <div class="events-pagination__links">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => file_get_contents(get_template_directory() . '/assets/icons/chevron-left-black.svg'),
                            'next_text' => file_get_contents(get_template_directory() . '/assets/icons/chevron-right-black.svg')
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $page = get_page_by_path('events');
        $page_id = $page ? $page->ID : null;
        $content_post = get_post($page_id);
        $content = apply_filters('the_content', $content_post->post_content);

        echo $content;

        if (have_posts()):
            while (have_posts()):
                the_post();
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php get_footer(); ?>