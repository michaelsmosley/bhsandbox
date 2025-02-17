<aside class="aim__blog__articles__content">
    <?php
        require_once 'list_query.php';

        $current_page = max(1, get_query_var('paged'));
        $featured_query = get_posts_query($current_page);
        $total_pages = $wp_query->max_num_pages;

        $iconArrow = file_get_contents(get_template_directory() . "/assets/icons/arrow-top-right-black.svg");
        $iconPrev = file_get_contents(get_template_directory() . "/assets/icons/chevron-left-black.svg");
        $iconNext = file_get_contents(get_template_directory() . "/assets/icons/chevron-right-black.svg");

        if ( $featured_query->have_posts() ) :
            while ( $featured_query->have_posts() ) : $featured_query->the_post();
                $featured_image = get_field('featured_image');
                $featured_post = get_field('featured_post');
            ?>
            <div class="aim__blog__list-item">
                <div class="aim__blog__list-item__image">
                    <?php if ($featured_image): ?>
                            <?= get_responsive_image($featured_image, 250, 250) ?>
                    <?php endif; ?>
                </div>
                <h2 class="aim__blog__list-item__title">
                    <?php if($featured_post == 1): ?>
                    <div class="aim__blog__list-item__featured-badge">Featured Article</div>
                    <?php endif; ?>
                    <?php the_title(); ?>
                </h2>
                <div class="aim__blog__list-item__excerpt">
                    <p><?php echo get_the_excerpt(); ?></p>
                    <div class="aim__blog__list-item__read-more">
                        <a href="<?php the_permalink(); ?>">Read Article</a>
                        <a href="<?php the_permalink(); ?>"><?php echo $iconArrow; ?></a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <div class="aim__blog__articles__pagination-wrapper">
                <div class="aim__blog__articles__page-number">
                    <span><?php echo $current_page; ?><span  class="aim__blog__articles__page-number__total"> / <?php echo $total_pages; ?></span></span>
                </div>
                <div class="aim__blog__articles__pagination">
                    <?php
                        echo paginate_links(array(
                            'base'      => esc_url_raw( add_query_arg( 'paged', '%#%' ) ),
                            'format'    => '',
                            'type'      => 'plain',
                            'current'   => $current_page,
                            'total'     => $total_pages,
                            'prev_text' => $iconPrev,
                            'next_text' => $iconNext,
                        ));
                    ?>
               </div>
           </div>
        <?php endif; ?>
</aside>
