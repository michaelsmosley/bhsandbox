<aside class="aim__blog__side">
        <p class="aim__blog__side__title">Article Details</p>
        <p class="aim__blog__side__info"><span>Author:</span> <?php echo esc_html(get_the_author()); ?></p>
        <p class="aim__blog__side__info"><span>Published on:</span> <?php echo esc_html(get_the_date()); ?></p>
        <p class="aim__blog__side__info"><span>Reading time:</span> <?php echo esc_html(calculate_reading_time(get_the_content())); ?></p>
        <p class="aim__blog__side__info"><span>Category:</span> <?php
        $categories = get_the_category();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">' . esc_html($category->name) . '</a>';
            }
        }
        ?></p>
        <p class="aim__blog__side__info"><span>Share:</span></p>
        <div class="aim__blog__side__buttons">
            <a
                href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                class="btn btn-secondary btn-secondary-small button-s"
                target="_blank"
            >
                Facebook <?php require get_template_directory() . "/assets/icons/arrow-top-right-black.svg"; ?>
            </a>
            <a
                href="https://x.com/intent/tweet?url=<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>&text=<?php echo esc_html(get_the_title()); ?>"
                class="btn btn-secondary btn-secondary-small button-s"
                target="_blank"
            >
                X<?php require get_template_directory() . "/assets/icons/arrow-top-right-black.svg"; ?>
            </a>
            <a
                href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                class="btn btn-secondary btn-secondary-small button-s"
                target="_blank"
            >
                LinkedIn<?php require get_template_directory() . "/assets/icons/arrow-top-right-black.svg"; ?>
            </a>
        </div>
</aside>