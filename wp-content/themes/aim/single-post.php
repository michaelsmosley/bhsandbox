<?php get_header(); ?>
<?php
    function calculate_reading_time($content) {
        $words_per_minute = 200;
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / $words_per_minute);
        return sprintf(_n('%d minute', '%d minutes', $reading_time, 'text-domain'), $reading_time);
    }
?>
<div class="aim__bg"></div>
<div class="aim__blog aim__blog--spacing-post">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php require_once get_template_directory() . '/components/single_article/header.php'; ?>
        <main class="aim__blog__main">
            <div></div>
            <article class="aim__blog__article">
                <?php the_content(); ?>
            </article>
        </main>
        <?php require_once get_template_directory() . '/components/single_article/footer.php'; ?>
    <?php endwhile; else : ?>
        <p><?php esc_html_e('No posts found.', 'text-domain'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>