<?php
    // Get block configuration
    $categories = get_field('categories') ?: [];
    $tags = get_field('tags') ?: [];
    $max_events = get_field('max_events') ?: 6;

    // Build query args
    $args = [
        'post_type' => 'event',
        'posts_per_page' => $max_events,
        'orderby' => 'meta_value',
        'meta_key' => 'event_start_date',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'event_start_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            ]
        ]
    ];

    // Add taxonomy queries if specified
    if (!empty($categories)) {
        $args['tax_query'][] = [
            'taxonomy' => 'event_category',
            'field' => 'id',
            'terms' => $categories,
            'operator' => 'IN'
        ];
    }

    if (!empty($tags)) {
        $args['tax_query'][] = [
            'taxonomy' => 'event_tag',
            'field' => 'id',
            'terms' => $tags,
            'operator' => 'IN'
        ];
    }

    // If multiple taxonomies, specify the relationship
    if (!empty($categories) && !empty($tags)) {
        $args['tax_query']['relation'] = 'AND';
    }

    $events_query = new WP_Query($args);

    // Add unique ID for the block
    $id = 'events-grid-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className"
    $className = 'events-grid-block';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="events-grid__column">
            <div class="events-grid__container">
                <?php if ($events_query->have_posts()): ?>
                    <?php while ($events_query->have_posts()):
                        $events_query->the_post();
                        $event_meta = get_post_meta(get_the_ID(), '', false);
                        $location = $event_meta['event_location'][0];
                        $start_date = $event_meta['event_start_date'][0];
                        $end_date = $event_meta['event_end_date'][0];
                        ?>
                        <article class="event-card">
                            <?php $event_url = get_field('event_url'); ?>
                            <a href="<?php echo esc_url($event_url ? $event_url : get_permalink()); ?>"
                                class="event-card__link">
                                <div class="event-card__content">
                                    <div class="event-card__header">
                                        <div class="event-card__date">
                                            <?php
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

                                    <h2 class="event-card__title">
                                        <?php the_title(); ?>
                                    </h2>

                                    <div class="event-card__details">
                                        <?php if ($location): ?>
                                            <div class="event-card__location">
                                                <?php echo esc_html($location); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($start_date && $end_date): ?>
                                            <div class="event-card__time">
                                                <?php
                                                if ($start_date instanceof DateTime) {
                                                    $start_time = $start_date->format('g:i');
                                                } else {
                                                    $start_time = date("g:i", strtotime($start_date));
                                                }

                                                if ($end_date instanceof DateTime) {
                                                    $end_time = $end_date->format('g:iA');
                                                } else {
                                                    $end_time = date("g:iA", strtotime($end_date));
                                                }

                                                echo esc_html($start_time . '-' . $end_time);
                                                ?>
                                            </div>
                                        <?php endif; ?>
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
                    <p>No events found.</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>