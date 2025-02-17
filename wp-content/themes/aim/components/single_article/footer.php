<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post__not_in'   => array(get_the_ID()),
);

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <p class="aim__blog__recent-posts__more">More Articles</p>
    <div class="aim__blog__recent-posts">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="aim__blog__recent-posts__post">
                <div class="aim__blog__recent-posts__post__category-group">
                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                echo '<a class="aim__blog__recent-posts__post__category" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                            }
                        } else {
                            echo '<span>Uncategorized</span>';
                        }
                    ?>
                </div>
                <h2 class="aim__blog__recent-posts__post__title"><?php the_title(); ?></h2>
                <p class="aim__blog__recent-posts__post__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                    <a class="aim__blog__recent-posts__post__read" href="<?php the_permalink(); ?>"><span>Read Article</span><?php require get_template_directory() . "/assets/icons/arrow-top-right-black.svg"; ?></a>
                        <?php
                            $featured_image = get_field("featured_image");
                            echo get_responsive_image($featured_image, 200, 100, 'medium');
                        ?>
                </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>