<?php
    get_header();
    function calculate_reading_time($content) {
        $words_per_minute = 200;
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / $words_per_minute);
        return sprintf(_n('%d minute', '%d minutes', $reading_time, 'text-domain'), $reading_time);
    }
?>
<div class="aim__bg"></div>
<div class="aim__blog">
        <?php require_once get_template_directory() . '/components/articles/header.php'; ?>
        <main class="aim__blog__main">
           <?php require_once get_template_directory() . '/components/articles/sidebar.php'; ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="aim__blog__articles">
                    <?php require_once get_template_directory() . '/components/articles/list.php'; ?>
                </article>
            <?php endwhile; else: ?>
            <div class="aim__blog__articles__empty">
                <p>No articles found. Try another search term.</p>
                    <button
                      type="button"
                      class="btn btn-primary btn-primary-large"
                    >
                      <span class="body-m">Browse Latest Articles</span> <?php require get_template_directory() . '/assets/icons/arrow-top-right-black.svg'; ?>
                  </button>
            </div>
            <?php endif;?>
        </main>
        <?php require_once get_template_directory() . '/components/articles/footer.php'; ?>

</div>

<?php get_footer(); ?>

